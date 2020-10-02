@extends('admin.layout.base')
@section('title', 'Edit User')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">Edit User - {{ $user->username }}</h2>
        <hr>

        <section>


            @include('includes.messages')

            <section>
                <div class="grid-padding-x grid-x ">

                    <div class="small-12 medium-6 cell">
                        <form action="/profile/{{$user->username}}/users/{{$user->id}}/update_user" method="post" enctype="multipart/form-data">

                            <label for="fullname">Full Name:</label>
                            <input type="text" id="fullname" name="fullname" value="{{ $user->fullname  }}">

                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="{{$user->address }}">

                            <label for="region">Region:</label>
                            <input type="text" id="region" name="region" value="{{$user->region}}">

                            <label for="city">City Name:</label>
                            <input type="text" id="city" name="city" value="{{ $user->city }}">

                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone" value="{{ $user->phone }}">

                            <label for="gps">GhanaPost GPS Code:</label>
                            <input type="text" id="gps" name="gps" value="{{ $user->gps }}">

                            <label for="role">Role:</label>
                            <select name="role" id="role">
                                <option value="user">User</option>
                                <option value="worker">Worker</option>
                            </select>

                            <label for="userImage" class="button">Upload Image</label>
                            <input type="file" id="userImage" class="show-for-sr" name="userImage">

                            <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">

                            <div>
                                <input type="submit" class="button expanded" value="Update">
                            </div>


                        </form>

                    </div>


                </div>

            </section>

        </section>

    </div>



    

    @endsection









