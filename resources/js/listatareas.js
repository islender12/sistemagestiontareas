window.addEventListener("DOMContentLoaded", () => {
  cargarListado();
});

async function cargarListado(page = "") {
  try {
    const response = await fetch(`listadotareas?page=${page}`);
    const datos = await response.json();
    const tbody = document.querySelector("#tbody");
    tbody.innerHTML = "";
    if (!datos.tareas.total) {
      const tareaHTML =
        '<tr><td colspan="7" class="py-8 text-center">No se ha podido encontrar Registros</td></tr>';
      tbody.innerHTML = tareaHTML;
    }

    datos.tareas.data.forEach((tarea) => {
      let buttonAsignar = "";
      if (tarea.estatus !== "asignado") {
        buttonAsignar =
          '<button class="hover:text-white asignar-tarea" title="Asignar Tarea"><i class="fas fa-hand-pointer"></i></button>';
      }
      const tareaHTML = `
            <tr class="border-b border-gray-700" data-id="${tarea.id}">
                <td class="py-3 px-2 font-bold">
                    <div class="inline-flex space-x-3 items-center">
                        <span class="indent-2">${tarea.nombre}</span>
                    </div>
                </td>
                <td class="py-3 px-2">${tarea.fecha_asignacion}</td>
                <td class="py-3 px-2">${tarea.fecha_vencimiento}</td>
                <td class="py-3 px-2">${tarea.proyecto.nombre}</td>
                <td class="py-3 px-2">${tarea.user.name}</td>
                <td class="py-3 px-2">${tarea.estatus}</td>
                <td class="py-3 px-2">
                    <div class="grid grid-cols-2 justify-center gap-4">
                        <a href="" title="Editar Tarea" class="hover:text-white">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                        <button class="mostrar hover:text-white" title="Mostrar Detalles"><i class="fas fa-eye"></i></button>
                        <button class="eliminar hover:text-white" title="Eliminar Tarea"><i class="fa-solid fa-trash"></i></button>
                        ${buttonAsignar}
                    </div>
                </td>
            </tr>`;
      tbody.insertAdjacentHTML("beforeend", tareaHTML);
    });

    // Modal de Mostrar Tarea
    const Modal = document.querySelector("#modal-component-container");
    const btnMostrar = document.querySelectorAll(".mostrar");
    // Creamos el evento click a cada uno de los botones mostrar
    btnMostrar.forEach((btn) => {
      btn.addEventListener("click", (event) => {
        const tarea_id = event.target.closest("tr").dataset.id;
        Modal.classList.remove("hidden");
        tareashow(tarea_id, Modal);
      });
    });

    const paginate = document.querySelector(".paginate");
    paginate.innerHTML = "";
    const lastPages = datos.tareas.last_page;
    const currentPage = datos.tareas.current_page;
    const Total = datos.tareas.total;
    const describe = document.querySelector(".describe");
    // Actualizar la descripción sin generarla de nuevo
    describe.innerHTML = `<p> Mostrando ${currentPage} a ${lastPages} de ${Total} Entradas</p>`;

    let btnPaginate = "";

    if (currentPage > 1) {
      btnPaginate += `<button id="prev" class="btn bg-black/60 rounded-lg py-2 px-8">Prev</button>`;
    }

    if (currentPage < lastPages) {
      btnPaginate += `<button id="next" class="btn bg-black/60 rounded-lg py-2 px-8">Next</button>`;
    }

    paginate.insertAdjacentHTML("beforeend", btnPaginate);

    const btnPrev = document.querySelector("#prev");
    const btnNext = document.querySelector("#next");

    if (btnNext) {
      btnNext.addEventListener("click", () => {
        cargarListado(currentPage + 1);
      });
    }

    if (btnPrev) {
      btnPrev.addEventListener("click", () => {
        cargarListado(currentPage - 1);
      });
    }

    // Evento del Boton Eliminar
    const btnELiminar = document.querySelectorAll(".eliminar");
    btnELiminar.forEach((eliminar) => {
      eliminar.addEventListener("click", (event) => {
        const tarea = event.target.closest("tr").dataset.id;
        Swal.fire({
          title: "Deseas Eliminar?",
          text: "¡No podrás revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí, Eliminar!",
        }).then((result) => {
          if (result.isConfirmed) {
            eliminarTarea(tarea);
          }
        });
      });
    });

    // Evento del Boton Asignar Tarea
    const butonesAsignar = document.querySelectorAll(".asignar-tarea");
    butonesAsignar.forEach((botonasignar) => {
      botonasignar.addEventListener("click", (event) => {
        const tarea = event.target.closest("tr").dataset.id;

        cargarUsuarios().then((usuarios) => {
          // Contruimos el objeto dinamicamente
          const inputOptions = {};
          usuarios.users.forEach((usuario) => {
            inputOptions[usuario.id] = usuario.name;
          });
          Swal.fire({
            title: "Asignar Tarea al Usuario",
            input: "select",
            inputOptions: inputOptions,
            inputPlaceholder: "Selecciona el usuario",
            showCancelButton: true,
            confirmButtonText: "Asignar Tarea",
            // inputAttributes: {
            //     name: "usuario_asignado",
            // },
          }).then((result) => {
            if (result.isConfirmed) {
              const selectedOption = result.value;
              AsignarTareaUsuario(tarea, selectedOption);
            }
          });
        });
      });
    });
  } catch (error) {
    console.error(error);
  }
}

