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
        <?php if($datos['usuarioSesion']->id_rol == 3): ?>
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
                <?php foreach($datos['alumnos'] as $alumno): ?>
                    <tr>
                        <td> <?php echo $alumno->nombre ?> </td>
                        <td> <?php echo $alumno->apellidos ?> </td>
                        <td> <?php echo $alumno->mail ?> </td>
                        <td> <?php echo $alumno->telefono ?> </td>
                        <?php if($datos['usuarioSesion']->id_rol == 3): ?>
                            <td> <i class="bi bi-pencil-square fs-4"></i> <i class="bi bi-person-dash fs-4"></i> </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>      
    </div>

</div>

<script type='text/javascript'>

    //Modal INSERT / EDITAR

    let modal = document.createElement("div");
    let modalcontenido = document.createElement("div");
    let modalheader = document.createElement("div");
    let modalbody = document.createElement("div");
    let modalfooter = document.createElement("div");
    let form = document.createElement("form");
    let input_idalumno = document.createElement("input");
    let input_idmaterial = document.createElement("input");
    let inputnota = document.createElement("input");
    let inputobservacion = document.createElement("textarea");
    let inputboton = document.createElement("input");
    let modalbotoncerrar = document.createElement("button");
    let modala = document.createElement("a");
    let modalh5 = document.createElement("h5");
    let labelnota = document.createElement("label");
    let labelobservacion = document.createElement("label");
    let labelarchivo = document.createElement("label");
    let br = document.createElement("br");

    //Modal BORRAR

    let modalborrar = document.createElement("div");
    let modalborrarcontenido = document.createElement("div");
    let modalborrarheader = document.createElement("div");
    let modalborrarbody = document.createElement("div");
    let modalborrarfooter = document.createElement("div");

    let modalborrarh5 = document.createElement("h5");

    let modalborrarbotoncerrar = document.createElement("button");
    let modalborrarbotoncerrar = document.createElement("button");

    function generarModalBorrar($id_persona) {

        

    }






    function rellenarModal($id) {

        inputobservacion.innerHTML = "";

    }

    function generarModal($id_persona) {
        
        //Modal
        modal.classList.add("modal-manual");

        //Contenido
        modalcontenido.classList.add("modal-contenido");

        //Header
        modalheader.classList.add("modal-header");

        //Body
        modalbody.classList.add("modal-body");

        //Archivo
        labelarchivo.innerHTML = "Archivo";
        modala.innerHTML = "Holaa";
        modala.classList.add("fs-6");
        modala.href = "#";

        //Form
        ruta_url = <?php echo json_encode(RUTA_URL) ?>;
        ruta_addnota = "/curso/add_nota/" + $id;
        ruta = ruta_url+ruta_addnota;
        
        form.method = "post";
        form.action = ruta;

        //H5 y botoncerrar

        modalh5.classList.add("fs-6");
        modalh5.innerHTML = "Evaluar: ";
        modalbotoncerrar.classList.add("btn-close");

        //Inputs
        labelnota.innerHTML = "Nota";
        labelnota.classList.add("mt-2");
        inputnota.type = "text";
        inputnota.classList.add("form-control");
        inputnota.classList.add("mb-3");
        inputnota.name = "nota";

        labelobservacion.innerHTML = "Observaciones";
        inputobservacion.classList.add("form-control");
        inputobservacion.classList.add("mb-5");
        inputobservacion.style.height = "100px";
        inputobservacion.name = "observacion";

        input_idalumno.name = "id_alumno";
        input_idalumno.value = $id_persona;
        input_idalumno.style.display = "none";

        input_idmaterial.name = "id_material";
        input_idmaterial.value = $id;
        input_idmaterial.style.display = "none";

        //Boton Guardar
        inputboton.type = "submit";
        inputboton.value = "Guardar";
        inputboton.classList.add("btn");
        inputboton.classList.add("btn-success");

        //Footer
        modalfooter.classList.add("modal-footer");
        
        document.body.appendChild(modal);
        modal.appendChild(modalcontenido);
        modalcontenido.appendChild(modalheader);
        modalcontenido.appendChild(modalbody);
        modalcontenido.appendChild(modalfooter);
        modalheader.appendChild(modalh5);
        modalheader.appendChild(modalbotoncerrar);
        modalbody.appendChild(labelarchivo);
        modalbody.appendChild(br);
        modalbody.appendChild(modala);
        modalbody.appendChild(form);
        form.appendChild(labelnota);
        form.appendChild(inputnota);
        form.appendChild(labelobservacion);
        form.appendChild(inputobservacion);
        form.appendChild(input_idalumno);
        form.appendChild(input_idmaterial);
        form.appendChild(inputboton);

        const closeModal = document.querySelector('.btn-close');

        closeModal.addEventListener('click', (e)=> {

            e.preventDefault();
            modal.remove();

        });

    }

</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>