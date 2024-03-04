<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Log;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use App\Http\Requests;
use App\Http\Requests\
{
    StoreRequest
};
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;

class azureController extends Controller
{
    public function callback()
    {

        try
        {

            $user = Socialite::driver('azure')->stateless()
                ->user();

            $finduser = User::where('email', $user->user['mail'])
                ->first();

            if ($finduser)
            {

                $affected = User::where('email', $user->user['mail'])
                    ->update(['azure_token' => $user->token, 'name' => $user->name, 'login_type' => '1', 'last_login_at' => date('Y-m-d H:i:s') , ]);

                Auth::login($finduser);

                return redirect()->intended('dashboard');
            }
            else
            {

                return view('errors.noaccess', ['user' => $user]);

            }

        }
        catch(\Exception $ex)
        {
            Bugsnag::notifyException($ex);
            print($ex);
        //  return redirect()->intended('login');
       


        }

    }

    public function logoff(Request $request)
    {
        Auth::guard()->logout();
        $request->session()
            ->flush();
        $azureLogoutUrl = Socialite::driver('azure')->getLogoutUrl(route('auth.azure'));
        return redirect($azureLogoutUrl);
    }

}

