<?php
namespace App\Filament\Resources;

use App\Filament\Resources\RelationLocationResource\Pages;
use App\Filament\Resources\RelationLocationResource\RelationManagers;
use App\Models\relationLocation;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RelationLocationResource extends Resource
{
    protected static ?string $model           = relationLocation::class;
    protected static ?string $navigationLabel = "Oplossingen";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function getRelations(): array
    {
        return [

            //   RelationGroup::make('Contacts', [
            //      RelationManagers\ObjectsRelationManager::class,
            RelationManagers\ContactsRelationManager::class,
            //    RelationManagers\NotesRelationManager::class,
            //  RelationManagers\ProjectsRelationManager::class,
            // RelationManagers\AttachmentsRelationManager::class,
            // RelationManagers\TasksRelationManager::class,

            // ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRelationLocations::route('/'),
            'create' => Pages\CreateRelationLocation::route('/create'),
            'view'   => Pages\ViewRelationLocation::route('/{record}'),
            'edit'   => Pages\EditRelationLocation::route('/{record}/edit'),
        ];
    }
}
