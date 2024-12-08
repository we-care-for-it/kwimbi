<?php

namespace App\Filament\Clusters\General\Resources;

use App\Filament\Clusters\General;
use App\Filament\Clusters\General\Resources\UserResource\Pages;
use App\Filament\Clusters\General\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Grouping\Group;
use Illuminate\Support\Facades\Hash;


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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Columns\TagsColumn;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = General::class;
    protected static ?string $navigationGroup = "Applicatie";
  
    protected static ? string $navigationLabel = 'Gebruikers';
  
    public static function form(Form $form): Form
    {
        return $form
            ->schema(components: [
                Section::make()
                    ->columns(3)
                    ->schema([
              
                        TextInput::make('name')
                            ->label("Naam")
                            ->required(),
                        
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')

                            ,TextInput::make('email')
                            ->label('E-mailadres')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),
  
                            Select::make('Rechten')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->columnSpan('full') ,
                            
                    ]),
              
                    
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
 
            ->columns([
                 TextColumn::make('name')
                    ->label('Naam')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('E-mailadres')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.name')->badge()->label('Rolen')
             ])
            ->filters([
 
            ])
        
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyState(view("partials.empty-state"));
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
            'index' => Pages\ListUsers::route('/'),
          //  'create' => Pages\CreateUser::route('/create'),
          //  'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
