<div id="menu" class="bg-white/10 col-span-3 rounded-lg p-4 overflow-x-hidden">
    <h1
        class="font-bold text-lg lg:text-3xl bg-gradient-to-br from-white via-white/50 to-transparent bg-clip-text text-transparent">
        Dashboard<span class="text-indigo-400">.</span></h1>
    <p class="text-slate-400 text-sm mb-2">Gestion de Tareas</p>
    <x-user-logo-component :user="auth()->user()->name" />
    <hr class="my-2 border-slate-700">
    <div id="menu" class="flex flex-col space-y-2 my-5">

        <x-sidebar-nav-link-component class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center" href="{{route('home')}}">
            <x-slot name="svg">
                <i class="fas fa-house-chimney text-2xl m-auto lg:mr-1"></i>
            </x-slot>
            <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                Dashboard</p>
            <p class="text-slate-400 text-sm hidden md:block">Modulo Principal</p>
        </x-sidebar-nav-link-component>

        <x-sidebar-nav-link-component
            class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
            <x-slot name="svg">
                <i class="fas fa-comment-dots text-2xl m-auto lg:mr-1"></i>
            </x-slot>
            <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                Chat</p>
            <p class="text-slate-400 text-sm hidden md:block">Chat de la Empresa</p>
            <x-slot name="notification">23</x-slot>
        </x-sidebar-nav-link-component>
        <x-sidebar-nav-link-component
            class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center" href="{{route('tareas.index')}}">
            <x-slot name="redirect">tareas</x-slot>
            <x-slot name="svg">
                <i class="fas fa-book text-2xl m-auto lg:mr-1"></i>
            </x-slot>
            <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                Crear Tareas</p>
            <p class="text-slate-400 text-sm hidden md:block">Creación de Tareas</p>
        </x-sidebar-nav-link-component>
        <x-sidebar-nav-link-component>
            <x-slot name="svg">
                <i class="fas fa-user-group text-2xl m-auto lg:mr-1"></i>
            </x-slot>
            <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                Users</p>
            <p class="text-slate-400 text-sm hidden md:block">Manage users</p>
        </x-sidebar-nav-link-component>
        <x-sidebar-nav-link-component href="{{route('logout')}}">
            <x-slot name="svg">
                <i class="fas fa-door-open text-2xl m-auto lg:mr-1"></i>
            </x-slot>
            <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                Logout</p>
            <p class="text-slate-400 text-sm hidden md:block">Cerrar Sesión</p>
        </x-sidebar-nav-link-component>
    </div>
    <p class="text-sm text-center text-gray-600">v2.0.0.3 | &copy; Dashboard designed by 2022 Pantazi Soft</p>
</div>