async function cargarUsuarios() {
  try {
    const response = await fetch(`listadousuarios`);
    const datos = await response.json();
    return datos;
  } catch (error) {
    console.log(datos);
  }
}

async function AsignarTareaUsuario(tarea, usuario) {
  try {
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const response = await fetch("asignar_tarea_usuario", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": token,
      },
      body: JSON.stringify({ tarea: tarea, usuario: usuario }),
    });

    const data = await response.json();
    const { mensaje } = data;
    const keys = Object.keys(mensaje);
    const errorField = keys[0];
    const errorMessage = mensaje[errorField][0];
    if (response.status !== 201) {
      return Swal.fire("Ha Ocurrido Un Error", errorMessage, "error");
    }

    Swal.fire(
      "Tarea Asignada",
      "La Tarea fue Asignada Correctamente",
      "success"
    );
    cargarListado();
  } catch (error) {
    console.log(error);
  }
}

async function eliminarTarea(tarea) {
  const token = document.querySelector('meta[name="csrf-token"]').content;
  try {
    const response = await fetch(`tareas/${tarea}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": token,
      },
    });
    const data = await response.json();
    if (response.status !== 200) {
      return Swal.fire("Ha Ocurrido Un Error", data.mensaje, "error");
    }

    Swal.fire(
      "Eliminado",
      "Tu registro fue Eliminado Correctamente",
      "success"
    );
    cargarListado();
  } catch (error) {
    // Manejar el error de la solicitud
    console.log(error);
  }
}

async function tareashow(tarea_id, Modal) {
  const response = await fetch(`tareas/${tarea_id}`);
  const { tarea } = await response.json();
  const { proyecto } = tarea;
  const { users_asigned } = tarea;

  const usuario_asignado = users_asigned.length > 0 ? users_asigned[0] : { name: "N/A", email: "N/A", pivot: null};
  
  Modal.innerHTML = ` <div
  class="modal-flex-container flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
  <div class="modal-bg-container fixed inset-0 bg-gray-700 bg-opacity-75"></div>
  <div class="modal-space-container hidden sm:inline-block sm:align-middle sm:h-screen"></div>
  <div
      class="modal-container inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
      <div class="modal-wrapper bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="modal-wrapper-flex sm:flex sm:items-start">
              <div
                  class="modal-icon mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                  <i class="fas fa-paste mx-auto text-xl"></i>
              </div>
              <div class="modal-content text-center mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="font-bold text-gray-900 text-xl">${tarea.nombre}</h3>
                  <div class="modal-text mt-2">
                      <p class="text-black font-semibold my-2">Descripción</p>
                      <p class="text-gray-800 text-left">
                          ${tarea.descripcion}
                      </p>
                      <h3 class="my-3 text-black font-semibold">Proyecto al Que Pertenece</h3>
                      <p class="text-gray-900">${proyecto.nombre}</p>
                      <h3 class="my-3 text-black font-semibold">Usuario Asignado</h3>
                      <p class="text-gray-900"> - Nombre: ${usuario_asignado.name}</p>
                      <p class="text-gray-900"> - Correo: ${usuario_asignado.email}</p>
                      <h3 class="my-3 text-black">Estatus Usuario/Tarea: ${usuario_asignado.pivot ? usuario_asignado.pivot.status : "pendiente"}</h3>

                  </div>
              </div>
          </div>
      </div>
      <div class="modal-actions bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button id="exit" 
              class="w-full inline-flex justify-center rounded-md border-transparent shadow-md px-4 py-2 bg-slate-800 font-medium text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Salir</button>
      </div>
  </div>
</div>`;

  // Boton para salir del Modal
  const btnExit = document.querySelector("#exit");
  btnExit.addEventListener("click", () => {
    Modal.classList.add("hidden");
    Modal.innerHTML = "";
  });
}
