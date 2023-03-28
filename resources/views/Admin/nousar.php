@extends('plantilla')
@section('container')
    <section class="w-full h-14 bg-slate-200 flex border-slate-300 border-b shadow-sm">
        <a class="logo flex-shrink-0" href="#">
            <img class="rounded-full w-10 h-10" src="{{ asset('image/logo.png') }}">
            <span class="logo_description">Task Management</span>
        </a>

        <div class="flex items-center gap-4 mx-4">
            <i class="bars"></i>
            <ul class=" text-slate-700 hover:text-slate-900 flex gap-4">
                <li><a href="#">Home</a></li>
                <li><a href="#">Home</a></li>
                <li><a href="#">Home</a></li>
            </ul>
        </div>
        <div class="w-full my-auto">
            <div class="flex justify-end mx-10 items-center gap-4">
                <img class="rounded-full w-8 h-8 object-cover"
                    src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
                <span class=" text-slate-900">Islender Montilva</span>
            </div>
        </div>
    </section>
    <section class="flex">
        <aside class="aside">
            <a href="#">
                <img class="rounded-full w-10 h-10 object-cover"
                    src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
                <span class="logo_description">Islender Montilva</span>
            </a>
            <hr>
            <ul class="menu_aside">
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span></a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span>
                    </a>
                </li>
                <li class="hover:opacity-80 hover:p-1">
                    <a href="#" class="link_aside">
                        <i class="fas fa-house-user text-xl"></i>
                        <span class="logo_description"> Inicio</span>
                    </a>
                </li>

            </ul>
        </aside>
        <section class="w-full m-4">

            <nav class="flex px-5 py-3 text-gray-700  rounded-lg bg-gray-50 dark:bg-[#1E293B] " aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white gap-2">
                            <i class="fas fa-house"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-angle-right text-gray-400"></i>

                            <p
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                                Templates</p>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="flex flex-wrap my-5 -mx-2">
                <div class="w-full lg:w-1/3 p-2">
                    <div
                        class="flex items-center flex-row w-full bg-gradient-to-r dark:from-cyan-500 dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                        <div
                            class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="object-scale-down transition duration-500">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Total User
                            </div>
                            <div class="">
                                100
                            </div>
                        </div>
                        <div class=" flex items-center flex-none text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="w-6 h-6">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-2 ">
                    <div
                        class="flex items-center flex-row w-full bg-gradient-to-r dark:from-cyan-500 dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                        <div
                            class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="object-scale-down transition duration-500 ">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Total Product
                            </div>
                            <div class="">
                                500
                            </div>
                        </div>
                        <div class=" flex items-center flex-none text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="w-6 h-6">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                    <div
                        class="flex items-center flex-row w-full bg-gradient-to-r dark:from-cyan-500 dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                        <div
                            class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="object-scale-down transition duration-500">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Total Visitor
                            </div>
                            <div class="">
                                500
                            </div>
                        </div>
                        <div class=" flex items-center flex-none text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="w-6 h-6">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </section>

    <script>
        const bars = document.querySelector('.bars');
        const logo = document.querySelector('.logo');
        const aside = document.querySelector('.aside');
        const links_asides = document.querySelectorAll('.link_aside');
        const logos_description = document.querySelectorAll('.logo_description');
        bars.addEventListener('click', () => {
            logo.classList.toggle('logo_responsive');
            aside.classList.toggle('aside_responsive');

            for (let logo_desc of logos_description) {
                logo_desc.classList.toggle('hidden');
            }

            for (let link_aside of links_asides) {
                link_aside.classList.toggle('link_aside');
                link_aside.classList.toggle('link_aside_responsive');
            }

        });
    </script>
@endsection
