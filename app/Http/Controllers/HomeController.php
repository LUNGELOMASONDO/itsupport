<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Slot;
use App\Models\Technician;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if($user->type == "TECH")
        {
            $data = [
                'technician' => $user,
            ];
            return view('technician.profile')->with($data);
        }
        elseif($user->type == 'USER')
        {
            $slots = Slot::all();
            
            $data = [
                'user' => $user,
                'slots' => $slots,
            ];
            return view('user.home')->with($data);
        }

        /* Super Admin */

        $technicians = Technician::all();

        $data = [
            'user' => $user,
            'technicians' => $technicians
        ];
        return view('home')->with($data);
    }

    public function showRegistrationForm()
    {
        $user = Auth::user();

        $data = [
            'user' => $user,
        ];
        return view('auth.register')->with($data);
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
            'id' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'usertype' => ['required', 'string', Rule::in(['SUPER', 'TECH', 'USER'])],
            'phonenumber' => ['required', 'string', 'min:10', 'unique:users,cellphone'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createTechnician(Request $request)
    {
        $data = $request->all();
        
        $this->validator($data)->validate();
        
        $user = \App\User::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'type' => $data['usertype'],
            'cellphone' => $data['phonenumber'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        return redirect()->route('home');
    }
}
