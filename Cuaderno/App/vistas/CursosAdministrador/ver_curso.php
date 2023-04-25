<?php require_once RUTA_APP.'/vistas/inc/header.php'; ?>


<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="mt-5">
        
        <div class="row d-flex"> 
            <?php foreach($datos['materiales'] as $material): ?>
                <div class="col-11">
                    <p> <img src="icons/archivo.png"><?php echo $material->nombre?> </p>
                </div>
            <?php endforeach ?>
        </div>      

    </div>
</div>



<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>