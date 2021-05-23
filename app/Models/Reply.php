<?php

namespace App\Models;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $guarded = [];

    //Links replies to its owner
    public function owner() {
    	return $this->belongsTo(User::class, 'user_id');
    }

    //For Discussion

    public function discussion() {
    	return $this->belongsTo(Discussion::class);
    }

}
