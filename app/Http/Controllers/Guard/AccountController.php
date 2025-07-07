<?php

namespace App\Http\Controllers\Guard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function changePassword(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $user = Auth::user();

            $saltedPassword = $user->konkac . $request->current_password;
            $daubuoi = env('BUOM_TO');


            if (password_verify($saltedPassword . $daubuoi, $user->password)) {


                $konkac = Str::random(16);

                $daubuoi = env('BUOM_TO');
                $saltedPassword = $konkac . $request->new_password;
                $hashedPassword = password_hash($saltedPassword . $daubuoi, PASSWORD_ARGON2ID);
                $user->konkac = $konkac;
                $user->password = $hashedPassword;
                $user->save();

                return redirect()->back()->with('success', __('Password has been changed'));
            } else {
                return redirect()->back()->with('error', __('Current password is invalid'))->withInput();
            }
        }
    }

    public function twoFactorAuth(Request $request)
    {

        if (Auth::user()->two_factor_auth === 'yes') {
            return redirect()->back()->with('error', __('Two factor authentication has been enabled'));
        }

        $valid = Validator::make($request->all(), [
            'code' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $ga = new \App\Library\GoogleAuthenticator();
            $user = Auth::user();

            if ($ga->verifyCode($user->two_factor_secret, $request->code, 2)) {
                $user->two_factor_auth = 'yes';
                $user->save();

                return redirect()->back()->with('success', __('Two factor authentication has been enabled'));
            } else {
                return redirect()->back()->with('error', __('Code is invalid'))->withInput();
            }
        }
    }

    public function twoFactorAuthDisable(Request $request)
    {
        if (Auth::user()->two_factor_auth !== 'yes') {
            return redirect()->back()->with('error', __('Two factor authentication has been disabled'));
        }

        $valid = Validator::make($request->all(), [
            'code' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $ga = new \App\Library\GoogleAuthenticator();
            $user = Auth::user();

            if ($ga->verifyCode($user->two_factor_secret, $request->code, 2)) {
                $user->two_factor_auth = 'no';
                $user->two_factor_secret = null;
                $user->save();

                return redirect()->back()->with('success', __('Two factor authentication has been disabled'));
            } else {
                return redirect()->back()->with('error', __('Code is invalid'))->withInput();
            }
        }
    }

    public function reloadUserToken()
    {
        $user = Auth::user();
        $api_token = "" . Str::random(30);
        $user->api_token = $api_token;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Token has been reloaded',
            'api_token' => $api_token
        ]);
    }

    public function updateStatusTelegram(Request $request)
    {

        $user = Auth::user();
        if ($user->telegram_id === null) {
            return redirect()->back()->with(
                'error',
                __('You have not verified your telegram account')
            )->withInput();
        }
        $user->notification_telegram = $request->status === 'yes' ? 'yes' : 'no';
        $user->save();

        return redirect()->back()->with('success', __('Cập nhật thành công'));
    }
}
