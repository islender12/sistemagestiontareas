@props(['title' => 'Datatable'])
<div id="last-users">
    <h1 class="font-bold py-4 uppercase">{{$title}}</h1>
    <div class="overflow-x-scroll">
        <table class="w-full text-justify">
            <thead class="bg-black/60">
                {{ $thead }}
            </thead>
            <tbody id="tbody">
                {{ $tr }}
            </tbody>
        </table>
    </div>

    <div class="flex flex-col">
        <div class="describe flex justify-center gap-2 mt-4">

        </div>
        <div class="paginate flex justify-center gap-2 mt-4">

        </div>
    </div>
</div>
