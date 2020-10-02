@extends('layout.app')
@section('title', 'Login to your Account')
@section('data-page-id', 'auth')


@section('content')

    <div class="auth-login " id="auth-login">

        {{--DISPLAY SPINNER CUBE IF VUE JS LOADING IS TRUE--}}
        {{--<div class="text-center loading-spinner">--}}
        {{--<img src="/images/spinners/cube.gif" alt="loader" v-if="loading === true" class="cube-loader" style="width: 100px; height: 100px; padding-bottom: 3rem;" >--}}

        {{--</div>--}}


        <section class="login_form grid-container">

            <div class="grid-x grid-padding-x" style="padding-top: 30px;">

                <div class="medium-2 cell">

                </div>

                <div class="cell small-12 medium-7 ">

                    <h2 class="text-center">Login</h2>

                    {{--INCLUDE THE MESSAGE FOR ERROR DISPLAY--}}
                    @include('includes.messages')

                    {{--REGISTER FORM--}}
                    <form action="/login" method="post" id="login-form">

                        <input type="text" name="username" placeholder="username or email" value="{{ \App\classes\Request::oldData('post', 'username') }}">

                        <input type="password" name="password" placeholder="password">

                        <label for="remember">
                            <input type="checkbox" name="remember_me" id="remember" value=""> Remember Me
                        </label>

                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">

                        {{--<button class="button hollow float-right " id="login-btn">Login  @include('includes.spinner')</button>--}}
                        <input type="submit" class="button hollow float-right ">
                    </form>

                    <p>Don't have an Account? <a href="/register"> Register Here </a></p>
                    {{--END REGISTER FORM--}}
                </div>

            </div>

        </section>



    </div>




@endsection

<script src="https://www.google.com/recaptcha/api.js?render={{ getenv('GR_SITE_KEY') }}"></script>





















































