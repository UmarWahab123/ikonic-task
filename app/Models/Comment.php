<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = array();
    protected $table = 'comments';
    public function user()
    {
     return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function feedback()
    {
     return $this->belongsTo('App\Models\Feedback', 'feedback_id', 'id');
    }
}
