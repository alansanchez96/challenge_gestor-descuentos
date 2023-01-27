<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  text-gray-800 leading-tight">
            {{ __('Descuentos') }}
        </h2>
        @if (session('success'))
            <p class="text-green-500 mt-2 font-bold">{{ session('success') }}</p>
        @endif
        <button type="button"
            class="mr-auto mt-3 rounded-md py-3 px-4 bg-indigo-500 hover:bg-indigo-700 text-white border-indigo-500">
            <a href="{{ route('discount.create') }}">Nuevo Descuento</a>
        </button>
    </x-slot>

    @livewire('list-discounts')

</x-app-layout>
