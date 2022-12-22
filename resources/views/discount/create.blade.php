<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear descuento') }}
        </h2>
    </x-slot>

    <div class="mx-auto w-full">
        <form class="w-11/12 mx-auto my-10" method="post" action="{{ route('discount.store') }}">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-2/6 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Nombre del descuento
                    </label>
                    <input type="text" name="discounts.name"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Activo
                    </label>
                    <div class="relative">
                        <select name="discounts.active"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-state">
                            <option disabled>Selecciona una opcion</option>
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Rentadora
                    </label>
                    <div class="relative">
                        <select name="discount.brand_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option disabled>Selecciona una opcion</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Tipo de Acceso
                    </label>
                    <div class="relative">
                        <select name="discounts.access_type_code"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option disabled>Selecciona una opcion</option>
                            @foreach ($accessTypes as $accessType)
                                <option value="{{ $accessType->code }}">{{ $accessType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Prioridad
                    </label>
                    <input type="number" name="discounts.priority" placeholder="Desde 1 a 1000..." min="1"
                        max="1000"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Region
                    </label>
                    <div class="relative">
                        <select name="discounts.region_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-state">
                            <option disabled>Selecciona una opcion</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- Aplicacion 1 --}}
            <div class="flex flex-col lg:flex-row">
                <div class="flex flex-wrap p-5 mt-10 w-full lg:w-4/12 mb-2 border">

                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Periodo de aplicacion 1
                        </label>
                        @error('from_days_1')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        @error('to_days_1')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="from_days_1"
                            class="appearance-none inline-block w-2/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Desde...">
                        <input type="number" name="to_days_1"
                            class="appearance-none inline-block w-2/5 ml-8 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Hasta...">
                    </div>
                    <div class="w-full px-3 my-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Codigo de descuento AWD / BCD
                        </label>
                        @error('discount_code_1')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="text" name="discount_code_1"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Codigo...">
                    </div>
                    <div class="w-full px-3 my-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Porcentaje de descuento GSA
                        </label>
                        @error('discount_percent_1')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="discount_percent_1"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Porcentaje...">
                    </div>

                </div>
                {{-- Aplicacion 2 --}}
                <div class="flex flex-wrap p-5 mt-10 w-full lg:w-4/12 mb-2 border">

                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Periodo de aplicacion 2
                        </label>
                        @error('from_days_2')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="from_days_2"
                            class="appearance-none inline-block w-2/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Desde...">
                        @error('to_days_2')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="to_days_2"
                            class="appearance-none inline-block w-2/5 ml-8 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Hasta...">
                    </div>
                    <div class="w-full px-3 my-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Codigo de descuento AWD / BCD
                        </label>
                        @error('discount_code_2')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="text" name="discount_code_2"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Codigo...">
                    </div>
                    <div class="w-full px-3 my-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Porcentaje de descuento GSA
                        </label>
                        @error('discount_percent_2')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="discount_percent_2"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Porcentaje...">
                    </div>

                </div>
                {{-- Aplicacion 3 --}}
                <div class="flex flex-wrap p-5 mt-10 w-full lg:w-4/12 mb-2 border">

                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Periodo de aplicacion 3
                        </label>
                        @error('from_days_3')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="from_days_3"
                            class="appearance-none inline-block w-2/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Desde...">
                        @error('to_days_3')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="to_days_3"
                            class="appearance-none inline-block w-2/5 ml-8 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Hasta...">
                    </div>
                    <div class="w-full px-3 my-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Codigo de descuento AWD / BCD
                        </label>
                        @error('discount_code_3')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="text" name="discount_code_3"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Codigo...">
                    </div>
                    <div class="w-full px-3 my-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Porcentaje de descuento GSA
                        </label>
                        @error('discount_percent_3')
                            <p class="text-red-100"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="discount_percent_3"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Porcentaje...">
                    </div>

                </div>
            </div>

            <div class="flex flex-wrap p-5 mt-10 w-full mb-2 border">

                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Periodo de aplicacion
                    </label>

                    <input type="date" name="start_date">
                    <input type="date" name="end_date">
                </div>
            </div>


            <div class="inline-block p-5 mt-5 mb-2">
                <button type="submit"
                    class="py-2 px-4 bg-indigo-500 hover:bg-indigo-700 rounded text-white">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
