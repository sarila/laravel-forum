<?php

namespace App\Models;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\User;
use App\Notifications\ReplyMarkedAsBestReply;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
	protected $guarded = [];
    use HasFactory;


    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function replies() {
    	return $this->hasMany(Reply::class);
    }

    public function scopeFilterByChannels($builder) {
        if (request()->query('channel')) {
            $channel = Channel::where('slug', request()->query('channel'))->first();

            if ($channel) {
                return $builder->where('channel_id', $channel->id);
            }
            return $builder;
        }

        return $builder;
    }

    // Replace Default Parameter used during route model binding (use slug instead of id)
    public function getRouteKeyName() {
    	return 'slug';
    }


    public function markAsBestReply(Reply $reply) {
        $this->update([
            'reply_id' => $reply->id,
        ]);

        if ($reply->owner->id != $this->user) {

            $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
        }
    }

    public function bestReply () {
        return $this->belongsTo(Reply::class, 'reply_id');
    }
}
