<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CompanyResource\Pages;
use App\Filament\Admin\Resources\CompanyResource\RelationManagers\ExternalTokenRelationManager;
use App\Filament\Admin\Resources\CompanyResource\RelationManagers\GpsObjectsRelationManager;
use App\Filament\Admin\Resources\CompanyResource\RelationManagers\MailboxRelationManager;
use App\Filament\Admin\Resources\CompanyResource\RelationManagers\UsersRelationManager;
use App\Models\Company;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompanyResource extends Resource
{
    protected static bool $isScopedToTenant   = false;
    protected static ?string $model           = Company::class;
    protected static ?string $navigationIcon  = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Main';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->unique(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('company_users_count')->counts('companyUsers')->badge()->alignment(Alignment::Center),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),

                Action::make('activities')
                    ->label('Activities')
                    ->icon('heroicon-o-newspaper')
                    ->iconPosition(IconPosition::Before)
                    ->color('#C0C0C0')
                    ->url(fn($record) => CompanyResource::getUrl('activities', ['record' => $record])),

                DeleteAction::make(),

            ])
            ->bulkActions([

            ]);

    }
    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
            GpsObjectsRelationManager::class,
            ExternalTokenRelationManager::class,
            MailboxRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index'      => Pages\ListCompanies::route('/'),
            'create'     => Pages\CreateCompany::route('/create'),
            'edit'       => Pages\EditCompany::route('/{record}/edit'),
            'activities' => Pages\ListCompanyActivities::route('/{record}/activities'),
        ];
    }
}
