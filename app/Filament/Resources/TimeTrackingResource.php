<?php
namespace App\Filament\Resources;

use App\Filament\Resources\TimeTrackingResource\Pages;
use App\Models\Project;
use App\Models\Relation;
use App\Models\TimeTracking;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class TimeTrackingResource extends Resource
{
    protected static ?string $model = TimeTracking::class;

    protected static ?string $navigationIcon   = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel  = "Tijdregistratie";
    protected static ?string $title            = "Tijdregistratie";
    protected static ?string $pluralModelLabel = 'Tijdregistratie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->groups([
                Group::make('weeknr')
                    ->label('Weeknummer'),
                Group::make('project_id')
                    ->label('Project'),
                Group::make('relation_id')
                    ->label('Relatie'),
                Group::make('status_id')
                    ->label('Status'),
            ])

            ->columns([

                TextColumn::make('fff')
                    ->label('Datum')
                    ->width(50)
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('coddde')
                    ->label('Week nr.')
                    ->width(50)
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('Activiteit')
                    ->label('Activiteit')
                    ->placeholder('-')

                    ->searchable(),

                TextColumn::make('cdddde')
                    ->label('Relatie')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('codddde')
                    ->label('Project')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('cdddodddae')
                    ->label('Uren')
                    ->placeholder('-')
                    ->width(10)
                    ->searchable(),
                TextColumn::make('coddddddddde')
                    ->label('Facturable')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Status')
                    ->placeholder('-')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('periode_id')
                    ->label('Periode')
                    ->options([
                        '1' => 'Deze week',
                        '2' => 'Deze maand',
                        '3' => 'Dit kwartaal',
                        '4' => 'Dit jaar',
                        '5' => 'Gisteren',
                        '6' => 'Vorige week',
                        '7' => 'Vorige maand',
                        '8' => 'Vorig kwartaal',
                        '9' => 'Vorig jaar',
                    ]),
                SelectFilter::make('user_id')
                    ->options(User::all()
                            ->pluck("name", "id"))
                    ->label('Medewerker'),
                SelectFilter::make('relation_id')
                    ->label('Relatie')
                    ->options(Relation::where('type_id', 5)
                            ->pluck("name", "id")),
                SelectFilter::make('project_id')
                    ->options(Project::all()
                            ->pluck("name", "id"))
                    ->label('Project'),
                SelectFilter::make('status_id')
                    ->label('Status'),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Verwijderen')
                    ->color('danger'),
            ]
            )

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

            ])

            ->emptyState(view('partials.empty-state')
            )
        ;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTimeTrackings::route('/'),
            'create' => Pages\CreateTimeTracking::route('/create'),
            'edit'   => Pages\EditTimeTracking::route('/{record}/edit'),
        ];
    }
}
