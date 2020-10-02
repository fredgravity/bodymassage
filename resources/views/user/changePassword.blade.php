@extends('layout.profile_base')
@section('title', 'User Change Password')
@section('data-page-id', 'changePassword')


@section('content')

    <section>

        <div class="grid-padding-x grid-x">
            <div class="cell small-12 medium-8 float-center">

                @include('includes.messages')

                <form action="/profile/{{$user->username}}/{{$user->id}}/change_password" method="post" >
                    <fieldset class="fieldset">
                        <legend><h2>Change Password</h2></legend>
                        <div>
                            <label for="old_password">Old Password:</label>
                            <input type="password" name="old_password" placeholder="type in the old password">
                        </div>

                        <div>
                            <label for="new_password">New Password:</label>
                            <input type="password" name="new_password" placeholder="type in the new password">
                        </div>

                        <div>
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" placeholder="confirm password">
                        </div>

                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">
                        <input type="submit"  value="Change" class="button warning float-right">
                    </fieldset>
                </form>

            </div>
        </div>


    </section>



    @endsection