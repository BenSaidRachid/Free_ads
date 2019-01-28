@extends('layouts.index')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="blog-post">
                <p>{{$user['firstname']}}</p>
                <p>{{$user['lastname']}}</p>
                <p>{{$user['email']}}</p>
                <a href="/profil/{{$user['id']}}/edit" class="btn btn-primary">Edit</a>
                <a href="/profil/{{$user['id']}}/delete" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
