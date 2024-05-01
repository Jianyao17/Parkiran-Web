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
    <title>{{ $page ?? 'Parkiran Web' }}</title>
</head>

<body>
    {{-- Toast Popout --}}
    <div class="toast-container position-fixed start-50 top-0 translate-middle-x p-3">
        <div class="toast align-items-center text-bg-success border-0" id="liveToast" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body d-flex flex-row fw-medium">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <div id="message">Hello, world! This is a toast message.</div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    {{-- Navbar --}}
    <nav class="navbar fixed-top bg-body-tertiary border-bottom border-1" style="height: 60px">
        <div class="container-fluid d-flex justify-content-between mx-3">
            <div name="title-bar">
                <span class="navbar-brand ms-1 h1">Sistem Parkiran Web</span>
            </div>
            <a href="#" class="position-absolute top-50 start-50 translate-middle px-5 py-3 bg-primary-subtle rounded-3 link-underline link-underline-opacity-0">
                <h3 class="mt-2 text-dark">{{$page ?? 'Parkir Keluar'}}</h3>
            </a>
            <div class="d-flex">
                <div class="d-flex flex-row border rounded p-1 px-2 mx-2">
                    <i class="bi bi-person-workspace me-1 d-flex justify-content-center align-items-center"
                        style="font-size: 200%"></i>
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
    <script src="/js/shortcuts.js"></script>
    <script>
        const toastElement = document.getElementById('liveToast');

        window.addEventListener('notify', event => {
            var toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElement);

            toastElement.classList.remove('text-bg-danger');
            toastElement.classList.remove('text-bg-success');

            if (event.detail.type == 'success') toastElement.classList.add('text-bg-success');
            else if (event.detail.type == 'failed') toastElement.classList.add('text-bg-danger');

            document.getElementById('message').innerHTML = event.detail.message;
            toastBootstrap.show();
        });

        // Tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    </script>
    @livewireScripts
    @stack('javascript')
</body>

</html>
