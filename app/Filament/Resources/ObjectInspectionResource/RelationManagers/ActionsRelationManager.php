<?php

namespace App\Filament\Resources\ObjectInspectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Support\Enums\Alignment;
use App\Models\ObjectInspectionData;



class ActionsRelationManager extends RelationManager
{
    protected static string $relationship = 'actions';
    protected static ?string $title = "Acties";

    
    protected static bool $isLazy = false;
    public static function getBadge($ownerRecord, string $pageClass) : ? string
    {
 
        return count($ownerRecord?->actions);
   
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                
                    Forms\Components\TextInput::make('itemdata')
                    ->required()
                    ->label('sad')
                    ->maxLength(255),


            ]);
    }

    

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
               
                TextColumn::make("itemdata_count")
                        ->counts("itemdata")
                        ->label("Punten")
                        ->badge()
                        ->alignment(Alignment::Center)
                        ->color("success")

            ])
            ->filters([
                //
            ])
            ->headerActions([
              //  Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->modalHeading('Snel bewerken')
                        ->modalIcon('heroicon-o-pencil')
                        ->hidden(fn($record) => $record->external_uuid)
                        ->label('Snel bewerken')
                        
                        ->slideOver(),
                    DeleteAction::make()

                    ->modalHeading("Actie verwijderen")
                    ->modalDescription(
                        "Met deze zorg je ervoor dat de actie voor dit keuringspunt verwijderd word."
                    )

                        ->modalIcon('heroicon-o-trash')
                        ->modalHeading('Keuring verwijderen')
                        ->color('danger')
                        
                        ->action(function () {
                                       
                            ObjectInspectionData::where('action_id', $this->ownerRecord->id)->update([
                        'action_id' => NULL
                     
                   
                        
                    ]);
                    
                    
                        })

                    
                            
                            
                            ,
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                   // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
