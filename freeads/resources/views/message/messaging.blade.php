@extends('layouts.index')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Messages</div>

                <div class="card-body">
                    <ul class="list-group">
                        @if($msg->count() > 0)
                            @foreach($msg as $message)
                                @if($message->sender['firstname'] != null)
                                    <li class="list-group-item">
                                        <span><strong>{{$message->sender['firstname']}} {{$message->sender['lastname']}}</strong></span> :
                                        {{$message->message}} 
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            {{$msg->render()}}
            <div class="card">
                <div class="card-header">Answer</div>
                    <div class="card-body">
                        <form method="POST" action="/message/answer" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="to" class="col-md-4 col-form-label text-md-right">To</label>
                                <div class="col-md-6">
                                   <select name="receiver_id" class="form-control">
                                       @foreach($send_to as $message)
                                            @if($message->sender['id'] != Auth::user()->id && $message->sender['firstname'] != null)
                                            <option value="{{ $message->sender['id'] }}">{{$message->sender['email'] }} ({{$message->sender['firstname'] }} {{$message->sender['lastname']}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">Message</label>

                                <div class="col-md-6">
                                    <textarea id="message" type="text" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" placeholder="Tap your message" required autofocus></textarea>

                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection