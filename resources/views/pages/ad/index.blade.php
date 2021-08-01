@extends('layouts/master')
@section('title')
    Student's Ads
@endsection
@section('content')
    <div id="app" class="ads-page">
        <ads url="{{route('home')}}" :authuser="{{$user}}" :allowancesettings="{{ json_encode($allowanceSettings) }}" :adminsettings="{{ $adminSettings }}"></ads>
    </div>
@endsection
