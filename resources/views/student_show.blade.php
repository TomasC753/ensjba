<x-app-layout>
    <div class="pt-6 px-4">
        <div class="grid grid-cols-6 gap-3 dark:text-white">
            <div class="col-span-6 md:col-span-2 bg-white dark:bg-gray-700 shadow-md p-4 rounded-lg">
                <p class="text-center font-bold text-lg text-blue-500">{{$student->dni}}</p>
                <p class="text-center font-bold text-lg border-b-2 border-gray-200 dark:border-gray-500"><span class="editable font-bold">{{$student->lastName}} {{$student->name}}</span></p>
                <p class="text-md border-b-2 border-gray-200 dark:border-gray-500 py-2 break-words">Edad: <span class="editable font-bold">{{$student->age}}</span> años</p>
                <p class="text-md border-b-2 border-gray-200 dark:border-gray-500 py-2 break-words">Genero: <span class="editable font-bold">{{$student->gender}}</span></p>
                <p class="text-md border-b-2 border-gray-200 dark:border-gray-500 py-2 break-words">Tutor/a: <span class="editable font-bold">{{$student->tutor->lastName}} {{$student->tutor->name}}</span></p>
                <p class="text-md border-b-2 border-gray-200 dark:border-gray-500 py-2 break-words">Email: <span class="editable font-bold">{{$student->email}}</span></p>
                <p class="text-md border-b-2 border-gray-200 dark:border-gray-500 py-2 break-words">Localidad: <span class="editable font-bold">{{$student->country}}</span></p>
            </div>
            <div class="col-span-6 md:col-span-4 min-h-full max-h-max flex overflow-y-auto">
                <div class="pt-3 bg-white dark:bg-gray-700 shadow-md p-4 rounded-lg flex-1 min-h-full max-h-max">
                    <table class="w-full border-2 border-gray-200 dark:border-gray-500">
                        <thead class="border-2 border-gray-200 dark:border-gray-500">
                            <tr class="justify-center border-b-2 border-gray-200 dark:border-gray-500">
                                <td colspan="4" class="text-center text-lg font-bold">Cursos</td>
                            </tr>
                            <tr>
                                <th class="border-r-2 border-gray-200 dark:border-gray-500">Año/Grado</th>
                                <th class="border-r-2 border-gray-200 dark:border-gray-500">Division</th>
                                <th class="border-r-2 border-gray-200 dark:border-gray-500">Nivel</th>
                                <th class="">Preceptor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($student->courses as $course)
                                <tr class="border-b-2 border-gray-200 dark:border-gray-500">
                                    <td class="text-center border-r-2 border-gray-200 dark:border-gray-500">{{$course->year}}</td>
                                    <td class="text-center border-r-2 border-gray-200 dark:border-gray-500">{{$course->division}}</td>
                                    <td class="text-center border-r-2 border-gray-200 dark:border-gray-500">{{$course->type}}</td>
                                    <td class="text-center">
                                        {{-- @php dd($course->preceptor()->first()->lastName) @endphp --}}
                                        @if ($course->type == 'secundario' && $course->preceptor()->count() != 0)
                                            {{-- @php dd($course->preceptor()) @endphp --}}
                                            {{$course->preceptor()->lastName}} {{$course->preceptor()->name}}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                            <tr class="border-b-2 border-gray-200 dark:border-gray-500"><td colspan="4" class="text-center text-lg font-bold">Cursando</td></tr>
                            <tr>
                                <td class="text-center border-r-2 border-gray-200 dark:border-gray-500">{{$student->lastCourse->year}}</td>
                                <td class="text-center border-r-2 border-gray-200 dark:border-gray-500">{{$student->lastCourse->division}}</td>
                                <td class="text-center border-r-2 border-gray-200 dark:border-gray-500">{{$student->lastCourse->type}}</td>
                                <td class="text-center">
                                    @if ($student->lastCourse->type == 'secundario' && $student->lastCourse->preceptor()->count() != 0)
                                        {{$student->lastCourse->preceptor()->lastName}} {{$student->lastCourse->preceptor()->name}}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if (Auth::user()->role_is('teacher'))
                <div class="col-span-6 md:col-span-3 mt-3 bg-white dark:bg-gray-700 shadow-md rounded-lg">
                    <div class="header bg-gray-200 dark:bg-gray-600 p-4 rounded-t-lg">
                        <h3>Asistencia a la materia</h3>
                    </div>
                    <div class="body p-4">     
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 mt-3 bg-white dark:bg-gray-700 shadow-md rounded-lg">
                    <div class="header bg-gray-200 dark:bg-gray-600 p-4 rounded-t-lg">
                        <h3>Calificaciones en la materia</h3>
                    </div>
                    <div class="body p-4">
                        <livewire:qualifications-individual-show :student="$student" />
                    </div>
                </div>               
            @endif
        </div>
    </div> 
</x-app-layout>