<?php require_once RUTA_APP.'/vistas/inc/header_curso.php'; ?>

<?php print_r($datos['usuarioSesion']); ?>


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
        <?php if ($datos['usuarioSesion']->id_rol == 1  ): ?>
            <div class="row mb-4">
                <button 
                id="addNoEntregable" 
                class="col-2 btn btn-primary d-flex align-items-center" 
                <?php echo "onclick='generarModal(".$datos['cursoactual'].", false)'" ?> > 
                    <i class="bi bi-file-earmark-plus fs-3"></i> &nbsp &nbsp &nbsp
                    Añadir material
                </button>
            </div>
        <?php endif ?>
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
                        <?php echo "onclick='generarModalVer(".$noevaluable->id_material.",".$datos['cursoactual'].")'" ?>>
                            <i class="bi bi-eye fs-4"></i>
                        </a>
                        <a 
                        class="text-decoration-none text-dark d-flex align-items-center me-3" 
                        href="#"
                        <?php echo "onclick='generarModalEditar(".$noevaluable->id_material.",".$datos['cursoactual'].")'" ?>> 
                            <i class="bi bi-pencil-square fs-4"></i> 
                        </a>
                        <a 
                        class="text-decoration-none text-dark d-flex align-items-center me-3" 
                        href="#"
                        <?php echo "onclick='generarModalBorrar(".$noevaluable->id_material.",".$datos['cursoactual'].")'" ?>>
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                    <?php endif ?>
                </div>
                <hr>
            <?php endforeach ?>
        </div> 
    </div>

    <div id="divEntregables" class="mt-5 d-none">
        <?php if ($datos['usuarioSesion']->id_rol == 1): ?>
            <div class="row mb-4">
                <button 
                id="addEntregable" 
                class="col-2 btn btn-primary d-flex align-items-center"
                <?php echo "onclick='generarModal(".$datos['cursoactual'].", true)'" ?>> 
                    <i class="bi bi-file-earmark-plus fs-3"></i> &nbsp &nbsp &nbsp
                    Añadir material
                </button>
            </div>
        <?php endif ?>

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
                        <?php echo "onclick='generarModalVer(".$evaluable->id_material.",".$datos['cursoactual'].")'" ?>>
                            <i class="bi bi-eye fs-4"></i>
                        </a>
                        <a 
                        class="text-decoration-none text-dark d-flex align-items-center me-3"
                        href="#"
                        <?php echo "onclick='generarModalEditar(".$evaluable->id_material.",".$datos['cursoactual'].")'" ?>> 
                            <i class="bi bi-pencil-square fs-4"></i> 
                        </a>
                        <a 
                        class="text-decoration-none text-dark d-flex align-items-center me-3" 
                        href="#"
                        <?php echo "onclick='generarModalBorrar(".$evaluable->id_material.",".$datos['cursoactual'].")'" ?>>
                            <i class="bi bi-trash fs-4"></i>
                        </a>
                    <?php endif ?>
                    
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
    let labelnombretarea = document.createElement("label");
    let inputnombretarea = document.createElement("input");
    let labeldescripciontarea = document.createElement("label");
    let inputdescripciontarea = document.createElement("textarea");
    let inputcurso = document.createElement("input");
    let inputboton = document.createElement("input");
    let modalbotoncerrar = document.createElement("button");
    let modalh5 = document.createElement("h5");
    let br = document.createElement("br");

    function generarModal(id_curso, evaluable) {

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

        if (evaluable == true) {

            ruta_addnota = "/curso/add_evaluable/"+id_curso;

        } else {

            ruta_addnota = "/curso/add_noevaluable/"+id_curso;

        }
        ruta = ruta_url+ruta_addnota;

        form.method = "post";
        form.action = ruta;

        //H5 y botoncerrar
        modalh5.classList.add("fs-6");
        modalh5.innerHTML = "Subir Material";
        modalbotoncerrar.classList.add("btn-close");

        //Inputs
        labelnombretarea.innerHTML = "Nombre";
        inputnombretarea.id = "inputnombretarea";
        inputnombretarea.type = "text";
        inputnombretarea.classList.add("form-control");
        inputnombretarea.classList.add("mb-3");
        inputnombretarea.name = "nombre";

        labeldescripciontarea.innerHTML = "Descripción";
        inputdescripciontarea.id = "inputdescripciontarea";
        inputdescripciontarea.style.height = "100px";
        inputdescripciontarea.classList.add("form-control");
        inputdescripciontarea.classList.add("mb-4");
        inputdescripciontarea.name = "descripcion";

        inputcurso.value = id_curso;
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
        form.appendChild(labelnombretarea);
        form.appendChild(inputnombretarea);
        form.appendChild(labeldescripciontarea);
        form.appendChild(inputdescripciontarea);
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
    let editarlabelnombretarea = document.createElement("label");
    let editarinputnombretarea = document.createElement("input");
    let editarlabeldescripciontarea = document.createElement("label");
    let editarinputdescripciontarea = document.createElement("textarea");
    let editarinputmaterial = document.createElement("input");
    let editarinputboton = document.createElement("input");
    let editarmodalbotoncerrar = document.createElement("button");
    let editarmodalh5 = document.createElement("h5");
    let editarbr = document.createElement("br");


    function generarModalEditar(id_material, id_curso) {
        
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

        ruta_updatematerial = "/curso/update_material/"+id_curso;

        ruta = ruta_url+ruta_updatematerial;

        editarform.method = "post";
        editarform.action = ruta;
        editarform.id = "formulario";

        //H5 y botoncerrar
        editarmodalh5.classList.add("fs-6");
        editarmodalh5.innerHTML = "Subir Material";
        editarmodalbotoncerrar.classList.add("btn-close");

        //Inputs
        editarlabelnombretarea.innerHTML = "Nombre";
        editarlabelnombretarea.classList.add("mt-2");
        editarinputnombretarea.id = "inputnombretarea";
        editarinputnombretarea.type = "text";
        editarinputnombretarea.classList.add("form-control");
        editarinputnombretarea.classList.add("mb-3");
        editarinputnombretarea.name = "nombre";

        editarlabeldescripciontarea.innerHTML = "Descripción";
        editarinputdescripciontarea.id = "inputdescripciontarea";
        editarinputdescripciontarea.style.height = "100px";
        editarinputdescripciontarea.classList.add("form-control");
        editarinputdescripciontarea.classList.add("mb-4");
        editarinputdescripciontarea.name = "descripcion";

        editarinputmaterial.value = id_material;
        editarinputmaterial.classList.add("d-none");
        editarinputmaterial.name = "id_material";

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
        editarform.appendChild(editarlabelnombretarea);
        editarform.appendChild(editarinputnombretarea);
        editarform.appendChild(editarlabeldescripciontarea);
        editarform.appendChild(editarinputdescripciontarea);
        editarform.appendChild(editarinputmaterial);
        editarform.appendChild(editarinputboton);

        rellenarModal();

        //Cerrar Modal
        const closeModalEditar = document.querySelector('.btn-close');

        closeModalEditar.addEventListener('click', (e)=> {

            e.preventDefault();
            modaleditar.remove();

        });

    }

    async function rellenarModal(){

        const datosForm = new FormData(document.getElementById("formulario"))

        await fetch(`<?php echo RUTA_URL?>/curso/get_datosmaterial`, {
            method: "POST",
            body: datosForm,
        })
            .then((resp) => resp.json())
            .then(function(data) {

                let datosmaterial = data;

                if(datosmaterial == "") {

                    // Relleno los datos del formulario
                    document.getElementById("inputnombretarea").value = "";
                    document.getElementById("inputdescripciontarea").value = "";

                } else {

                    // Relleno los datos del formulario
                    document.getElementById("inputnombretarea").value = datosmaterial.nombre;
                    document.getElementById("inputdescripciontarea").value = datosmaterial.descripcion;

                }
                
            })
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////

    //MODAL VER MATERIAL
    let modalver = document.createElement("div");
    let modalvercontenido = document.createElement("div");
    let modalverheader = document.createElement("div");
    let modalverbody = document.createElement("div");
    let modalverfooter = document.createElement("div");
    let verform = document.createElement("form");
    let verlabelnombretarea = document.createElement("label");
    let verinputnombretarea = document.createElement("input");
    let verlabeldescripciontarea = document.createElement("label");
    let verinputdescripciontarea = document.createElement("textarea");
    let verinputmaterial = document.createElement("input");
    let verinputboton = document.createElement("input");
    let vermodalbotoncerrar = document.createElement("button");
    let vermodalh5 = document.createElement("h5");
    let verbr = document.createElement("br");


    function generarModalVer(id_material, id_curso) {
        
        //Modal
        modalver.classList.add("modal-manual");

        //Contenido
        modalvercontenido.classList.add("modal-contenido");

        //Header
        modalverheader.classList.add("modal-header");

        //Body
        modalverbody.classList.add("modal-body");

        //Form

        verform.id = "formulario";

        //H5 y botoncerrar
        vermodalh5.classList.add("fs-6");
        vermodalh5.innerHTML = "Ver Material";
        vermodalbotoncerrar.classList.add("btn-close");

        //Inputs
        verlabelnombretarea.innerHTML = "Nombre";
        verlabelnombretarea.classList.add("mt-2");
        verinputnombretarea.id = "inputnombretarea";
        verinputnombretarea.readOnly = true;
        verinputnombretarea.type = "text";
        verinputnombretarea.classList.add("form-control");
        verinputnombretarea.classList.add("mb-3");
        verinputnombretarea.name = "nombre";

        verlabeldescripciontarea.innerHTML = "Descripción";
        verinputdescripciontarea.id = "inputdescripciontarea";
        verinputdescripciontarea.readOnly = true; 
        verinputdescripciontarea.style.height = "100px";
        verinputdescripciontarea.classList.add("form-control");
        verinputdescripciontarea.classList.add("mb-4");
        verinputdescripciontarea.name = "descripcion";

        verinputmaterial.value = id_material;
        verinputmaterial.classList.add("d-none");
        verinputmaterial.name = "id_material";

        //Footer
        modalverfooter.classList.add("modal-footer");

        //Appends
        document.body.appendChild(modalver);
        modalver.appendChild(modalvercontenido);
        modalvercontenido.appendChild(modalverheader);
        modalvercontenido.appendChild(modalverbody);
        modalvercontenido.appendChild(modalverfooter);
        modalverheader.appendChild(vermodalh5);
        modalverheader.appendChild(vermodalbotoncerrar);
        modalverbody.appendChild(verbr);
        modalverbody.appendChild(verform);
        verform.appendChild(verlabelnombretarea);
        verform.appendChild(verinputnombretarea);
        verform.appendChild(verlabeldescripciontarea);
        verform.appendChild(verinputdescripciontarea);
        verform.appendChild(verinputmaterial);

        rellenarModalVer();

        //Cerrar Modal
        const closeModalVer = document.querySelector('.btn-close');

        closeModalVer.addEventListener('click', (e)=> {

            e.preventDefault();
            modalver.remove();

        });

    }

    async function rellenarModalVer(){

        const datosForm = new FormData(document.getElementById("formulario"))

        await fetch(`<?php echo RUTA_URL?>/curso/get_datosmaterial`, {
            method: "POST",
            body: datosForm,
        })
            .then((resp) => resp.json())
            .then(function(data) {

                let datosmaterial = data;

                if(datosmaterial == "") {

                    // Relleno los datos del formulario
                    document.getElementById("inputnombretarea").value = "";
                    document.getElementById("inputdescripciontarea").value = "";

                } else {

                    // Relleno los datos del formulario
                    document.getElementById("inputnombretarea").value = datosmaterial.nombre;
                    document.getElementById("inputdescripciontarea").value = datosmaterial.descripcion;

                }
                
            })
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////

    //MODAL BORRAR
    let modalborrar = document.createElement("div");
    let modalborrarcontenido = document.createElement("div");
    let modalborrarheader = document.createElement("div");
    let modalborrarbody = document.createElement("div");
    let modalborrarfooter = document.createElement("div");
    let borrarform = document.createElement("form");
    let borrarinputmaterial = document.createElement("input");
    let borrarinputboton = document.createElement("input");
    let borrarmodalbotoncerrar = document.createElement("button");
    let borrarmodalh5 = document.createElement("h5");

    function generarModalBorrar(id_material, id_curso) {

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

        ruta_addnota = "/curso/delete_material/"+id_curso;

        ruta = ruta_url+ruta_addnota;

        borrarform.method = "post";
        borrarform.action = ruta;

        //H5 y botoncerrar
        borrarmodalh5.classList.add("fs-6");
        borrarmodalh5.innerHTML = "Borrar Material";
        borrarmodalbotoncerrar.classList.add("btn-close");

        //Inputs

        borrarinputmaterial.value = id_material;
        borrarinputmaterial.classList.add("d-none");
        borrarinputmaterial.name = "id_material";

        //Boton Guardar
        borrarinputboton.type = "submit";
        borrarinputboton.value = "Borrar";
        borrarinputboton.classList.add("btn");
        borrarinputboton.classList.add("btn-danger");
        borrarinputboton.id = "borrar";

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
        modalborrarbody.appendChild(borrarform);
        borrarform.appendChild(borrarinputmaterial);
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