<?php
    require 'config/config.php';
    require 'config/db.php';
    $dato = $_POST['termino-busqueda'];
    if(isset($_POST['termino-busqueda']) ){
        $valor = $_POST['termino-busqueda'];
        $valor = filter_var($valor, FILTER_SANITIZE_STRING); 
        $valor = '%'.$valor.'%';
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participa</title>

    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="css/template.css">
    <!-- Timeline CSS -->
    <link rel="stylesheet" href="css/timeline2.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Letra -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" />
    <!-- Icono -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icono Redes Sociales -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body style="font-family: Roboto;">
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/logo.png" style="width: 200px;" alt="LOGO"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link"  href="index.php">Inicio</a>
                </li>
                <li class="nav-item mx-5">
                    <a class="nav-link" href="participa.php">Participa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ayuda.php">Ayuda</a>
                </li>
                <li class=" mx-5 nav-item">
                    <a class="nav-link" href="calendario.php">Calendario</a>
                </li>
                </ul>
                <!-- (Iniciar Sesión / Registrarse) o Sesion Inicada -->
				<?php require 'components/login.php' ?>
            </div>
        </div>
    </nav>
    <!-- Start search bar-->

    <?php require 'components/search_bar.php'; ?>
    
    <!-- End search bar-->
    <!-- End Navbar -->

    <!-- process dps -->

    <!-- Process -->
    <div class="container process-featured">
        <div class="process-filter">
            <?php
                $sql = $pdo->prepare("SELECT procesos.*, ambitos.*, municipios.*, fases.* FROM procesos INNER JOIN fases ON (procesos.pid = fases.pid AND procesos.fase_actual = fases.n_fase ) INNER JOIN ambitos ON procesos.aid = ambitos.aid INNER JOIN municipios ON procesos.mid = municipios.mid WHERE LOWER(titulo_proceso) LIKE ? OR LOWER(subtitulo_proceso) LIKE ? OR LOWER(descripcion_proceso) LIKE ? OR LOWER(descripcion_c_proceso) LIKE ? OR LOWER(nombre_municipio) LIKE ? OR LOWER(nombre_ambito) LIKE ?");

                // Agregar los parametros
                
                $sql->execute([$valor, $valor, $valor, $valor, $valor, $valor]);
                // Fetch los resultados
                $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
                $count = $sql->rowCount();
            ?>
            <h4 style="color: #252525; font-weight: 600;"><i class="fa fa-square" aria-hidden="true"></i> PROCESOS (<?php echo $count; ?>)</h4> 
        </div>

        <!-- START CARDS NUEVO -->
        <div class="container text-center" style="margin-top: 4rem; margin-bottom: 8rem;">
            <div class="process-card-scroll">
                <div class="filter row row-cols-1 row-cols-md-2 row-cols-lg-4 d-flex align-items-stretch g-3">
                    <!-- START INDIVIDUAL CARD -->
                    <?php
                        if($count > 0){
                            foreach($rows as $row){

                                require 'components/card_proceso.php';

                            }
                        }else{
                            ?>
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>
                                <symbol id="info-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </symbol>
                                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                                </svg>

                                <div class="container alert alert-warning d-flex align-items-center" role="alert" style="margin: 1rem auto; width: 90%;">
                                    <svg class="bi flex-shrink-0 me-2" style="height:50%" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        <h1 class="text-center" style="font-weight: 400;">No se encontró ninguna búsqueda con esos valores 😰</h1>
                                    </div>
                                </div>
                            <?php
                        }
                        $sql->closeCursor();
                    ?>
                    <!-- END INDIVIDUAL CARD--> 
                </div>  
            </div>
        </div>
        <!-- END CARDS -->                        
        
    </div>
    <!-- End First Content -->

    <!-- Participaciones  -->
    <div class="container process-featured">
        <div class="process-filter">
            <?php
                $sql = $pdo->prepare("SELECT participaciones.*, participaciones.img as imagen, usuarios.*, distritos.* FROM participaciones INNER JOIN usuarios ON participaciones.uid = usuarios.uid INNER JOIN distritos ON distritos.did = participaciones.did WHERE LOWER(titulo_registro) LIKE ? OR LOWER(propuesta) LIKE ? OR LOWER(nombre) LIKE ? OR participaciones.uid LIKE ?");

                // Agregar los parametros
                
                $sql->execute([$valor, $valor, $valor, $valor]);
                // Fetch los resultados
                $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
                $count = $sql->rowCount();
            ?>
            <h4 style="color: #252525; font-weight: 600;"><i class="fa fa-square" aria-hidden="true"></i> PARTICIPACIONES (<?php echo $count; ?>)</h4>
        </div>

        <!-- START CARDS NUEVO -->
        <div class="container text-center" style="margin-top: 4rem; margin-bottom: 8rem;">
            <div class="ficha-card-scroll">
                <div class="filter row row-cols-1 row-cols-md-2 row-cols-lg-4 d-flex align-items-stretch g-3">
                    <!-- START INDIVIDUAL CARD -->
                    <?php
                        if($count > 0){
                            foreach($rows as $row){
                                require 'components/card_ficha.php';
                            }
                        }else{
                            ?>
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>
                                <symbol id="info-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </symbol>
                                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                                </svg>

                                <div class="container alert alert-warning d-flex align-items-center" role="alert" style="margin: 1rem auto; width: 90%;">
                                    <svg class="bi flex-shrink-0 me-2" style="height:50%" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        <h1 class="text-center" style="font-weight: 400;">No se encontró ninguna búsqueda con esos valores 😰</h1>
                                    </div>
                                </div>
                            <?php
                        }
                        $sql->closeCursor();
                    ?>
                    <!-- END INDIVIDUAL CARD--> 
                </div>
            </div>
        </div>
        <!-- END CARDS -->                        
    </div>
    <!-- End First Content -->

    <!-- Participaciones  -->
    <div class="container process-featured">
        <div class="process-filter">
            <?php
                $sql = $pdo->prepare("SELECT usuarios.* FROM usuarios WHERE LOWER(nombre) LIKE ? ");

                // Agregar los parametros
                
                $sql->execute([$valor]);
                // Fetch los resultados
                $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
                $count = $sql->rowCount();
            ?>
            <h4 style="color: #252525; font-weight: 600;"><i class="fa fa-square" aria-hidden="true"></i> USUARIOS (<?php echo $count; ?>)</h4>
        </div>

        <!-- START CARDS NUEVO -->
        <div class="container" style="margin-top: 4rem; margin-bottom: 8rem;">
            <div class="user-card-scroll">                
                <div class="filter row row-cols-1 row-cols-md-2 row-cols-lg-4 d-flex align-items-stretch g-3">
                    <!-- START INDIVIDUAL CARD -->
                    <?php 
                        if($count > 0){
                            
                            foreach($rows as $row){
                                
                                require 'components/card_perfil.php';

                            }
                        }else{
                                require 'components/not-found.php';
                        }
                        $sql->closeCursor();
                    ?>
                    <!-- END INDIVIDUAL CARD--> 
                </div>
            </div>
        </div>
        <!-- END CARDS -->           
    </div>
    <!-- End First Content -->

    <!-- Start Footer -->
    <?php require 'components/footer.php'; ?>
    <!-- End Footer -->
</body>
</html>

<?php

    }else{
        header("Location: /components/404.php");
        exit();
    }
?>