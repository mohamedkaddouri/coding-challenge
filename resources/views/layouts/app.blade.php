<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials.head')

<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            @yield('app-content')
        </div>
    </div>
</div>
</body>
</html>
