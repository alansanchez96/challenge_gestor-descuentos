<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Descuentos') }}
        </h2>
        <button type="button"
            class="mr-auto mt-3 rounded-md py-3 px-4 bg-indigo-500 hover:bg-indigo-700 text-white border-indigo-500">
            <a href="{{ route('discount.create') }}">Nuevo Descuento</a>
        </button>
    </x-slot>

    <div class="container mx-auto p-10 my-5 rounded">

        <table class="table-fixed">
            <thead>
                <tr>
                    <th>Rentadora</th>
                    <th>Region</th>
                    <th>Nombre</th>
                    <th>Tipo de acceso</th>
                    <th>Estado</th>
                    <th>Periodo</th>
                    <th>AWD/BCD</th>
                    <th>Descuento GSA</th>
                    <th>Periodo de promocion</th>
                    <th>Prioridad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ $discount->brand->name }}</td>
                        <td>{{ $discount->region->name }}</td>
                        <td>{{ $discount->name }}</td>
                        <td>{{ $discount->accessType->name }}</td>
                        <td>{{ $discount->active ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $discounts->links() }}

</x-app-layout>
