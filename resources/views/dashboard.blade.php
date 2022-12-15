<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="logo my-6 flex justify-center">
                <img class="w-28" src="http://ensjba.com.ar/recursos/escudo_ce_chi.png" alt="logo">
            </div>
            <h1 class="text-2xl font-light text-center">Bienvenido <b class="font-bold">{{Auth::user()->lastName}} {{ Auth::user()->name }}</b>.</h1>
            <div class="grid grid-cols-2 gap-4 my-6">
                <div class="py-8 rounded-xl shadow-md" style="background-color: #68B984">
                    <div class="flex justify-center aling-center">
                        <i class="fa-solid fa-users text-white mr-3 text-xl"></i>
                        <h4 class="text-white text-center text-xl font-bold">Estudiantes</h4>
                    </div>
                    <h5 class="text-center text-white text-3xl my-3 font-bold">200</h5>        
                </div>
                <div class="py-8 rounded-xl shadow-md" style="background-color: #68B984">
                    <div class="flex justify-center aling-center">
                        <i class="fa-solid fa-users text-white mr-3 text-xl"></i>
                        <h4 class="text-white text-center text-xl font-bold">Profesores</h4>
                    </div>
                    <h5 class="text-center text-white text-3xl my-3 font-bold">50</h5> 
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 my-6">
                <div class="bg-white hover:bg-blue-300 duration-200 cursor-pointer rounded-xl shadow-md py-8 p-4 flex flex-col justify-center items-center">
                    <i class="fa-solid fa-chalkboard text-center text-4xl"></i>
                    <p class="text-center my-6">Cursos</p>
                </div>
                <div class="bg-white hover:bg-blue-300 duration-200 cursor-pointer rounded-xl shadow-md py-8 p-4 flex flex-col justify-center items-center">
                    <i class="fa-solid fa-users text-center text-4xl"></i>
                    <p class="text-center my-6">Estudiantes</p>
                </div>
                <div class="bg-white hover:bg-blue-300 duration-200 cursor-pointer rounded-xl shadow-md py-8 p-4 flex flex-col justify-center items-center">
                    <i class="fa-solid fa-users text-center text-4xl"></i>
                    <p class="text-center my-6">Profesores</p>         
                </div>
                <div class="bg-white hover:bg-blue-300 duration-200 cursor-pointer rounded-xl shadow-md py-8 p-4 flex flex-col justify-center items-center">
                    <i class="fa-solid fa-award text-center text-4xl"></i>
                    <p class="text-center my-6">Cuadro de Honor</p>
                </div>
                <div class="bg-white hover:bg-blue-300 duration-200 cursor-pointer rounded-xl shadow-md py-12 p-4 flex flex-col justify-center items-center">
                    <i class="fa-solid fa-bars-progress text-center text-4xl"></i>
                    <p class="text-center my-6">Roles</p>
                </div>
                <div class="bg-white hover:bg-blue-300 duration-200 cursor-pointer rounded-xl shadow-md py-12 p-4 flex flex-col justify-center items-center">
                    <i class="fa-regular fa-clipboard text-center text-4xl"></i>
                    <p class="text-center my-6">Calificaciones</p>
                </div>
                <div class="bg-white hover:bg-blue-300 duration-200 cursor-pointer rounded-xl shadow-md py-12 p-4 flex flex-col justify-center items-center">
                    <i class="fa-solid fa-graduation-cap text-center text-4xl"></i>
                    <p class="text-center my-6">Materias</p>
                </div>
                <div class="bg-white hover:bg-blue-300 duration-200 cursor-pointer rounded-xl shadow-md py-12 p-4 flex flex-col justify-center items-center">
                    <i class="fa-regular fa-calendar text-center text-4xl"></i>
                    <p class="text-center my-6">Periodos</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
