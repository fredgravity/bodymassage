@extends('admin.layout.base')
@section('title', 'Edit Worker')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">Edit Worker - {{ $worker->username }}</h2>
        <hr>

        <section>


            @include('includes.messages')

            <section>
                <div class="grid-padding-x grid-x ">

                    <div class="small-12 medium-6 cell">
                        <form action="/profile/{{user()->username}}/users/{{ $worker->id }}/update_user" method="post" enctype="multipart/form-data">

                            <label for="fullname">Full Name:</label>
                            <input type="text" id="fullname" name="fullname" value="{{ $worker->fullname  }}">

                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="{{ $worker->address }}">

                            <label for="region">Region:</label>
                            <input type="text" id="region" name="region" value="{{ $worker->region }}">

                            <label for="city">City Name:</label>
                            <input type="text" id="city" name="city" value="{{ $worker->city }}">

                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone" value="{{ $worker->phone}}">

                            <label for="gps">GhanaPost GPS Code:</label>
                            <input type="text" id="gps" name="gps" value="{{ $worker->gps }}">

                            <label for="role">Role:</label>
                            <select name="role" id="role">
                                <option value="worker">Worker</option>
                                <option value="user">User</option>
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









