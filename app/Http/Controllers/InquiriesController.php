<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inquiry;
use App\User;
use App\Mail\InquirySent;
use Illuminate\Support\Facades\Mail;

class InquiriesController extends Controller
{
    public function inquiry(){
        return view("inquiries.inquiry");
    }
    
    public function querying(Request $request){
        
        if(\Auth::check()){
            $this->validate($request, [
                "inquiry" => "required|max:300",
            ]);
        }else{
            $this->validate($request, [
                "email" => "required|email",
                "inquiry" => "required|max:300",
            ]);
        }
        if(\Auth::check()){
            $inquiry = new Inquiry([
                "name" => User::find(\Auth::id())->name,
                "email" => User::find(\Auth::id())->email,
                "inquiry" => $request->inquiry,
            ]);
        }else{
            $inquiry = new Inquiry([
                "name" => "guest",
                "email" => $request->email,
                "inquiry" => $request->inquiry,
            ]);
        }
        
        $to = 'portfolio.moguri@gmail.com';
        Mail::to($to)->send(new InquirySent($inquiry));

        return view("inquiries.inquiry_complete", compact("inquiry"));
    }
}
