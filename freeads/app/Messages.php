<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
       'sender_id', 'receiver_id', 'message', 'status'
    ];
    
    public function receiver()
    {
    	return $this->belongsTo(User::class);
    }

    public function sender()
    {
    	return $this->belongsTo(User::class);
    }
}
