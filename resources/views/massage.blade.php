@extends('layout.app')
@section('title', 'Massages Page')
@section('data-page-id', 'massages')

@section('content')

<div class="massage-wrapper">
    <section class="massages" id="massages">
            <div class="text-center">
                <p>Click on the type of massage for more details</p>
            </div>

        <div class="hero grid-x">
            <div class="hero-main-slider cell">

                @if($products)
                    @foreach($products as $product)
                        <div  id="slider-div">
                            <div class="text-center"><h5>{{$product->product_name}}</h5></div>
                            <img class="slides" src="{{ $product->image_path }}" alt="{{ $product->product_name }}" data-slider-id="{{ $product->id }}">
                        </div>

                    @endforeach
                @endif

            </div>

        </div>


    </section>

    <section class="massage-description">

        <div class="grid-x grid-padding-x">

            <div class="cell medium-10 float-center ">
                <hr>
                <h4 class="text-center"><span id="desc_name"></span> </h4>
            <p id="massage-description"></p>

        </div>

        </div>

    </section>

    <section>

        <div class="grid-padding-x grid-x">

                <div class=" cell medium-5 float-center animate__animated animate__bounceInDown animate__delay-3s">
                    <a href="/bookings" class="button expanded large warning" id="book-now">Book Now !</a>
                </div>



        </div>

    </section>
</div>






    @endsection