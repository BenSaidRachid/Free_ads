<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Advertisement;
use \App\Messages;

class IndexController extends Controller
{
    public function showIndex()
    {
        $notif = (\Auth::check()) ? Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get() : "";
        $advert =  Advertisement::latest()->paginate(10);
    	return view("home")->with(array(
            "adverts" =>  $advert,
            "notif" => $notif
        ));
    }
    public function show($id, User $user)
    {
        $notif = (\Auth::check()) ? Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get() : "";
    	if($user->find($id))
		{
			if(auth()->id() == $id)
   				return view("auth.profil")->with(array(
                    "user" => User::find($id),
                    "notif" => $notif
                ));
		}
       	return back();
    }
    public function delete($id, User $user)
    {
        if($user->find($id))
        {
            if(auth()->id() == $id)
            {
                $user->where('id', $id)
                ->update([
                    'status' => false
                ]);
                auth()->logout();
            }
        }
        return redirect()->route("home");
    }
    public function update($id, User $user)
    {
        if($user->find($id))
        {
            $mailCHeck = ($user->find($id)->email == request('email')) ?  'required|string|email|max:255' : 'required|string|email|max:255|unique:users';
            $this->validate(request(),[
            	'firstname' => 'required|string|max:255',
	            'lastname' => 'required|string|max:255',
	            'email' => $mailCHeck,
	            'password' => 'required|string|min:6|confirmed',
            ]);
            if(auth()->id() == $id)
            {
                $user->where('id', $id)
                ->update([
                	'firstname' => request('firstname'),
		            'lastname' => request('lastname'),
		            'email' => request('email'),
		            'password' =>  bcrypt(request("password")),
                ]);
            }
        }
        return redirect()->route("home");
    }
    public function edit($id, User $user)
    {
        if($user->find($id))
        {
            if(auth()->id() == $id)
            {
                $notif = (\Auth::check()) ? Messages::latest()->where('receiver_id',\Auth::user()->id)
                ->where("status",false)->get() : "";
                return view('auth.profilEdit')->with(array(
                    'user' => $user->find($id),
                    'notif' => $notif
                 ));
            }
        }
        return redirect()->route("home");
    }
}
