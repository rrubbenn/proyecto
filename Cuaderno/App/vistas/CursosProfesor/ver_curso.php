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
            <?php foreach($datos["materialesNoEvaluables"] as $noevaluable): ?>
                <div class="col-11">
                    <a class="text-decoration-none text-dark d-flex align-items-center"> 
                        <i class="bi bi-file-earmark fs-3"></i> &nbsp &nbsp &nbsp <?php echo $noevaluable->nombre?> 
                    </a>
                </div>
                <div class="col-1 d-flex justify-content-end">
                    <?php if($datos['usuarioSesion']->id_rol == 1 ): ?>
                        <a 
                        class="text-decoration-none text-dark d-flex align-items-center me-3" 
                        href="#"
                        <?php echo "onclick='generarModalEditar(".$noevaluable->id_material.", false)'" ?>> 
                            <i class="bi bi-pencil-square fs-4"></i> 
                        </a>
                        <a class="text-decoration-none text-dark d-flex align-items-center me-3" href="#">
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                    <?php endif ?>
                    <a class="text-decoration-none text-dark d-flex align-items-center" href="#"> 
                        <i class="bi bi-download fs-4"></i>
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
            <?php foreach($datos["materialesEvaluables"] as $evaluable): ?>
                
                <div class="col-11">
                    <a href="<?php echo RUTA_URL?>/curso/ver_material/<?php echo $evaluable->id_material?>" class="text-decoration-none text-dark d-flex align-items-center"> 
                        <i class="bi bi-file-earmark fs-3"></i> &nbsp &nbsp &nbsp <?php echo $evaluable->nombre?> 
                    </a>
                </div>
                <div class="col-1 d-flex justify-content-end">
                    <?php if($datos['usuarioSesion']->id_rol == 1 ): ?>
                        <a 
                        class="text-decoration-none text-dark d-flex align-items-center me-3"
                        href="#"
                        <?php echo "onclick='generarModal(".$evaluable->id_material.", true)'" ?>> 
                            <i class="bi bi-pencil-square fs-4"></i> 
                        </a>
                        <a class="text-decoration-none text-dark d-flex align-items-center me-3" href="#">
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                    <?php endif ?>
                    <a class="text-decoration-none text-dark d-flex align-items-center" href="#"> 
                        <i class="bi bi-download fs-4"></i>
                    </a>
                </div>
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

    //MODAL AÑADIR MATERIAL
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

        console.log($evaluable);

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

        console.log("HE LLEGAO AL ELSE")
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

    ///////////////////////////////////////////////////////////////////////////////////////////////////

    //MODAL EDITAR MATERIAL
    let modaleditar = document.createElement("div");
    let modaleditarcontenido = document.createElement("div");
    let modaleditarheader = document.createElement("div");
    let modaleditarbody = document.createElement("div");
    let modaleditarfooter = document.createElement("div");
    let editarform = document.createElement("form");
    let editarlabelarchivo = document.createElement("label");
    let editarinputfile = document.createElement("input");
    let editarlabelnombrearchivo = document.createElement("label");
    let editarinputnombrearchivo = document.createElement("input");
    let editarlabeldescripcionarchivo = document.createElement("label");
    let editarinputdescripcionarchivo = document.createElement("textarea");
    let editarinputcurso = document.createElement("input");
    let editarinputboton = document.createElement("input");
    let editarmodalbotoncerrar = document.createElement("button");
    let editarmodalh5 = document.createElement("h5");
    let editarbr = document.createElement("br");


    function generarModalEditar($id, $evaluable) {

        console.log($evaluable);

        //Modal
        modaleditar.classList.add("modal-manual");

        //Contenido
        modaleditarcontenido.classList.add("modal-contenido");

        //Header
        modaleditarheader.classList.add("modal-header");

        //Body
        modaleditarbody.classList.add("modal-body");

        //Form
        ruta_url = <?php echo json_encode(RUTA_URL) ?>;

        if ($evaluable == true) {

        ruta_addnota = "/curso/add_evaluable/"+$id;

        } else {

        console.log("HE LLEGAO AL ELSE")
        ruta_addnota = "/curso/add_noevaluable/"+$id;

        }
        ruta = ruta_url+ruta_addnota;

        form.method = "post";
        form.action = ruta;

        //H5 y botoncerrar
        editarmodalh5.classList.add("fs-6");
        editarmodalh5.innerHTML = "Subir Material";
        editarmodalbotoncerrar.classList.add("btn-close");

        //Inputs
        editarlabelnombrearchivo.innerHTML = "Nombre";
        editarlabelnombrearchivo.classList.add("mt-2");
        editarinputnombrearchivo.id = "inputNombreArchivo";
        editarinputnombrearchivo.type = "text";
        editarinputnombrearchivo.classList.add("form-control");
        editarinputnombrearchivo.classList.add("mb-3");
        editarinputnombrearchivo.name = "nombre";

        editarlabelarchivo.innerHTML = "Archivo";
        editarinputfile.type = "file";
        editarinputfile.name = "archivo";
        editarinputfile.classList.add("mb-3");
        editarinputfile.classList.add("mt-2");

        editarlabeldescripcionarchivo.innerHTML = "Descripción"
        editarinputdescripcionarchivo.style.height = "100px";
        editarinputdescripcionarchivo.classList.add("form-control");
        editarinputdescripcionarchivo.classList.add("mb-4");
        editarinputdescripcionarchivo.name = "descripcion";

        editarinputcurso.value = $id;
        editarinputcurso.classList.add("d-none");
        editarinputcurso.name = "id_curso";

        //Boton Guardar
        editarinputboton.type = "submit";
        editarinputboton.value = "Guardar";
        editarinputboton.classList.add("btn");
        editarinputboton.classList.add("btn-success");
        editarinputboton.id = "guardar";

        //Footer
        modaleditarfooter.classList.add("modal-footer");

        //Appends
        document.body.appendChild(modaleditar);
        modaleditar.appendChild(modaleditarcontenido);
        modaleditarcontenido.appendChild(modaleditarheader);
        modaleditarcontenido.appendChild(modaleditarbody);
        modaleditarcontenido.appendChild(modaleditarfooter);
        modaleditarheader.appendChild(editarmodalh5);
        modaleditarheader.appendChild(editarmodalbotoncerrar);
        modaleditarbody.appendChild(editarbr);
        modaleditarbody.appendChild(editarform);
        editarform.appendChild(editarlabelarchivo);
        editarform.appendChild(editarinputfile);
        editarform.appendChild(editarlabelnombrearchivo);
        editarform.appendChild(editarinputnombrearchivo);
        editarform.appendChild(editarlabeldescripcionarchivo);
        editarform.appendChild(editarinputdescripcionarchivo);
        editarform.appendChild(editarinputcurso);
        editarform.appendChild(editarinputboton);

        //Cerrar Modal
        const closeModalEditar = document.querySelector('.btn-close');

        closeModalEditar.addEventListener('click', (e)=> {

            e.preventDefault();
            modaleditar.remove();

        });

    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////

    //MODAL BORRAR
    let modalborrar = document.createElement("div");
    let modalborrarcontenido = document.createElement("div");
    let modalborrarheader = document.createElement("div");
    let modalborrarbody = document.createElement("div");
    let modalborrarfooter = document.createElement("div");
    let borrarform = document.createElement("form");
    let borrarlabelarchivo = document.createElement("label");
    let borrarinputfile = document.createElement("input");
    let borrarlabelnombrearchivo = document.createElement("label");
    let borrarinputnombrearchivo = document.createElement("input");
    let borrarlabeldescripcionarchivo = document.createElement("label");
    let borrarinputdescripcionarchivo = document.createElement("textarea");
    let borrarinputcurso = document.createElement("input");
    let borrarinputboton = document.createElement("input");
    let borrarmodalbotoncerrar = document.createElement("button");
    let borrarmodalh5 = document.createElement("h5");
    let borrarbr = document.createElement("br");


    function generarModalBorrar($id, $evaluable) {

        console.log($evaluable);

        //Modal
        modalborrar.classList.add("modal-manual");

        //Contenido
        modalborrarcontenido.classList.add("modal-contenido");

        //Header
        modalborrarheader.classList.add("modal-header");

        //Body
        modalborrarbody.classList.add("modal-body");

        //Form
        ruta_url = <?php echo json_encode(RUTA_URL) ?>;

        if ($evaluable == true) {

        ruta_addnota = "/curso/add_evaluable/"+$id;

        } else {

        console.log("HE LLEGAO AL ELSE")
        ruta_addnota = "/curso/add_noevaluable/"+$id;

        }
        ruta = ruta_url+ruta_addnota;

        form.method = "post";
        form.action = ruta;

        //H5 y botoncerrar
        borrarmodalh5.classList.add("fs-6");
        borrarmodalh5.innerHTML = "Subir Material";
        borrarmodalbotoncerrar.classList.add("btn-close");

        //Inputs
        borrarlabelnombrearchivo.innerHTML = "Nombre";
        borrarlabelnombrearchivo.classList.add("mt-2");
        borrarinputnombrearchivo.id = "inputNombreArchivo";
        borrarinputnombrearchivo.type = "text";
        borrarinputnombrearchivo.classList.add("form-control");
        borrarinputnombrearchivo.classList.add("mb-3");
        borrarinputnombrearchivo.name = "nombre";

        borrarlabelarchivo.innerHTML = "Archivo";
        borrarinputfile.type = "file";
        borrarinputfile.name = "archivo";
        borrarinputfile.classList.add("mb-3");
        borrarinputfile.classList.add("mt-2");

        borrarlabeldescripcionarchivo.innerHTML = "Descripción"
        borrarinputdescripcionarchivo.style.height = "100px";
        borrarinputdescripcionarchivo.classList.add("form-control");
        borrarinputdescripcionarchivo.classList.add("mb-4");
        borrarinputdescripcionarchivo.name = "descripcion";

        borrarinputcurso.value = $id;
        borrarinputcurso.classList.add("d-none");
        borrarinputcurso.name = "id_curso";

        //Boton Guardar
        borrarinputboton.type = "submit";
        borrarinputboton.value = "Guardar";
        borrarinputboton.classList.add("btn");
        borrarinputboton.classList.add("btn-success");
        borrarinputboton.id = "guardar";

        //Footer
        modalborrarfooter.classList.add("modal-footer");

        //Appends
        document.body.appendChild(modalborrar);
        modalborrar.appendChild(modalborrarcontenido);
        modalborrarcontenido.appendChild(modalborrarheader);
        modalborrarcontenido.appendChild(modalborrarbody);
        modalborrarcontenido.appendChild(modalborrarfooter);
        modalborrarheader.appendChild(borrarmodalh5);
        modalborrarheader.appendChild(borrarmodalbotoncerrar);
        modalborrarbody.appendChild(borrarbr);
        modalborrarbody.appendChild(borrarform);
        borrarform.appendChild(borrarlabelarchivo);
        borrarform.appendChild(borrarinputfile);
        borrarform.appendChild(borrarlabelnombrearchivo);
        borrarform.appendChild(borrarinputnombrearchivo);
        borrarform.appendChild(borrarlabeldescripcionarchivo);
        borrarform.appendChild(borrarinputdescripcionarchivo);
        borrarform.appendChild(borrarinputcurso);
        borrarform.appendChild(borrarinputboton);

        //Cerrar Modal
        const closeModalBorrar = document.querySelector('.btn-close');

        closeModalBorrar.addEventListener('click', (e)=> {

            e.preventDefault();
            modalborrar.remove();

        });

    }


</script> 

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>