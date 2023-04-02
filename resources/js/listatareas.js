window.addEventListener("DOMContentLoaded", () => {
    cargarListado();
});

async function cargarListado(page = "") {
    try {
        const response = await fetch(
            `listadotareas?page=${page}`
        );
        const datos = await response.json();
        console.log(datos);
        const tbody = document.querySelector("#tbody");
        tbody.innerHTML = "";
        if (!datos.tareas.total) {
            const tareaHTML = '<tr><td colspan="7" class="py-8 text-center">No se ha podido encontrar Registros</td></tr>';
            tbody.innerHTML = tareaHTML;
        }

        datos.tareas.data.forEach((tarea) => {
            let buttonAsignar = "";
            if (tarea.estatus === "pendiente") {
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
                        <button class="eliminar hover:text-white" title="Eliminar Tarea"><i class="fa-solid fa-trash"></i></button>
                        ${buttonAsignar}
                    </div>
                </td>
            </tr>`;
            tbody.insertAdjacentHTML("beforeend", tareaHTML);
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
            btnPaginate += `<button onclick="cargarListado(${currentPage - 1
                })" class="btn bg-black/60 rounded-lg py-2 px-8">Prev</button>`;
        }

        if (currentPage < lastPages) {
            btnPaginate += `<button onclick="cargarListado(${currentPage + 1
                })" class="btn bg-black/60 rounded-lg py-2 px-8">Next</button>`;
        }

        paginate.insertAdjacentHTML("beforeend", btnPaginate);

        // Evento del Boton Eliminar
        const btnELiminar = document.querySelectorAll(".eliminar");
        btnELiminar.forEach((eliminar) => {
            eliminar.addEventListener("click", (event) => {
                const tarea = event.target.closest('tr').dataset.id;
                Swal.fire({
                    title: "Deseas Eliminar?",
                    text: "You won't be able to revert this!",
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
        const butonesAsignar = document.querySelectorAll('.asignar-tarea');
        butonesAsignar.forEach(botonasignar => {
            botonasignar.addEventListener('click', (event) => {
                const tarea = event.target.closest('tr').dataset.id;

                cargarUsuarios().then((usuarios) => {

                    // Contruimos el objeto dinamicamente 
                    const inputOptions = {};
                    usuarios.users.forEach((usuario) => {
                        inputOptions[usuario.id] = usuario.name;
                    });
                    Swal.fire({
                        title: 'Asignar Tarea al Usuario',
                        input: 'select',
                        inputOptions: inputOptions,
                        inputPlaceholder: 'Selecciona el usuario',
                        showCancelButton: true,
                    })

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
        console.log(datos);
        return datos;
    } catch (error) {
        console.log(datos);
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

