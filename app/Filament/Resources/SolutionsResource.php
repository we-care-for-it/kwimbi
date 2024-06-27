<?php
namespace App\Filament\Resources;

use App\Filament\Resources\SolutionsResource\Pages;
use App\Filament\Resources\SolutionsResource\RelationManagers;
use App\Models\Solution;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class SolutionsResource extends Resource
{
    protected static ? string $model = Solution::class;

    protected static ? string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ? string $navigationLabel = 'Oplossingen';

    public static function form(Form $form) : Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('code')
            ->required()
            ->maxLength(255)
            ->live(onBlur : true) ,

            Forms\Components\TextArea::make('solution')
                ->label('Oplossing')
                ->columnSpan('full') ,

            Forms\Components\Toggle::make('is_active')
                ->label('Zichtbaar bij werkopdrachten')
                ->default(true) , ]);

    }

    public static function table(Table $table) : Table
    {
        return $table->columns([ToggleColumn::make('is_active')
            ->label('Zichbaar')
            ->searchable()
            ->width(100) , TextColumn::make('code')
            ->label('Code')
            ->width(100) , TextColumn::make('solution')
            ->label('Oplossing')
            ->searchable() ,

        ])
            ->filters([
                Tables\Filters\TrashedFilter::make(), 
         ])
            ->actions([Tables\Actions\EditAction::make()
            ->modalHeading('Wijzig oplossing') , Tables\Actions\DeleteAction::make()
            ->modalHeading('Oplossing verwijderen?') , ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make() , ]) , ])
            ->emptyState(view('partials.empty-state'));;
    }

    public static function getPages() : array
    {
        return ['index' => Pages\ManageSolutions::route('/') , ];
    }
}

