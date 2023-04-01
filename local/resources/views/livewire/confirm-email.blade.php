@section('title','Confirmar email')
<!DOCTYPE html>
<html lang="en">
{{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
<head>
    <title>@yield('title') - Jointrust</title>
    <!-- Apex Charts -->
    <link type="text/css" href="{{ asset('local/public/vendor/apexcharts/apexcharts.css') }}" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Datepicker -->
    <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link type="text/css" href="{{ asset('local/public/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    
    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('local/public/vendor/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
    
    <!-- Notyf -->
    <link type="text/css" href="{{ asset('local/public/vendor/notyf/notyf.min.css')}}" rel="stylesheet">

    <!-- Choices.js -->
    <link type="text/css" href="{{ asset('public/assets/css/choices.min.css')}}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('public/css/volt.css')}}" rel="stylesheet">

    <!-- Jointrust CSS -->
    <link type="text/css" href="{{ asset('public/assets/css/jointrust.css')}}" rel="stylesheet">

    @livewireStyles

    <!-- Core -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- Vendor JS -->
    <script src="{{ asset('public/assets/js/on-screen.umd.min.js')}}"></script>

    <!-- Slider -->
    <script src="{{ asset('public/assets/js/nouislider.min.js')}}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('public/assets/js/smooth-scroll.polyfills.min.js')}}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('local/public/vendor/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Charts -->
    <script src="{{ asset('public/assets/js/chartist.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/chartist-plugin-tooltip.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{ asset('public/assets/js/simple-datatables.js')}}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('public/assets/js/sweetalert2.all.min.js')}}"></script>

    <!-- Choices.js -->
    <script src="{{ asset('public/assets/js/choices.min.js')}}"></script>

    <!-- Notyf -->
    <script src="{{ asset('local/public/vendor/notyf/notyf.min.js')}}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('public/assets/js/simplebar.min.js')}}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="UTF-8"></script>

    <!-- Datepicker -->
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    
    <!-- Volt JS -->
    <script src="{{ asset('public/assets/js/volt.js')}}"></script>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a5347400c8.js" crossorigin="anonymous"></script>



</head>

<body>
<main>
    @if ($data['diff_day'] >= 24)
        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="signin-inner my-3 my-lg-0 bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                            <h1 class="h3 text-center ">UPS! El enlace caduco</h1>
                            <p class="mb-4">Recuerda que el enlace es valido por <b>24 horas</b>. 
                                <br><br>Pero no te preocupes! Puedes volver a hacer el registro en Jointrus.</p>                                    
                                <div class="d-grid">
                                    <a href="/deleteUserRegister/{{ $data['email']}}" class="btn btn-gray-800">Registrarte</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image"
                    data-background-lg="../../assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Bienvenido a Jointrust</h1>
                            </div>
                            <div class="d-grid">
                                <a href="/loginUser/{{ Crypt::encryptString($data['email'].'-'.$data['password']) }}" class="btn btn-gray-800">Entrar a Jointrust</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    
</main>
@include('layouts.footer2')
</body>

</html>