<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Traits\Common;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Common;
    public function index()
    {  
        
        $messages =Message::with('user')->get();
        $cars= car::get();
        return view('admin.cars',compact('cars','messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messages =Message::with('user')->get();
        $categories=Category::get();
        return view('admin.addcar', compact('categories','messages'));
        $msgs= $this->messages();
        return view('admin.addcar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $data = $request->validate([
             'title'=>'required|string|max:50',
             'content'=>'required|string|max:100',
             'luggage'=>'required|string|max:50',
             'doors'=>'required|string|max:50',
             'passengers'=>'required|string|max:50',
             'price'=>'required|string',
             'image' =>'sometimes|mimes:png,jpg,jpeg|max:2048',
             'category_id'=>'required|string',
             
            ]);

            $fileName = $this->uploadFile($request->image, 'adminassets/images');    
        $data['image'] = $fileName;
        $data['status'] = $request->has('status');
        Car::create($data);
        return redirect('admin/cars');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   $car =Car::find($id);
        $category = $car->category;
        $categories = Category::all();

        return view ('single', compact('car','categories','category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $messages =Message::with('user')->get();
        $cars=Car::findOrFail($id);
        $categories=Category::get();
        return view ('admin.editCar', compact('cars','categories','messages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $data = $request->validate([
             'title'=>'required|string|max:50',
             'content'=>'required|string|max:100',
             'luggage'=>'required|string|max:50',
             'doors'=>'required|string|max:50',
             'passengers'=>'required|string|max:50',
             'price'=>'required|string',
             'image' =>'sometimes|mimes:png,jpg,jpeg|max:2048',
             'category_id'=>'required|string',
            ]);

            if($request->hasFile('image')){
                $fileName = $this->uploadFile($request->image, 'adminassets/images');    
                $data['image'] = $fileName;
               
            }else{
                $data ['image']=$request->oldImage;
                //unlink("assets/images/" . $request->oldImage);
            }
             
            $data['status'] = isset($request->status);
                Car::where('id', $id)->update($data);
                return redirect('admin/cars');
            }
            public function search(Request $request)
            {
                // Retrieve selected car type from the select menu
                $selectedOption = $request->input('carType');
            
                // Query cars based on the selected car type
                $cars = Car::where('title', $selectedOption)->get();
            
                // Return the search results to a view or perform further actions as needed
                return view('search-results', compact('cars'));
            }
            

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        car::where('id',$id)->delete();
        
        return redirect('admin/cars');
    }

    public function blog()
 { $cars= car::get();
    return view('blog',compact('cars'));
   
}

}
