<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ToolsResource\Pages;
use App\Filament\Resources\ToolsResource\RelationManagers;
use App\Models\Tools;
use App\Models\toolsBrand;
use App\Models\toolsCategory;

use App\Models\User;
use App\Models\toolsInspectionCompany;
use App\Models\toolsInspectionMethod;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Section;
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


use Filament\Forms\Components\Fieldset;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;

class ToolsResource extends Resource
{
    protected static ? string $model = Tools::class;

    protected static ? string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ? string $navigationGroup = 'Beheer';
    protected static ? string $navigationLabel = 'Gereedschap';
    public static function form(Form $form) : Form
    {
        return $form->schema([
            Forms\Components\Section::make()
            ->schema([

        Grid::make(4)
            ->schema([FileUpload::make('image')
            ->image()
            ->label('Afbeelding / foto')

            ->imagePreviewHeight('250')
            ->loadingIndicatorPosition('left')
            ->panelAspectRatio('2:1')
            ->panelLayout('integrated')
            ->removeUploadedFileButtonPosition('right')
            ->uploadButtonPosition('left')
            ->uploadProgressIndicatorPosition('left')

            ->imageEditor() ,

        Textarea::make('description')
            ->rows(7)
            ->label('Opmerking')
            ->columnSpan(3)
            ->autosize() ,

        // ...
        ]) ,

        // ...
        ]) ,

        Forms\Components\Section::make()
            ->schema([

        Forms\Components\TextInput::make('name')
            ->label('Naam') , 
            

            Forms\Components\TextInput::make('serial_number')
            ->label('Serienummer') , 
            


            Select::make('category_id')
            ->label('Categorie')

            ->relationship(name : 'category', titleAttribute:'name')
                ->loadingMessage('Categorieën laden...')
                ->createOptionForm([Forms\Components\TextInput::make('name')
                ->required() ,

            ]) ,

            Select::make('brand_id')
                ->label('Merk')

                ->relationship(name:
                'brand', titleAttribute:
                    'name')
                        ->loadingMessage('Merken laden...')
                        ->createOptionForm([Forms\Components\TextInput::make('name')
                        ->required() ,

                    ]) ,

                    Select::make('supplier_id')
                        ->label('Leverancier')

                        ->relationship(name:
                        'supplier', titleAttribute:
                            'name')
                                ->loadingMessage('Leveranciers laden...')
                                ->createOptionForm([Forms\Components\TextInput::make('name')
                                ->required() ,

                            ]) ,

                            Select::make('type_id')
                                ->label('Type')

                                ->relationship(name:
                                'type', titleAttribute:
                                    'name')
                                        ->loadingMessage('Types laden...')
                                        ->createOptionForm([

                                    Forms\Components\TextInput::make('name')
                                        ->required() ,

                                    ]) ,

 
    




                                  ])
            ->columns(2)
            ->columnSpan(2) ,

        Forms\Components\Section::make()
            ->schema([

                Select::make('warehouse_id')
                ->label('Magazijn')
    
                ->relationship(name : 'warehouse', titleAttribute : 'name')
                ->loadingMessage('Magazijnen laden...')
                ->createOptionForm([
    
            Forms\Components\TextInput::make('name')
                ->required() ,
    
                ]),
                
                Select::make('employee_id')
            ->label('Medewerker')
            ->options(User::all()
            ->pluck('name', 'id'))
            ->searchable(),

            Select::make('inspection_company_id')
            ->label('Keuringsinstantie')
            ->options(toolsInspectionCompany::all()
            ->pluck('name', 'id'))
            ->searchable() ,
            
            Select::make('inspection_method')
            ->label('Keuringsmethode')
            ->options(toolsInspectionMethod::all()
            ->pluck('name', 'id'))
            ->searchable() ,

 
            
 
            ])
            ->columnSpan(['lg' => 1])

        ])
            ->columns(3);

        Section::make()

            ->schema([

        Forms\Components\TextInput::make('name')
            ->label('Naam') ,
        //->columnSpan('full')
        


      
                                 

                                     

                                    ]);
                                }

                                public static function table(Table $table):
                                    Table
                                    {
                                        return $table->columns([

                                        ImageColumn::make('image')
                                            ->label('')
                                            ->width(100) ,


                                            
                                        TextColumn::make('name')
                                        ->searchable()
                                        ->label('Naam'),

                                        TextColumn::make('serial_number')
                                            ->searchable()
                                            ->label('Serienummer')

                                            ->searchable()
                                            ->sortable() ,

                                        TextColumn::make('category.name')
                                            ->searchable()
                                            ->label('Categorie')

                                            ->sortable() ,

                                        TextColumn::make('brand.name')
                                            ->searchable()
                                            ->label('Merk')

                                            ->sortable() ,

                                        TextColumn::make('type.name')
                                            ->searchable()
                                            ->label('Type / Model') ,

                                        TextColumn::make('employee.name')
                                            ->searchable()
                                            ->label('Gebruiker')
                                            ->badge()

                                            ->sortable() ,

                                        ])
                                            ->filters([SelectFilter::make('brand_id')
                                            ->label('Merk')
                                            ->options(toolsBrand::all()
                                            ->pluck('name', 'id')) ,

                                        SelectFilter::make('category_id')
                                            ->label('Categorie')
                                            ->options(toolsCategory::all()
                                            ->pluck('name', 'id')) ,

                                        SelectFilter::make('employee_id')
                                            ->label('Medewerker')
                                            ->options(User::all()
                                            ->pluck('name', 'id')) ,

                                        ])
                                            ->actions([Tables\Actions\EditAction::make()
                                            ->modalHeading('Wijzigen')
                                            ->modalWidth(MaxWidth::FiveExtraLarge) , Tables\Actions\DeleteAction::make()
                                            ->modalHeading('Verwijderen') ,

                                        ])
                                            ->bulkActions([
                                        // Tables\Actions\BulkActionGroup::make([
                                        //     Tables\Actions\DeleteBulkAction::make(),
                                        // ]),
                                        ])
                                            ->emptyState(view('partials.empty-state'));
                                    }

                                    public static function getRelations():
                                        array
                                        {
                                            return [
                                            //
                                            ];
                                        }

                                        public static function getPages():
                                            array
                                            {
                                                return ['index' => Pages\ListTools::route('/') , 'create' => Pages\CreateTools::route('/create') , 'edit' => Pages\EditTools::route('/{record}/edit') , ];
                                            }
                                        }
                                        
