<?php
    require '../config/db.php';
    require '../config/config.php';
    session_start();
    $usuario = $_SESSION['usr'];

    $db = new Database();
    $pdo = $db -> connect();

    $sql = $pdo->prepare("SELECT * FROM ambitos;");
    $sql->execute();
    $rows = $sql->fetchAll();
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Stylesheet CSS -->
        <link rel="stylesheet" href="admin.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- Letra -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" />
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    </head>
    <style>
        body {
            margin-top: 2.5% !important;
            margin-left: 32% !important;
            margin-right: 12% !important;
        }
    </style>

    <body>
        <div class="nav-bar">
            <center><h6>Sesión iniciada como:<br><?php echo $usuario ?></h6></center>
            
            <center>
                <ul class="list-group list-group-flush mb-5">
                    <li class="list-group-item p-0"><a class="active nav-link p-3" aria-current="page">Ambitos</a></li>
                    <li class="list-group-item p-0"><a class="nav-link p-3" href="distrito.php">Distrito</a></li>
                    <li class="list-group-item p-0"><a class="nav-link p-3" href="municipios.php">Municipios</a></li>
                    <li class="list-group-item p-0"><a class="nav-link p-3" href="participaciones.php">Participaciones</a></li>
                    <li class="list-group-item p-0"><a class="nav-link p-3" href="proceso.php">Procesos</a></li>
                    <li class="list-group-item p-0"><a class="nav-link p-3" href="usuarios.php">Usuarios</a></li>
                </ul>
            </center>
            <form action="logout.php">
                <center><button type="submit" class="btn btn-secondary">Cerrar sesión</button></center>
            </form>
        </div>

        <center><h4>Ambitos</h4></center>
        <br>

        <button type="button" class="btn btn-success float-end" id="add">Añadir</button>
        <br><br>
        
        <div class="add">
            <center><h5>Añadir ambito</h5></center>
            <br>
            
            <form action="fetch/ambits/add-ambit.php">
                <label for="name" class="form-label mb-0">Nombre</label>
                <input type="text" class="form-control mb-4" name="name"> 

                <center>
                    <button type="submit" class="add-new btn btn-primary me-3">Añadir</button>
                    <button type="button" class="cancel btn btn-danger ms-3">Cancelar</button>
                </center>
            </form>
        </div>

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Operaciones</th>
            </tr>
            <?php foreach ($rows as $row){ ?>
            <tr>
                <td><?php echo $row ['aid'];?></td>
                <td><?php echo $row ['nombre_ambito'];?></td>
                <td>
                    <form action="fetch/ambits/edit-ambit.php?edit=<?=$row['aid'];?>" method="POST" class="d-inline">
                        <button type="submit" class="edit btn btn-primary" id="edit" value="<?=$row['aid'];?>">Modificar</button>
                    </form>
                    
                    <form action="fetch/ambits/delete-ambit.php?delete=<?=$row['aid'];?>" method="POST" class="d-inline">
                        <button type="submit" class="delete btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php } $sql->closeCursor(); ?>
        </table>
    </body> 
    <script>
        $.fn.slideFadeToggle = function(easing, callback) {
            return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
        };

        function deselectAdd(e){
            $('.add').slideFadeToggle(function(){
                e.removeClass('selected');
            });
        }
        $(function(){
            $('#add').on('click',function(){
                if ($(this).hasClass('selected')){
                    deselectAdd($(this));
                } else {
                    $(this).addClass('selected');
                    $('.add').slideFadeToggle();
                }
                return false;
            });
            $('.cancel').on('click',function(){
                deselectAdd($('#add'));
                return false;
            });
        });
    </script>
</html>