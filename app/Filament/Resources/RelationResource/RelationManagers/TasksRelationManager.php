<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Enums\MaxWidth;


class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';
    protected static ?string $icon        = 'heroicon-o-rectangle-stack';
    protected static ?string $title = 'Taken';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord->tasks->count();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titel')
                    ->columnSpan('full')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpan('full')
                    ->label('Beschrijving'),

                Forms\Components\TimePicker::make('begin_time')
                    ->label('Starttijd'),
                Forms\Components\TimePicker::make('end_time')
                    ->label('Eindtijd'),

                // Forms\Components\DatePicker::make('deadline')
                // ->label('Deadline'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->emptyState(view('partials.empty-state'))
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titel')
                    ->searchable()
                    ->placeholder('-')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Beschrijving')
                    ->placeholder('-')
                    ->limit(50),
                //  Tables\Columns\TextColumn::make('deadline')
                //     ->label('Deadline')
                //     ->placeholder('-')
                //     ->date(),
                Tables\Columns\TextColumn::make('begin_time')
                    ->label('Starttijd')
                    ->placeholder('-')
                    ->time(),
                Tables\Columns\TextColumn::make('end_time')
                    ->placeholder('-')
                    ->label('Eindtijd')
                    ->time(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth(MaxWidth::FourExtraLarge)
                    ->modalHeading('Taak toevoegen')
                    ->modalDescription('Voeg een nieuwe taak toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
                    ->icon('heroicon-m-plus')
                    ->modalIcon('heroicon-o-plus')
                    ->label('Taak toevoegen')
                    ->slideOver()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['model_id']   = $this->ownerRecord->id;
                        $data['model']      = 'location';
                        $data['model_id']   = $this->getOwnerRecord()->id;
                        $data['company_id'] = Filament::getTenant()->id;

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Bewerken')->color('success'),
                Tables\Actions\DeleteAction::make()
                    ->label('Voltooi taak'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Geselecteerde verwijderen'),
                ]),
            ]);
    }
}
