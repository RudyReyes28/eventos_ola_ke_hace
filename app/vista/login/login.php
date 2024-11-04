<?php

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />


</head>

<body>
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="../../../public/imagenes/imagen_login.jpg"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="../../controlador/autenticacion/autenticar.php">

                                        <div class="d-flex align-items-center mb-3 pb-1">

                                            <span class="h1 fw-bold mb-0">Eventos Ola Ke Hace</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar Sesion</h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" id="form2Example17" name="usuario" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Usuario</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="form2Example27" name="contrasenia" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Contraseña</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Iniciar Sesion</button>
                                        </div>


                                    </form>

                                    <p class="mb-3 pb-lg-2" style="color: #393f81;">No tiene una cuenta? <a href="registrarUsuario.php"
                                            style="color: #393f81;">Registrar Aqui</a></p>

                                    <p class="mb-2 pb-lg-2" style="color: #393f81;">Namas anda viendo? <a href="../visitante/vistaVisitante.php"
                                            style="color: #393f81;">Entre aqui</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
</body>

</html>