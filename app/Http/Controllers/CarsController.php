<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\Cars;
use App\Models\Engine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
       $this->middleware(['auth','is_admin', 'verified'])->only([
        'create',
        'edit'
       ]);
    }

    public function index()
    {
        // $cars = Cars::all();

        // $cars = Cars::orderBy('id','desc')->get();

        // $cars = Cars::latest()->get();

        // $cars = Cars::oldest()->get();

        // $cars = Cars::where('color','!=','#000000')->get();
        // $cars = Cars::where('color','#000000')->get();
        // dd($cars);

        $cars = Cars::orderBy('id','desc')->paginate(10);
        
        return view('cars.index',[
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => "required|string",
            'color' => "required|string",
            'date' => "required|date",
            'price' => "required|numeric",
            'transmission' => ['required', 'string']
        ]);

        $cars = Cars::create([
            'title' => $request->input('title'),
            'color' => $request->color,
            'm_date' => $request->date,
            'price' => $request->price,
            'transmission' => $request->transmission
        ]);

        // return redirect('/cars/create');

        // return redirect()->route('cars.create');    

        return back()->with('success', $request->title . ' Has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Cars::findOrFail($id);
        return view('cars.show', [
            'car' => $car 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $car = Cars::where('id', $id)->first(); 

        // $car = Cars::find($id);

        $car = Cars::findOrFail($id);

        // $engine = Engine::where('car_id', $car->id)->first();


        // dd($engine);
        return view('cars.edit',[
            'car' => $car
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => "required|string",
            'color' => "required|string",
            'date' => "required|date",
            'price' => "required|numeric",
            'transmission' => ['nullable', 'string',"in:Automatic,Manual,Electric"]
        ]);


        $car = Cars::findOrFail($id);

        $carUpdate = Cars::where('id', $id)->update([
            'title' => $request->input('title'),
            'color' => $request->color,
            'm_date' => $request->date,
            'price' => $request->price,
            'transmission' => $request->transmission == null? $car->transmission : $request->transmission
        ]);

        if($carUpdate){
            return back()->with('success', "Record updated");
        }else{
            return back()->with('error', "Record update failed");
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $carDelete = Cars::findOrFail($id)->delete();
        $carDelete = Cars::where('id', $id)->delete();
        if($carDelete){
            return back()->with('success', "Record deleted");
        }else{
            return back()->with('error', "Record delete failed");
        }

    }



    public function upload_image(Request $request, $id)
    {
        $request->validate([
            'file' => "required|image|mimes:jpeg,jpg,png,webp,gif|max:5024"
        ]);

        $cars = Cars::findOrFail($id);
        $oldFile = $cars->image;


        $storage_location = 'uploads';
        // $fileName = time() . "." . $request->file->getClientOriginalExtension();

        $fileName = time() . "." . $request->file->extension();

        $move = $request->file->move($storage_location, $fileName);
       
        $cars = Cars::findOrFail($id)->update([
            'image' => $fileName
        ]);


        if (File::exists(public_path('uploads/'. $oldFile))) {
            File::delete(public_path('uploads/'. $oldFile));
        }

        return back()->with('success', 'Image uploaded');
    }
}
