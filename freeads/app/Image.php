<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable = [
       'advertisement_id', 'description_picture'
    ];
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
