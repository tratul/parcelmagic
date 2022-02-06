<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Campaign;

class ApiCampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();
        return response()->json(['data'=>$campaigns, 'status'=>201]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'total_budget' => 'required',
            'daily_budget' => 'required',
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png'
          ]);
          if($request->hasfile('imageFile')) {
              foreach($request->file('imageFile') as $file)
              {
                  $name = $file->getClientOriginalName();
                  $file->move(public_path().'/uploads/', $name);  
                  $imgData[] = $name;  
              }
              $campaign = new Campaign();
              $campaign->name = $request->name;
              $campaign->date_from = $request->date_from;
              $campaign->date_to = $request->date_to;
              $campaign->total_budget = $request->total_budget;
              $campaign->daily_budget = $request->daily_budget;
              $campaign->creative_upload = json_encode($imgData);
              
             
              $campaign->save();
             return response()->json(['data'=>$campaign, 'status'=>201]);
          }
    }
}
