@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Add Discussion</div>

    <div class="card-body">
        @foreach($errors as $error)
            <p>{{$error}}</p>
        @endforeach
       <form action="{{route('discussions.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{old('title')}}">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <input type="hidden" name="content" id="content">
                <trix-editor input="content"></trix-editor>
                <!-- <textarea class="form-control" name="content" rows="5" cols="5"></textarea> -->
            </div>

            <div class="form-group">
                <label for="channel_id">Channel</label>
                <select name="channel_id" id="channel_id" class="form-control">
                    @foreach($channels as $channel)
                        <option value="{{$channel->id}}"> {{$channel->name}}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success" type="submit">Create Discussion</button>
       </form>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endsection