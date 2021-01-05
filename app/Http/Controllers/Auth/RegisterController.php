<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use App\Models\Person;
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
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'midd_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string'],
            'birthday' => ['required', 'date', 'before:today'],
            'phone' => ['required', 'regex:/(0)[0-9]{9}/'],
            'city' => ['required', 'string'],
            'district' => ['required', 'string'],
            'street' => ['required', 'string'],
            'apartment_number' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'username' => ['required', 'string', 'max:255', 'unique:persons'],
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
        $person = Person::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'midd_name' => $data['midd_name'],
            'last_name' => $data['last_name'],
            'status' => config('status.person.active'),
        ]);

        Customer::create([
            'phone' => $data['phone'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'person_id' => $person->id,
        ]);

        return $person;
    }

    public function showRegistrationForm()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://localhost:5000/provinces');
        $response = $request->getBody();
        $provinces = json_decode($response)->data;

        $request = $client->get('http://localhost:5000/districts', [
            'query' => ['province' => $provinces[0]]
        ]);
        $response = $request->getBody();
        $districts = json_decode($response)->data;

        return view('auth.register', compact('provinces', 'districts'));
    }
}
