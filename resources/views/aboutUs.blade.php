@extends('layout.app')
@section('title', 'About Us Page')
@section('data-page-id', 'about_us')


@section('content')

    <div class="about_us" id="about_us">

        <section>

            <div class="grid-padding-x grid-x">

                <div class="small-12 cell animate__animated animate__slideInRight" id="about">
                    <div class="grid-x grid-padding-x ">

                        <div class="small-12 medium-6 cell">
                            <h2 id="abouth1">About Us</h2>
                            <p class="text-justify">
                                Artisao Technologies is a software and technology hub pursuing technological innovation in Africa. We are of African origin registered under Ghana’s Business Names Act 1962 (Act 151).
                            </p>
                            <p>
                                We seek to create technological platforms by which people of SKILL use their dexterity in promoting commerce, industry, culture, health and general wellbeing; for which reason we bring you masartgh.com, our online massage booking service.
                            </p>

                            <p>
                                MASARTGH <sup>SM</sup> is a brand established in 2020 to bridge the gap between the massage industry and client availability. The service makes it easier for individuals and corporations to enjoy massage services anywhere at their convenience and with a touch of luxury. All it takes is to go to our online platform and book for the service, stating your availability, anywhere you are and at your convenience.
                            </p>

                            <p>
                                MASARTGH.COM is powered by Artisao Technologies.
                            </p>
                        </div>

                        <div class="medium-3 cell small-12 aboutus-profile" style="margin-top: 1rem;  max-width: 300px;">
                            <div class="card">
                                <div class="card-divider">
                                    <div class="grid-x cell text-center">
                                        <p>Co-Founder Technologies</p>
                                    </div>
                                </div>
                                <div class="grid-padding-x grid-x">
                                    <div class="cell aboutus-profile-img" >
                                        <img src="/images/aboutUsPic/fred_amoah_profile_pic.jpg" alt="frederick-amoah-sekyi" style="width: 100%; height: 400px;">
                                    </div>
                                </div>
                                <div class="card-section">

                                    <div class="text-center">
                                        <p>Frederick Amoah-Sekyi</p>
                                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class=" medium-3 cell small-12 aboutus-profile" style="margin-top: 1rem;  max-width: 300px;">
                            <div class="card">
                                <div class="card-divider">
                                    <div class="grid-x cell text-center">
                                        <p>Co-Founder Business Dev.</p>
                                    </div>
                                </div>
                                <div class="grid-padding-x grid-x">
                                    <div class="cell aboutus-profile-img"  >
                                        <img src="/images/aboutUsPic/ebo_awortwe_profile_pic.jpg" alt="ebo awortwe" style="width: 100%; height: 400px;">
                                    </div>
                                </div>
                                <div class="card-section">

                                    <div class="text-center">
                                        <p>Ebo Awortwe</p>
                                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </section>

        <section>
            <div class="grid-x grid-padding-x">


                <div class="small-12 cell animate__animated animate__slideInRight animate__delay-2s">
                    <hr>
                    <h2>Join Us</h2>
                    <p class="text-justify" id="joinus">
                        We would love to hear from you if you:
                        <ul class="text-justify">
                            <li>
                                    are passionate about bringing the benefits of massage to the healthy conscious and corporate market.
                            </li>
                            <li>
                                    want to increase your earning potential whilst working sociable and flexible hours
                            </li>
                            <li>
                                    have a diploma in Massage Therapy, Reflexology, Seated Acupressure Chair Massage (a short weekend course is not sufficient) plus at least one other complementary therapy
                            </li>
                        </ul>

                        If you are highly qualified, experienced and have great people skills then we would love to hear from you.
                        Please e-mail your CV to us at <strong>enquiry@masartgh.com</strong>  or call +233245991097 for more details.



                    </p>
                </div>


            </div>


        </section>

    </div>



@endsection

{{--<script src="https://www.google.com/recaptcha/api.js?render={{ getenv('GR_SITE_KEY') }}"></script>--}}