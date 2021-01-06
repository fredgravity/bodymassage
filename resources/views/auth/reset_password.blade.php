@extends('layout.app')
@section('title', 'Login to your Account')
@section('data-page-id', 'auth')


@section('content')

    <div class="auth-reset-password " id="auth-reset-password">

        {{--DISPLAY SPINNER CUBE IF VUE JS LOADING IS TRUE--}}
        {{--<div class="text-center loading-spinner">--}}
        {{--<img src="/images/spinners/cube.gif" alt="loader" v-if="loading === true" class="cube-loader" style="width: 100px; height: 100px; padding-bottom: 3rem;" >--}}

        {{--</div>--}}


        <section class="login_form grid-container">

            <div class="grid-x grid-padding-x" style="padding-top: 30px;">

                <div class="medium-2 cell">

                </div>

                <div class="cell small-12 medium-7 ">

                    <h2 class="text-center">Reset Your Password</h2>

                    {{--INCLUDE THE MESSAGE FOR ERROR DISPLAY--}}
                    @include('includes.messages')

                    {{--RESET PASSWORD FORM--}}
                    <form action="/reset_password" method="post" id="reset_password-form">

                        <input type="email" name="email" placeholder="Enter your Email Address for Password Reset" value="">

                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">

                        <button class="button hollow float-right " id="reset-password-btn">Reset Password  @include('includes.spinner')</button>
                        <input type="submit" class="button hollow float-right " value="Reset Password">
                    </form>

                    {{--END RESET PASSWORD FORM--}}
                </div>

            </div>

        </section>



    </div>




@endsection

<script src="https://www.google.com/recaptcha/api.js?render={{ getenv('GR_SITE_KEY') }}"></script>





















































