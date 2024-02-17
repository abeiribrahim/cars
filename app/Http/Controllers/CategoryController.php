<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Message;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Traits\Common;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Common;
    public function index()
    {   $messages =Message::with('user')->get();
        $categories= Category::get();
        return view('admin.categories',compact('categories','messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messages = Message::with('user')->get();
        $categories = Category::get();
        return view('admin.addcategory', compact('categories', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    $data = $request->validate([
        'cat_name' => 'required|string',
    ]);

    try {
        Category::create($data);
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        return redirect()->back()->withErrors(['error' => 'An error occurred while creating the category.'])->withInput();
    }

    // Flash success message to the session
    session()->flash('success', 'Category created successfully.');

    return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $messages =Message::with('user')->get();
        $categories =Category::findOrFail($id);
        
        return view ('admin.editcategory', compact('categories','messages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        $data = $request->validate([
            'cat_name'=>'required|string',
        ]);
        Category::where('id', $id)->update($data);
                return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id',$id)->delete();
        
        return redirect('admin/categories');
    }



    public function showCategories()
{
    // Retrieve all categories
    $categories = Category::all();

    // Create an associative array to store category names and their corresponding car counts
    $categoryCarCounts = [];

    // Loop through each category to count the number of cars it contains
    foreach ($categories as $category) {
        $carCount = Car::where('category_id', $category->id)->count();
        $categoryCarCounts[$category->cat_name] = $carCount;
    }

    // Pass the categories and their car counts to the view
    return view('single', compact('categoryCarCounts'));
}


  
}
