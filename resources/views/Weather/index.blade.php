@extends('Layouts/main')
@section('title_page','weather')
@section('title','weather')
@section('content')
<div class="row match-height">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Search Weather by City</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('weather.show') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>City</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="city" class="form-control" name="city" placeholder="City">
                                </div>
                                <input type="hidden" name="lat" value="">
                                <input type="hidden" name="lon" value="">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Search Weather by Location</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('weather.show') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Latitude</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="latitudes" class="form-control" name="lat" placeholder="Latitude">
                                </div>
                                <div class="col-md-4">
                                    <label>Longitude</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="longitudes" class="form-control" name="lon" placeholder="Longitude">
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-info ml-1" onclick="getLocation()">Generate Location</a>
                                </div>
                                <input type="hidden" name="city" value="">


                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_custom')
<script>
    var x = document.getElementById("latitudes");
    var y = document.getElementById("longitudes");
    // var latitude_user;
    // var longitude_user;
    // var accuracy_user;
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.value = "Geolocation is not supported by this browser.";
            y.value = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.value = position.coords.latitude;
        y.value = position.coords.longitude;
        // latitude_user = position.coords.latitude;
        // longitude_user = position.coords.longitude;
    }
</script>
@endsection