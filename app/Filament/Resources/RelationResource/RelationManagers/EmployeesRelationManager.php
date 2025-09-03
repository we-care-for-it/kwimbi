<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;

use App\Models\relationLocation;
use App\Models\contactType;

use App\Models\Employee;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Tiles\Tables\Columns\TileColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Contact;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';
    protected static ?string $title = 'Medewerkers';
    protected static ?string $modelLabel = 'medewerker';
    protected static ?string $pluralModelLabel = 'medewerkers';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->employees()   ->where('type_id', 1)      ->where('relation_id', $ownerRecord->id)->count();
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {

        return in_array('Medewerkers', $ownerRecord?->type?->options) ? true : false;
    }



    public function form(Form $form): Form
    {
          return $form
            ->schema([
                Grid::make(2)
                    ->schema([

                                            Forms\Components\Select::make('type_id')
                            ->options([
                                '2' => 'Contactpersoon',
                                '1' => 'Medewerker',
                            ])->default(1),


                        Forms\Components\TextInput::make('first_name')
                            ->label('Voornaam')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('last_name')
                            ->label('Achternaam')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('company')
                            ->label('Bedrijf')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('E-mailadres')
                            ->email()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('department')
                            ->label('Afdeling')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('function')
                            ->label('Functie')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone_number')
                            ->label('Telefoonnummer')
                                ->tel()
  
    ->regex('/^\+?\d{6,20}$/')
                            ->maxLength(255),

                            
                        Forms\Components\Select::make("location_id")
                             ->label("Locatie")
                             ->options(
                                            relationLocation::where('relation_id', $this->getOwnerRecord()->id)
    ->pluck('address', 'id')
                                            ),

     

                           Forms\Components\Toggle::make('show_in_contactlist')
                            ->label('Toon in contactpersonen overzicht')
                            ->columnSpan('full'),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
             ->query(
            Contact::query()->where('type_id', 1) 
            ->where('relation_id', $this->ownerRecord->id)

            )
            ->recordTitleAttribute('name')

            ->filters([
                TrashedFilter::make(),

                SelectFilter::make('department')
                    ->label('Afdeling')
                    ->options(
                    Employee::where('type_id', 1)
                        ->select('department')
                        ->distinct()
                        ->pluck('department')
                        ->mapWithKeys(fn ($dept) => [
                            $dept ?? 'null' => $dept ?? 'Geen afdeling',
                        ])
                        ->toArray()
                        ),

                 SelectFilter::make('function')
                    ->label('Functie')
                    ->options(
                
                Employee::where('type_id', 1)
                        ->select('function')
                        ->distinct()
                        ->pluck('function')
                        ->mapWithKeys(fn ($func) => [
                            $func ?? 'null' => $func ?? 'Geen functie',
                        ])
                        ->toArray()
                        ),

                        
                
                
        ])
   
            ->columns([
                TileColumn::make('name')
                    ->description(fn($record) => $record->function)
                    ->sortable()
                    ->searchable()
                    ->image(fn($record) => $record->avatar)
                    ->label('Naam'),

                TextColumn::make('email')
                    ->placeholder('-')
                    ->searchable()
                    ->url(fn($record) => "mailto:{$record->email}")
                    ->label('E-mailadres'),

                TextColumn::make('department')
                    ->label('Afdeling')
                    ->placeholder('-'),

                TextColumn::make('function')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable()
                    ->label('Functie'),

                TextColumn::make('phone_number')
                    ->placeholder('-')
                    ->searchable()
                    ->url(fn($record) => "tel:{$record->contact?->phone_number}")
                    ->label('Telefoonnummer')
                    ->description(fn($record): ?string => $record?->mobile_number ?? null),



            ])
            ->emptyState(view('partials.empty-state'))

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth(MaxWidth::FourExtraLarge)
                    ->modalHeading('Medewerker toevoegen')
                                     ->slideover()
                    ->modalDescription('Voeg een nieuwe medewerker toe door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->icon('heroicon-m-plus')
                    ->modalIcon('heroicon-o-plus')
                    ->link()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['type_id'] = 1;
                        return $data;
                    })
                    ->label('Medewerker toevoegen'),

            ])

            ->actions([

          Tables\Actions\Action::make('openObject')
                    ->icon('heroicon-m-eye')
                    ->url(fn($record) => route('filament.app.resources.tickets.view', ['record' => $record]))
                    ->label('Bekijk'),
                
                Tables\Actions\EditAction::make()
                        ->label('Snel bewerken')
                        ->slideover(),


 


                Tables\Actions\ActionGroup::make([

     
                    Tables\Actions\DeleteAction::make()
                        ->label('Verwijder'),
                ])

                ,

            ])
        ;
    }
}
