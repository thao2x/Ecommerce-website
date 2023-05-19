<!DOCTYPE html>
<html lang="en">

@include('base.head')

<body>

    @include('base.header')

    @include('base.sidebar')

    <main id="main" class="main">

        @yield('title')

        @yield('content')

    </main>

    @include('base.js')

</body>

</html>