<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReplyRequest;
use App\Models\Discussion;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Notifications\NewReplyAdded;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReplyRequest $request, Discussion $discussion)
    {
        auth()->user()->replies()->create([
            'content' => $request->reply,
            'discussion_id' => $discussion->id,
        ]);

        if ($discussion->user->id != auth()->user()->id) {
            $discussion->user->notify(new NewReplyAdded($discussion));

        }

        Session::flash('success', 'Reply Added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
