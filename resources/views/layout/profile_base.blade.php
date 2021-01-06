<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - @yield('title')</title>

    <link rel="stylesheet" href="/css/all.css">
</head>
<body data-page-id="@yield('data-page-id')">

    {{--Admin side bar here--}}
    @include('includes.user-sidebar')


    <div class="off-canvas-content" data-off-canvas-content>
        <!-- Your page content lives here -->

        {{--title bar here--}}
        <div class="title-bar admin-title-bar">
            <div class="title-bar-left">
                <button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
                <span class="title-bar-title"> <a href="/"><i class="fa fa-arrow-circle-left"> </i> {{getenv('APP_NAME')}}</a> </span>
            </div>
        </div>



        @yield('content')
    </div>

    <script src="/fontawesome/js/allfonts.js"></script>
    <script src="/js/all.js">
        $(document).foundation();
    </script>

</body>
</html>