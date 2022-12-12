<div x-data="{open: false}">
    <div x-show="open" @click="open = false" class="min-w-screen min-h-screen bg-gray-800 opacity-20 fixed inset-0" style="z-index: 999"></div>
    <div class="inset-0 fixed px-3 py-4 overflow-y-auto rounded bg-gray-50 dark:bg-gray-800" :class="open ? 'w-64' : 'w-16'" style="z-index: 1000">
        <button @click="open = !open" class="flex justify-start hover:bg-gray-600 p-2 rounded-md w-full">
            <i class="fa-solid fa-bars text-white text-2xl mr-3"></i>
            <span x-show="open" class="text-white">Menú</span>
        </button>
        <ul class="space-y-2">
            <li>
                <a href="{{Route('dashboard')}}"
                    class="flex items-center p-2 text-base font-normal dark:text-white text-gray-900 rounded-l {{Request::is('dashboard') ? 'bg-blue-500' : 'bg-none hover:bg-gray-100 dark:hover:bg-gray-700'}}"
                    :class="!open ? 'justify-center' : ''">
                    <svg class="w-6 h-6 {{Request::is('dashboard') ? 'text-white' : 'text-gray-500 dark:text-gray-400'}} transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span x-show="open" class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{Route('student.index')}}"
                    class="flex items-center p-2 text-base font-normal dark:text-white text-gray-900 rounded-l {{Request::is('student') ? 'bg-blue-500' : 'bg-none hover:bg-gray-100 dark:hover:bg-gray-700'}}"
                    :class="!open ? 'justify-center' : ''">
                    <i class="fa-solid fa-users {{Request::is('student') ? 'text-white' : 'text-gray-500 dark:text-gray-400'}}"></i>
                    <span x-show="open" class="ml-3">Estudiantes</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-normal dark:text-white text-gray-900 rounded-l {{Request::is('teacher.index') ? 'bg-blue-500' : 'bg-none hover:bg-gray-100 dark:hover:bg-gray-700'}}"
                    :class="!open ? 'justify-center' : ''">
                    <i class="fa-solid fa-users {{Request::is('teacher.index') ? 'text-white' : 'text-gray-500 dark:text-gray-400'}}"></i>
                    <span x-show="open" class="ml-3">Profesores</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-normal dark:text-white text-gray-900 rounded-l {{Request::is('subject.index') ? 'bg-blue-500' : 'bg-none hover:bg-gray-100 dark:hover:bg-gray-700'}}"
                    :class="!open ? 'justify-center' : ''">
                    <i class="fa-solid fa-graduation-cap {{Request::is('subject.index') ? 'text-white' : 'text-gray-500 dark:text-gray-400'}}"></i>
                    <span x-show="open" class="ml-3">Materias</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-normal dark:text-white text-gray-900 rounded-l {{Request::is('qualifications.index') ? 'bg-blue-500' : 'bg-none hover:bg-gray-100 dark:hover:bg-gray-700'}}"
                    :class="!open ? 'justify-center' : ''">
                    <i class="fa-solid fa-clipboard {{Request::is('qualifications.index') ? 'text-white' : 'text-gray-500 dark:text-gray-400'}}"></i>
                    <span x-show="open" class="ml-3">Calificaciones</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-normal dark:text-white text-gray-900 rounded-l {{Request::is('honor_roll') ? 'bg-blue-500' : 'bg-none hover:bg-gray-100 dark:hover:bg-gray-700'}}"
                    :class="!open ? 'justify-center' : ''">
                    <i class="fa-solid fa-award {{Request::is('honor_roll') ? 'text-white' : 'text-gray-500 dark:text-gray-400'}}"></i>
                    <span x-show="open" class="ml-3">Cuadro de Honor</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-normal dark:text-white text-gray-900 rounded-l {{Request::is('periods.index') ? 'bg-blue-500' : 'bg-none hover:bg-gray-100 dark:hover:bg-gray-700'}}"
                    :class="!open ? 'justify-center' : ''">
                    <i class="fa-solid fa-calendar {{Request::is('periods.index') ? 'text-white' : 'text-gray-500 dark:text-gray-400'}}"></i>
                    <span x-show="open" class="ml-3">Periodos</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span x-show="open" class="flex-1 ml-3 whitespace-nowrap">Cerrar Sesión</span>
                </a>
            </li>        
        </ul>
    </div>    
</div>
