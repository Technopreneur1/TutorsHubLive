@extends('layouts/master')
@section('title')
    User Unavailable | Tutors-Hib
@endsection
@section('styles')
<style>

    .unavailable{
        margin-top: 55px;
        padding: 100px 2px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 55px);
        flex-direction: column

    }
    h1{
        font-size: 70px;
        color: #2575bc;
    }
    h2{
        font-size: 30px
    }

</style>
@endsection
@section('content')
    
    <div class="unavailable">
        <h1>Sorry!!!</h1>
        <h2>This user is temporarily unavailable</h2>
    </div>
    
@endsection
