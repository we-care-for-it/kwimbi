<?php
namespace App\Filament\Admin\Resources\CompanyResource\RelationManagers;

use App\Models\gpsObject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GpsObjectsRelationManager extends RelationManager
{
    protected static bool $isScopedToTenant = false;

    protected static string $relationship = 'gpsObjects'; // Match model relationship name

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('imei')->label('IMEI')->required(),
            Forms\Components\TextInput::make('vehicle_id')->label('Vehicle ID')->nullable(),
            Forms\Components\DatePicker::make('object_expire_dt')->label('Expire Date')->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('GPS Object Name')->sortable()->searchable(),
                TextColumn::make('imei')->label('IMEI')->sortable()->searchable(),
                TextColumn::make('vehicle_id')->label('Vehicle ID')->sortable(),
                TextColumn::make('object_expire_dt')->label('Expire Date')->dateTime()->sortable(),
                TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
            ])
            ->actions([
                ViewAction::make(),
                Action::make('Detach')
                    ->requiresConfirmation()
                    ->action(function (array $data, $record): void {
                        $record->company_id = null;
                        $record->save();
                    }),
            ])
            ->headerActions([
                Action::make('Attach')
                    ->form([
                        Forms\Components\Select::make('object_id')
                            ->options(gpsObject::where('company_id', null)->pluck('name', 'id')),
                    ])
                    ->action(function (array $data) {
                        gpsObject::whereId($data['object_id'])->update(['company_id' => $this->ownerRecord->id]);
                    }),
            ]);
    }
}
