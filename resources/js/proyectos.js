window.addEventListener("DOMContentLoaded", () => {
    cargarProyecto();
});

async function cargarProyecto(page = "") {
    const response = await fetch(`allprojects?page=${page}`);
    const dataprojects = await response.json();
    const tbody = document.querySelector("#tbody");
    tbody.innerHTML = "";

    dataprojects.proyectos.data.forEach((proyecto) => {
        const estado = proyecto.status
            ? "<button class='active p-2 rounded-lg bg-slate-800' title='Inhabilitar'>Activo</button>"
            : "Inactivo";
        const cantidadTareas = proyecto.tareas.length;
        const fecha_creacion = new Date(proyecto.created_at)
            .toLocaleDateString("es-VE", {
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
            })
            .split("/")
            .reverse()
            .join("-");
        const proyectoHTML = `
            <tr class="border-b border-gray-700" data-id="${proyecto.id}">
                <td class="py-3 px-2 font-bold">
                    <div class="inline-flex space-x-3 items-center">
                        <span class="indent-2">${proyecto.nombre}</span>
                    </div>
                </td>
                <td class="py-3 px-2">${proyecto.descripcion.substring(
                    0,
                    30
                )}...</td>
                <td class="py-3 px-2 text-center">${cantidadTareas}</td>
                <td class="py-3 px-2">${fecha_creacion}</td>
                <td class="py-3 px-2">${estado}</td>
                <td class="py-3 px-2">
                    <div class="grid grid-cols-2 justify-center gap-4">
                        <a href="" title="Editar proyecto" class="hover:text-white">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                        <button class="mostrar hover:text-white" title="Mostrar Detalles"><i class="fas fa-eye"></i></button>
                        <button class="eliminar hover:text-white" title="Eliminar proyecto"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </td>
            </tr>`;
        tbody.insertAdjacentHTML("beforeend", proyectoHTML);
    });

    const btnactive = document.querySelectorAll(".active");
    btnactive.forEach((btn) => {
        btn.addEventListener("click", (event) => {
            const proyecto_id = event.target.closest("tr").dataset.id;
            const data = {
                id: proyecto_id,
                status: 0,
            };

            Swal.fire({
                title: "Deseas Inhabilitar el Proyecto?",
                text: "¡No podrás revertir esto!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, Inhabilitar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    actualizarproyecto(data);
                }
            });
        });
    });


    const paginate = document.querySelector(".paginate");
    paginate.innerHTML = "";
    const lastPages = dataprojects.proyectos.last_page;
    const currentPage = dataprojects.proyectos.current_page;
    const Total = dataprojects.proyectos.total;
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
            cargarProyecto(currentPage + 1);
        });
    }

    if (btnPrev) {
        btnPrev.addEventListener("click", () => {
            cargarProyecto(currentPage - 1);
        });
    }
}

/**
 *
 * @param {object} data objeto de los datos a actualizar
 */

async function actualizarproyecto(data) {
    try {
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const response = await fetch(`proyectos/${data.id}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify(data),
        });
        if (response.ok) {
            // Si la respuesta es exitosa, actualiza la lista de proyectos
            cargarProyecto();
        } else {
            throw new Error(`Error ${response.status}: ${response.statusText}`);
        }
    } catch (error) {
        console.log(error);
    }
}

