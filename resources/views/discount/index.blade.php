<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between w-full mx-auto">
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">
                {{ __('Descuentos') }}
            </h2>
            <div>
                <a href="{{ route('discount.create') }}">
                    <button type="button" class="rounded-md py-3 px-4 bg-indigo-500 hover:bg-indigo-700 text-white border-indigo-500">
                        Agregar descuento
                    </button>
                </a>
            </div>
        </div>

        @if (session('success'))
            <p class="text-green-500 mt-2 font-bold">{{ session('success') }}</p>
        @elseif(session('delete'))
            <p class="text-red-700 mt-2 font-bold">{{ session('delete') }}</p>
        @endif
    </x-slot>

    @livewire('list-discounts')

</x-app-layout>
