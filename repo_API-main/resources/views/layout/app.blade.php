<!DOCTYPE html>
<html lang="en">

@include('base.head')

<body>

    @include('base.header')

    @include('base.sidebar')

    <main id="main" class="main">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    @include('base.js')

    @yield('script')
</body>

</html>