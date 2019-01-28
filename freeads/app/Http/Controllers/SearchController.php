<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Advertisement;
use \App\Category;
use \App\Messages;

class SearchController extends Controller
{
    public function searchShow(Request $request)
    {
        $notif = (\Auth::check()) ? Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get() : "";
        $advert =  Advertisement::latest()->where('title', 'like', '%' . $request['search'] 
    		. '%')->orWhere('description', 'like', '%' . $request['search'] . '%')->paginate(10);
    	return view("search.search")->with(array(
    		"research" => $advert,
    		"categories" => Category::all(),
            "notif" => $notif
    	));
    }
    public function show(Request $request)
    {
        $notif = (\Auth::check()) ? Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get() : "";
        return view("search.search")->with(array(
            "categories" => Category::all(),
            "notif" => $notif
        ));
    }
    public function search(Request $request)
    {
        $notif = (\Auth::check()) ? Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get() : "";
    	$search = $request['search'];
    	$where = ($request->has('category_id')) ?  [
	    		['price', '<=', intval($request['price'])],
	            ['category_id', '=' ,  $request['category_id']]
        	] : [
        			['price', '<=', intval($request['price'])]
        		];
		$advert =  Advertisement::where($where)
		->where(function($query) use ($search) {
			$query->where('description', 'like', '%' . $search . '%');    
			$query->orWhere('title', 'like', '%' . $search . '%');
		})->orderBy('updated_at', $request['order'])->paginate(10);

        return view("search.search")->with(array(
    		"research" => $advert,
    		"categories" => Category::all(),
            "notif" => $notif
    	));
    }
}




