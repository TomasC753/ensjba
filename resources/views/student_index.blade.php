<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estudiantes') }}
        </h2>
    </x-slot>
    <div class="pt-6 px-4">
        @if (Auth::user()->role_is('administrator'))
        <h2 class="text-2xl font-light my-8">Vista de Administrador</h2>
        @endif
        @if (Auth::user()->role_is('teacher'))
        <h2 class="text-2xl font-light my-8">Vista de Docente</h2>
        @endif
        @if (Auth::user()->role_is('preceptor'))
        <h2 class="text-2xl font-light my-8">Vista de Preceptor</h2>
        @endif        
    </div>
    <livewire:student-table/>
    {{-- @livewire('student-table', ['data' => $students]) --}}
</x-app-layout>