<?php require_once RUTA_APP.'/vistas/inc/header_curso.php'; ?>


<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row d-flex">

        <button id="botonContenido" class="btn btn-primary col-2" onclick="mostrarContenido()"> Contenido </button>
        <button id="botonEntregables" class="btn btn-outline-primary col-2 offset-1" onclick="mostrarEntregables()"> Entregables </button>

    </div>

    <?php print_r($datos["cursoactual"]); ?>

    <div id="divContenido" class="mt-5 d-block">
        <div class="row mb-4">
            <button 
            id="addNoEntregable" 
            class="col-2 btn btn-primary d-flex align-items-center" 
            <?php echo "onclick='generarModal(".$datos['cursoactual'].", false)'" ?> > 
                <i class="bi bi-file-earmark-plus fs-3"></i> &nbsp &nbsp &nbsp
                Añadir material
            </button>
        </div>
        <div class="row col-12">
            <?php foreach($datos["materialesEvaluables"] as $evaluable): ?>
                <div class="col-11">
                    <a class="text-decoration-none text-dark d-flex align-items-center"> 
                        <i class="bi bi-file-earmark fs-3"></i> &nbsp &nbsp &nbsp <?php echo $evaluable->nombre?> 
                    </a>
                </div>
                <div class="col-1 d-flex justify-content-end">
                    <a class="text-decoration-none text-dark d-flex align-items-center"> 
                        <i class="bi bi-download"></i>
                    </a>
                </div>
                <hr>
            <?php endforeach ?>
        </div> 
    </div>

    <div id="divEntregables" class="mt-5 d-none">
        <div class="row mb-4">
            <button 
            id="addEntregable" 
            class="col-2 btn btn-primary d-flex align-items-center"
            <?php echo "onclick='generarModal(".$datos['cursoactual'].", true)'" ?>> 
                <i class="bi bi-file-earmark-plus fs-3"></i> &nbsp &nbsp &nbsp
                Añadir material
            </button>
        </div>
        <div class="row col-12">
            <?php foreach($datos["materialesNoEvaluables"] as $noevaluable): ?>
                <a href="<?php echo RUTA_URL?>/curso/ver_material/<?php echo $noevaluable->id_material?>" class="text-decoration-none text-dark d-flex align-items-center"> 
                    <i class="bi bi-file-earmark fs-3"></i> &nbsp &nbsp &nbsp <?php echo $noevaluable->nombre?> 
                </a>
                <hr>
            <?php endforeach ?>
        </div> 
    </div>

</div>

<script type="text/javascript"> 

    function mostrarContenido() {

        let botonContenido = document.getElementById("botonContenido");
        let botonEntregables = document.getElementById("botonEntregables");
        let divContenido = document.getElementById("divContenido");
        let divEntregables = document.getElementById("divEntregables");

        botonEntregables.classList.remove("btn-primary");
        botonEntregables.classList.add("btn-outline-primary");

        botonContenido.classList.add("btn-primary");
        botonContenido.classList.remove("btn-outline-primary");

        divContenido.classList.remove("d-none");
        divContenido.classList.add("d-block");
        divEntregables.classList.remove("d-block");
        divEntregables.classList.add("d-none");

    }

    function mostrarEntregables() {

        let botonContenido = document.getElementById("botonContenido");
        let botonEntregables = document.getElementById("botonEntregables");
        let divContenido = document.getElementById("divContenido");
        let divEntregables = document.getElementById("divEntregables");

        botonEntregables.classList.add("btn-primary");
        botonEntregables.classList.remove("btn-outline-primary");

        botonContenido.classList.remove("btn-primary");
        botonContenido.classList.add("btn-outline-primary");

        divEntregables.classList.remove("d-none");
        divEntregables.classList.add("d-block");
        divContenido.classList.remove("d-block");
        divContenido.classList.add("d-none");

    }

    let modal = document.createElement("div");
    let modalcontenido = document.createElement("div");
    let modalheader = document.createElement("div");
    let modalbody = document.createElement("div");
    let modalfooter = document.createElement("div");
    let form = document.createElement("form");
    let labelarchivo = document.createElement("label");
    let inputfile = document.createElement("input");
    let labelnombrearchivo = document.createElement("label");
    let inputnombrearchivo = document.createElement("input");
    let labeldescripcionarchivo = document.createElement("label");
    let inputdescripcionarchivo = document.createElement("textarea");
    let inputcurso = document.createElement("input");
    let inputboton = document.createElement("input");
    let modalbotoncerrar = document.createElement("button");
    let modalh5 = document.createElement("h5");
    let br = document.createElement("br");

    function generarModal($id, $evaluable) {

    //Modal
    modal.classList.add("modal-manual");

    //Contenido
    modalcontenido.classList.add("modal-contenido");

    //Header
    modalheader.classList.add("modal-header");

    //Body
    modalbody.classList.add("modal-body");
    
    //Form
    ruta_url = <?php echo json_encode(RUTA_URL) ?>;

    if ($evaluable == true) {

        ruta_addnota = "/curso/add_evaluable/"+$id;

    } else {

        ruta_addnota = "/curso/add_noevaluable/"+$id;

    }
    ruta = ruta_url+ruta_addnota;

    form.method = "post";
    form.action = ruta;

    //H5 y botoncerrar
    modalh5.classList.add("fs-6");
    modalh5.innerHTML = "Subir Material";
    modalbotoncerrar.classList.add("btn-close");

    //Inputs
    labelnombrearchivo.innerHTML = "Nombre";
    labelnombrearchivo.classList.add("mt-2");
    inputnombrearchivo.id = "inputNombreArchivo";
    inputnombrearchivo.type = "text";
    inputnombrearchivo.classList.add("form-control");
    inputnombrearchivo.classList.add("mb-3");
    inputnombrearchivo.name = "nombre";

    labelarchivo.innerHTML = "Archivo";
    inputfile.type = "file";
    inputfile.name = "archivo";
    inputfile.classList.add("mb-3");
    inputfile.classList.add("mt-2");

    labeldescripcionarchivo.innerHTML = "Descripción"
    inputdescripcionarchivo.style.height = "100px";
    inputdescripcionarchivo.classList.add("form-control");
    inputdescripcionarchivo.classList.add("mb-4");
    inputdescripcionarchivo.name = "descripcion";

    inputcurso.value = $id;
    inputcurso.classList.add("d-none");
    inputcurso.name = "id_curso";

    //Boton Guardar
    inputboton.type = "submit";
    inputboton.value = "Guardar";
    inputboton.classList.add("btn");
    inputboton.classList.add("btn-success");
    inputboton.id = "guardar";

    //Footer
    modalfooter.classList.add("modal-footer");

    //Appends
    document.body.appendChild(modal);
    modal.appendChild(modalcontenido);
    modalcontenido.appendChild(modalheader);
    modalcontenido.appendChild(modalbody);
    modalcontenido.appendChild(modalfooter);
    modalheader.appendChild(modalh5);
    modalheader.appendChild(modalbotoncerrar);
    modalbody.appendChild(br);
    modalbody.appendChild(form);
    form.appendChild(labelarchivo);
    form.appendChild(inputfile);
    form.appendChild(labelnombrearchivo);
    form.appendChild(inputnombrearchivo);
    form.appendChild(labeldescripcionarchivo);
    form.appendChild(inputdescripcionarchivo);
    form.appendChild(inputcurso);
    form.appendChild(inputboton);

    //Cerrar Modal
    const closeModal = document.querySelector('.btn-close');

    closeModal.addEventListener('click', (e)=> {

        e.preventDefault();
        modal.remove();

    });

    }

</script> 

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>