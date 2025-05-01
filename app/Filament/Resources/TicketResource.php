<?php
namespace App\Filament\Resources;

use App\Enums\TicketStatus;
use App\Filament\Resources\TicketResource\Pages;
use App\Models\Relation;
use App\Models\Ticket;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class TicketResource extends Resource
{

    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon   = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel  = 'Tickets';
    protected static ?string $pluralModelLabel = 'Tickets';
    protected static ?string $title            = 'Tickets';

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
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->toggleable()
                    ->label('#')
                    ->getStateUsing(function ($record): ?string {
                        return sprintf("%05d", $record?->id);
                    }),

                //     ->label('Medewerker'),

                TileColumn::make('AssignedByUser')
                // ->description(fn($record) => $record->AssignedByUser->email)
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return $record->AssignedByUser->name;
                    })
                    ->label('MEdewerker')
                    ->searchable(['first_name', 'last_name'])
                    ->image(fn($record) => $record->AssignedByUser->avatar),

                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->toggleable()
                    ->date('h:m d-m-Y')
                    ->label('Gemeld op'),

                Tables\Columns\TextColumn::make('relation.name')
                    ->sortable()
                    ->toggleable()
                    ->label('Relatie'),

                Tables\Columns\TextColumn::make('department.name')
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->label('Afdeling'),

                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->toggleable()
                    ->label('Omschrijving'),

                // Tables\Columns\TextColumn::make('createByUser.name')
                //     ->sortable()
                //     ->toggleable()
                //     ->label('Medewerker'),

                // Tables\Columns\TextColumn::make('AssignedByUser.name')
                //     ->sortable()
                //     ->toggleable()
                //     ->label('Medewerker'),

                Tables\Columns\TextColumn::make('type_id')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Type'),

                Tables\Columns\TextColumn::make('status_id')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Stats'),

            ])
            ->filters([
                SelectFilter::make('relation_id')
                    ->label('Medewerker')
                    ->options(Relation::all()->pluck("name", "id")),
                SelectFilter::make('assigned_by_user')
                    ->label('Medewerker')
                    ->options(User::all()->pluck("name", "id")),

                SelectFilter::make('status_id')
                    ->label('Status')
                    ->options(TicketStatus::Class),

            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyState(view("partials.empty-state"));
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
            'index'  => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit'   => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

}
