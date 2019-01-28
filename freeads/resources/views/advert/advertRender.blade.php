<div class="blog-post">
	<h2 class="blog-post-title">
		<a href="advert/{{$advert->id}}">
		{{$advert->title}}
		</a>
	</h2>
	<div class="image-container">
		<img src="{{ Illuminate\Support\Facades\Storage::url($advert->picture) }}" alt="description" class="image-description" />
	</div>
	<div class="product-container">
		<p>{{$advert->description}}</p>
		<p>{{$advert->price}}€ </p>
		<p><i>{{$advert->updated_at->diffForHumans()}}</i></p>
	</div>
</div>