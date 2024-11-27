<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;

use App\Models\Customer;
use App\Models\ObjectManagementCompany;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
 






use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Grouping\Group;
use Illuminate\Support\Facades\Hash;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    
    protected static ?string $title = "Gebruikers";
    protected static ?string $SearchResultTitle = "Gebruikers";
    protected static ?string $navigationGroup = "Hoofdmenu";
    protected static ?string $navigationLabel = "Gebruikers";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

                            CheckboxList::make('roles')
                            ->relationship('roles', 'name')
                            ->searchable(),

                            Toggle::make('is_active')
                            ->label('Actief')
                            ->inline(false),


                            
                    ]),
              
                    
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table

        ->groups([
            Group::make('customer_id')
            ->getTitleFromRecordUsing(fn ( $record): string => ucfirst($record?->customer?->name ?? 'Geen'))
  
                ->label('Relatie'),

                Group::make('management_id')
                


                ->getTitleFromRecordUsing(fn ( $record): string => ucfirst($record?->managementCompany?->name ?? 'Geen'))
 
                ->label('Beheerder')
                //->titlePrefixedWithLabel(false),
        ])
            // ->modifyQueryUsing(fn (Builder $query) => $query
            //     ->whereHas('companies', fn ($query) => $query
            //         ->where('companies.id', Filament::getTenant()->id)
            //     )
            // )
            ->columns([
 
                ToggleColumn::make('is_active')
                ->label('Actief'),

                TextColumn::make('name')
                    ->label('Naam')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-mailadres')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('customer.name')
                    ->label('Relatie')
                    ->searchable()
                    ->sortable(),

                    TextColumn::make('managementCompany.name')
                    ->label('Beheerder')
                    ->searchable()
                    ->sortable(),





                TextColumn::make('last_login_at')
                    ->label('Laatst ingelogd')
                    ->dateTime('d-m-Y H:i')
                    ->searchable()
                    ->sortable(),
              

            ])
            ->filters([
                
                SelectFilter::make('customer_id')
                ->searchable()
                ->options(Customer::all()->pluck('name', 'id'))
                ->label('Relatie'),
                
                SelectFilter::make('management_id')
                ->searchable()
                ->options(ObjectManagementCompany::all()->pluck('name', 'id'))
                ->label('Beheerder'),
                         

            ], layout: FiltersLayout::AboveContent)
        
            ->actions([
                Tables\Actions\EditAction::make(),
                Impersonate::make(),
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
           // 'create' => Pages\CreateUser::route('/create'),
           // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

  
}
