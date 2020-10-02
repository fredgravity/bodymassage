@extends('layout.app')
@section('title', 'Bookings')
@section('data-page-id', 'bookings')


@section('content')

    <section class="bookings" id="bookings">
        @include('includes.messages')
        <div class="grid-x grid-padding-x">



            <div class="small-12 medium-8 cell" style="margin-top: 1rem;">

                <iframe
                        width="100%"
                        height="100%"
                        frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key={{ getenv('GEO_API_KEY2') }}&q={{ $user }},Greater+Accra+Ghana" allowfullscreen>
                </iframe>




            </div>

            <div class="small-12 medium-4 cell">

                <div class="grid-padding-x grid-x flatpickr">
                    <div class="small-10 medium-10 cell">
                        <label for="selectDate">* Select Date:</label>
                        <input type="text" placeholder="Select Date.."  data-input id="selectDate">
                    </div>
                    <div class="medium-1 small-1 cell">
                        <a class="input-button" title="toggle" data-toggle><i class="fa fa-calendar "></i></a>
                    </div>

                    <div class="medium-1 small-1 cell">
                        <a class="input-button" title="clear" data-clear><i class="fa fa-trash "></i></a>
                    </div>
                </div>

                @if(user())

                    <div class="grid-padding-x grid-x">
                        <div class=" medium-10 small-12 cell">
                            <label for="district">* District:</label>
                            <select name="district" id="district">
                                <option value="{{ user()->district }}">{{ user()->district }}</option>
                                @foreach( $districts as $district)
                                    @if($district['inclusive']== 1)
                                        <option value="{{ $district['district_name'] }}">{{ $district['district_name'] }}</option>
                                        @endif

                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="grid-padding-x grid-x">
                        <div class="gps-code medium-6 small-12 cell">
                            <label for="gps">GhanaPost GPS:</label>
                            <input type="text" name="gps"  id="gps" value="{{ user()->gps }}">

                        </div>

                        <div class="city medium-4 small-12 cell">
                            <label for="city">City:</label>
                            <input type="text" name="city"  id="city" value="{{ user()->city }}">

                        </div>
                    </div>

                @endif


                <div class="grid-padding-x grid-x">
                    <div class="time-session medium-6 small-12 cell">
                        <label for="timeSession">* Session Time:</label>
                        <select name="time_session" id="timeSession">
                            <option value="first">8am - 10pm</option>
                            <option value="second">11pm - 1pm</option>
                            <option value="third">2pm - 4pm</option>
                        </select>

                    </div>



                    <div class="time-session medium-4 small-12 cell">
                        <label for="hourSession">* Hours:</label>
                        <select name="hour_session" id="hourSession">
                            <option value="1">1hr</option>
                            <option value="1.5">1hr 30min</option>
                            <option value="2">2hrs</option>
                        </select>

                    </div>


                </div>

                <div class="grid-padding-x grid-x">
                    <div class="place medium-10 small-12 cell">
                        <label for="place">* Place To Have Massage:</label>
                        <select name="place" id="place">
                            <option value="home">Home Address</option>
                            <option value="others">Other Address</option>
                        </select>
                    </div>


                </div>


                <div class="grid-x grid-padding-x ">

                    <div class="place_name medium-10 small-12 cell" >
                        <label for="place_name_home">* Home Address:</label>
                        {{--<input type="text" name="place_name"  id="place_name" value="">--}}
                        @if(user())
                            <textarea name="place_name_home" id="place_name_home"  cols="5" rows="3">{{ user()->address }}</textarea>
                        @else
                            <textarea name="place_name_home" id="place_name_home"  cols="5" rows="3"></textarea>
                        @endif
                    </div>

                </div>

                <div class="grid-x grid-padding-x ">

                    <div class="place_name medium-10 small-12 cell" style="display: none;">
                        <label for="place_name_other">* Other Address:</label>
                        {{--<input type="text" name="place_name"  id="place_name" value="">--}}
                        <textarea name="place_name_other" id="place_name_other" cols="5" rows="3"></textarea>
                    </div>

                </div>



                <div class="grid-x grid-padding-x">

                    <div class="medium-10 small-12 cell">
                        <label for="massageType">* Choose Massage: </label>
                        <select name="massage_type" id="massageType">
                            <option value="">Select Massage</option>
                            @foreach($products as $product)
                                @if($product['id'] != 12)
                                    <option value="{{$product['id']}}">{{$product['product_name']}}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="grid-x grid-padding-x">

                    <div class="medium-10 expanded small-12 cell ">
                        <img src="" alt="" id="massageImg"  style="width: 100%; min-height: 250px;">

                    </div>

                </div>

                <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::generate()}}" id="dateToken">

                <div class="grid-x grid-padding-x">

                    <div class="medium-10 small-12 cell" style="display: none; padding-top: 1rem;" id="checkout-btn" >
                        <input type="button" id="checkout-btn-click" value="Add to Cart!" class="button warning expanded animate__animated animate__bounceInUp animate__delay-1s">

                    </div>

                </div>


            </div>

        </div>


    </section>



@endsection