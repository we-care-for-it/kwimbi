<?PHP
namespace App\Filament\Pages;

use App\Models\relationType;
use App\Models\tenantSetting;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class TenantSettings extends Page implements HasForms
{

    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-cog';
    protected static string $view             = 'filament.pages.tenant-settings';
    protected static ?string $navigationLabel = 'Settings';

    public $inspection_relation_group;
    public $object_supplier_group;
    public $use_projects;
    public $use_timetracking;
    public $use_inspections;
    public $use_locations;
    public $use_tickets;
    public $use_incidents;
    public $use_vehiclemanagement;
    public $use_gps_tracker;
    public $use_api_connection;
    public $use_workorders;

    public function mount(): void
    {
        $this->form->fill([
            'object_supplier_group'     => $this->getSetting('object_supplier_group'),
            'seo_title'                 => $this->getSetting('seo_title'),
            'use_projects'              => $this->getSetting('use_projects') ?? false,
            'use_timetracking'          => $this->getSetting('use_timetracking'),
            'use_inspections'           => $this->getSetting('use_inspections'),
            'use_locations'             => $this->getSetting('use_locations'),
            'use_tickets'               => $this->getSetting('use_tickets'),
            'use_incidents'             => $this->getSetting('use_incidents'),
            'use_vehiclemanagement'     => $this->getSetting('use_vehiclemanagement'),
            'use_gps_tracker'           => $this->getSetting('use_gps_tracker'),
            'use_api_connection'        => $this->getSetting('use_api_connection'),
            'use_workorders'            => $this->getSetting('use_workorders'),
            'inspection_relation_group' => $this->getSetting('inspection_relation_group'),

        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Tabs::make('Settings')
                ->tabs([

                    // Forms\Components\Tabs\Tab::make('Bedrijfsinformatie')

                    //     ->schema([
                    //     ]),

                    Forms\Components\Tabs\Tab::make('Modules')

                        ->schema([

                            Section::make('Beschikbare modules')
                                ->columns(4)
                                ->schema([

                                    ToggleButtons::make('use_projects')
                                        ->label('Projecten')
                                        ->boolean()
                                        ->default(false)
                                        ->inline(),

                                    ToggleButtons::make('use_timetracking')
                                        ->label('Tijdregistratie')
                                        ->boolean()
                                        ->inline(),

                                    ToggleButtons::make('use_inspections')
                                        ->label('Keuringen')
                                        ->boolean()
                                        ->inline(),

                                    ToggleButtons::make('use_locations')
                                        ->label('Locaties')
                                        ->boolean()
                                        ->inline(),

                                    ToggleButtons::make('use_tickets')
                                        ->label('Tickets')
                                        ->boolean()
                                        ->inline(),
                                    ToggleButtons::make('use_incidents')
                                        ->label('Storingen')
                                        ->boolean()
                                        ->inline(),

                                    ToggleButtons::make('use_vehiclemanagement')
                                        ->label('Voortuigbeheer')
                                        ->boolean()
                                        ->inline(),

                                    ToggleButtons::make('use_gps_tracker')
                                        ->label('Voortuig GPS Tracker')
                                        ->boolean()
                                        ->inline(),

                                    ToggleButtons::make('use_api_connection')
                                        ->label('API Verbinding')
                                        ->boolean()
                                        ->inline(),

                                    ToggleButtons::make('use_workorders')
                                        ->label('Werkbonnen')
                                        ->boolean()
                                        ->inline(),
                                ])

                                ->description('Desknow bevat meerdere modules. Op deze pagina kan je de module aan of uit zetten die niet gebruikt worden ')]),

                    Forms\Components\Tabs\Tab::make('Relatie categorieen')
                        ->schema([

                            Section::make()
                                ->columns(4)
                                ->schema([

                                    Forms\Components\Select::make('object_supplier_group')
                                        ->label('Objecten')
                                        ->options(relationType::pluck('name', 'id')),

                                    Forms\Components\Select::make('inspection_relation_group')
                                        ->label('Keuringen')
                                        ->options(relationType::pluck('name', 'id')),

                                ])->description('Selecteer standaard relatie categorieen per onderdeel'),

                        ]),

                ]),
        ];
    }

    protected function getFormModel(): Model | string | null
    {
        return tenantSetting::first(); // or findOrFail($id), etc.
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            tenantSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Notification::make()
            ->title('Settings saved!')
            ->success()
            ->send();
    }

    private function getSetting($key)
    {
        return tenantSetting::where('key', $key)->value('value') ?? '';
    }
}
