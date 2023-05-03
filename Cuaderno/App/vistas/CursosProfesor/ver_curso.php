<?php require_once RUTA_APP.'/vistas/inc/header_curso.php'; ?>


<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="mt-5">
        
        <div class="row d-flex"> 
            <?php foreach($datos['materiales'] as $material): ?>
                <div class="col-12">
                    <a href="<?php echo RUTA_URL?>/curso/ver_material/<?php echo $material->id_material?>" class="text-decoration-none text-dark d-flex align-items-center"> 
                        <i class="bi bi-file-earmark fs-3"></i> &nbsp &nbsp &nbsp <?php echo $material->nombre?> 
                    </a>
                    <hr>
                </div>
            <?php endforeach ?>
        </div>      

    </div>
</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>