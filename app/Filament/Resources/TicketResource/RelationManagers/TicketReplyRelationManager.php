<?php
namespace App\Filament\Resources\TicketResource\RelationManagers;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class TicketReplyManager extends RelationManager
{
    protected static string $relationship = 'replies';
    protected static ?string $title       = 'Reacties';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Textarea::make('description')
                    ->rows(7)
                    ->label('Notitie')
                    ->columnSpan(3)
                    ->required()
                    ->autosize()
                    ->hint(fn($state, $component) => "Aantal karakters: " . $component->getMaxLength() - strlen($state) . '/' . $component->getMaxLength())
                    ->maxlength(255)
                    ->reactive(),

                Select::make('status_id')
                    ->default(fn($record) => $this->getOwnerRecord()->status_id)
                    ->label('Status')

                    ->options(TicketStatus::Class),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([

                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime("d-m-Y H:i:s")
                    ->sortable()
                    ->width('120px')
                    ->label("Toegevoegd op"),

                TileColumn::make('employee')
                // ->description(fn($record) => $record->AssignedByUser->email)
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return $record?->employee?->name;
                    })
                    ->label('Medewerker')
                    ->searchable(['first_name', 'last_name'])
                    ->image(fn($record) => $record?->employee?->avatar),

                Tables\Columns\TextColumn::make('status_id')
                    ->badge()
                    ->sortable()

                    ->toggleable()
                    ->label('Status'),

                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->toggleable()
                    ->label('Werkzaamheden'),

            ])->emptyState(view('partials.empty-state-small'))

            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data, $livewire): array {

                    $data['ticket_id'] = $this->getOwnerRecord()->id;
                    $data['user_id']   = Auth::user()->id;
                    Ticket::whereId($this->getOwnerRecord()->id)->update([
                        'status_id' => $data['status_id'],
                    ]);

                    return $data;
                })->after(function ($livewire) {
                    $livewire->dispatch('refreshForm');
                })
                    ->label('Reactie toevoegen')
                    ->modalHeading('Reacie')
                    ->modalDescription('Indien er een externe medewerker aan deze ticket gekoppeld is zal hij of zij een update mail krijgen')
                    ->icon('heroicon-m-plus')
                    ->modalIcon('heroicon-o-plus'),

            ])
            ->actions([

                Tables\Actions\EditAction::make()
                    ->modalHeading('Reactie wijzigen'),
                Tables\Actions\DeleteAction::make()

                    ->modalHeading('Bevestig actie')
                    ->modalDescription('Weet je zeker dat je deze notities wilt verwijderen?'),

            ])
            ->bulkActions([
                //
            ]);
    }

}
