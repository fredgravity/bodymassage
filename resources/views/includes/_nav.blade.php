<header class="navigation">

    <div class="hide-for-medium">
        <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
            <div class="cell clearfix">
                <button class="menu-icon menu_icon float-left" type="button" data-toggle="responsive-menu"></button>
                <a href="/" class="float-right" ><img class="float-right" src="/images/logo.png" alt="logo" style="height: 2rem; width: 3rem;"> </a>
            </div>

        </div>


        <div class="top-bar my-top-bar menu_icon_display" id="main-menu">

            <div class="top-bar-left">
                <ul class=" menu vertical text-center">

                    <li><a href="/massages">Massages</a></li>
                    <li><a href="/bookings">Bookings</a></li>
                    <li><a href="/contact_us">Contact Us</a></li>
                    <li><a href="/about_us">About Us</a></li>
                    <li><a href="/corporate">Corporate</a></li>
                </ul>
            </div>
            <div class="top-bar-right ">
                {{--<ul class="menu vertical text-center ">--}}

                    @if(!isAuthenticated())
                    {{--make menu all vertical if not logged in--}}
                <ul class="menu vertical text-center ">

                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    @else

                        {{--make menu form small screen horizontal after logged in--}}
                <ul class="menu text-center ">

                        <li>
{{--TODO: update live version with this if else username on nav bar--}}
                            @if(user()->image_path)
                                @if(user()->role === "admin")
                                    <a href="/admin/{{ user()->username }}">
                                        <img src="/images/defaults/defaultProfile.png" alt="{{ user()->username }}" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;">{{ user()->username }}
                                    </a>
                                @else
                                    <a href="/profile/{{ user()->username }}">
                                        <img src="/{{user()->image_path}}" alt="{{ user()->username }}" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"> {{ user()->username }}
                                    </a>
                                @endif

                            @else
                                @if(user()->role === "admin")
                                    <a href="/admin/{{ user()->username }}">
                                        <img src="/images/defaults/defaultProfile.png" alt="{{ user()->username }}" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;">{{ user()->username }}
                                    </a>
                                @else
                                    <a href="/profile/{{ user()->username }}">
                                        <img src="/images/defaults/defaultProfile.png" alt="{{ user()->username }}" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;">{{ user()->username }}
                                    </a>
                                @endif

                            @endif

                        </li>
                        <li class="nav-logout-sc"><a href="/logout">Logout</a></li>
                        @if(isAuthenticated())
                            @if(isset($count))
                                <li id="cart-icon" class="nav-logout cart-icon" ><a href="/bookings/cart">Cart <span class="cart-icon-span">({{$count}})</span></a></li>
                            @else
                                <li id="cart-icon" class="nav-logout cart-icon" ><a href="/bookings/cart">Cart <span class="cart-icon-span"></span></a></li>
                            @endif
                        @endif
                    @endif


                </ul>
            </div>
        </div>
    </div>


    <div class="show-for-medium">
        <div class="top-bar my-top-bar" id="main-menu">

            <div class="top-bar-title show-for-medium">
                <a href="/" class="logo"><img src="/images/logo.png" alt="logo" style="height: 3rem; width: 4rem;"></a>
            </div>

            <div class="top-bar-left">
                <ul class="dropdown menu vertical medium-horizontal" data-dropdown-menu>

                    <li><a href="/massages">Massages</a></li>
                    <li><a href="/bookings">Bookings</a></li>
                    <li><a href="/contact_us">Contact Us</a></li>
                    <li><a href="/about_us">About Us</a></li>
                    <li><a href="/corporate">Corporate</a></li>
                </ul>
            </div>
            <div class="top-bar-right">
                <ul class="menu ">

                    @if(!isAuthenticated())
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                        @else
                        <li>

                            @if(user()->image_path)
                                @if(user()->role === "admin")
                                    <a href="/admin/{{ user()->username }}">
                                        <img src="/images/defaults/defaultProfile.png" alt="{{ user()->username }}" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;">{{ user()->username }}
                                    </a>
                                    @else
                                    <a href="/profile/{{ user()->username }}">
                                        <img src="/{{user()->image_path}}" alt="{{ user()->username }}" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;"> {{ user()->username }}
                                    </a>
                                @endif

                            @else
                                @if(user()->role === "admin")
                                    <a href="/admin/{{ user()->username }}">
                                        <img src="/images/defaults/defaultProfile.png" alt="{{ user()->username }}" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;">{{ user()->username }}
                                    </a>
                                @else
                                    <a href="/profile/{{ user()->username }}">
                                        <img src="/images/defaults/defaultProfile.png" alt="{{ user()->username }}" class="nav-user-image" style="width: 40px; height: 40px; border-radius: 50%;">{{ user()->username }}
                                    </a>
                                @endif

                            @endif
                           
                        </li>
                        <li class="nav-logout"><a href="/logout" >Logout</a></li>

                        @if(isAuthenticated())
{{--{{ pnd(isset($count)) }}--}}
                            @if(isset($count))
                                <li id="cart-icon" class="nav-logout cart-icon" ><a href="/bookings/cart"><i class="fa fa-book"></i>Cart <span class="cart-icon-span">({{$count}})</span></a></li>
                                @else
                                <li id="cart-icon" class="nav-logout cart-icon" ><a href="/bookings/cart"><i class="fa fa-book"></i>Cart <span class="cart-icon-span"></span></a></li>
                                @endif

                        @endif
                    @endif


                </ul>
            </div>
        </div>
    </div>



</header>


































