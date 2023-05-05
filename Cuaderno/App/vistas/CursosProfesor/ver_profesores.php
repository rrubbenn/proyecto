<?php require_once RUTA_APP.'/vistas/inc/header_curso.php'; ?>



<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-4">
            <div class="d-flex mt-3">
                <input type="text"> </input>
                <button type="submit" class="btn btn-primary"> <i class="bi bi-search"></i> </button>
            </div>
        </div>
        <?php if ($datos['usuarioSesion']->id_rol == 3): ?>
            <div class="col-2"> 
                <button class="btn btn-link"> <i class="bi bi-person-add fs-1"></i> </button>
            </div>
        <?php endif ?>
    </div>

    <div class="mt-5">
        <div class="row d-flex justify-content-end"> 
            <table>
                <tr>
                    <th> Nombre </th>
                    <th> Apellidos </th>
                    <th> Mail </th>
                    <th> Teléfono </th>
                    <?php if($datos['usuarioSesion']->id_rol == 3): ?>
                        <th> Acciones </th>
                    <?php endif ?>
                </tr>
                <?php foreach($datos['profesores'] as $profesor): ?>
                    <tr>
                        <td> <?php echo $profesor->nombre ?> </td>
                        <td> <?php echo $profesor->apellidos ?> </td>
                        <td> <?php echo $profesor->mail ?> </td>
                        <td> <?php echo $profesor->telefono ?> </td>
                        <?php if($datos['usuarioSesion']->id_rol == 3): ?>
                            <td> <i class="bi bi-pencil-square fs-4"></i> <i class="bi bi-person-dash fs-4"></i> </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>      
    </div>

</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>