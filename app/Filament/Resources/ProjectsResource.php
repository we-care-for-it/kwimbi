<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectsResource\Pages;
use App\Filament\Resources\ProjectsResource\RelationManagers;
use App\Models\Project;

use App\Models\projectStatus;
use App\Models\customer;



use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use Filament\Support\Enums\FontWeight;

use Filament\Support\Enums\MaxWidth;
//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Select;
//tables
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
class ProjectsResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $title = 'Projecten';
    protected static ? string $navigationLabel = 'Projecten';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $isLazy = false;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
 
        ->schema([
    
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->label('Naam')           ->maxLength(255)
                    ->required(),

                    Forms\Components\TextArea::make('description')
                    ->label('Omschrijving')           
                    ->required(),

                    
                    ])
                    ->columnSpan(['lg' => 3]),
            
            Forms\Components\Section::make()
                ->schema([
                   
                 
               
             

                    Forms\Components\DatePicker::make('startdate')
                     
                        ->label('Startdatum')
                        ,
       
                        Forms\Components\DatePicker::make('enddate')
                     
                        ->label('Einddatum'),


               
                  
                    ])
                ->columnSpan(['lg' => 1]),
     


            Forms\Components\Section::make()
                ->schema([

                    Forms\Components\TextInput::make('budget_hours')

                    ->columnSpan('full')
                    ->suffixIcon('heroicon-o-currency-euro')->label('Begrote uren') ,




  TextInput::make('budget_costs')
                    ->label('Begrote kosten') 
                     ->columnSpan('full')
                    ->suffixIcon('heroicon-o-currency-euro'),

                    
                ])
                ->columns(2)
          ->columnSpan(['lg' => 1]),

          
          Forms\Components\Section::make()
          ->schema([

           
           
             
            


   
Select::make('status_id')->label('Status')->columnSpan('full')       ->required() 
->options(projectStatus::all()->pluck('name', 'id')),


Select::make('customer_id')->label('Relatie')->columnSpan('full')
->options(customer::all()->pluck('name', 'id')),

              
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
                Tables\Columns\TextColumn::make('name')
                ->label('Naam')
                ->searchable(),

                Tables\Columns\TextColumn::make('customer.name')
                ->searchable(),

                Tables\Columns\TextColumn::make('startdate')
                ->label('Startdatum')
                ->dateTime('d-m-Y')   ,


                Tables\Columns\TextColumn::make('enddate')
                ->label('Eindddatum')
             ->dateTime('d-m-Y') ,
                                       
             Tables\Columns\TextColumn::make('description')
             ->label('Omschrijving')->weight(FontWeight::Light),

 
                                       
             Tables\Columns\TextColumn::make('status.name')
             ->label('Status')
    
             ->label('Status')->badge(),

            
            ])
            ->filters([
                SelectFilter::make('status_id')
                ->label('Status')
                ->relationship('status', 'name')
                ->searchable()
                ->preload()
                ->multiple()
            ])
            ->actions([

          Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                 //   Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyState(view('partials.empty-state'));;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UploadsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
       'view' => Pages\ViewProjects::route('/{record}'),
            'edit' => Pages\EditProjects::route('/{record}/edit'),
        ];
    }
}
