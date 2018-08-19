<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Auth;

class PassportController
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('Platform2')->accessToken;
            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }
}
