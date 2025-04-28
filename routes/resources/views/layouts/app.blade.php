<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        /* Custom CSS for Login Page */
        body {
            background: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .text-center h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        .form-control-user {
            border-radius: 20px;
            padding: 1rem;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        .form-control-user:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.25);
        }

        .btn-user {
            border-radius: 20px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .custom-control-label::before {
            border-radius: 10px;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #007bff;
        }

        .alert-danger {
            border-radius: 10px;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 1rem;
        }

        .bg-login-image {
            background: url('path/to/your/image.jpg') center center;
            background-size: cover;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
    </style>
</head>

<body>

    <main class="py-4">
        @yield('content')
    </main>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('admin/js/sb-admin-2.min.js') }}"></script>


</body>

</html>
