<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Filters\SelectFilter;
use App\Models\companyType;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = "Contactpersonen";
    protected static ?string $title = "Contactpersonen";
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('first_name')
                ->label('Voornaam')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                ->label('Achternaam')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('email')
                ->label('E-mailadres')
                ->maxLength(255),

                Forms\Components\TextInput::make('department')
                ->label('Afdeling')
                ->maxLength(255),

                Forms\Components\TextInput::make('function')
                ->label('Functie')
                ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                ->label('Telefoonnummer')
                ->maxLength(255),


                Forms\Components\TextInput::make('mobile_number')
                ->label('Intern telefoonnummer')
                ->maxLength(255),


        ]);
    }

    public static function table(Table $table): Table
    {
        return $table

        ->groups([
            Group::make('company.name')
                ->label('Bedrijf'),
        ])


            ->columns([
            

       


 
    // ImageColumn::make('avatar')->label("")
    // ->defaultImageUrl(url('/images/noavatar.jpg'))
    //     ->circular()
    //     ->grow(true),
    TextColumn::make('name')
    ->label('Naam')
    ->searchable()
    ->getStateUsing(function ($record) : ? string
                {
                 


        
                    return $record?->first_name . " " . $record?->last_name;
                }) ,
 
        
      
    TextColumn::make('email')
    ->searchable(),

    Tables\Columns\TextColumn::make("department")
    ->label("Afdeling")
    ->description(function ($record) : ? string
    {
           return $record?->function ?? NULL;
    }),

    Tables\Columns\TextColumn::make("phone_number")
    ->label("Telefoonnummers")
    ->description(function ($record) : ? string
    {
           return $record?->mobile_number ?? NULL;
    }),


    Tables\Columns\TextColumn::make("company.name")
    ->url(function ($record) {
        return "/admin/companies/" .
            $record->company_id;
    })
    ->label("Bedrijfsnaam"),


    

    Tables\Columns\TextColumn::make('company.type.name')
    ->label('Type')
    ->badge()
    ->searchable()
    ->sortable(),


 
            ])
            ->filters([
                    // SelectFilter::make("company.type_id")
                    // ->label("Categorie")
                    // ->options(companyType::where('is_active', 1)->pluck('name', 'id'))
                    // ->searchable()
                    // ->preload(),
            ])
            ->actions([


                ActionGroup::make([
                    EditAction::make()
                        ->modalHeading('Snel bewerken')
                        ->modalIcon('heroicon-o-pencil')
                        ->label('Snel bewerken')
                        ->slideOver(),
                    DeleteAction::make()
                        ->modalIcon('heroicon-o-trash')
                        ->modalHeading('Object verwijderen')
                        ->color('danger'),
                ]),
            ])
            ->bulkActions([
             
            ])->emptyState(view('partials.empty-state')) ;
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
            'index' => Pages\ListContacts::route('/'),
           // 'create' => Pages\CreateContact::route('/create'),
            //'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
