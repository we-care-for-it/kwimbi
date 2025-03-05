<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
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
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use LaraZeus\Tiles\Tables\Columns\TileColumn;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

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
                // Profiel Sectie
                Section::make('Contactgegevens')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Profielfoto')
                            ->image()
                            ->nullable()
                            ->directory('contacts')
                            ->columnSpanFull(),
    
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('first_name')
                                    ->label('Voornaam')
                                    ->required()
                                    ->maxLength(255),
    
                                TextInput::make('last_name')
                                    ->label('Achternaam')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                            Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('E-mailadres')
                                    ->maxLength(255),
    
                                TextInput::make('phone_number')
                                    ->label('Telefoonnummer')
                                    ->maxLength(15),
    
                                TextInput::make('mobile_number')
                                    ->label('Intern telefoonnummer')
                                    ->maxLength(15),
    
                                TextInput::make('department')
                                    ->label('Afdeling')
                                    ->maxLength(255),
    
                                TextInput::make('function')
                                    ->label('Functie')
                                    ->maxLength(255),
                            ]),
                    
                    ])
                    ->collapsible(),
    
                Section::make('Adresgegevens')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('street')
                                    ->label('Straat')
                                    ->maxLength(255),
    
                                TextInput::make('city')
                                    ->label('Stad')
                                    ->maxLength(255),
    
                                TextInput::make('postal_code')
                                    ->label('Postcode')
                                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                                    ->maxLength(10),
    
                                TextInput::make('country')
                                    ->label('Land')
                                    ->maxLength(255),
                            ]),
                    ])
                    ->collapsible(), // Maakt deze sectie inklapbaar

                    Section::make('Social Media')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('linkedin')
                                    ->label('LinkedIn')
                                    ->maxLength(255),
    
                                TextInput::make('twitter')
                                    ->label('Twitter')
                                    ->maxLength(255),
    
                                TextInput::make('facebook')
                                    ->label('Facebook')
                                    ->maxLength(255),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Contact Informatie') // Hoofd-tab component
                    ->columnSpan('full')
                    ->tabs([
                        Tabs\Tab::make('Contactgegevens')
                            ->icon('heroicon-o-user')
                            ->schema([
                                TextEntry::make('name')->label('Naam')->placeholder('-'),
                                TextEntry::make('department')->label('Afdeling')->placeholder('-'),
                                TextEntry::make('function')->label('Functie')->placeholder('-'),
                                TextEntry::make('company.name')->label('Bedrijf')->placeholder('-'),
                                TextEntry::make('email')->label('E-mail')->placeholder('-'),
                                TextEntry::make('phone_number')->label('Telefoon')->placeholder('-'),
                                TextEntry::make('mobile_number')->label('Intern Tel')->placeholder('-'),
                            ])->columns(3),
    
                        Tabs\Tab::make('Social Media')
                            ->icon('heroicon-o-share') 
                            ->schema([
                                TextEntry::make('linkedin')->label('LinkedIn')->placeholder('-'),
                                TextEntry::make('twitter')->label('Twitter')->placeholder('-'),
                                TextEntry::make('facebook')->label('Facebook')->placeholder('-'),
                            ])->columns(3),
    
                        Tabs\Tab::make('Adresgegevens')
                            ->icon('heroicon-o-map')
                            ->schema([
                                TextEntry::make('street')->label('Straat')->placeholder('-'),
                                TextEntry::make('city')->label('Stad')->placeholder('-'),
                                TextEntry::make('postal_code')->label('Postcode')->placeholder('-'),
                                TextEntry::make('country')->label('Land')->placeholder('-'),
                            ])->columns(3),
                    ]),
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
            ])
            ->actions([
                    EditAction::make()
                        ->modalHeading('Snel bewerken')
                        ->tooltip('Bewerken')
                        ->label('')
                        ->size(ActionSize::Medium)
                        ->modalIcon('heroicon-o-pencil')
                        ->slideOver(),
                    DeleteAction::make()
                        ->modalIcon('heroicon-o-trash')
                        ->tooltip('Verwijderen')
                        ->label('')
                        ->size(ActionSize::Medium)
                        ->modalHeading('Contactpersoon verwijderen')
                        ->color('danger'),
                ])
            ->bulkActions([])
            ->emptyState(view('partials.empty-state'));
    }

    
    public static function getRelations(): array
    {
        return [

            RelationManagers\RelationRelationManager::class,

        ];
    }


    public static function getPages(): array
    {
        return [
            'view'   => Pages\ViewContact::route('/{record}'), // Ensure this is defined
            'index'  => Pages\ListContacts::route('/'),
            // 'create' => Pages\CreateContact::route('/create'),
            // 'edit'   => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
