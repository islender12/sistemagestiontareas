 <a href="{{ $href }}" class="rounded-lg pt-2 px-2 group mt-4">
     <div
         class="hover:bg-white/10 transition duration-150 ease-linear relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
         <div>
             {{$icon}}
         </div>
         <div>
             <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                 {{ $title }}
             </p>
             <p class="text-slate-400 text-sm hidden md:block">{{$slot}}</p>
         </div>
     </div>
 </a>
