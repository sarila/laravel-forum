@extends('layouts.app')

@section('content')

    <div class="card">
	    @include('partials.discussion-header')

	    <div class="card-body">
	        <div class="text-center">
	        	<strong>{{ $discussion->title }}</strong>
	        </div>
	        <hr>
	        {!! $discussion->content !!}
	    </div>
	</div>
	@foreach($discussion->replies()->paginate(3) as $reply)
		<div class="card my-3">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<div>
						<img width="30px" height="30px" style="border-radius: 50%;" src=" {{Gravatar::src($reply->owner->email)}} " alt="avatar"> 
						<span> {{$reply->owner->name}}</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				{!! $reply->content !!}
			</div>
		</div>
	@endforeach

	{{$discussion->replies()->paginate(3)->links()}}

	<div class="card my-4">
		<div class="card-header">
			Reply to discussion
		</div>
		@auth
			<div class="card-body">
				<form method="POST" action=" {{ route('replies.store', $discussion->slug)}}">
					@csrf
					<input type="hidden" name="reply" id="reply">
					<trix-editor input="reply"></trix-editor>

					<button class="btn btn-success btn-sm mt-2" type="submit">Add Reply</button>
				</form>
			</div>
		@else
			<a href="{{route('login')}}" class="btn btn-info"> Sigin to add reply</a>

		@endauth
	
	</div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endsection
