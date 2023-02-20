<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Machine Lang</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>


    <div id="app" class=" p-0">

        {{-- @include('layouts.header') --}}



        <router-view></router-view>

        @yield('content')



    </div>
</body>

<style>
    #app{
        height: 100vh;
        overflow: hidden;
    }
</style>
<script src="{{ asset('js/main.js') }}"></script>



</html>
