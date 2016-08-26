<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
<header class="row">
    @include('partials.header')
</header>
    <div class="container">


        <div id="main" class="row">

        @yield('content')
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('successMessage') }}</div>
        @endif
        </div>

    </div>
</body>
</html>