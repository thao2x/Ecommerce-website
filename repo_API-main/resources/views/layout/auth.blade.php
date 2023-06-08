<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - ShoesAdmin Bootstrap Template</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/picwish.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100 w-login">
        <div class="card-body shadow-lg m-5 mb-5 bg-body rounded w-75">
            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">ShoesAdmin</h5>
            </div>
            <form class="row g-3 needs-validation" action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="col-12">
                    <label for="yourPassword" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger pt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        value="{{ old('password') }}">
                    @error('password')
                    <p class="text-danger pt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <button class="btn btn-primary w-auto" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>