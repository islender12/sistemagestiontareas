@extends('plantilla')
@section('container')
    <!-- component -->
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <x-principal-component>
        <x-sidebar-component />
        <x-content-component />
    </x-principal-component>
@endsection
