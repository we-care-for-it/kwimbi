<?php

namespace App\Filament\Clusters\General\Resources;

use App\Filament\Clusters\General;
use App\Filament\Clusters\General\Resources\ExternalResource\Pages;
use App\Filament\Clusters\General\Resources\ExternalResource\RelationManagers;
use App\Models\external;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;



class ExternalResource extends Resource
{
    protected static ?string $model = external::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $cluster = General::class;
    protected static ? string $navigationLabel = 'Koppelingen';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('module_id')
                ->label('Koppeling')
                ->options([
                    'Boekhoudprogrammas' => [
                        '101' => 'E-Boekhouden',
                        '102' => 'WeFact',
                    ],
                    'Objecte keuringinstanties' => [
                        '201' => 'Liftinstituut',
                        '202' => 'TUV Nederland',
                        '203' => 'Chex Nederland',
                    ],
                    'Addressen en postcode' => [
                        '301' => 'Pro6PP',
                        '302' => 'Google Geo',
                        '302' => 'GAB Register',
                    ],
                    'Voertuigen' => [
                        '401' => 'RDW' 
                    ] 
                    ])
                    ->searchable(),

                    Forms\Components\Toggle::make('is_active')
                    ->label('Actief  ')
                    ->inline(false)
    
                    ->default(true) , 
                    Forms\Components\TextInput::make('token_1')
                    ->label('Sleutel 1')  ->password(), 

                    Forms\Components\TextInput::make('token_2')
                    ->label('Sleutel 2')  ->password(), 
                    
                    Forms\Components\TextInput::make('password')
                    ->label('Wachtwoord')  ->password()


             
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('is_active')
                ->label('Zichbaar')
                ->onColor('success')
    ->offColor('danger')
                ->width(100) , 

             

                TextColumn::make('last_connection')
    ->numeric(locale: 'nl'),

 
 
    TextColumn::make('last_status')
    ->badge()
    ->color(fn (string $state): string => match ($state) {
        'succesvol' => 'success',
        'error' => 'danger',
        'Met fouten' => 'warning',
    })
            
                
             //   last_message


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])   ->emptyState(view('partials.empty-state')) ;
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
          //  'index' => Pages\ListExternals::route('/'),
            'index' => Pages\ManageExternal::route('/'),
         //   'create' => Pages\CreateExternal::route('/create'),
            'edit' => Pages\EditExternal::route('/{record}/edit'),
        ];
    }
}
