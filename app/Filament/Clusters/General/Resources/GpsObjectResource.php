<?php
namespace App\Filament\Clusters\General\Resources;

use App\Filament\Clusters\General;
use App\Filament\Clusters\General\Resources\GpsObjectResource\Pages;
use App\Models\GpsObject;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
//Form
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
//tables
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GpsObjectResource extends Resource
{
    protected static ?string $model = GpsObject::class;

    protected static ?string $navigationIcon       = 'heroicon-o-rectangle-stack';
    protected static ?string $cluster              = General::class;
    protected static ?string $navigationLabel      = 'GPS Modules';
    protected static ?string $navigationGroup      = 'Algemeen';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Naam')
                    ->maxLength(255)
                    ->columnSpan('full')
                    ->required(),

                Select::make('vehicle_id')
                    ->label('Voortuig')
                    ->options(Vehicle::pluck('kenteken', 'id'))
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('imei')
                    ->label('imei')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Naam')
                    ->searchable(),

                TextColumn::make('object_expire_dt')

                    ->label('Verloopdatum')
                    ->placeholder('Niet bekend')
                    ->date('m-d-Y')
                    ->color(
                        fn($record) => strtotime($record?->object_expire_dt) <
                        time()
                        ? "danger"
                        : "success"
                    ),

                TextColumn::make('vehicle.kenteken')
                    ->getStateUsing(function ($record): ?string {
                        if ($record->vehicle->kenteken) {
                            return strtoupper($record?->vehicle->kenteken) . "-" . $record?->vehicle->merk;

                        } else {
                            return false;
                        }
                    })

                    ->label('Voortuig')
                    ->placeholder('Niet gekoppeld')
                    ->searchable(),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalWidth(MaxWidth::Small),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListGpsObjects::route('/'),
            //  'create' => Pages\CreateGpsObject::route('/create'),
            //'edit'   => Pages\EditGpsObject::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
