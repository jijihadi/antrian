<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $data['data'] = DB::table('users')->where('role',2)->get();
        // dd($data['data']);
        return view('users.index', $data);
    }

    public function create()
    {

        return view('users.create');
    }

    public function store(request $request) 
    {
        
        $request->validate([ 
                'name' => [
                    'required', 'min:3'
                ],
                'nik' => [
                    'required','min:6'
                ],
                'password' => [
                 'required', 'confirmed', 'min:6'
                ]
            
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 2;
        $user->save();
         
    
        return redirect()->route('user.index')
                        ->with('success','user created successfully.');

    }
}
 