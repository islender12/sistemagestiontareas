<div class="errors">
    @if ($errors->any())
        <div class="bg-red-500 h-auto w-full p-4 rounded-lg" id="card-error">
            <div class="float-right" id="close"><i class="fas fa-xmark"></i></div>
            <ul class="flex flex-col gap-4 lg:gap-2">
                @foreach ($errors->all() as $error)
                    <li> &ndash; {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
