@extends('plantilla')

@section('container')
    <x-principal-component>
        <x-sidebar-component />
        <x-principal-content-component>
            <h1 class="font-bold py-4 uppercase">Listador de Tareas</h1>
            <x-table-component>
                <x-slot name="thead">
                    <th class="text-left py-3 px-2 rounded-l-lg">Nombre de la Tarea</th>
                    <th class="text-left py-3 px-2">Fecha Asignación</th>
                    <th class="text-left py-3 px-2">Fecha Vencimiento</th>
                    <th class="text-left py-3 px-2">Proyecto</th>
                    <th class="text-left py-3 px-2">Usuario Creador</th>
                    <th class="text-left py-3 px-2">Status</th>
                    <th class="text-left py-3 px-2 rounded-r-lg">Actions</th>
                </x-slot>
                <x-slot name="tr">
                </x-slot>
            </x-table-component>
        </x-principal-content-component>
        <div id="modal-component-container" class="hidden fixed inset-0">
        </div>
    </x-principal-component>
    @vite('resources/js/listatareas.js')
@endsection
