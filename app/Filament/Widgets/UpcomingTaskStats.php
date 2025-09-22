<?PHP
namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Table;
 
use Filament\Tables\Filters\SelectFilter;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\{ImageColumn, TextColumn};
use Filament\Tables\Actions\Action;
use App\Filament\Resources\TaskResource;
class UpcomingTaskStats extends BaseWidget
{
 
protected static ?string $heading = 'Aankomende taken'; // ✅ correct
protected static ?string $pollingInterval = '60s';
  protected int | string | array $columnSpan = '6';

protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
{
    return Task::query()
        ->where('employee_id', Auth::id())
        ->whereDate('begin_date', '>=', now()->startOfDay());
}
    protected function getTableColumns(): array
    {
        return [
 ImageColumn::make('make_by_employee.avatar')
                    ->size(30)
                    ->square()
                    ->circular()
                    ->stacked()
                    ->label('')
                    ->tooltip(fn($record) =>
                        $record->make_by_employee_id === $record->employee_id
                            ? 'Gemaakt door: ' . $record->make_by_employee?->name . ' (ook eigenaar)'
                            : implode(', ', array_filter([
                                'Medewerker: ' . $record->employee?->name,
                                'Gemaakt door: ' . $record->make_by_employee?->name,
                            ]))
                    )
                    ->getStateUsing(fn($record) =>
                        $record->make_by_employee_id === $record->employee_id
                            ? [$record->make_by_employee?->avatar]
                            : [$record->make_by_employee?->avatar, $record->employee?->avatar]
                    ),
             
                TextColumn::make('type')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->width('100px')
                    ->label('Type'),

                TextColumn::make('priority')
                    ->badge()
                    ->sortable()
                    ->width('150px')
                    ->toggleable()
                    ->label('Prioriteit'),

                // TextColumn::make('related_to')
                //     ->label('Relatie')
                //     ->wrap(0)
                //     ->toggleable()
                //     ->getStateUsing(fn($record): ?string => $record?->related_to?->name)
                //     ->placeholder('-'),

                TextColumn::make('description')
                    ->label('Taak')
                    ->grow()
                    ->placeholder('-')
                    ->toggleable()
                    
       ->description(fn($record) => $record?->begin_date
    ? 'Start op: ' . date("d-m-Y", strtotime($record->begin_date))
    : '-'
),


                     
 
                // TextColumn::make('deadline')
                //     ->label('Einddatum')
                //     ->sortable()
                //     ->dateTime('d-m-Y')
                //     ->toggleable()
                //     ->placeholder('-'),

        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('go_to_all__task')
        ->label('Alle taken bekijken')
 
        ->link()
         ->url(TaskResource::getUrl('index')) // Goes to the index page
        ->color('primary')
        
        ];
    }
}