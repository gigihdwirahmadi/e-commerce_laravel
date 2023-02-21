<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style> @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap'); </style>

        {{-- style dan bootstrap --}}

        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"rel = "stylesheet"
        integrity = "sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin = "anonymous" >
            {{-- select2 --}} 
            <link href = "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel = "stylesheet" />
            <script src = "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" >
    </script>
    
</head>
<style>
    *{
        font-family: 'Poppins', sans-serif;
    }
</style>
@yield('style')

<body>
    <div class="container-fluid" style="display: grid; width:100%; height:100vh; align-items:center; justify-items:center">
        @yield('content')
    </div>
    @include('layouts.footer')
