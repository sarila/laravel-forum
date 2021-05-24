@extends('layouts.app')

@section('content')



@foreach($discussions as $discussion)
    <div class="card my-3">
   
        @include('partials.discussion-header')
        
        <div class="card-body">
            {{ $discussion->title }}
        </div>
    </div>
@endforeach
    {{ $discussions->links() }}
@endsection
