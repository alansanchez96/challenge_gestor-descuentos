<div>
    <div class="w-11/12 mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="w-full flex flex-row justify-start bg-gray-50 mb-6 rounded p-6">
            <select wire:model.defer="brandFilter"
                class="appearance-none w-1/6 bg-gray-200 border border-gray-200 text-gray-700 mx-1 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option disabled selected>Filtrar por rentadora</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            <select wire:model.defer="regionFilter"
                class="appearance-none w-1/6 bg-gray-200 border border-gray-200 text-gray-700 mx-1 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option disabled selected>Filtrar por region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
            <input placeholder="Busca por nombre" wire:model.defer="searchDiscount"
                class="appearance-none inline-block w-1/5 bg-gray-200 text-gray-700 border mx-1 border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <input placeholder="AWD/BCD" wire:model.defer="searchCode"
                class="appearance-none inline-block w-1/5 bg-gray-200 text-gray-700 border mx-1 border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <div class="flex justify-end flex-row w-1/4">
                <button type="button" wire:click.defer="search"
                    class="rounded-md py-3 px-4 bg-indigo-500 hover:bg-indigo-700 text-white border-indigo-500">
                    Buscar
                </button>
                <button type="button" wire:click="$emit('reset')"
                    class="ml-2 rounded-md py-3 px-4 bg-gray-500 hover:bg-gray-700 text-white border-indigo-500">
                    Eliminar filtros
                </button>
                <button type="button" wire:click.prevent="export"
                    class="ml-2 rounded-md py-3 px-4 bg-green-600 hover:bg-green-700 text-white border-green-500">
                    Exportar CSV
                </button>
            </div>
        </div>

        <div class="relative overflow-x-auto">
            @if ($discounts->count())
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
                                        <span
                                            class="rounded-xl py-2 px-4 bg-red-200 font-bold text-red-700">Inactivo</span>
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
                @else
                    <p class="font-semibold">No se han encontrado registros coincidentes.</p>
            @endif
            </table>
        </div>
        <div class="my-10">
            {{ $discounts->links() }}
        </div>
    </div>
</div>
