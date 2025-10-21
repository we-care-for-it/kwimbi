<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';
    protected static ?string $icon        = 'heroicon-o-link';

    //protected static ?string $badge = 'new';
    protected static ?string $title = 'Bijlages';
//'model', '','model','filename','original_filename','extention','description','size','user_id','item_id'];
    protected static bool $isLazy = false;
    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord
            ->attachments
            ->count();
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {

        return in_array('Bijlages', $ownerRecord?->type?->options) ? true : false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('description')
                    ->rows(7)
                    ->label('Omschrijving')
                    ->columnSpan(3)
                    ->autosize()
                    ->required(),

                FileUpload::make('filename')
                    ->label('Bestand')
                    ->columnSpan(3)
                    ->preserveFilenames()
                    ->required()
                    ->disk(config('filesystems.default')) // use the tenant disk
                    ->downloadable()
                    ->directory(function () {
                        $parent_id = $this->getOwnerRecord()->id; // Assuming you've set up relationships with eloquent
                        return '/uploads/location/' . $parent_id . '/attachments';
                    }),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Medewerker')
                ,

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Datum / tijd')
                    ->sortable()
                    ->dateTime("d-m-Y H:i"),

                Tables\Columns\TextColumn::make('description')->grow(true)->label('Omschrijving')
                ,

            ])->emptyState(view('partials.empty-state'))
            ->filters([
                //
            ])
            ->headerActions([

                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                    $data['user_id']    = auth()->id();
                    $data['model']      = "Relation";
                //    $data['company_id'] = Filament::getTenant()->id;
                    return $data;
                })->label('Bijlage toevoegen')
                    ->link()
                    ->icon('heroicon-m-plus')
                    ->modalIcon('heroicon-o-plus'),
            ])
            ->actions([

                Tables\Actions\Action::make('Download')
                    ->label('Download bestand')

                    ->action(fn($record) => Storage::disk(config('filesystems.default'))
                            ->download($record->filename))
                    ->icon('heroicon-o-document-arrow-down'),

                Tables\Actions\ActionGroup::make([

                    Tables\Actions\EditAction::make()->modalHeading('Wijzig bijlage'),
                    Tables\Actions\DeleteAction::make(),
                ])])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

}
