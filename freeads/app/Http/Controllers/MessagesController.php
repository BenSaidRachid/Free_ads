<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Messages;
class MessagesController extends Controller
{

	public function show()
	{
        $notif = Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get();
        Messages::where('receiver_id',\Auth::user()->id)
        ->update([
            'status' => true
        ]);
		$all = Messages::latest()->where('sender_id',\Auth::user()->id)
		->orWhere('receiver_id',\Auth::user()->id)->paginate(5);
		$send_to = Messages::distinct()->where('receiver_id',\Auth::user()->id)->get(["sender_id"]);
		return view("message.messaging")->with(array(
			"msg" => $all,
			"send_to" => $send_to,
            "notif" => $notif
		));
	}

	public function answer()
    {
    	$this->validate(request(),[
        	'message' => 'required'
        ]);

       	Messages::create([
            'sender_id' => \Auth::user()->id,
            'receiver_id' => request("receiver_id"),
            'message' => request("message")
		]); 
		return redirect("/message");
    }

    public function create($id)
    {
        $notif = Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get();
    	return view("message.send")->with(array(
            "dest" => $id,
            "notif" => $notif
        ));
    }

    public function store($id, Request $request, Messages $messages)
    {
    	$this->validate(request(),[
        	'message' => 'required'
        ]);

    	if(\Auth::user()->id == $id) {
			return redirect("/message/$id")->with("warning","You can't send a message to yourself");
		}

		$messages::create([
            'sender_id' => \Auth::user()->id,
            'receiver_id' => $id,
            'message' => $request["message"]
		]); 

		return redirect("/message");
    }
}
