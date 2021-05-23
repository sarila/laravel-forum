<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
	protected $guarded = [];
    use HasFactory;


    public function user() {
    	return $this->belongsTo(User::class);
    }

    // Replace Default Parameter used during route model binding (use slug instead of id)
    public function getRouteKeyName() {
    	return 'slug';
    }
}
