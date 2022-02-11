<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Helpers\Helper;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $random  = rand(1000,999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'referal_code' => $random,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if (Auth()->user()->rule_id == 1){
            return route('admin.dashboard');
        }elseif (Auth()->user()->rule_id == 2){
            return route('user.dashboard');
        }
    }

    public function profileUpdate(Request $request, $id){
        $request->validate([
            'name' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            'phone' => [  'max:255', ],
            'gender' => [ 'required',],
            'profile_photo' => [ 'required'],
        ]);
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->date_of_birth = $request->date_of_birth;
        $data->gender = $request->gender;

        if ($request->hasFile('profile_photo')){
            $file = $request->file('profile_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.'.$extension;
            $file->move('upload/profile-imgs',$filename);
            $data['profile_photo']=$filename;
        }else{
            return $request;
            $data->image = '';
        }

        $data-> update();

      return redirect()->back();
    }
}
