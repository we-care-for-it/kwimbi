<?php

namespace App\Filament\Resources\ProjectsResource\RelationManagers;

use App\Models\ProjectStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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


class ReactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'Reactions';
    protected $listeners = ['refreshRelation' => '$refresh'];

    public function hasCombinedRelationManagerTabsWithForm(): bool
    {
        return true;
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Textarea::make('reaction')
                    ->rows(7)
                    ->label('Opmerking')
                    ->columnSpan(3)
                    ->autosize() ,

                Select::make('status_id')
                    ->label('Status')

                    ->required()

                    ->options(ProjectStatus::all()
                        ->pluck('name', 'id')) ,



            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([

                Tables\Columns\TextColumn::make('nobo_nr')
                    ->label('Toegevoegd op'),


                        Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('reaction')->wrap(),
                Tables\Columns\TextColumn::make('status.name')->label('Status')->badge(),



            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();

                    return $data;
                })

            ])

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
              //      Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
