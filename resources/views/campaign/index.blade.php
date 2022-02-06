@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($campaigns as $campaign)
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">{{ $campaign->name }}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">{{ $campaign->date_from }} To {{ $campaign->date_to }}</h6>
                          @php
                              $creative_upload = json_decode($campaign->creative_upload);
                          @endphp
                          @foreach ($creative_upload as $item)
                              <img src="{{asset('uploads/'.$item)}}" alt="" class="w-25">
                          @endforeach
                          <div class="pt-3">
                            <a href="{{ route('campaign.edit',$campaign->id) }}" class="card-link">Edit Campaign</a>
                          </div>
                        </div>
                      </div>
                </div> 
            @endforeach
        </div>
    </div>
@endsection