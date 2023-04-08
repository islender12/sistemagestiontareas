@extends('plantilla')
@section('container')
    <x-principal-component>
        <x-sidebar-component />
        <x-principal-content-component>
            <h1 class="font-bold py-4 uppercase">Listador de Tareas</h1>
            <x-table-component>
                <x-slot name="thead">
                    <th class="text-center py-3 px-2 rounded-l-lg">Nombre del Proyecto</th>
                    <th class="text-center py-3 px-2">Breve Descripción</th>
                    <th class="text-center py-3 px-2">Cantidad Tareas</th>
                    <th class="text-center py-3 px-2">Fecha Creación</th>
                    <th class="text-center py-3 px-2">Status</th>
                    <th class="text-center py-3 px-2 rounded-r-lg">Actions</th>
                </x-slot>
                <x-slot name="tr">
                </x-slot>
            </x-table-component>
        </x-principal-content-component>
        <div id="modal-component-container" class="hidden fixed inset-0">
            <div
                class="modal-flex-container flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
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
                                <h3 class="text-lg font-medium text-gray-900">Eliminar elemento</h3>
                                <div class="modal-text mt-2">
                                    <p class="text-gray-500 text-sm">Seguro</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-actions bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            class="w-full inline-flex justify-center rounded-md border-transparent shadow-md px-4 py-2 bg-red-700 font-medium text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Eliminar</button>
                        <button id="exit"
                            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-md px-4 py-2 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm mt-3">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </x-principal-component>
    @vite('resources/js/proyectos.js')
@endsection
