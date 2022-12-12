<div class="px-3">
    <div class="bg-white rounded-lg shadow-md p-4 grid grid-cols-2 gap-3 items-center">
        <div class="col-span-2 lg:col-span-1 flex flex-col lg:flex-row gap-2 items-center">
            <div class="flex flex-col pt-4 w-full">
                <label for="type" class="text-lg">Nivel</label>
                <select wire:model="level" id="type">
                    <option value="">--Seleccionar nivel--</option>
                    <option value="primario">Primario</option>
                    <option value="secundario">Secundario</option>
                    <option value="terciario">Terciario</option>
                </select>
            </div>
            <div class="flex flex-col pt-4 w-full">
                <label for="course text-lg">Curso</label>
                <input wire:model="course" type="text" id="course" placeholder='6"b"'>
            </div>
        </div>
        <div class="col-span-2 lg:col-span-1">
            <div class="flex flex-col pt-4">
                <label for="search">Buscar alumno</label>
                <div class="relative flex-1">
                    <span class="absolute text-gray-600 inset-y-0 left-0 flex items-center pl-2">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input wire:model="search" class="w-full pl-10 bg-gray-200 border-0 focus:outline-none focus:ring-0 focus:bg-white focus:rounded-none focus:shadow-none border-b-2 border-gray-200 duration-200" placeholder="Buscar alumno" type="search" id="search">
                </div>
            </div>
        </div>
    </div>
    <div class="flex overflow-x-auto w-full mt-4">
        <div class="w-full overflow-x-scroll">
            <table class="w-full overflow-x-auto" x-data="{order_by: '', desc: @entangle('desc')}">
                <thead class="bg-white border-b-8 border-gray-100">
                    <tr>
                        <th>Acciones</th>
                        <th class="p-4 text-left" :class="(order_by == 'lastName') ? 'bg-blue-100' : 'bg-white'">
                            <label class="hover:underline cursor-pointer" for="order_by_lastName">Nombre y Apellido</label>
                            <input wire:model="order_by" class="hidden" type="radio" name="order_by" id="order_by_lastName" value="lastName" @click="order_by = 'lastName'">
                            <button class="w-full text-left"  :class="(order_by == 'lastName') ? '' : 'hidden'" @click="desc = !desc">
                                <i class="fa-solid" :class="desc ? 'fa-arrow-down' : 'fa-arrow-up'"></i>
                            </button>
                        </th>
                        <th class="p-4 text-left" :class="(order_by == 'dni') ? 'bg-blue-100' : 'bg-white'">
                            <label class="hover:underline cursor-pointer" for="order_by_dni">DNI</label>
                            <input wire:model="order_by" class="hidden" type="radio" name="order_by" id="order_by_dni" value="dni" @click="order_by = 'dni'">
                            <button class="w-full text-left" :class="(order_by == 'dni') ? '' : 'hidden'" @click="desc = !desc">
                                <i class="fa-solid" :class="desc ? 'fa-arrow-down' : 'fa-arrow-up'"></i>
                            </button>
                        </th>
                        <th class="p-4 text-left" :class="(order_by == 'tutor') ? 'bg-blue-100' : 'bg-white'">
                            <label class="hover:underline cursor-pointer" for="order_by_tutor">Tutor</label>
                            <input wire:model="order_by" class="hidden" type="radio" name="order_by" id="order_by_tutor" value="tutor.name" @click="order_by = 'tutor'">
                            <button class="w-full text-left" :class="(order_by == 'tutor') ? '' : 'hidden'" @click="desc = !desc">
                                <i class="fa-solid" :class="desc ? 'fa-arrow-down' : 'fa-arrow-up'"></i>
                            </button>
                        </th>
                        @if (Auth::user()->role_is('administrator'))
                           
                        <th class="p-4 text-left" :class="(order_by == 'phone_number') ? 'bg-blue-100' : 'bg-white'">
                            <label class="hover:underline cursor-pointer" for="order_by_phone_number">Numero de Telefono</label>
                            <input wire:model="order_by" class="hidden" type="radio" name="order_by" id="order_by_phone_number" value="phone_number" @click="order_by = 'phone_number'">
                            <button class="w-full text-left" :class="(order_by == 'phone_number') ? '' : 'hidden'" @click="desc = !desc">
                                <i class="fa-solid" :class="desc ? 'fa-arrow-down' : 'fa-arrow-up'"></i>
                            </button>
                        </th>
                        <th class="p-4 text-left" :class="(order_by == 'house_phone_number') ? 'bg-blue-100' : 'bg-white'">
                            <label class="hover:underline cursor-pointer" for="order_by_house_phone_number">Telefono Fijo</label>
                            <input class="hidden" type="checkbox" name="order_by" id="order_by_house_phone_number" value="house_phone_number" @click="order_by = 'house_phone_number'">
                            <button class="w-full text-left" :class="(order_by == 'house_phone_number') ? '' : 'hidden'" @click="desc = !desc">
                                <i class="fa-solid" :class="desc ? 'fa-arrow-down' : 'fa-arrow-up'"></i>
                            </button>
                        </th>
                        <th class="p-4 text-left" :class="(order_by == 'email') ? 'bg-blue-100' : 'bg-white'" >
                            <label class="hover:underline cursor-pointer" for="order_by_email">Email</label>
                            <input wire:model="order_by" class="hidden" type="radio" name="order_by" id="order_by_email" value="email" @click="order_by = 'email'">
                            <button class="w-full text-left" :class="(order_by == 'email')  ? '' : 'hidden'" @click="desc = !desc">
                                <i class="fa-solid" :class="desc ? 'fa-arrow-down' : 'fa-arrow-up'"></i>
                            </button>
                        </th>

                        @endif
                        <th class="p-4 text-left">Cursando</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @php dump($students) @endphp --}}
                    @forelse ($students as $student)
                        {{-- @php dump($student) @endphp --}}
                        <tr class="shadow-md bg-white hover:bg-blue-200 duration-300 rounded-xl border-b-8 border-gray-100">
                            <td class="px-3 py-4 text-center">
                                <a class="text-blue-500 hover:text-blue-700" href="{{Route('student.show', $student->id)}}"><i class="fa-solid fa-eye" title="Ver Alumno"></i></a>
                                <a class="text-orange-500 hover:text-orange-700" href="#" title="Calificaciones del Alumno"><i class="fa-solid fa-clipboard"></i></a>
                            </td>
                            <td class="px-3 py-4 text-left">{{$student->lastName}} {{$student->name}}</td>
                            <td class="px-3 py-4 text-left text-blue-600">{{$student->dni}}</td>
                            <td class="px-3 py-4 text-left">{{$student->tutor ? $student->tutor->name.' '.$student->tutor->lastName : ''}}</td>
                            @if (Auth::user()->role_is('administrator'))                            
                            <td class="px-3 py-4 text-left">{{$student->phone_number}}</td>
                            <td class="px-3 py-4 text-left">{{$student->house_phone_number}}</td>
                            <td class="px-3 py-4 text-left">{{$student->email}}</td>
                            @endif
                            <td class="px-3 py-4 text-left">{{$student->lastCourse()->name()}} {{$student->studentFrom()}}</td>
                            {{-- <td class="px-3 py-4 text-left">{{$student->studentFrom()}}</td> --}}
                        </tr>
                        @empty
                        <h1>No hay estudiantes registrados</h1>
                    @endforelse
                </tbody>
            </table>
            {{ $students->links() }}
        </div>    
    </div>
</div>