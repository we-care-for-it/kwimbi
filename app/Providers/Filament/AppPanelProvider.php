<?php
namespace App\Providers\Filament;
use App\Models\Company;

use App\Filament\Pages\Tenancy\RegisterCompany;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
 use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use DutchCodingCompany\FilamentSocialite\Provider;
use Filament\Support\Enums\MaxWidth;
use Carbon\Carbon;
use Niladam\FilamentAutoLogout\AutoLogoutPlugin;
 //use lockscreen\FilamentLockscreen\Lockscreen;
//use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
//use lockscreen\FilamentLockscreen\Http\Middleware\LockerTimer;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticationPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Rupadana\ApiService\ApiServicePlugin;

use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
       
->darkMode(false)
->default()

            ->id('app')
->plugins([
    ApiServicePlugin::make()
])
->plugins([
    \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
])

->plugins([

 FilamentEditProfilePlugin::make()
        ->slug('my-profile')
        ->setTitle('Mijn profiel')
        ->setNavigationLabel('My Profile')
        ->setNavigationGroup('Group Profile')
        ->setIcon('heroicon-o-user')
        ->setSort(10)
        ->shouldRegisterNavigation(false)
        ->shouldShowDeleteAccountForm(false)
        ->shouldShowBrowserSessionsForm(true)
        ->shouldShowAvatarForm(),
        FilamentDeveloperLoginsPlugin::make()
        ->enabled(app()->environment('local'))
        ->switchable(false)

        ->users([
            'Admin' => 'superAdmin@ltssoftware.nl',
        ]),
        ])

 ->plugins([
        AutoLogoutPlugin::make()

            ->color(Color::Emerald)                         // Set the color. Defaults to Zinc
            ->disableIf(fn () => auth()->id() === 1)        // Disable the user with ID 1
            ->logoutAfter(Carbon::SECONDS_PER_MINUTE * 5)   // Logout the user after 5 minutes
            ->withoutWarning()                              // Disable the warning before logging out
            ->withoutTimeLeft()                             // Disable the time left
            ->timeLeftText('Je word straks automatiche uitgelogd')      // Change the time left text
            ->timeLeftText('')                              // Remove the time left text (displays only countdown)
    ])

  // ->plugins([
         //   TwoFactorAuthenticationPlugin::make()
                 //   ->addTwoFactorMenuItem() // Add 2FA settings to user menu items

      //  ])
 //->plugin(new Lockscreen())   // <- Add this
 


 //->plugins([
          //  FilamentBackgroundsPlugin::make()
            //    ->imageProvider(
               //     MyImages::make()
                //        ->directory('images/backgrounds')
               // ),
     //   ])

 //->plugin(\TomatoPHP\FilamentPWA\FilamentPWAPlugin::make())
            ->path('')
   	    //->tenant(Company::class)
            ->maxContentWidth(MaxWidth::Full)
  ->sidebarCollapsibleOnDesktop()
            ->unsavedChangesAlerts()
            ->breadcrumbs(true)
->plugins([
              
                FilamentSocialitePlugin::make()
                    ->providers([
                        Provider::make('azure')
     ->icon('fab-microsoft')
  ->color(Color::hex('#5E5E5E'))
       ->outlined(false)            
                    ])->slug('app')

   
                    ->createUserUsing(fn (string $provider, User $oauthUser, FilamentSocialitePlugin $plugin) => UserModel::create([
                        'name' => $oauthUser->user['givenName'] . " " . $oauthUser->user['surname'],
 
                        'email' => $oauthUser->getEmail(),
                    ]))


                    ->registration(false)            ])



    ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->login()
     ->brandLogo(fn() => view('components.logo'))
            ->colors([
                'primary' => Color::Amber,
            ])      ->plugin(
            \Hasnayeen\Themes\ThemesPlugin::make()
        )    ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
              
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
   \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
       //
              

 
                DispatchServingFilamentEvent::class,
            ])   ->authMiddleware([
                // ...
               //  Locker::class, // <- Add this
            ])
// ->tenantMiddleware([
     //                 \Hasnayeen\Themes\Http\Middleware\SetTheme::class
     //   ], isPersistent: true)
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}


 



















 




 












    
    
        
       



            

    



 
        
        
        
        
        
        
        
        
        
        
        
        
        

        
            
        
        

 
        

            
            
            
            
            
            
            
    

  
         
                 

      
 


 
          
            
               
                
               
     

 
            
   	    
            
  
            
            

              
                
                    
                        
     
  
       
                    

   
                    
                        
 
                        
                    

                    



    
            
     
            
                
            
            
        
            
            
                
            
            
            
              
            
            
                
                
                
                
                
                
                
                
       
              

 
                
            
                
               
            

     
     
            
                
            
    





















 




 












    
    
        
       



            

    



 
        
        
        
        
        
        
        
        
        
        
        
        
        

        
            
        
        

 
        

            
            
            
            
            
            
            
    

  
         
                 

      
 


 
          
            
               
                
               
     

 
            
   	    
            
  
            
            

              
                
                    
                        
     
  
       
                    

   
                    
                        
 
                        
                    

                    



    
            
     
            
                
            
            
        
            
            
                
            
            
            
              
            
            
                
                
                
                
                
                
                
                
       
              

 
                
            
                
                