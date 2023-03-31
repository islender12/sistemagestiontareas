@extends('plantilla')
@section('container')
    <!-- component -->
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <x-principal-component>
        <x-sidebar-component />
        <x-principal-content-component>
            <h1 class="font-bold py-4 uppercase">Crear Tareas</h1>
            <x-errors-component />
            <form action="{{ route('tareas.store') }}" method="POST">
                @csrf
                <div class="mt-4 grid gap-4 lg:grid-cols-2">
                    <div class="text-center sm:text-left order-1">
                        <label for="tarea" class="block mb-3 font-medium">Nombre de la Tarea</label>
                        <input type="text" name="tarea" id="tarea"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 px-6 text-base font-medium text-[#6b7280] outline-none focus:border-[#6a64f1] focus:shadow-md"
                            placeholder="Nombre de la tarea">
                    </div>
                    <div class="text-center sm:text-left order-2 lg:order-3 lg:col-span-2">
                        <label for="descripcion" class="block mb-3 font-medium">Descripción de la Tarea</label>
                        <textarea id="descripcion" name="descripcion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 min-h-[10em] max-h-56"
                            placeholder="Descripción"></textarea>
                    </div>

                    <div class="text-center sm:text-left order-3 lg:order-2">
                        <div class="mb-4">
                            <label for="proyecto" class="block mb-3 font-medium">Asignar Tarea al Proyecto</label>
                            <select id="proyecto" name="proyecto"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option disabled selected value="">Seleccionar Proyecto</option>
                                @foreach ($proyectos as $proyecto)
                                    <option value="{{ $proyecto->id }}" class="text-lg">{{ $proyecto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center sm:text-left order-4">
                        <label for="fecha_asignacion" class="block mb-3 font-medium">Fecha de Asignación</label>
                        <input type="date" name="fecha_asignacion" id="fecha_asignacion"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 px-6 text-base font-medium text-[#6b7280] outline-none focus:border-[#6a64f1] focus:shadow-md">
                    </div>
                    <div class="text-center sm:text-left order-5">
                        <label for="fecha_vencimiento" class="block mb-3 font-medium">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-2 px-6 text-base font-medium text-[#6b7280] outline-none focus:border-[#6a64f1] focus:shadow-md">
                    </div>
                </div>
                <div class="mt-6 order">
                    <button class="rounded-lg bg-[#6a64f1] py-2 px-8 w-full lg:w-auto" id="guardar">Guardar
                        Tarea</button>
                </div>
            </form>
        </x-principal-content-component>
    </x-principal-component>
    @vite('resources/js/createtareas.js')
@endsection
