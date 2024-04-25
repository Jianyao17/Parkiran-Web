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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        
        body {    
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            min-height: 100vh;

            font-family: "Roboto", sans-serif;
        }

        .bg-image {
            position: absolute;
            height: 100vh;
            width: 100%;
            z-index: -1;

            background-image: url("/img/parking-cars.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <title>Login Parkiran Web</title>
</head>

<body>
    <div class="bg-image"></div>
    <div class="container-fluid d-flex justify-content-center">
        <div class="border border-top-0 rounded-4 shadow" style="width: 400px;">
            <div class="pt-3 p-2 bg-body-tertiary border-top border-3 border-primary rounded-top-3">
                <h2 class="text-center fw-semibold fs-3">Login Parkiran</h2>
            </div>
            <div class="px-4 pt-4 bg-white rounded-bottom-3">
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                            name="username" id="username" value="{{ old('username') }}" autofocus>
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" id="password" placeholder="">
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="py-4 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-medium">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Bootstrap Script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
