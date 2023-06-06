<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function getUsers() {

        $users = [
            "Jane Doe",
            "Janet jackson",
            "John wick",
            "Jude Don",
        ];
        // $users = [];

        
        return view('users', [
            'all' => "" ,
            'allUsers' => $users
        ]);
    }


    public function add_model(Request $request, $id)
    {
        $request->validate([
            'model'=> 'required',
            'date' => 'required'
        ]);

        $model = CarModel::create([
            'car_id' => $id,
            'model' => $request->model,
            'date_m' => $request->date
        ]);


        return back()->with('success', 'Model Added Successfully');
    }

    public function show_contact(){
        return view('contact');
    }


    public function send_message(Request $request){
       $request->validate([
        'message'=> 'required'
       ]);

       $to = "tester@gmail.com";

       $data = [
        'message' => $request->message,
        'time' => date('jS M. Y h:i a'),
       ];

       $mail = Mail::to($to)->send(new ContactMail($data)); //Plain Email

       if($mail){
        return back()->with('success', 'Mail Sent');
       }
       return back()->with('error', 'Mail Failed') ;
    }
}
