<?php
namespace App\Filament\Admin\Resources\CompanyResource\RelationManagers;

use App\Models\Relation;
use Filament\Forms;
//Form
use Filament\Forms\Components\Select;

//Table
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

//Table
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ExternalTokenRelationManager extends RelationManager
{
    protected static string $relationship = 'externalConnection';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('module_id')
                    ->label('Koppeling')
                    ->options([
                        'Boekhoudprogrammas'        => [
                            '101' => 'E-Boekhouden',
                            '102' => 'WeFact',
                        ],
                        'Objecte keuringinstanties' => [
                            '201' => 'Liftinstituut',
                            '202' => 'TUV Nederland',
                            '203' => 'Chex Nederland',
                        ],
                        'Addressen en postcode'     => [
                            '301' => 'Pro6PP',
                            '302' => 'Google Geo',
                            '302' => 'GAB Register',
                        ],
                        'Voortuigen'                => [
                            '401' => 'RDW',
                        ],
                    ])
                    ->searchable(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Actief  ')
                    ->inline(false)

                    ->default(true),
                Forms\Components\TextInput::make('token_1')
                    ->label('Sleutel 1')->password(),

                Forms\Components\TextInput::make('token_2')
                    ->label('Sleutel 2')->password(),

                Forms\Components\TextInput::make('password')
                    ->label('Wachtwoord:'),

                Forms\Components\DatePicker::make('from_date')
                    ->label('Vanaf datum:'),

                Select::make('relation_id')
                    ->label('Relatie')
                    ->options(Relation::where('company_id', $this->ownerRecord->id)->pluck('name', 'id')),
            ]);
    }

    public function table(Table $table): Table
    {

        return $table
            ->columns([
                ToggleColumn::make('is_active')
                    ->label('Zichbaar')
                    ->onColor('success')
                    ->offColor('danger')
                    ->width(100),

                TextColumn::make('from_date')
                    ->label('Begindatum')
                    ->date('d-m-Y')
                    ->placeholder('-'),

                TextColumn::make('relation.name')
                    ->label('Relatie')
                    ->placeholder('-'),

                TextColumn::make('lastLog.status_id')
                    ->badge()
                    ->placeholder('-'),

                TextColumn::make('lastLog.created_at')
                    ->label('Datum / Tijd')
                    ->date('d-m-Y H:i:s')
                    ->placeholder('-'),

                TextColumn::make('lastLog.schedule_run_token')
                    ->label('Run Token')
                    ->placeholder('-'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
