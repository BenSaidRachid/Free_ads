<div class="blog-post search-value">
	<h2 class="blog-post-title">
		<a href="/advert/{{$search->id}}">
		{{$search->title}}
		</a>
	</h2>
	<div class="image-container">
		<img src="{{ Illuminate\Support\Facades\Storage::url($search->picture) }}" alt="description" class="image-description" />
	</div>
	<div class="product-container">
		<p>{{$search->description}}</p>
		<p>{{$search->price}}€ </p>
		<p><i>{{$search->updated_at->diffForHumans()}}</i></p>
	</div>
</div>