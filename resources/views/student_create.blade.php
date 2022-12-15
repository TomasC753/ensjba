<x-app-layout>

    <div>
        <form class="md:flex justify-center items-center max-h-max md:pt-6" action="" x-data="{step: 1}">
            <h3 class="text-2xl font-light px-6" x-show="step == 1">Paso 01</h3>
            <h3 class="text-2xl font-light px-6" x-show="step == 2">Paso 02</h3>
            @csrf
            <!--
            |
            |  Step One
            |   
            -->
            <div class="bg-white rounded-lg shadow-md w-full md:w-3/4" x-show="step == 1">
                <div class="header bg-gray-500 p-4 rounded-t-lg">
                    <h4 class="text-white">Registrar Estudiante</h4>
                </div>
                <div class="body p-4 max-h-max overflow-y-auto">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2 md:col-span-1">
                                <div class="flex flex-col pt-4">
                                    <label for="name" class="text-lg">Nombre*</label>
                                    <input required value="{{ old('name') }}" type="text" id="name" name="name" placeholder="John" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('name')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="lastName" class="text-lg">Apellido*</label>
                                    <input required value="{{ old('lastName') }}" type="text" id="lastName" name="lastName" placeholder="Smith" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('lastName')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="dni" class="text-lg">DNI*</label>
                                    <input required value="{{ old('dni') }}" type="text" id="dni" name="dni" placeholder="DNI" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('dni')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="date_birth" class="text-lg">Fecha de Nacimiento*</label>
                                    <input required value="{{ old('date_birth') }}" type="date" id="date_birth" name="date_birth" placeholder="Fecha de Nacimiento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('date_birth')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="dni" class="text-lg">Genero*</label>
                                    <select required name="gender" id="gender">
                                        <option disabled>Seleccionar Genero...</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                        <option value="no binario">No Binario</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>    
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <div class="flex flex-col pt-4">
                                    <label for="country" class="text-lg">Localidad*</label>
                                    <input required value="{{ old('country') }}" type="text" id="country" name="country" placeholder="Localidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('country')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="andress" class="text-lg">Domicilio*</label>
                                    <input required value="{{ old('andress') }}" type="text" id="andress" name="andress" placeholder="Domicilio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('andress')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="email" class="text-lg">Email*</label>
                                    <input required value="{{ old('email') }}" type="email" id="email" name="email" placeholder="your@email.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('email')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="phone_number" class="text-lg">Numero de Telefono</label>
                                    <input value="{{ old('phone_number') }}" type="text" id="phone_number" name="phone_number" placeholder="Numero de Telefono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('phone_number')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="house_phone_number" class="text-lg">Telefono Fijo</label>
                                    <input value="{{ old('house_phone_number') }}" type="text" id="house_phone_number" name="house_phone_number" placeholder="Telefono Fijo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('house_phone_number')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
      
                            </div>
                            {{-- <div class="col-span-2">
                                <div class="flex flex-col pt-4">
                                    <label for="password" class="text-lg">Contraseña</label>
                                    <input type="password" id="password" name="password" placeholder="Contraseña" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('password')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="confirm-password" class="text-lg">Confirmar Contraseña</label>
                                    <input type="password" id="confirm-password" name="password_confirmation" placeholder="Contraseña" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                </div>
                            </div> --}}
                        </div>

                        <button @click="step = 2" class="bg-blue-700 cursor-pointer text-white text-lg hover:bg-blue-800 px-8 py-2 mt-8 rounded-xl float-right">Siguiente</button>
    
                </div>
            </div>
            <!--
            |
            |  Step Two
            |   
            -->
            <div class="bg-white rounded-lg shadow-md w-full md:w-3/4" x-show="step == 2">
                <div class="header bg-gray-500 p-4 rounded-t-lg">
                    <h4 class="text-white">Registrar Tutor del Estudiante</h4>
                </div>
                <div class="body p-4 max-h-max overflow-y-auto">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2 md:col-span-1">
                                <div class="flex flex-col pt-4">
                                    <label for="name" class="text-lg">Nombre*</label>
                                    <input required value="{{ old('name') }}" type="text" id="name" name="name" placeholder="John" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('name')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="lastName" class="text-lg">Apellido*</label>
                                    <input required value="{{ old('lastName') }}" type="text" id="lastName" name="lastName" placeholder="Smith" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('lastName')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="dni" class="text-lg">DNI*</label>
                                    <input required value="{{ old('dni') }}" type="text" id="dni" name="dni" placeholder="DNI" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('dni')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="date_birth" class="text-lg">Fecha de Nacimiento*</label>
                                    <input required value="{{ old('date_birth') }}" type="date" id="date_birth" name="date_birth" placeholder="Fecha de Nacimiento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('date_birth')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="dni" class="text-lg">Genero*</label>
                                    <select required name="gender" id="gender">
                                        <option disabled>Seleccionar Genero...</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                        <option value="no binario">No Binario</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>    
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <div class="flex flex-col pt-4">
                                    <label for="country" class="text-lg">Localidad*</label>
                                    <input required value="{{ old('country') }}" type="text" id="country" name="country" placeholder="Localidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('country')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="andress" class="text-lg">Domicilio*</label>
                                    <input required value="{{ old('andress') }}" type="text" id="andress" name="andress" placeholder="Domicilio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('andress')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="email" class="text-lg">Email*</label>
                                    <input required value="{{ old('email') }}" type="email" id="email" name="email" placeholder="your@email.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('email')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="phone_number" class="text-lg">Numero de Telefono</label>
                                    <input value="{{ old('phone_number') }}" type="text" id="phone_number" name="phone_number" placeholder="Numero de Telefono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('phone_number')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="house_phone_number" class="text-lg">Telefono Fijo</label>
                                    <input value="{{ old('house_phone_number') }}" type="text" id="house_phone_number" name="house_phone_number" placeholder="Telefono Fijo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('house_phone_number')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
      
                            </div>
                            {{-- <div class="col-span-2">
                                <div class="flex flex-col pt-4">
                                    <label for="password" class="text-lg">Contraseña</label>
                                    <input type="password" id="password" name="password" placeholder="Contraseña" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                    @error('password')
                                        <span class="text-red-500">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col pt-4">
                                    <label for="confirm-password" class="text-lg">Confirmar Contraseña</label>
                                    <input type="password" id="confirm-password" name="password_confirmation" placeholder="Contraseña" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                                </div>
                            </div> --}}
                        </div>

                        <div class="mt-8 flex flex-col md:flex-row justify-evenly md:justify-end">
                            <button @click="step = 1" class="text-blue-700 cursor-pointer text-lg hover:text-blue-800 px-8 py-2 rounded-xl">Atras</button>
                            <button class="bg-blue-700 cursor-pointer text-white text-lg hover:bg-blue-800 px-8 py-2 rounded-xl">Registrar Estudiante</button>
                        </div>            
                </div>
            </div>
        </form>
    </div>

</x-app-layout>