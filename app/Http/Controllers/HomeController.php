<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\Feedback;
use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function dashboard()
    {
     $total_feedback = Feedback::get()->count();
     $total_users = User::where('role_id',2)->get()->count();
     return view('dashboard.index',compact('total_feedback','total_users'));
    }
    public function home()
    {
     $products = Product::get();
      return view('frontend.home',compact('products'));
    }
    public function productDetail($product_id)
    {
     $product = Product::where('id',$product_id)->first();
     $feedbacks = Feedback::with(['user', 'comments' => function ($query) {
        $query->latest()->take(5); // Load the latest 5 comments for each feedback
     }])->latest()->paginate(2); // Paginate feedback with 2 items per page
     return view('frontend.product-detail',compact('product','feedbacks'));
    }
    public function storeFeedback(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required',
            'product_id' => 'required',
            'user_id' => 'required',
        ]);

        $data = $validatedData;
        $affected_rows = FeedBack::create($data);

        $response = ['response' => 'Your feedback has been successfully submitted.'];

        return json_encode($response);
    }
    public function storeComment(Request $request)
    {
        $affected_rows = Comment::create($request->all());
        $response = ['response' => 'Your Comment has been successfully submitted.'];
        return json_encode($response);
    }
}
