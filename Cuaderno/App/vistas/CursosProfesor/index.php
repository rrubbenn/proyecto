<?php require_once RUTA_APP.'/vistas/inc/header.php'; ?>


<?php print_r($datos['usuarioSesion']); ?>

<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row">
        <?php if($datos['usuarioSesion']->id_rol == 1): ?>
            <?php foreach($datos['CursosProfesor'] as $curso):?>
                <a class="text-decoration-none text-dark" href="<?php RUTA_URL?>/Cuaderno/curso/ver_curso/<?php echo $curso->id_curso?>">
                    <div class="card col-5">
                        <div class="row card-body">
                            <div class="col-6">
                                <p> <?php echo $curso->nombre?> </p>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <p> <?php echo $curso->anyo?> </p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        <?php endif ?>
        <?php if($datos['usuarioSesion']->id_rol == 2): ?>
            <?php foreach($datos['CursosAlumno'] as $curso):?>
                <a class="text-decoration-none text-dark" href="<?php RUTA_URL?>/Cuaderno/curso/ver_curso/<?php echo $curso->id_curso?>">
                    <div class="card col-5">
                        <div class="row card-body">
                            <div class="col-6">
                                <p> <?php echo $curso->nombre?> </p>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <p> <?php echo $curso->anyo?> </p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        <?php endif ?>
        <?php if($datos['usuarioSesion']->id_rol == 3): ?>
            <?php foreach($datos['CursosAdmin'] as $curso):?>
                <a class="text-decoration-none text-dark" href="<?php RUTA_URL?>/Cuaderno/curso/ver_curso/<?php echo $curso->id_curso?>">
                    <div class="card col-5">
                        <div class="row card-body">
                            <div class="col-6">
                                <p> <?php echo $curso->nombre?> </p>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <p> <?php echo $curso->anyo?> </p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>



<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>