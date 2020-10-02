    <div class="off-canvas position-right reveal-for-large admin-nav" id="offCanvas" data-off-canvas data-transition="overlap">

    <!-- Close button -->
    <!--        <button class="close-button" aria-label="Close menu" type="button" data-close>-->
    <!--            <span aria-hidden="true">&times;</span>-->
    <!--        </button>-->

    <h3>Welcome Admin</h3>

    <div class="image-holder text-center">
        <img src="/images/fred.jpg" alt="admin_image" title="Admin">
        <p>Gravity</p>
    </div>

    <!-- side bar -->
    <ul class="vertical menu">
        <li><a href="/admin/{{user()->username}}"><i class="fa fa-tachometer-alt" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
        <li><a href="/profile/{{ user()->username }}/users"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Users</a></li>
        <li><a href="/profile/{{ user()->username }}/products"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Products</a></li>
        <li><a href="/profile/{{ user()->username }}/orders"><i class="fa fa-shuttle-van" aria-hidden="true"></i>&nbsp;Orders</a></li>
        <li><a href="/profile/{{ user()->username }}/payments"><i class="fa fa-money-bill" aria-hidden="true"></i>&nbsp;Payments</a></li>
        <li><a href="/profile/{{ user()->username }}/workers"><i class="fa fa-people-carry" aria-hidden="true"></i>&nbsp;Workers</a></li>
        <li><a href="/logout"><i class="fa fa-sign-out-alt" aria-hidden="true"></i>&nbsp;Logout</a></li>

    </ul>

</div>