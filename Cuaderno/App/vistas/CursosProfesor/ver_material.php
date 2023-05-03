<?php require_once RUTA_APP.'/vistas/inc/header_curso.php'; ?>

<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-6">
            <h4 class="mb-4"> Evaluados </h4>
            <div class="row">
                <?php foreach($datos["materialRealizado"] as $alumno): ?>
                    <p class="col-10"> <?php echo $alumno->nombre ?>  </p>
                    <button 
                    type="button" 
                    class="btn btn-primary col-1" 
                    <?php echo "onclick='generarModal(".$datos['material']->id_material.",".$alumno->id_persona.")'" ?>> 
                        <i class="bi bi-pencil-square"></i> 
                    </button>
                <?php endforeach ?>
            </div> 
        </div>

        <div class="col-6">
            <h4 class="mb-4"> No Evaluados </h4>
                <div class="row">
                    <?php foreach($datos["materialNoRealizado"] as $alumno): ?>
                        <p class="col-10"> <?php echo $alumno->nombre ?> </p>
                        <button 
                        type="button" 
                        class="btn btn-primary col-1" 
                        <?php echo "onclick='generarModal(".$datos['material']->id_material.",".$alumno->id_persona.")'" ?>> 
                            <i class="bi bi-pencil-square"></i> 
                        </button>
                    <?php endforeach ?> 
                </div>
        </div>
    </div>
</div>

<script type='text/javascript'>

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

    function rellenarModal($id) {



        inputobservacion.innerHTML = "";

    }

    function generarModal($id, $id_persona, $nombre) {
        
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


        async function rellenarModal(id_reg_acciones){

// Marcamos el boton como cargando ... y lo deshabilitamos
let buttonEditar = document.getElementById("buttonEditar")
buttonEditar.innerHTML='<span class="spinner-border spinner-border-sm"></span> Loading...'
buttonEditar.disabled = true

await fetch(`<?php echo RUTA_URL?>/asesorias/get_accion/${id_reg_acciones}`, {
    headers: {
        "Content-Type": "application/json"
    },
    credentials: 'include'
})
    .then((resp) => resp.json())
    .then(function(data) {
        let accion = data

        // Relleno los datos del formulario
        document.getElementById("id_reg_acciones").value = id_reg_acciones
        document.getElementById("accion_edit").value = accion.accion

        // Activamos de nuevo el boton, despues de un delay
        setTimeout(() => {
            buttonEditar.innerHTML='Guardar'
            buttonEditar.disabled = false
        }, 1000);
        
    })
}

        const closeModal = document.querySelector('.btn-close');

        closeModal.addEventListener('click', (e)=> {

            e.preventDefault();
            modal.remove();

        });

    }

</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>