<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Login and Registration Form in HTML & CSS | CodingLab </title>
    <link rel="stylesheet" href="plugins/main.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="{{asset('images/login.jpg')}}" alt="">
        <div class="text">
          <span class="text-1">Bienvenido <br> a tu plataforma</span>
          <span class="text-2">de Recursos Humanos</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Inicio de sesión</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="text"><a href="#">He olvidado mi contraseña</a></div>
              <div class="button input-box">
                <input type="submit" value="Iniciar sesión">
              </div>
            </div>
        </form>
      </div>
    </div>
    </div>
  </div>
</body>
</html>
