<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Client;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected function redirectTo()
    {
        if (auth()->user()->is_admin == 1) {
            return '/admin/dashboard';
        }
        return '/clients/profile';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
    
        DB::beginTransaction();
        try {

            $user = User::create([
                'email'     => $data['email'],
                'password'  => $data['password'],
                'is_admin'  => 0,
            ]);
    
            $userID = $user->id;
            $client = Client::create([
                'user_id'        => $userID,
                'first_name'     => $data['first_name'],
                'last_name'      => $data['last_name'],
                'address'        => $data['address'],
                'contact_number' => $data['contact_number'],
            ]);

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            
        }

        DB::commit();
        return $user;


    }
}
