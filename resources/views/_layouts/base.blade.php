<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap Styles --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- CSS Style --}}
    <link rel="stylesheet" href="/css/main.css">

    @livewireStyles
    <title>{{ $page ?? '' }}</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar fixed-top bg-body-tertiary border-bottom border-1" style="height: 60px">
        <div class="container-fluid d-flex justify-content-between mx-3">
            <div name="title-bar">
                <span class="navbar-brand ms-1 h1">Sistem Parkiran Web</span>
            </div>
            <div class="d-flex">
                <div class="d-flex flex-row border rounded p-1 px-2 mx-2">
                    <i class="bi bi-person d-flex justify-content-center align-items-center"
                        style="font-size: 220%"></i>
                    <div class="mx-2 d-flex flex-column justify-content-center">
                        <div class="fw-bold lh-sm" style="font-size: 90%"> {{ $user->name ?? 'Arief Wiradrama Tan' }}</div>
                        <div class="lh-sm" style="font-size: 80%"> Role : {{ $user->role ?? 'Admin' }} </div>
                    </div>
                </div>
                <a class="btn btn-outline-danger d-flex justify-content-center align-items-center" href="/">
                    <i class="bi bi-box-arrow-right ms-1 " style="font-size: 1.2rem"></i>
                </a>
            </div>
        </div>
    </nav>
    
    <div>
        @yield('content')
    </div>

    {{-- Bootstrap Script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @livewireScripts
</body>

</html>
