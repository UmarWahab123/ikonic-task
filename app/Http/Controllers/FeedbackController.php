<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
class FeedbackController extends Controller
{
  public function feedbackList(){
    $feedbacks = Feedback::with('user','products')->get();
    return view('feedback.index',compact('feedbacks'));
  }
  public function delete(Request $request)
    {
        $id = $request->input('id');
        $feedback = Feedback::find($id);
       if ($feedback) {
            $affected_rows = $feedback->delete();
            return back()->with(['success' => 'Feedback has been deleted successfully!']);
       }else{
         return back()->with(['error' => 'Feedback not found!']);
       }

    }
}
