<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use \App\User;
use \App\Advertisement;
use \App\Image;
use \App\Category;
use \App\Messages;

class AdvertisementController extends Controller
{
    public function create()
    {
        $notif = Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get();
    	return view("advert.advertisement")->with(array(
            "categories" => Category::all(),
            "notif" => $notif
        ));
    }
    public function show($id)
    {
        if(!Advertisement::find($id))
            return  redirect()->route("home");
        $notif = (\Auth::check()) ? Messages::latest()->where('receiver_id',\Auth::user()->id)
        ->where("status",false)->get() : "";
        return view("advert.describeAdvert")->with(array(
            "advert" => Advertisement::find($id),
            "notif" => $notif
            ));
    }
    public function delete($id, Advertisement $advert)
    {
        if($advert->find($id)) {
            if(auth()->id() == $advert->find($id)->user_id) {
                $advert->find($id)->images()->delete();
                $advert->find($id)->delete();
            }
        }
        return redirect()->route("home");
    }
    public function edit($id, Advertisement $advert)
    {
        if($advert->find($id)) {
            if(auth()->id() == $advert->find($id)->user_id) {
                $notif = Messages::latest()->where('receiver_id',\Auth::user()->id)
                ->where("status",false)->get();
                return view("advert.advertEdit")->with(array(
                    "categories" => Category::all(),
                    "advert" => Advertisement::find($id),
                    "notif" => $notif
                ));
            }
        }
        return redirect()->route("home");
    }
    public function update($id, Advertisement $advert, Request $request)
    {
        if ($advert->find($id)) {
            if (auth()->id() == $advert->find($id)->user_id) {
                $this->validate(request(),[
                    'title' => 'required',
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'category_id' => 'required',
                ]);

                $advert->where('id', $id)
                ->update([
                    'title' => $request["title"],
                    'description' => $request["description"],
                    'price' => $request["price"],
                    'category_id' => $request["category_id"]
                ]);

                $path = "/public/UserAdvert/" .auth()->user()->id. "/".$id;

                if ($request->hasFile('picture')) {
                     $image = $request->picture->store($path);
                    Advertisement::where('id', $id)
                        ->update([
                            'picture' => $image,
                        ]);
                }

                if ($request->hasFile('description_picture')) {
                    if ($advert->find($id)->images()) {
                        $advert->find($id)->images()->delete();
                    }
                    foreach ($request->description_picture as $value) {
                        $image = $value->store($path);
                        Image::create([
                            'advertisement_id' => $id,
                            'description_picture' => $image
                        ]); 
                    }
                }
            }
        }
        return redirect("home");
    }
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'picture' => 'required',
            'category_id' => 'required',
        ]);
        $advertisement = Advertisement::create([
            'user_id' => auth()->user()->id,
            'title' => $request["title"],
            'description' => $request["description"],
            'price' => $request["price"],
            'category_id' => $request["category_id"]
        ]); 
        
        $path = "/public/UserAdvert/" .auth()->user()->id. "/".$advertisement->id;
        $image = $request->picture->store($path);

        Advertisement::where('id', $advertisement->id)
            ->update([
                'picture' => $image,
            ]);
       
        if ($request->hasFile('description_picture')) {
            foreach ($request->description_picture as $value) {
                $image = $value->store($path);
                Image::create([
                    'advertisement_id' => $advertisement->id,
                    'description_picture' => $image
                ]); 
            }
        }
        return redirect()->route("home");
    }
}
