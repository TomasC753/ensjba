<x-app-layout>
    <div class="pt-6 px-4">
        <div class="grid grid-cols-6 gap-3">
            <div class="col-span-2 bg-white shadow-md p-4 rounded-lg">
                <p class="text-center font-bold text-lg text-blue-500">{{$student->dni}}</p>
                <p class="text-center font-bold text-lg border-b-2 border-gray-200"><span class="editable font-bold">{{$student->lastName}} {{$student->name}}</span></p>
                <p class="text-md border-b-2 border-gray-200 py-2">Edad: <span class="editable font-bold">{{$student->age()}}</span> años</p>
                <p class="text-md border-b-2 border-gray-200 py-2">Genero: <span class="editable font-bold">{{$student->gender}}</span></p>
                <p class="text-md border-b-2 border-gray-200 py-2">Tutor/a: <span class="editable font-bold">{{$student->tutor->lastName}} {{$student->tutor->name}}</span></p>
                <p class="text-md border-b-2 border-gray-200 py-2">Email: <span class="editable font-bold">{{$student->email}}</span></p>
                <p class="text-md border-b-2 border-gray-200 py-2">Localidad: <span class="editable font-bold">{{$student->country}}</span></p>
            </div>
            <div class="col-span-4 bg-white shadow-md p-4 rounded-lg">
                <div class="pt-3">
                    <table class="w-full border-2 border-gray-200">
                        <thead class="border-2 border-gray-200">
                            <tr class="justify-center border-b-2 border-gray-200">
                                <td colspan="4" class="text-center text-lg font-bold">Cursos</td>
                            </tr>
                            <tr>
                                <th class="border-r-2 border-gray-200">Año/Grado</th>
                                <th class="border-r-2 border-gray-200">Division</th>
                                <th class="border-r-2 border-gray-200">Nivel</th>
                                <th class="">Preceptor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($student->courses as $course)
                                <tr class="border-b-2 border-gray-200">
                                    <td class="text-center border-r-2 border-gray-200">{{$course->year}}</td>
                                    <td class="text-center border-r-2 border-gray-200">{{$course->division}}</td>
                                    <td class="text-center border-r-2 border-gray-200">{{$course->type}}</td>
                                    <td class="text-center">
                                        {{-- @php dd($course->preceptor()->first()->lastName) @endphp --}}
                                        @if ($course->type == 'secundario' && $course->preceptor->count() != 0)
                                            {{-- @php dd($course->preceptor()->first()->lastName) @endphp --}}
                                            {{$course->preceptor()->first()->lastName}} {{$course->preceptor()->first()->name}}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                            <tr class="border-b-2 border-gray-200"><td colspan="4" class="text-center text-lg font-bold">Cursando</td></tr>
                            <tr>
                                <td class="text-center border-r-2 border-gray-200">{{$student->lastCourse()->year}}</td>
                                <td class="text-center border-r-2 border-gray-200">{{$student->lastCourse()->division}}</td>
                                <td class="text-center border-r-2 border-gray-200">{{$student->lastCourse()->type}}</td>
                                <td class="text-center">
                                    @if ($student->lastCourse()->type == 'secundario' && $student->lastCourse()->preceptor()->count() != 0)
                                        {{$student->lastCourse()->preceptor()->first()->lastName}} {{$student->lastCourse()->preceptor()->first()->name}}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</x-app-layout>