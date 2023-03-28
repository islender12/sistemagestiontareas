<a href="{{$href}}" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
    <div class="{{ $class }}">
        <div>
            {{ $svg }}
        </div>
        <div>
            {{ $slot }}
        </div>
        @if ($notification)
            <div
                class="absolute -top-3 -right-3 md:top-0 md:right-0 px-2 py-1.5 rounded-full bg-indigo-800 text-xs font-mono font-bold">
                {{ $notification }}
            </div>
        @endif
    </div>
</a>
