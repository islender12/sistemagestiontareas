// almacenamos en el objeto form cada de sus propiedades
// en este caso cada uno de los inputs
const form = {
    tarea: document.querySelector("#tarea"),
    proyecto: document.querySelector("#proyecto"),
    descripcion: document.querySelector("#descripcion"),
    fechaAsignacion: document.querySelector("#fecha_asignacion"),
    fechaVencimiento: document.querySelector("#fecha_vencimiento"),
    guardar: document.querySelector("#guardar"),
};

var cardError = document.querySelector("#card-error");
const errorsClass = document.querySelector(".errors");
const closeButton = document.querySelector("#close");

const fechaActual = new Date()
    .toLocaleDateString("es-VE", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    })
    .split("/")
    .reverse()
    .join("-");

form.fechaAsignacion.min = fechaActual;

form.fechaAsignacion.addEventListener("change", () => {
    form.fechaVencimiento.min = form.fechaAsignacion.value;
    actualizarFechaMinima();
});

form.fechaAsignacion.addEventListener("blur", () => {
    form.fechaAsignacion.value < fechaActual
        ? (form.fechaAsignacion.value = fechaActual)
        : null;
    actualizarFechaMinima();
});

if (closeButton) {
    closeButton.addEventListener("click", () => {
        cardError.classList.add("hidden");
    });
}

form.guardar.addEventListener("click", (event) => {
    // usamos la desestructuracion de objetos

    // La desestructuración de objetos en JavaScript nos permite
    // extraer valores de propiedades de un objeto y asignarlos a variables individuales,
    // lo que nos facilita el trabajo al trabajar con objetos.En este caso,
    // se está desestructurando el objeto form para obtener las propiedades
    //  tarea, proyecto, descripcion, fechaAsignacion y fechaVencimiento y asignar su valor
    //   a cada una de las constantes correspondientes.

    const { tarea, proyecto, descripcion, fechaAsignacion, fechaVencimiento } =
        form;

    const validaciones = {
        tarea: "El campo Tarea es Obligatorio.",
        descripcion: "El campo descripcion es obligatorio.",
        proyecto: "El campo proyecto es obligatorio.",
        fechaAsignacion: "El campo fecha asignacion es obligatorio.",
        fechaVencimiento: "El campo fecha vencimiento es obligatorio.",
    };
    let validacionExitosa = true;
    const errors = [];

    for (const [propiedad, mensaje] of Object.entries(validaciones)) {
        if (!form[propiedad].value) {
            validacionExitosa = false;
            errors.push(mensaje);
        }
    }

    if (fechaVencimiento.value < fechaAsignacion.value) {
        validacionExitosa = false;
        errors.push(
            "La fecha de Vencimiento no puede ser menor a la de Asignación."
        );
    }

    if (!validacionExitosa) {
        const errorHtml = `
        <div class="bg-red-500 h-auto w-full p-4 rounded-lg" id="card-error">
            <div class="float-right hover:cursor-pointer" id="close"><i class="fas fa-times"></i></div>
            <ul class="flex flex-col gap-4 lg:gap-2">
                ${errors.map((error) => `<li>- ${error}</li>`).join("")}
            </ul>
        </div>
        `;

        const cardErrorExistente = document.querySelector("#card-error");
        if (cardErrorExistente) {
            cardErrorExistente.remove();
        }

        errorsClass.innerHTML += errorHtml;
        event.preventDefault();
    }

    const btnClose = document.querySelector("#close");

    btnClose
        ? btnClose.addEventListener("click", () => {
              const cardRemove = document.querySelector("#card-error");
              cardRemove.remove();
          })
        : null;
});

function actualizarFechaMinima() {
    // Obtener la fecha de asignación seleccionada
    const fechaAsignacionValue = form.fechaAsignacion.value;
    const fechaAsignacionSeleccionada = new Date(fechaAsignacionValue);
    const fechaVencimientoValue = form.fechaVencimiento.value;

    // Obtener el Valor del Input de fecha de vencimiento
    form.fechaVencimiento.min = fechaAsignacionValue;
    // Verificamos si la fecha de vencimiento es menor a la fecha de asignación y si es así actualizarla
    if (new Date(form.fechaVencimiento.value) < fechaAsignacionSeleccionada) {
        console.log(
            "La fecha de vencimiento debe ser mayor o igual a la actual"
        );
        form.fechaVencimiento.value = fechaAsignacionValue;
    }
}
