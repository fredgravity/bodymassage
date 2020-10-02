@extends('layout.app')
@section('title', 'Contact Us Page')
@section('data-page-id', 'contact_us')


@section('content')

    <section class="contact-us" id="contact-us">

        <div class="grid-container">



            <div class="grid-padding-x grid-x">

                <div class="medium-2 cell">

                </div>

                <div class="small-12 medium-8 cell">


                    <form action="/contact_us" method="post" id="contact-us-form">

                        <h3 class="text-center contact-artisao-heading">Contact Us</h3>
                        @include('includes.messages')

                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" value="{{ \App\classes\Request::oldData('post', 'fullname') }}">

                        @if(isAuthenticated())
                            <label for="email">Email Address</label>
                            <input type="text" id="email" name="email" value="{{ user()->email }}" >
                            @else
                            <label for="email">Email Address</label>
                            <input type="text" id="email" name="email" value="{{ \App\classes\Request::oldData('post', 'email') }}">
                        @endif


                        <label for="phone">Phone Number (optional)</label>
                        <input type="text" id="phone" name="phone" value="{{ \App\classes\Request::oldData('post', 'phone') }}">

                        <label for="message">Message to Us</label>
                        <textarea id="message"  cols="10" rows="10" name="message" >{{ \App\classes\Request::oldData('post', 'message') }}</textarea>

                        <input type="submit" class="button primary" value="Send" id="contact-us-btn">
                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">

                    </form>

                </div>

                <div class="medium-2 column">

                </div>

            </div>

        </div>

    </section>



@endsection

<script src="https://www.google.com/recaptcha/api.js?render={{ getenv('GR_SITE_KEY') }}"></script>