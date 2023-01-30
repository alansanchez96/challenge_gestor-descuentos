<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  text-gray-800 leading-tight">
            {{ __('Descuentos') }}
        </h2>
        @if (session('success'))
            <p class="text-green-500 mt-2 font-bold">{{ session('success') }}</p>
        @endif
        <div class="flex w-full justify-between">
            <a href="{{ route('discount.create') }}">
                <button type="button"
                    class="mt-3 rounded-md py-3 px-4 bg-indigo-500 hover:bg-indigo-700 text-white border-indigo-500">
                    Nuevo Descuento
                </button>
            </a>
        </div>
    </x-slot>

    @livewire('list-discounts')

</x-app-layout>
