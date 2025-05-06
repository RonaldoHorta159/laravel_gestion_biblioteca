<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>RegistrationForm_v5 by Colorlib</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .invalid-feedback {
            color: #fff !important;
            font-size: 0.7em;
            /* Puedes ajustar este valor a 0.85em, 12px, etc. */
        }
    </style>
</head>

<body>
    @php
        $loginUrl = View::getSection('login_url') ?? config('adminlte.login_url', 'login');
        $registerUrl = View::getSection('register_url') ?? config('adminlte.register_url', 'register');

        if (config('adminlte.use_route_url', false)) {
            $loginUrl = $loginUrl ? route($loginUrl) : '';
            $registerUrl = $registerUrl ? route($registerUrl) : '';
        } else {
            $loginUrl = $loginUrl ? url($loginUrl) : '';
            $registerUrl = $registerUrl ? url($registerUrl) : '';
        }
    @endphp
    <div class="wrapper">
        <div class="inner">
            <form action="{{ $registerUrl }}" method="POST">
                @csrf
                <h3>Registrate</h3>
                <div class="form-wrapper">
                    <label for="" class="label-input">Nombre</label>
                    <input name="name" type="text" class="form-control" @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- email --}}
                <div class="form-wrapper">
                    <label for="" class="label-input">Email</label>
                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- password --}}
                <div class="form-wrapper">
                    <label for="" class="label-input">Contaseña</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('adminlte::adminlte.password') }}">
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- condirmacion de password --}}
                <div class="form-wrapper">
                    <label for="" class="label-input">Confirmacion de contaseña</label>
                    <input name="password_confirmation" type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                </div>

                <!-- Register button -->
                <button type="submit"
                    class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-user-plus"></span>
                    {{ __('adminlte::adminlte.register') }}
                </button>

                <!-- Google Email button -->
                <a href="{{ url('/login/google') }}" type="submit" class="btn btn-block center">
                    <span class="fas fa-user-plus"></span> Google Email
                </a>

            </form>
            <div class="image-holder">
                <img src="images/conti.jpg" alt="">
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>