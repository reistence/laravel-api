<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            "name" => ["required", "max:150"],
            "email" => ["required", "email", "max:150"],
            "message" => ["required"],
            "user_id" => ["exist:users,id"],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors(),
            ]);
        }

        $data["user_id"] = 2;

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();


        Mail::to($new_lead->user->email)->send(new NewContact($new_lead));
        return response()->json([
            "success" => true
        ]);
    }

    // public function index()
    // {
    //     $leads = Lead::all()->where("user_id",Auth::user()->id);

    //     return view("")
    // }
}
