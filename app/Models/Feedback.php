<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Feedback extends Model
{
    use HasFactory;
    protected $guarded = array();
    protected $table = 'feedback';
    public function user()
    {
     return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    function votes() {
        return $this->hasMany(Vote::class);
     }
    public function products()
    {
     return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
