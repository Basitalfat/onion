<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>login</title>
    <link rel="stylesheet" href="{{ asset('halaman-login/css/style.css') }}" />
    <script src="https://kit.fontawesome.com/14384be2a0.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                <i class="fa-solid fa-user"></i>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required />
                <i class="fa-solid fa-lock"></i>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember" />{{ __('Remember me') }}</label>
                <a href="#">forgot password?</a>
            </div>
            <button type="submit" class="btn">{{ __('Log in') }}</button>

            <div class="register-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>
