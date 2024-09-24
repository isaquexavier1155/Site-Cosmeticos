<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoA7K5mNI2BFRq6wtXUPabM03w3X9knL1p4Ceoz2Os8wDJ4" crossorigin="anonymous">

    <link rel="icon" href="{{ asset('images/others/icon.png') }}">

    <link rel="stylesheet" href="{{ asset('vendors/lightgallery/css/lightgallery-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mapbox-gl/mapbox-gl.min.css') }}">



    <!-- Links externos permanecem inalterados -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- O arquivo theme.css também precisa ser referenciado corretamente -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
            /* Cor de fundo da página */
        }

        .login-container {
            background-color: #3f493c;
            /* Cor de fundo do formulário */
            border-radius: 10px;
            padding: 20px;
            /* Espaçamento interno */
        }

        .w-100 {
            color: white !important;
        }

        #btnentrar{
            background-color: #4e7661;
            border-color: #4e7661;
        }
        #btnentrar:hover {
            background-color: #5a8d74  ;
            border-color: #3d5b4d ;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="login-container shadow">
        <div class="modal-header text-center border-0 pb-0">
            <h3 class="modal-title w-100" id="signInModalLabel">Entrar</h3>
        </div>
        <div class="modal-body px-sm-13 px-8">
            <p class="text-center fs-16 mb-10 text-white">Ainda não tem uma conta?
                <a href="#" >Cadastre-se</a> gratuitamente
            </p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input name="email" type="email" class="form-control mb-5" placeholder="Seu email" required>
                <input name="password" type="password" class="form-control" placeholder="Senha" required>
                <div class="d-flex align-items-center justify-content-between mt-8 mb-7">
                    <div class="custom-control d-flex form-check">
                        <input name="remember" type="checkbox" class="form-check-input rounded-0 me-3"
                            id="staySignedIn">
                        <label class="custom-control-label text-white" for="staySignedIn">Manter conectado</label>
                    </div>
                    <!-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-secondary">Esqueceu sua senha?</a>
                    @endif -->
                </div>
                <button type="submit" class="btn btn-light w-100" id="btnentrar">Entrar</button>
            </form>
        </div>
        <div class="modal-footer px-13 pt-0 pb-12 border-0">
            <!-- Aqui você pode adicionar opções de login social se desejar -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-mQ93VXvPDn5y91hLJZZSBV14jZWEU6PHJsHXQt3SvHU5awsuZVVFIhvj4J8yW/Z9"
        crossorigin="anonymous"></script>

</body>

</html>