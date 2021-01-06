    <div class="off-canvas position-right reveal-for-large admin-nav" id="offCanvas" data-off-canvas data-transition="overlap">

        <div class="text-right user-logout" style="padding: 0.5rem; background-color: #569ff7;">
            <a style="" href="/logout">&nbsp;Logout <i class="fa fa-sign-out-alt" aria-hidden="true"></i></a>
        </div>


        <div class="image-holder text-center">
            @if (user()->image_path == '')
                <img src="/images/fred.jpg" alt="default_profile" style="width: 100px; height: 100px;">
            @else
                <img src="/{{user()->image_path}}" alt="{{user()->username}}" title="{{user()->username}}_profile" style="width: 100px; height: 100px;">
            @endif

            <p class="text-center"> {{ ucfirst(user()->username)}}</p>
        </div>
        <hr>
    <!-- side bar -->
    <ul class="vertical menu">
        <li><a href="/admin/{{user()->username}}"><i class="fa fa-tachometer-alt" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
        <li><a href="/profile/{{ user()->username }}/users"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Users</a></li>
        <li><a href="/profile/{{ user()->username }}/products"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Products</a></li>
        <li><a href="/profile/{{ user()->username }}/orders"><i class="fa fa-shuttle-van" aria-hidden="true"></i>&nbsp;Orders</a></li>
        <li><a href="/profile/{{ user()->username }}/payments"><i class="fa fa-money-bill" aria-hidden="true"></i>&nbsp;Payments</a></li>
        <li><a href="/profile/{{ user()->username }}/workers"><i class="fa fa-people-carry" aria-hidden="true"></i>&nbsp;Workers</a></li>


    </ul>

</div>