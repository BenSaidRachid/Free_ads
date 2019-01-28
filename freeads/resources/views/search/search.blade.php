@extends('layouts.index')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search</div>

                <div class="card-body">
                    <form method="POST" action="/search/filtered" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="categories" class="col-md-4 col-form-label text-md-right">Categories</label>
                            <div class="col-md-6">
                                <select name="category_id" class="form-control">
                                    <option selected disabled hidden>Choose a category...</option>
                                   @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{$categorie['names']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                            <div class="slidecontainer col-md-6">
                              <input type="range" min="1" max="10000" value="10000" name="price" class="slider" id="myRange" >
                              <p>Value: <span id="demo"></span> €</p>
                               @if ($errors->has('price'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="search" class="col-md-4 col-form-label text-md-right">Search</label>

                            <div class="col-md-6">
                                <input id="search" type="text" class="form-control{{ $errors->has('search') ? ' is-invalid' : '' }}" name="search" value="{{ old('search') }}" autofocus>

                                @if ($errors->has('search'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('search') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order" class="col-md-4 col-form-label text-md-right">Order by</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="order" id="options1" value="desc" value="option1" checked>
                                    Newest
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="order" id="options2" value="asc" value="option2">
                                    Oldest
                                  </label>
                                </div>
                                @if ($errors->has('search'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if(isset($research))
                @foreach($research as $search)
                    @include("search.searchRender")
                @endforeach
                {{ $research->appends(request()->input())->links() }}
            @endif
        </div>
    </div>
</div>
@endsection