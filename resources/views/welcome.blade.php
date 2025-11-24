<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>DominioLol</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        @if (Route::has('login'))

        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            
            <div class="container px-5">

                <a href="{{ url('/dashboard') }}" class="navbar-brand">Home</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                @auth
                @else
                <div class="collapse navbar-collapse" id="navbarResponsive"> 
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Log in</a></li>
                        @if (Route::has('register'))
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                        @endif
                    @endauth
                        
                    </ul>
                </div>
            </div>
            @endif
        </nav>
        <!-- Header-->
        <header class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">DominioLoL</h1>
                    <h2 class="masthead-subheading mb-0">Tournaments for the League of Legends Community</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Learn More</a>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
            <div style=" position: absolute;
            bottom: 20px; /* Ajusta la posición desde la parte inferior según sea necesario */
            left: 50%; /* Centrar horizontalmente */
            transform: translateX(-50%); /* Ajustar para centrar correctamente */
            width: 90%; /* Ancho del 90% del head */
            max-width: 600px; /* Máximo ancho del div */
            height: 100px;
            z-index: 9999; /* Esto hará que el div se superponga ante los demás elementos */
        }

        @media (max-width: 768px) {
            #miDiv {
                width: 95%; /* Cambiar el ancho en pantallas más pequeñas */
            }
        }

        @media (max-width: 480px) {
            #miDiv {
                width: 100%; /* Cambiar el ancho en pantallas aún más pequeñas */
            }
        }"> <p>Join the DominioLoL community and get ready to experience the thrill of competition in League of Legends like never before. Sign up now and start your journey to greatness!</p></div>
        </header>
        <!-- Content section 1-->
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/01.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Limitless Competition</h2>
                            <p>Engage in a dynamic array of tournaments, each offering unique challenges to test your League of Legends skills and strategies</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 2-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/02.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <h2 class="display-4">Unified Community</h2>
                            <p>Join a passionate community of gamers who share your love for LoL. Meet new friends, rivals, and allies as you compete for glory.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 3-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/03.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Professional Experience</h2>
                            <p>Our team is dedicated to delivering high-quality tournaments with professional standards. From impeccable organization to live streaming, we guarantee a top-notch experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 4-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/04.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <h2 class="display-4">Epic Prizes</h2>
                            <p>Are you ready to win big? Participate in our tournaments and showcase your skill for a chance to take home incredible rewards.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-black">
            <div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
