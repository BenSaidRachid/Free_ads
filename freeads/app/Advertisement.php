<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
	protected $fillable = [
       'user_id', 'title', 'description', 'price','category_id','picture'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function images()
    {
    	return $this->hasMany(Image::class);
    }
    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
