<?php
namespace App\Http\Controllers\webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Mailersend extends Controller
{
    public function handle(Request $request)
    {
        //Token from mailsender webhook configurations
        $token = $request->bearerToken();
        if ($token == 'blRFkyBkRctKJiViaMG52pjhMJ636Avz') {
            return response()->json(['success' => true]);
        } else {
            http_response_code(403);
            die('Forbidden');
        }
        return response()->json(['success' => true]);
    }
}
