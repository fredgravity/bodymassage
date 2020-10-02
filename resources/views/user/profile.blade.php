@extends('layout.profile_base')
@section('title', 'User Profile')
@section('data-page-id', 'auth')

@section('content')

<section class="auth-register" id="auth-register">
    <div class="grid-container fluid product">
        {{--@if($page_name)--}}
            {{--<h2 class="text-center">{{ $page_name }}</h2>--}}
        {{--@else--}}
            {{--<h2 class="text-center">Create User</h2>--}}
        {{--@endif--}}

        <section>

            <div class="grid-padding-x grid-x ">

                <div class="medium-3 cell">

                </div>

                <div class="small-12 medium-6 cell">
                    <h2 class="text-center">Profile Details</h2>

                    {{--INCLUDE THE MESSAGE FOR ERROR DISPLAY--}}
                    @include('includes.messages')


                    <form action="/profile/{{$user->username}}/profile" method="post" enctype="multipart/form-data">

                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" value="{{ $user->fullname }}">


                        @if(user())

                            {{--<label for="region">Region:</label>--}}
                            {{--<input type="text" id="region" name="region" value="{{ $user->region }}">--}}

                            <label for="region">Region:</label>
                            {{--<input type="text" id="region" name="region" value="{{ \App\Classes\Request::oldData('post', 'region') }}">--}}
                            <select name="region" id="region">
                                <option value="greater accra region">Greater Accra Region</option>

                            </select>

                            <label for="city">City Name:</label>
                            <input type="text" id="city" name="city" value="{{ $user->city }}">

                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone" value="{{ $user->phone }}">

                            <label for="gps">GhanaPost GPS Code:</label>
                            <input type="text" id="gps" name="gps" value="{{ $user->gps }}">

                            <label for="address">Address:</label>
                            <textarea name="address" id="address" cols="30" rows="5">{{ $user->address }}</textarea>

                            <label for="userImage" class="button">Upload Image</label>
                            <input type="file" id="userImage" class="show-for-sr" name="userImage">


                        @endif

                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">

                        <div>
                            <input type="submit" class="button hollow float-right" value="Create">
                        </div>


                    </form>

                </div>


            </div>

        </section>

    </div>
</section>




    

    @endsection









