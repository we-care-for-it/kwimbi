<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon       = 'heroicon-o-user-group';
    protected static ?string $navigationLabel      = "Contactpersonen";
    protected static ?string $title                = "Contactpersonen";
    protected static ?string $recordTitleAttribute = 'Contactpersoon';
    protected static ?string $pluralModelLabel     = 'Contactpersonen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Profielfoto')
                    ->image()
                    ->nullable()
                    ->directory('contacts'),

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
                    ->maxLength(15),

                Forms\Components\TextInput::make('mobile_number')
                    ->label('Intern telefoonnummer')
                    ->maxLength(15),

                // Forms\Components\TextInput::make('intern_number')
                //     ->label('Intern Nummer')
                //     ->maxLength(15),

                Forms\Components\TextInput::make('linkedin')
                    ->label('LinkedIn')
                    ->maxLength(255),

                Forms\Components\TextInput::make('twitter')
                    ->label('Twitter')
                    ->maxLength(255),

                Forms\Components\TextInput::make('facebook')
                    ->label('Facebook')
                    ->maxLength(255),

                Forms\Components\TextInput::make('street')
                    ->label('Straat')
                    ->maxLength(255),

                Forms\Components\TextInput::make('city')
                    ->label('Stad')
                    ->maxLength(255),

                Forms\Components\TextInput::make('postal_code')
                    ->label('Postcode')
                    ->maxLength(10),

                Forms\Components\TextInput::make('country')
                    ->label('Land')
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

                ImageColumn::make('image')
                    ->label('Profielfoto')
                    ->circular()
                    ->wrap()
                    ->defaultImageUrl(url('/images/noavatar.jpg'))
                    ->grow(false),

                TextColumn::make('first_name')
                    ->weight(FontWeight::Bold)
                    ->getStateUsing(fn($record) => $record?->first_name . " " . $record?->last_name)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email'),

                TextColumn::make("company.name")
                    ->url(fn($record) => "/app/companies/" . $record->company_id)
                    ->label("Bedrijfsnaam")
                    ->placeholder("-")
                    ->toggleable(),

                TextColumn::make("department")
                    ->label("Afdeling")
                    ->placeholder("-")
                    ->toggleable(),

                TextColumn::make("function")
                    ->label("Functie")
                    ->placeholder("-")
                    ->toggleable(),

                TextColumn::make("phone_number")
                    ->label("Telefoonnummer")
                    ->placeholder("-"),

                TextColumn::make("mobile_number")
                    ->label("Intern Telefoonnummer")
                    ->placeholder("-"),

                TextColumn::make('company.type.name')
                    ->label('Categorie')
                    ->badge()
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make(),
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
                        ->modalHeading('Contactpersoon verwijderen')
                        ->color('danger'),
                ]),
            ])
            ->bulkActions([])
            ->emptyState(view('partials.empty-state'));
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit'   => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
