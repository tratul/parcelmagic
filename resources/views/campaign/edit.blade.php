@extends('layout.app')
@section('content')
<style>
    dl, ol, ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .imgPreview img {
        padding: 8px;
        max-width: 100px;
    } 
</style>
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Campaign Update</h3>
                    <div class="card-body">
                        <form action="{{ route('campaign.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" placeholder="Name" id="name" class="form-control" value="{{ $campaign->name }}" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date From</label>
                                <input type="date" id="date_from" value="{{ $campaign->date_from }}" class="form-control"
                                    name="date_from" required autofocus>
                                @if ($errors->has('date_from'))
                                <span class="text-danger">{{ $errors->first('date_from') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date To</label>
                                <input type="date" id="date_to" class="form-control"
                                    name="date_to" value="{{ $campaign->date_to }}" required>
                                @if ($errors->has('date_to'))
                                <span class="text-danger">{{ $errors->first('date_to') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Total Budget</label>
                                <input type="number" id="total_budget" class="form-control"
                                    name="total_budget" value="{{ $campaign->total_budget }}" step="any" required>
                                @if ($errors->has('total_budget'))
                                <span class="text-danger">{{ $errors->first('total_budget') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Daily Budget</label>
                                <input type="number" id="daily_budget" class="form-control"
                                    name="daily_budget" value="{{ $campaign->daily_budget }}" step="any" required>
                                @if ($errors->has('daily_budget'))
                                <span class="text-danger">{{ $errors->first('daily_budget') }}</span>
                                @endif
                            </div>
                            {{-- <div class="form-group mb-3">
                                <input type="file" class="form-control" name="photos[]" multiple />
                            </div> --}}
                            <div class="user-image mb-3 text-center">
                                <div class="imgPreview">
                                    @php
                                        $creative_upload = json_decode($campaign->creative_upload);
                                    @endphp
                                    @foreach ($creative_upload as $item)
                                        <img src="{{asset('uploads/'.$item)}}" alt="" class="w-25">
                                    @endforeach
                                </div>
                            </div>            
                            <div class="form-group mb-3">
                                <input type="file" name="imageFile[]" class="form-control"  id="images" multiple="multiple" required>
                                @if ($errors->has('imageFile'))
                                <span class="text-danger">{{ $errors->first('imageFile') }}</span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Update Campaign</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
        });    
    </script>
@endsection