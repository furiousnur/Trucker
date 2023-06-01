<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        if (empty($data['type'])){
            return Validator::make($data, [
                'type' => ['required']
            ]);
        }
        if ($data['type'] == 'passenger' || $data['type'] == 'driver' ){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'numeric'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'gender' => ['required'],
            ]);
        }
        if ($data['type'] == 'passenger'){
            return Validator::make($data, [
                'nid' => ['required'],
            ]);
        }
        if ($data['type'] == 'driver'){
            return Validator::make($data, [
                'address' => ['required', 'string'],
                'dr_lic_num' => ['required'],
                'veh_reg_num' => ['required'],
                'dob' => ['required'],
                'monthly_income' => ['required'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_type' => $data['type'],
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'nid' => $data['type'] == 'passenger' ? $data['nid'] : null,
            'address' => $data['type'] == 'driver' ? $data['address'] : null,
            'dr_lic_num' => $data['type'] == 'driver' ? $data['dr_lic_num'] : null,
            'veh_reg_num' => $data['type'] == 'driver' ? $data['veh_reg_num'] : null,
            'dob' => $data['type'] == 'driver' ? $data['dob'] : null,
            'monthly_income' => $data['type'] == 'driver' ? $data['monthly_income'] : null,
        ]);
    }
}
