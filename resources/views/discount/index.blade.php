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

    <div class="w-11/12 mx-auto py-6 px-4 sm:px-6 lg:px-8">


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Rentadora
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Region
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Tipo de acceso
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Periodo
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            AWD/BCD
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Descuento GSA
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Periodo de promocion
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Prioridad
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($discounts as $discount)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $discount->brand->name }}
                            </th>
                            <td class="px-3 py-4 text-center whitespace-nowrap">
                                {{ $discount->region->name }}
                            </td>
                            <td class="px-3 py-4 text-center whitespace-nowrap">
                                {{ $discount->name }}
                            </td>
                            <td class="px-3 py-4 text-center whitespace-nowrap">
                                {{ $discount->accessType->name }}
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                @if ($discount->active === '1')
                                    <span
                                        class="rounded-xl py-2 px-4 bg-emerald-200 font-bold text-emerald-700">Activo</span>
                                @else
                                    <span class="rounded-xl py-2 px-4 bg-red-200 font-bold text-red-700">Inactivo</span>
                                @endif
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                @foreach ($discount->discountsRanges as $discountRange)
                                    <p class="font-semibold">
                                        {{ $discountRange->from_days }} - {{ $discountRange->to_days }}
                                    </p>
                                @endforeach
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                @foreach ($discount->discountsRanges as $discountRange)
                                    @if (!$discountRange->code)
                                        <p class="font-bold">--</p>
                                    @else
                                        <p class="font-semibold"> {{ $discountRange->code }}</p>
                                    @endif
                                @endforeach
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                @foreach ($discount->discountsRanges as $discountRange)
                                    @if (!$discountRange->discount)
                                        <p class="font-bold">--</p>
                                    @else
                                        <p class="font-semibold"> {{ $discountRange->discount }}%</p>
                                    @endif
                                @endforeach
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                <p>
                                    <span
                                        class="font-semibold">{{ date('d M Y', strtotime($discount->start_date)) }}</span>
                                    / <span
                                        class="font-semibold">{{ date('d M Y', strtotime($discount->end_date)) }}</span>
                                </p>
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                <p class="font-semibold">{{ $discount->priority }}</p>
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                <button type="button"
                                    class="mr-auto rounded-md py-3 px-4 bg-indigo-500 hover:bg-indigo-700 text-white border-indigo-500">
                                    <a href="#">Editar</a>
                                </button>
                                <button type="button"
                                    class="mr-auto rounded-md py-3 px-4 bg-red-500 hover:bg-red-700 text-white border-red-500">
                                    <a href="#">Eliminar</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <table class="table-fixed">
            <thead>
                <tr>

                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div class="my-10">
            {{ $discounts->links() }}
        </div>
    </div>


</x-app-layout>
