<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/errorPage.css">
    <link rel="stylesheet" href="/css/all.css">
    <title>Error Page</title>
</head>
<body>
<div class="container">
    @include('includes.messages')
    <div class="row">
        <div class="xs-12 md-6 mx-auto">
            <div id="countUp">
                <div class="number" data-count="404">404</div>
                <div class="text">Page not found</div>
                <div class="text">This may not mean anything.</div>
                <div class="text">We are probably working on something that has blown up.</div>
                <div class="text"><a href="/" class="button hollow">Home</a></div>
            </div>
        </div>
    </div>
</div>


</body>
</html>