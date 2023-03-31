async function cargarListado(page = "") {
    try {
        const response = await fetch(
            `http://gestionproyectos.test/listadotareas?page=${page}`
        );
        const datos = await response.json();
        const tbody = document.querySelector("#tbody");
        tbody.innerHTML = "";
        datos.tareas.data.forEach((tarea) => {
            const tareaHTML = `
            <tr class="border-b border-gray-700">
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
                        <button class="eliminar hover:text-white" title="Eliminar Tarea" id="${tarea.id}"><i class="fa-solid fa-trash"></i></button>
                        <a href="" title="Asignar Tarea" class="hover:text-white">
                        <i class="fas fa-hand-pointer"></i>
                    </a>
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
            btnPaginate += `<button onclick="cargarListado(${
                currentPage - 1
            })" class="btn bg-black/60 rounded-lg py-2 px-8">Prev</button>`;
        }

        if (currentPage < lastPages) {
            btnPaginate += `<button onclick="cargarListado(${
                currentPage + 1
            })" class="btn bg-black/60 rounded-lg py-2 px-8">Next</button>`;
        }

        paginate.insertAdjacentHTML("beforeend", btnPaginate);
        const btnELiminar = document.querySelectorAll(".eliminar");
        btnELiminar.forEach((eliminar) => {
            eliminar.addEventListener("click", () => {
                const tarea = eliminar.getAttribute("id");
                eliminarTarea(tarea);
            });
        });
    } catch (error) {
        console.error(error);
    }
}

cargarListado();


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
        console.log(data)
        // Manejar la respuesta del servidor
        cargarListado();
    } catch (error) {
        // Manejar el error de la solicitud
        console.log(error);
    }
}
