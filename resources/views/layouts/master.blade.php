<!DOCTYPE html>
<html>
    <head>
        <title>ST Reports</title>
        <link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Libre+Franklin">
        @yield('stylesheet')
        <!--optimize mobile experience-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>        
        @include('includes.header')
        <div class="container">
            @yield('content')
        </div>
        <script type="text/javascript" src="{{ URL::to('src/js/jquery-2.1.1.min.js') }}"></script>
        <script type="text/javascript" src=" {{ URL::to('src/js/bootstrap.js') }} "></script>
        @yield('script')
    </body>
</html>