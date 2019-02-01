<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="/css/app.css" rel="stylesheet" type="text/css" />
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">

    <link href="/css/moyo.css" rel="stylesheet" type="text/css" />
    @yield('styles')
</head>

<body>
    @yield('content')

    <script src="/js/app.js" type="text/javascript"></script>
    <script src="/js/Chart.min.js" type="text/javascript"></script>
    @yield('scripts')
</body>
</html>