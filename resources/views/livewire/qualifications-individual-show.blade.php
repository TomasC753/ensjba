<div>
    <label for="qualification__subjects">Materia</label>
    <select wire:model="subject" wire:change="subject_change" class="dark:bg-gray-800 w-full" id="qualification__subjects">
        <option value="" selected>--Seleccionar Materia--</option>
        @forelse (Auth::user()->subjects_in_course($student->lastCourse)->get() as $subject)
            <option value="{{$subject->id}}">{{ $subject->name }}</option>
        @empty
        @endforelse
    </select>
    <div class="flex overflow-x-auto w-full mt-4">
        <div class="w-full overflow-x-scroll">
            <table class="qualifications_table w-full overflow-x-auto dark:text-white">
                <thead class="qualifications_table__thead border border-gray-100 dark:border-gray-800">
                    <tr>
                        <th class="border border-r-gray-100 dark:border-gray-800 py-2">Nota</th>
                        <th class="border border-r-gray-100 dark:border-gray-800 py-2">Tema</th>
                        <th class="py-2">Fecha</th>
                    </tr>
                </thead>
                <tbody class="qualifications_table__tbody">
                    @forelse ($qualifications as $qualification)
                        <tr>
                            <td class="py-2 border border-r-gray-100 dark:border-gray-800">{{$qualification->note}}</td>
                            <td class="py-2 border border-r-gray-100 dark:border-gray-800"></td>
                            <td class="py-2"></td>
                        </tr>
                    @empty
                        <tr class="empty_qualifications">
                            <td class="text-center font-bold text-lg py-3" colspan="3">El alumno no tiene calificaciones cargadas en esta materia</td>
                        </tr>     
                    @endforelse
                    <tr class="add_qualification">
                        <td colspan="3"><button class="add_qualification_button bg-blue-500 hover:bg-blue-700 cursor-pointer py-2 text-white w-full">Agregar Nota</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                let add_qualification_form_is_open = false;
                let tbody = document.querySelector('.qualifications_table__tbody');
                document.querySelector('.add_qualification_button').addEventListener('click', function(event){
                    // event.preventDefault();
                    alert('hola');
                    
                });
            });
        </script>
    @endpush
</div>
