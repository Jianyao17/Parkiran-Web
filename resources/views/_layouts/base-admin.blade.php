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
            @auth
                <div class="d-flex">
                    <div class="d-flex flex-row border rounded p-1 px-2 mx-2">
                        <i class="bi bi-person-workspace me-1 d-flex justify-content-center align-items-center"
                            style="font-size: 200%"></i>
                        <div class="mx-2 d-flex flex-column justify-content-center">
                            <div class="fw-bold lh-sm" style="font-size: 90%"> {{ ucfirst(auth()->user()->username) }}</div>
                            <div class="lh-sm" style="font-size: 80%"> Role : {{  auth()->user()->role }} </div>
                        </div>
                    </div>
                    <form action="/logout"method="post">
                        @csrf   
                       <button type="submit" class="btn btn-outline-danger d-flex justify-content-center align-items-center">
                           <i class="bi bi-box-arrow-right ms-1 " style="font-size: 1.2rem"></i>
                       </button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <section class="container-fluid">
        <div class="row">
            <div class="col-2 bg-body-tertiary border-end border-1">
                {{-- Sidebar --}}
                <aside class="sticky-sidebar overflow-auto ">
                    <div class="d-flex flex-column gap-2 m-2 my-3">
                        <a class="btn btn-outline-primary @if ($page == 'Laporan') active @endif px-3 text-start"
                            href="/laporan">
                            <i class="bi bi-file-earmark-text me-1"></i> Laporan </a>
                        <a class="btn btn-outline-primary @if ($page == 'Parkiran') active @endif px-3 text-start"
                            href="/parkiran">
                            <i class="bi bi-car-front-fill me-1"></i> Parkiran </a>
                        <a class="btn btn-outline-primary @if ($page == 'Ruang Parkir') active @endif px-3 text-start"
                            href="/ruang-parkir">
                            <i class="bi bi-p-square me-1"></i> Ruang Parkir </a>
                        <a class="btn btn-outline-primary @if ($page == 'Users') active @endif px-3 text-start"
                            href="/users">
                            <i class="bi bi-people me-1"></i> Users </a>
                    </div>
                </aside>
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
    </section>

    {{-- Bootstrap Script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- JQuery Script --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/js/shortcuts.js"></script>
    <script>
        // Toast Popout Logic
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
</body>

</html>
