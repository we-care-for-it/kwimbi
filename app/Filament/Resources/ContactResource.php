<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use LaraZeus\Tiles\Tables\Columns\TileColumn;


class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon  = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = "Contactpersonen";
    protected static ?string $title           = "Contactpersonen";

    protected static ?string $pluralModelLabel = 'Contactpersonen';

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
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->maxLength(10),

                Forms\Components\TextInput::make('country')
                    ->label('Land')
                    ->maxLength(255),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\TextEntry::make('name')
                    ->label('Name'),
                Components\TextEntry::make('email')
                    ->label('Email'),
                Components\TextEntry::make('phone_number')
                    ->label('Phone Number'),
                Components\TextEntry::make('mobile_number')
                    ->label('Mobile Number'),
                Components\TextEntry::make('department')
                    ->label('Department'),
                Components\TextEntry::make('function')
                    ->label('Function'),
                Components\TextEntry::make('company.name')
                    ->label('Company'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(
                fn(Contact $record): string => Pages\ViewContact::getUrl(['record' => $record->id]), // Use Contact instead of Model
            )
            ->groups([
                Group::make('company.name')
                    ->label('Bedrijf'),
            ])
            ->columns([

                TileColumn::make('name')
                    ->description(fn($record) => $record->email)
                    ->image(fn($record) => $record->avatar),

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

            ])
            ->filters([])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([

                    Action::make('view') // Custom action for row click
                        ->icon('heroicon-o-eye')
                        ->action(fn($record) => static::infolist($record))
                        ->modalHeading('Contact Details')
                        ->modalContent(fn($record) => static::infolist($record)),

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
            'view'   => Pages\ViewContact::route('/{record}'), // Ensure this is defined
            'index'  => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit'   => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
