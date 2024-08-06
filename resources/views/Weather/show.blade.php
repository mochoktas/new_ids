@extends('Layouts/main')
@section('title_page','weather')
@section('title','weather')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Weather for {{ $weather['name'] }}</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <p>Temperature: {{ $weather['main']['temp'] }}°C</p>
            <p>Condition: {{ $weather['weather'][0]['description'] }}</p>
        </div>
    </div>
</div>


@endsection