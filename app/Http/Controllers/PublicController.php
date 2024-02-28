<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Pagination\Paginator;
use App\Mail\CarMail;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Models\Message;
use App\Models\Testimonial;
use App\Models\User;
use App\Traits\Common;

class PublicController extends Controller
{
    use Common;
    public function index()
    {
        $carTypes = Car::pluck('title', 'id'); // Assuming 'title' is the field representing car types
        
        $messages=Message::get();
        $cars= car::take(6)->get();
        $categories = Category::get();
        $testimonials = Testimonial::take(3)->get();
        return view('index',compact('testimonials','messages','cars','categories','carTypes'));
    }
    public function sendEmails(Request $request)
    {
             $data=$request->validate([
            'fname'=>'required|string',
            'lname'=>'required|string',
            'email'=>'required|string',
            'message'=>'required|string',
        ]);
 
         Message::create($data);
        Mail::to('abeir@gmail.com')->send(new CarMail($data));
 
         return view('contact');
          
     }
     public function testimonial()
     {
     $testimonials=Testimonial::get();
     return view('testimonials',compact('testimonials'));
    }

    public function listing()
{
    $cars= car::paginate(6);
    //$cars= car::take(6)->get();
    $categories = Category::get();
    $testimonials = Testimonial::take(3)->get();

return view('listing', compact('cars', 'categories' ,'testimonials'));
}
    public function show(string $id)
{ 
    // Retrieve the specific message by its ID
    $message = Message::findOrFail($id);

    // Check if the message is unread
    if (!$message->is_read) {
        // If unread, mark it as read and decrement the unread_count
        $message->update(['is_read' => true]);
        $message->decrement('unread_count');
    }

    // Fetch the latest messages after updating
    $latestMessages = Message::latest()->get();
    $unreadCount = $latestMessages->where('is_read', false)->count();

    return view('admin.messages', compact('latestMessages', 'unreadCount'));
}
public function about(){
return view('about');

}
}