<div class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group menudesplegable">
    <div class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
        <div>
            {{ $icon }}
        </div>
        <div class="relative">
            <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                {{ $title }}
            </p>
            <div class="absolute left-40 bottom-0">
                <i class="fas fa-down-long text-xl"></i>
            </div>
        </div>
    </div>
    {{ $slot }}
</div>
