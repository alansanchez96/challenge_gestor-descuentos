<div>
    <div class="w-11/12 mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="w-full flex flex-col justify-start gap-3 border border-b-0 border-t-0 border-gray-300 mb-6 rounded-md p-6">
            <div class="w-full flex flex-row gap-3">
                <select wire:model.defer="brandFilter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                    <option disabled selected>Filtrar por rentadora</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <select wire:model.defer="regionFilter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                    <option disabled selected>Filtrar por region</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full flex flex-row gap-3">
                <input placeholder="Busca por nombre" wire:model.defer="searchDiscount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                <input placeholder="AWD/BCD" wire:model.defer="searchCode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">    
            </div>
        </div>
        <div class="flex justify-end flex-row w-full mb-6 gap-3">
            <button type="button" wire:click.defer="search" class="rounded-md py-2 shadow-md px-6 bg-indigo-500 hover:bg-indigo-700 text-white border-indigo-500">
                Buscar
            </button>
            <button type="button" wire:click="$emit('reset')" class="rounded-md py-2 shadow-md px-6 bg-gray-500 hover:bg-gray-700 text-white border-indigo-500">
                Eliminar filtros
            </button>
            <button type="button" wire:click.prevent="export" class="rounded-md py-2 shadow-md px-6 bg-green-600 hover:bg-green-700 text-white border-green-500">
                Exportar CSV
            </button>
        </div>

        <div class="relative overflow-x-auto">
            @if ($discounts->count())
                <table class="w-full text-sm text-left text-gray-500 shadow-xl">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Rentadora</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Region</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Tipo de acceso</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Estado</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Periodo</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">AWD/BCD</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Descuento GSA</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Periodo de promocion</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Prioridad</th>
                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Acciones</th>
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
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                    @if ($discount->active === '1')
                                        <span class="rounded-xl py-2 px-4 bg-emerald-200 font-bold text-emerald-700">Activo</span>
                                    @else
                                        <span class="rounded-xl py-2 px-4 bg-red-200 font-bold text-red-700">Inactivo</span>
                                    @endif
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                    @foreach ($discount->discountsRanges as $discountRange)
                                        <p class="font-semibold">
                                            {{ $discountRange->period_formated }}
                                        </p>
                                    @endforeach
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                    @foreach ($discount->discountsRanges as $discountRange)
                                        <p class="font-semibold"> {{ $discountRange->code_formated }}</p>
                                    @endforeach
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                    @foreach ($discount->discountsRanges as $discountRange)
                                        <p class="font-semibold"> {{ $discountRange->discount_percentage_formated }}</p>
                                    @endforeach
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                    <p>
                                        <span class="font-semibold">{{ $discount->start_date_formated }}</span> / <span class="font-semibold">{{ $discount->end_date_formated }}</span>
                                    </p>
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                    <p class="font-semibold">{{ $discount->priority }}</p>
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap mx-auto text-center">
                                    <form method="post" class="inline" action="{{ route('discount.destroy', $discount) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')" class="mr-auto rounded-md py-2 px-6 bg-red-500 hover:bg-red-700 text-white border-red-500">
                                            Eliminar
                                        </button>
                                    </form>
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
