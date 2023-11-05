<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    function __invoke(Feedback $feedback) {
        $user = Auth::user();
        $vote = $user->votes->where('feedback_id', $feedback->id)->first();

        if ($vote) {
            $vote->delete();
            $response = false;
        } else {
            Vote::create([
                'user_id' => $user->id,
                'feedback_id' => $feedback->id
            ]);
            $response = true;
        }

        return response()->json(['response' => $response]);
    }

}
