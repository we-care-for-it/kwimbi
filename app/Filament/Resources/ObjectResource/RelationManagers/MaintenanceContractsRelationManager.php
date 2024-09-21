<?php

namespace App\Filament\Resources\ObjectResource\RelationManagers;

use App\Models\ObjectMaintenanceCompany;
use App\Models\Statuses;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MaintenanceContractsRelationManager extends RelationManager
{
    protected static string $relationship = 'maintenance_contracts';
    protected static ?string $title = 'Onderhoudcontracten';
    protected static bool $isLazy = false;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make("startdate")
                    ->label("Startdatum")
                    ->required(),

                DatePicker::make("enddate")
                    ->label("Einddatum")
                    ->required(),


                TextInput::make("count_of_maintenance")
                 //   ->default(now())
                    ->label("Aantal beurten"),


                Select::make("maintenance_company_id")
                    ->label("Onderhoudsbedrijf")
                    ->required()
                    ->reactive()
                    ->options(
                        ObjectMaintenanceCompany::pluck("name", "id")
                    ) ,



                FileUpload::make('contract')
                    ->columnSpan(3)
                    ->preserveFilenames()
                    ->label('Contract')
                    ->visibility('private')
                    ->directory(function () {
                        $parent_id = $this->ownerRecord->id;  // Assuming you've set up relationships with eloquent
                        return '/uploads/' . $parent_id . '/maintenance_contracts';
                    }),

                Textarea::make('remark')
                    ->rows(7)
                    ->label('Opmerking')
                    ->columnSpan(3)
                    ->autosize()


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([






                Tables\Columns\TextColumn::make("maintenance_company.name")
                    ->label("Onderhoudsbedrijf")

                    ->placeholder('-')->wrap(),


                Tables\Columns\TextColumn::make("startdate")
                    ->label("Startdatum")
                    ->dateTime("d-m-Y")
                    ->placeholder('-')->wrap(),

                Tables\Columns\TextColumn::make("enddate")
                    ->label("Einddatum")
                    ->dateTime("d-m-Y")
                    ->placeholder('-')->wrap(),




                Tables\Columns\TextColumn::make("remark")
                    ->label("Opmerking")
                    ->placeholder('')->wrap(),



                Tables\Columns\TextColumn::make("count_of_maintenance")
                    ->label("Aantal beurten")
                    ->placeholder('-')
            ->alignment('center'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->modalHeading('Contract toevoegen')->label('Toevoegen'),])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading('Wijzigcontract'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //   Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
