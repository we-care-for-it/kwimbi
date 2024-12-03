<?PHP


use Filament\Pages\Auth\Login as FilamentDefaultLoginPage;

class MyLogin extends FilamentDefaultLoginPage
{
    protected static string $view = 'filament.pages.my-login';
}

?>