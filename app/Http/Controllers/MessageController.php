<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\CarMail;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $messages =Message::with('user')->get();
        $messages =Message::paginate(3);
        return view('admin.messages', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $messages=Message::get();
        return view('contact', compact('messages'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        
        $data = $request->validate([
    'fname'=>'required|string',
    'lname'=>'required|string',
   'email'=>'required|string',
   'message'=>'required|string',
   
    ]);

    Message::create($data);
        return redirect('index');
       
}
     
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{ 
    $messages =Message::findOrFail($id);
   
  //  if (!$message->is_read) {
       $messages->update(['is_read' => true]);
        $messages->decrement('unread_count');

        // Debugging statements
    //    dd($message->unread_count); // Output the updated unread_count value
   // }

   // $messages = Message::latest()->get();
    $unreadCount = $messages->where('unread_count', false)->count();

    return view('admin.showmsg', compact('messages', 'unreadCount'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Message::where('id',$id)->delete();
        
        return redirect('admin/messages');
    }
   // public function showmsg(string $id)
  //  {
      // $msg= Message::findOrFail($id);
      // $msg->update(['unread_count' => 1]);
      // return view('emails.carmail', compact('msg'));
   // }
   
}
