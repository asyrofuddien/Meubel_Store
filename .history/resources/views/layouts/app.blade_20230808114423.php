<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
   
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="/images/logoicon.svg" type="image/x-icon">
    
    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
    <style>
      .hvvv{
        padding-top: 25px;
       margin-bottom: 25px;
       border-radius: 10px;
       transition: 0.2
      }
      .hvvv:hover{
        background-color: rgb(206, 206, 206);
        scale: 1.1;
        transition: 0.2s;
      }
    </style>
  </head>

  <body>
    {{-- Navbar --}}
    @include('includes.navbar')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('includes.footer')

    {{-- Script --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
  </body>
</html>
