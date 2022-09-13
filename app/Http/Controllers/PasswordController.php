<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class PasswordController extends Controller
{
    public function index()
    {
        return view(
            'password.index',
            [
                'password' => Password::where('users_id','=',Auth::id())->get()
            ]
        );
    }

    public function create()
    {
        return view('password.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|same:confirm-password'
        ]);
        $input = $request->all();
        $input['password'] =  Crypt::encrypt($input['password']);
        $input['users_id']= Auth::id();
    
        $password = Password::create($input);
    
        return redirect()->route('password.index')
                        ->with('success','hasło zapisano');
    }

    public function edit(Password $password)
    {
        $passwordshow = Crypt::decrypt($password->password);
        return view(
            'password.edit',
            compact('password','passwordshow')
        );
    }

    public function update(Request $request, Password $password)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|same:confirm-password'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Crypt::encrypt($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $password->update($input);
        
    
        return redirect()->route('password.index')
                        ->with('success','Zapisano zmiany');
    }

    public function delete(Password $password)
    {
        $password->forceDelete();
        return redirect()->route('password.index')
        ->with('success', __('Usunięto', [
            'name' => $password->name
        ]));
    }

    public function show(Request $request)
    {
        
        $password=Password::find($request->input('id'));
        //return $request->input('id');
        
        $decrypted = Crypt::decrypt($password->password);
        return $decrypted;
    }
}
