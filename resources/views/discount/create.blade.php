<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear descuento') }}
        </h2>
    </x-slot>

    <form class="mx-auto my-10" method="post" action="{{ route('discount.store') }}">
        @csrf
        <div class="w-11/12 mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full lg:w-2/6 px-3 mb-6 lg:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Nombre del descuento
                    </label>
                    @error('discounts_name')
                        <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                    @enderror
                    <input type="text" name="discounts.name"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                <div class="w-full lg:w-1/3 px-3 mb-6 lg:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Activo
                    </label>
                    @error('discounts_active')
                        <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                    @enderror
                    <div class="relative">
                        <select name="discounts.active"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-state">
                            <option disabled selected>Selecciona una opcion</option>
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full lg:w-1/3 px-3 mb-6 lg:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Rentadora
                    </label>
                    @error('discount_brand_id')
                        <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                    @enderror
                    <div class="relative">
                        <select name="discount.brand_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option disabled selected>Selecciona una opcion</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 px-3 mb-6 lg:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Tipo de Acceso
                    </label>
                    @error('discounts_access_type_code')
                        <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                    @enderror
                    <div class="relative">
                        <select name="discounts.access_type_code"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option disabled selected>Selecciona una opcion</option>
                            @foreach ($accessTypes as $accessType)
                                <option value="{{ $accessType->code }}">{{ $accessType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">

                <div class="w-full lg:w-1/3 px-3 mb-6 lg:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Prioridad
                    </label>
                    @error('discounts_priority')
                        <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                    @enderror
                    <input type="number" name="discounts.priority" placeholder="Desde 1 a 1000..." min="1"
                        max="1000"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </div>

                <div class="w-full lg:w-1/3 px-3 mb-6 lg:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Region
                    </label>
                    @error('discounts_region_id')
                        <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                    @enderror
                    <div class="relative">
                        <select name="discounts.region_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-state">
                            <option disabled selected>Selecciona una opcion</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- Aplicacion 1 --}}
            <div class="flex flex-col xl:flex-row">
                <div class="flex flex-wrap p-5 mt-10 w-full xl:w-4/12 mb-2 border">

                    <div class="w-full px-3 mb-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Periodo de aplicacion 1
                        </label>
                        @error('from_days_1')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        @error('to_days_1')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="from_days_1"
                            class="appearance-none inline-block w-full mb-4 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Desde...">
                        <input type="number" name="to_days_1"
                            class="appearance-none inline-block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Hasta...">
                    </div>
                    <div class="w-full px-3 my-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Codigo de descuento AWD / BCD
                        </label>
                        @error('discount_code_1')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="text" name="discount_code_1"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Codigo...">
                    </div>
                    <div class="w-full px-3 my-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Porcentaje de descuento GSA
                        </label>
                        @error('discount_percent_1')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="discount_percent_1"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Porcentaje...">
                    </div>

                </div>
                {{-- Aplicacion 2 --}}
                <div class="flex flex-wrap p-5 mt-10 w-full xl:w-4/12 mb-2 border">

                    <div class="w-full px-3 mb-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Periodo de aplicacion 2
                        </label>
                        @error('from_days_2')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="from_days_2"
                            class="appearance-none inline-block w-full mb-4 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Desde...">
                        @error('to_days_2')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="to_days_2"
                            class="appearance-none inline-block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Hasta...">
                    </div>
                    <div class="w-full px-3 my-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Codigo de descuento AWD / BCD
                        </label>
                        @error('discount_code_2')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="text" name="discount_code_2"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Codigo...">
                    </div>
                    <div class="w-full px-3 my-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Porcentaje de descuento GSA
                        </label>
                        @error('discount_percent_2')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="discount_percent_2"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Porcentaje...">
                    </div>

                </div>
                {{-- Aplicacion 3 --}}
                <div class="flex flex-wrap p-5 mt-10 w-full xl:w-4/12 mb-2 border">

                    <div class="w-full px-3 mb-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Periodo de aplicacion 3
                        </label>
                        @error('from_days_3')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="from_days_3"
                            class="appearance-none inline-block w-full mb-4 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Desde...">
                        @error('to_days_3')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="to_days_3"
                            class="appearance-none inline-block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Hasta...">
                    </div>
                    <div class="w-full px-3 my-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Codigo de descuento AWD / BCD
                        </label>
                        @error('discount_code_3')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="text" name="discount_code_3"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Codigo...">
                    </div>
                    <div class="w-full px-3 my-6 xl:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Porcentaje de descuento GSA
                        </label>
                        @error('discount_percent_3')
                            <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                        @enderror
                        <input type="number" name="discount_percent_3"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Porcentaje...">
                    </div>

                </div>
            </div>

            <div class="flex flex-wrap p-5 mt-10 w-full mb-2 border">

                <div class="w-full px-3 mb-6 lg:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Periodo de aplicacion
                    </label>

                    @error('start_date')
                        <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                    @enderror
                    @error('end_date')
                        <p class="text-red-700 mb-2"><i>{{ $message }}</i></p>
                    @enderror

                    <div date-rangepicker datepicker-format="yyyy-mm-dd" class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input name="start_date" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                placeholder="Fecha de inicio">
                        </div>
                        <span class="mx-4 text-gray-500">a</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input name="end_date" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                placeholder="Fecha de fin">
                        </div>
                    </div>

                </div>
            </div>


            <div class="inline-block p-5 mt-5 mb-2">
                <button type="submit"
                    class="py-2 px-4 bg-indigo-500 hover:bg-indigo-700 rounded text-white">Guardar</button>
            </div>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>

</x-app-layout>
