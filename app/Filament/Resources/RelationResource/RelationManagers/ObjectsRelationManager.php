<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Models\Employee;
use App\Models\ObjectModel;
use App\Models\ObjectType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class ObjectsRelationManager extends RelationManager
{
    protected static bool $isScopedToTenant = false;
    protected static string $relationship   = 'objects';
    protected static ?string $icon          = 'heroicon-o-user';
    protected static ?string $title         = 'Objecten';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord->objects->count();
    }
    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {

        return in_array('Objecten', $ownerRecord?->type?->options) ? true : false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([
                    Step::make('Hardware informatie')
                        ->schema([

                            Select::make('type_id')
                                ->label('Type')
                                ->options(ObjectType::pluck('name', 'id'))
                                ->reactive()

                                ->required()->afterStateUpdated(function (callable $set) {
                                $set('brand_id', null);
                            }),

                            Select::make('brand_id')
                                ->label('Merk')
                                ->options(function (callable $get) {
                                    $type_id = $get('type_id');

                                    return ObjectModel::query()
                                        ->when($type_id, fn($query) => $query->where('type_id', $type_id))
                                        ->get()
                                        ->groupBy('brand_id')
                                        ->map(fn($group) => $group->first()) // Only one per brand
                                        ->filter(fn($item) => $item->brand)  // Ensure brand exists
                                        ->mapWithKeys(fn($item) => [
                                            $item->brand_id => $item->brand->name,
                                        ])
                                        ->toArray();
                                })
                                ->reactive()
                                ->disabled(fn(callable $get) => ! $get('type_id')),

                            Select::make('model_id')
                                ->label('Model')
                                ->options(function (callable $get) {
                                    $type_id  = $get('type_id');
                                    $brand_id = $get('brand_id');

                                    return ObjectModel::query()
                                        ->when($type_id, fn($query) => $query->where('type_id', $type_id)->where('brand_id', $brand_id))
                                        ->get()
                                        ->mapWithKeys(function ($data) {

                                            return [
                                                $data->id => collect([
                                                    $data->name,

                                                ])->filter()->implode(', '),
                                            ];
                                        })
                                        ->toArray();
                                })
                                ->reactive()
                                ->disabled(fn(callable $get) => ! $get('brand_id')),

                            TextInput::make('name')
                                ->label('Naam'),

                        ])->columns(2),

                    Step::make('Toewijzing')
                        ->schema([

                            TextInput::make('serial_number')
                                ->label('Serienummer'),

                            Select::make('employee_id')
                                ->searchable(['first_name', 'last_name', 'email'])
                                ->options(
                                    Employee::where('relation_id', $this->ownerRecord->id)
                                        ->get()
                                        ->mapWithKeys(fn($employee) => [
                                            $employee->id => "{$employee->first_name} {$employee->last_name}",
                                        ])
                                )
                                ->label('Medewerker'),

                            TextInput::make('uuid')
                                ->label('Uniek id nummer')
                                ->hint('Scan een barcode sticker'),
                        ]),

                    Step::make('Opmerking')
                        ->schema([
                            Textarea::make("remark")
                                ->rows(7)
                                ->label('Opmerking')
                                ->columnSpan('full')
                                ->autosize()
                                ->hint(fn($state, $component) => "Aantal karakters: " . $component->getMaxLength() - strlen($state) . '/' . $component->getMaxLength())
                                ->maxlength(255)
                                ->reactive(),
                        ]),
                ])->columnSpanFull(),
                //  ->submitAction(new \Filament\Forms\Components\Actions\ButtonAction('Submit')),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make("type.name")
                    ->badge()
                    ->label("Categorie")
                    ->placeholder("-")
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make("brand.name")
                    ->label("Merk")
                    ->placeholder("-")
                    ->toggleable()
                    ->sortable()
                    ->searchable(),

                TextColumn::make("model.name")
                    ->label("Model")
                    ->placeholder("-")
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TileColumn::make('name')
                    ->description(fn($record) => $record->function)
                    ->placeholder("-")
                    ->sortable()

                    ->image(fn($record) => $record->avatar),

                TextColumn::make("employee.name")
                    ->badge()
                    ->label("Medewerker")
                    ->placeholder("-")
                    ->toggleable()
                    ->sortable()
                    ->searchable(),

                TextColumn::make("serial_number")
                    ->label("Serienummer")
                    ->placeholder("-")
                    ->toggleable()
                    ->sortable()
                    ->searchable(),

            ])
            ->emptyState(view('partials.empty-state-small'))
            ->recordUrl(function ($record) {
                return "/objects/" . $record->id;
            })
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalHeading('Object aanmaken')
                    ->label('Toevoegen')
                    ->icon('heroicon-m-plus'),
            ])
            ->actions([

                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->modalHeading('Object Bewerken')
                        ->modalDescription('Pas de bestaande object aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                        ->tooltip('Bewerken')
                    ,
                    Tables\Actions\DeleteAction::make()
                        ->modalIcon('heroicon-o-trash')
                        ->tooltip('Verwijderen')
                        ->modalHeading('Verwijderen')
                        ->color('danger'),

                ]),
            ])
            ->bulkActions([
                //
            ]);
    }
}
