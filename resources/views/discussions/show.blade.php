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

	        @if($discussion->bestReply)
				<div class="card my-5">
					<div class="card-header bg-success" style="color: white;">
						<div class="d-flex justify-content-between">
							<div>
								<img width="40px" height="40px" style="border-radius: 50%;" src="{{Gravatar::src('$discussion->bestReply->owner->email')}}">
								<strong> {{$discussion->bestReply->owner->name}}</strong>
							</div>
							<div>
								Best Reply
							</div>
						</div>
					</div>
					<div class="card-body">
						
						{!! $discussion->bestReply->content !!}
					</div>
				</div>
			@endif
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
					<div>
						@if(auth()->user()->id === $discussion->user_id)
							<form action=" {{route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id])}} " method="POST">
								@csrf
								<button type="submit" class="btn btn-sm btn-primary">Mark as Best Reply</button>
							</form>
						@endif
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
