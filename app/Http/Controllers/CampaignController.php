<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();
        return view('campaign.index',compact('campaigns'));
    }
    
    public function create()
    {
        return view('campaign.create');
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
             return back()->with('success', 'Campaign has successfully uploaded!');
          }
    }
    public function edit($id)
    {
        $campaign = Campaign::find($id);
        return view('campaign.edit', compact('campaign'));
    }

    public function update(Request $request, $id)
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
              $campaign = Campaign::find($id);
              $campaign->name = $request->name;
              $campaign->date_from = $request->date_from;
              $campaign->date_to = $request->date_to;
              $campaign->total_budget = $request->total_budget;
              $campaign->daily_budget = $request->daily_budget;
              $campaign->creative_upload = json_encode($imgData);
              
             
              $campaign->save();
             return back()->with('success', 'Campaign has successfully updated!');
          }
    }
}
