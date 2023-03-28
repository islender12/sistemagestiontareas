<div class="{{ $class }}">
    <div class="flex flex-row space-x-4 items-center">
        <div id="stats-1">
            {{ $principal_svg }}
        </div>
        <div>
            <p class="text-indigo-300 text-sm font-medium uppercase leading-4">{{ $title }}</p>
            <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                <span>{{ $cant }}</span>
                <span>
                    {{ $secondary_svg }}
                </span>
            </p>
        </div>
    </div>
</div>
