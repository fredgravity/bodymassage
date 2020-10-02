@extends('admin.layout.base')
@section('title', 'Create User')


@section('content')


    <div class="grid-container fluid product">
        @if($page_name)
            <h2 class="text-center">{{ $page_name }}</h2>
            @else
            <h2 class="text-center">Create User</h2>
            @endif



        <hr>

        @include('includes.messages')

        <section>
            <div class="grid-padding-x grid-x ">

                <div class="small-12 medium-6 cell">
                    <form action="/register" method="post" enctype="multipart/form-data">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="{{ \App\Classes\Request::oldData('post', 'username') }}">

                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" value="{{ \App\Classes\Request::oldData('post', 'fullname') }}">

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ \App\Classes\Request::oldData('post', 'email') }}">

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" value="{{ \App\Classes\Request::oldData('post', 'password') }}">

                        <label for="confirm-password">Confirm Password:</label>
                        <input type="password" id="confirm-password" name="confirmPassword" value="{{ \App\Classes\Request::oldData('post', 'confirmPassword') }}">

                        @if(user())

                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="{{ \App\Classes\Request::oldData('post', 'address') }}">

                            <label for="region">Region:</label>
                            <input type="text" id="region" name="region" value="{{ \App\Classes\Request::oldData('post', 'region') }}">

                            <label for="city">City Name:</label>
                            <input type="text" id="city" name="city" value="{{ \App\Classes\Request::oldData('post', 'city') }}">

                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone" value="{{ \App\Classes\Request::oldData('post', 'phone') }}">

                            <label for="role">Role:</label>
                            <select name="role" id="role">
                                <option value="user">User</option>
                                <option value="worker">Worker</option>
                            </select>

                            <label for="userImage" class="button">Upload Image</label>
                            <input type="file" id="userImage" class="show-for-sr" name="userImage">
                        @endif

                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">

                        <div>
                            <input type="submit" class="button expanded" value="Create">
                        </div>

                        
                    </form>

                </div>


            </div>

        </section>

    </div>



    

    @endsection









