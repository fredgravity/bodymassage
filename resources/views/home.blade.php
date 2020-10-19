@extends('layout.app')
@section('title', 'Home Page')
@section('data-page-id', 'home')


@section('content')

<section class="home" id="home">

    {{--{{ \App\classes\LocationData::getLocation('regionName')}}--}}

    <h1 class="  animate__animated animate__fadeInLeft animate__delay-1s" id="anim" >
        Feeling really stressed?
    </h1>

    <h1 class="  animate__animated animate__fadeInLeft animate__delay-2s" id="anim2" >
        <strong>Try us !</strong>
    </h1>

    <div class="button warning large animate__animated animate__bounceInDown animate__delay-3s" id="anim3">
        <a href="/bookings">Book Now!</a>
    </div>

</section>



@endsection


