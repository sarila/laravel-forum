<?php

namespace App\Models;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ReplyMarkedAsBestReply;

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

    // Replace Default Parameter used during route model binding (use slug instead of id)
    public function getRouteKeyName() {
    	return 'slug';
    }

    public function markAsBestReply(Reply $reply) {
        $this->update([
            'reply_id' => $reply->id,
        ]);
        $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
    }

    public function bestReply () {
        return $this->belongsTo(Reply::class, 'reply_id');
    }
}
