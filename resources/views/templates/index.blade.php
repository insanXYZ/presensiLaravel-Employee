<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('head')
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{asset("image/logo.png")}}" type="image/x-icon">
    <title>PresensiLaravel | insanXYZ</title>
</head>
<body @yield('onload')>
    @yield("body")
    @yield('script')
</body>
</html>
