<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources;

use App\Filament\Clusters\ElevatorsSettings;
use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource\Pages;
use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource\RelationManagers;
use App\Models\ObjectManagementCompany;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;


class ObjectManagementCompaniesResource extends Resource
{
    protected static ?string $model = ObjectManagementCompany::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ? string $navigationGroup = 'Extern';
    protected static ? string $navigationLabel = 'Beheerders';


    protected static ?string $cluster = ElevatorsSettings::class;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([


            Forms\Components\Section::make()
                ->schema([


                    Forms\Components\TextInput::make('name')
                    ->label('Naam')
                        ->maxLength(255)
                        ->required(),

                    Forms\Components\TextInput::make('zipcode')

                        ->label('Postcode')
                        ->maxLength(255),


                    Forms\Components\TextInput::make('place')
                    ->label('Plaats')
                        ->maxLength(255),


                        Forms\Components\TextInput::make('address')
                        ->label('Adres')
                        ->maxLength(255),

                       // ->content(fn (Customer $record): ?string => $record->updated_at?->diffForHumans()),
                ])
                ->columnSpan(['lg' => 2]),
              //  ->hidden(fn (?Customer $record) => $record === null),


            Forms\Components\Section::make()
                ->schema([


                    ->maxLength(255),

                    Forms\Components\TextInput::make('phonenumber')
                    ->label('Telefoonnummer')   ->columnSpan('full')

                    ->maxLength(255),



                ])
                ->columns(2)
          ->columnSpan(['lg' => 1]),

        ])
        ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table

        ->columns([
            Tables\Columns\Layout\Split::make([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->searchable()

                        ->weight('medium')
                        ->alignLeft()        ->label('Bedrijfsnaam'),

 


                        ->alignLeft(),
                ])->space(),

                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('address')
                    ->searchable()

                    ->weight('medium')
                    ->alignLeft(),



                    Tables\Columns\TextColumn::make('zipcode')->state(
                        function (objectManagementCompany $rec) {
                          return $rec->zipcode . " " . $rec->place;
                         }),





                ])->space(2),


                // Tables\Columns\TextColumn::make('phonenumber')
                // ->label('Telefoonnummer')
                // ->searchable()
                // ->sortable(),




            ])->from('md'),
        ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalHeading('Wijzigen'),
                Tables\Actions\EditAction::make()->modalHeading('Wijzigen'),
                Tables\Actions\DeleteAction::make()->modalHeading('Verwijderen van deze rij'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),

                ]),
            ]) ->emptyState(view('partials.empty-state')) ;
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
            'index' => Pages\ListObjectManagementCompanies::route('/'),
            'create' => Pages\CreateObjectManagementCompanies::route('/create'),
            'view' => Pages\ViewObjectManagementCompanies::route('/{record}'),
            'edit' => Pages\EditObjectManagementCompanies::route('/{record}/edit'),
        ];
    }
}
