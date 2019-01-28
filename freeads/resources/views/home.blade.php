@extends('layouts.index')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	@if($adverts->count() != 0)
            	<h1>Advertisements</h1>
            @else
           		<h1>Nothing found</h1>
            @endif
            @foreach($adverts as $advert)
                @include("advert.advertRender")
            @endforeach
    		{{$adverts->render()}}
        </div>
    </div>
</div>
@endsection