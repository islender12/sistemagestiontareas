@extends('plantilla')
@section('container')
    <x-principal-component>
        <x-sidebar-component />
        <x-principal-content-component>
            <h1 class="font-bold py-4 uppercase">Listador de Proyecto</h1>
            <x-table-component title="Lista de Proyectos">
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
        </div>
    </x-principal-component>
    @vite('resources/js/proyectos.js')
@endsection
