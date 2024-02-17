<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $messages =Message::with('user')->get();
        $users=User::get();
        return view('admin.users',compact('users','messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $messages = Message::latest()->get();
        $unreadCount = $messages->where('is_read', false)->count();
    
        return view('admin.adduser', compact('messages', 'unreadCount'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        $data = $request->validate([
        'fullname'=>'required|string|max:50',
        'user_name'=>'required|string|max:50',
        'email'=>'required|string|max:50',
        'password'=>'required',
        'active'=>'required',
        
       ]);
        
       $data['active'] = isset($request->active);
       
       User::create($data);
     
      
       return redirect('admin/users');
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $users =User::findOrFail($id);
        $messages =Message::with('user')->get();
        return view('admin.edituser',compact('users','messages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate the request data
    $data = $request->validate([
        'fullname' => 'required|string|max:50',
        'user_name' => 'required|string|max:50',
        'email' => 'required|string|email|max:50',
        'password' => 'required',
        'active' => 'sometimes|boolean', // 'sometimes' makes 'active' optional
    ]);

    // Find the user by ID
    $user = User::find($id);

    // Check if the user exists
    if ($user) {
        // Update the 'active' status
        if (isset($data['active'])) {
            $user->active = $data['active'];
        } else {
            // If 'active' is not provided, set it to false
            $user->active = false;
        }

        // Update the user with the validated data
        $user->update($data);

        return redirect('admin/users')->with('success', 'User updated successfully.');
    }
}
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id',$id)->delete();
        
        return redirect('admin/users');
    }
    

    
}
