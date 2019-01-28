@extends('layouts.index')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<div class="blog-post">
				<h2 class="blog-post-title">
					{{$advert->title}}
				</h2>
				<div class="all">
					<div class="image-container col-sm-4">
						<img src="{{ Illuminate\Support\Facades\Storage::url($advert->picture) }}" alt="description" class="image-description" />
					</div>
					<div class="product-container col-sm-6">
						<div>
							<h4>Description</h4>
							<p>{{$advert->description}}</p>
						</div>
						<div>
							<h4>Price</h4>
							<p>{{$advert->price}}€ </p>
						</div>
						<div>
							<h4>Email</h4>
							<p>{{$advert->user['email']}}</p>
						</div>
						<p><i>{{$advert->updated_at->diffForHumans()}}</i></p>
						<a href="/message/{{$advert->user_id}}" class="btn btn-primary">Send a message</a>
					</div>
				</div >
				<div class="container_image">
					<ul class="inline-list ">
						@if($advert->images->count() > 0)
							@foreach($advert->images as $image)
							<li class="list-inline-item description_image">
								<img src="{{ Illuminate\Support\Facades\Storage::url($image->description_picture) }}" alt="description" class="image-description" />
							</li>
							@endforeach
						@endif
					</ul>
				</div>
				@if(Auth::check())
					@if(Auth::user()->id == $advert->user_id)
	                    <a href="/advert/{{$advert->id}}/edit" class="btn btn-primary">Edit</a>
	                    <a href="/advert/{{$advert->id}}/delete" class="btn btn-danger">Delete</a>
	                @endif
	            @endif
			</div>
		</div>
	</div>
</div>
@endsection