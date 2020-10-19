<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{getenv('APP_NAME')}} - @yield('title')</title>

    <link rel="stylesheet" href="/css/all.css">
</head>
<body data-page-id="@yield('data-page-id')">
@include('includes.preloader')


<!-- Your page content lives here -->

<div class="grid-container fluid" id="hide-div" style="display: none">
    @yield('body')
</div>







<script src="/fontawesome/js/allfonts.js"></script>
<script src="/js/all.js">
    $(document).foundation();

</script>
</body>
</html>