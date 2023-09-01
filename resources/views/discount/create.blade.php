<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear descuento') }}
        </h2>
    </x-slot>

    <div class="w-11/12 mx-auto sm:px-6 lg:px-8 py-24">
        <form action="{{ route('discount.store') }}" method="post">
            @csrf
            {{-- 1er fila --}}
            <div class="flex flex-row justify-between gap-10 w-full items-center mb-6">
                <div class="flex flex-col w-full">
                    <label for="discounts.name" class="block mb-2 text-sm font-bold text-gray-900">Nombre del descuento</label>
                    <input type="text" name="discounts.name" id="discounts.name" placeholder="Nombre del descuento" value="{{ old('discounts_name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('discounts_name')
                        <p class="text-red-700 text-sm mb-2">* {{ $message }}</p>
                    @enderror    
                </div>
                <div class="flex flex-col w-full">
                    <label for="active" class="block mb-2 text-sm font-bold text-gray-900">Activo / Inactivo</label>
                    <select name="discounts.active" id="active" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                        <option disabled selected>Selecciona una opcion</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                    @error('discounts_active')
                        <p class="text-red-700 text-sm mb-2">* {{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- 2da fila --}}
            <div class="flex flex-row justify-between gap-10 w-full items-center mb-6">
                <div class="flex flex-col w-full">
                    <label for="brand_id" class="block mb-2 text-sm font-bold text-gray-900">Rentadora</label>
                    <select name="discounts.brand_id" id="brand_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                        <option disabled selected>Selecciona una opcion</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('discounts_brand_id')
                        <p class="text-red-700 text-sm mb-2">* {{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col w-full">
                    <label for="access_type_code" class="block mb-2 text-sm font-bold text-gray-900">Tipo de acceso</label>
                    <select name="discounts.access_type_code" id="access_type_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                        <option disabled selected>Selecciona una opcion</option>
                        @foreach ($accessTypes as $accessType)
                            <option value="{{ $accessType->code }}">{{ $accessType->name }}</option>
                        @endforeach
                    </select>
                    @error('discounts_access_type_code')
                        <p class="text-red-700 text-sm mb-2">* {{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- 3er fila --}}
            <div class="flex flex-row justify-between gap-10 w-full items-center mb-6">
                <div class="flex flex-col w-full">
                    <label for="discounts.priority" class="block mb-2 text-sm font-bold text-gray-900">Prioridad</label>
                    <input type="number" name="discounts.priority" placeholder="Prioridad" id="discounts.priority" value="{{ old('discounts_priority') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                    @error('discounts_priority')
                        <p class="text-red-700 text-sm mb-2">* {{ $message }}</p>
                    @enderror    
                </div>
                <div class="flex flex-col w-full">
                    <label for="region_id" class="block mb-2 text-sm font-bold text-gray-900">Region</label>
                    <select name="discounts.region_id" id="region_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                        <option disabled selected>Selecciona una opcion</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                    @error('discounts_region_id')
                        <p class="text-red-700 text-sm mb-2">* {{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 4ta fila PERIODOS --}}

            <div class="flex md:flex-row mt-12 flex-col gap-3 justify-between items-center w-full">
                {{-- 1 --}}
                <div class="flex flex-col lg:gap-3 gap-6 p-4 border w-full lg:w-1/3 border-gray-300 rounded-md">
                    <label class="block ml-2 font-bold text-sm  text-gray-900">Periodo de aplicacion 1</label>
                    <input type="number" name="from_days_1" value="{{ old('from_days_1') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Desde...">
                    <input type="number" name="to_days_1" value="{{ old('to_days_1') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Hasta...">

                    <label class="block ml-2 font-bold text-sm  text-gray-900" for="discount_code_1">Codigo de descuento AWD / BCD</label>
                    <input type="text" name="discount_code_1" value="{{ old('discount_code_1') }}" id="discount_code_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Codigo...">

                    <label class="block ml-2 font-bold text-sm  text-gray-900" for="discount_percent_1">Porcentaje de descuento GSA</label>
                    <input type="number" name="discount_percent_1" value="{{ old('discount_percent_1') }}" id="discount_percent_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Porcentaje...">
                </div>

                {{-- 2 --}}
                <div class="flex flex-col lg:gap-3 gap-6 p-4 border w-full lg:w-1/3 border-gray-300 rounded-md">
                    <label class="block ml-2 font-bold text-sm  text-gray-900">Periodo de aplicacion 2</label>
                    <input type="number" name="from_days_2" value="{{ old('from_days_2') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Desde...">
                    <input type="number" name="to_days_2" value="{{ old('to_days_2') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Hasta...">

                    <label class="block ml-2 font-bold text-sm  text-gray-900" for="discount_code_2">Codigo de descuento AWD / BCD</label>
                    <input type="text" name="discount_code_2" value="{{ old('discount_code_2') }}" id="discount_code_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Codigo...">

                    <label class="block ml-2 font-bold text-sm  text-gray-900" for="discount_percent_2">Porcentaje de descuento GSA</label>
                    <input type="number" name="discount_percent_2" value="{{ old('discount_percent_2') }}" id="discount_percent_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Porcentaje...">
                </div>

                {{-- 3 --}}
                <div class="flex flex-col lg:gap-3 gap-6 p-4 border w-full lg:w-1/3 border-gray-300 rounded-md">
                    <label class="block ml-2 font-bold text-sm  text-gray-900">Periodo de aplicacion 3</label>
                    <input type="number" name="from_days_3" value="{{ old('from_days_3') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Desde...">
                    <input type="number" name="to_days_3" value="{{ old('to_days_3') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Hasta...">

                    <label class="block ml-2 font-bold text-sm  text-gray-900" for="discount_code_3">Codigo de descuento AWD / BCD</label>
                    <input type="text" name="discount_code_3" value="{{ old('discount_code_3') }}" id="discount_code_3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Codigo...">

                    <label class="block ml-2 font-bold text-sm  text-gray-900" for="discount_percent_3">Porcentaje de descuento GSA</label>
                    <input type="number" name="discount_percent_3" value="{{ old('discount_percent_3') }}" id="discount_percent_3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Porcentaje...">
                </div>
            </div>

            {{-- Errores de 4ta Fila --}}
            @php
                $showErrorDiv = $errors->has('from_days_1') || $errors->has('to_days_1') || $errors->has('discount_percent_1') || $errors->has('discount_code_1') ||
                                $errors->has('from_days_2') || $errors->has('to_days_2') || $errors->has('discount_percent_2') || $errors->has('discount_code_2') ||
                                $errors->has('from_days_3') || $errors->has('to_days_3') || $errors->has('discount_percent_3') || $errors->has('discount_code_3') ||
                                $errors->has('failed');
            @endphp

            @if($showErrorDiv)
                
            <div class="mt-6 border border-gray-300 p-4 rounded-md">
                <h3 class="text-red-700 font-bold text-center mb-6">Periodos de aplicacion</h3>

                @error('from_days_1')           <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('to_days_1')             <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('discount_percent_1')    <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('discount_code_1')       <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                
                @error('from_days_2')           <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('to_days_2')             <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('discount_percent_2')    <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('discount_code_2')       <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                
                @error('from_days_3')           <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('to_days_3')             <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('discount_percent_3')    <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                @error('discount_code_3')       <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror
                
                @error('failed')                <label class="text-red-700 text-sm mb-2 text-center block">* {{ $message }}</label> @enderror

            </div>
            @endif

            {{-- 5ta fila --}}
            
            <div class="mt-6 border border-gray-300 p-4 rounded-md">
                <label class="block ml-2 mb-4 font-bold text-sm text-gray-900 text-center">Periodo de la aplicación</label>
                <div date-rangepicker class="flex items-center justify-center">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input name="start_date" datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 " placeholder="Fecha inicial">
                        @error('start_date')
                            <p class="text-red-700 text-sm mb-2">* {{ $message }}</p>
                        @enderror    
                    </div>
                    <span class="mx-4 text-gray-500">a</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input datepicker name="end_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 " placeholder="Fecha final">
                        @error('end_date')
                            <span class="text-red-700 text-sm mb-2">* {{ $message }}</span>
                        @enderror
                    </div>
                </div>
  
            </div>

            <div class="flex items-center justify-center mx-auto">
                <button class="rounded-md py-3 px-4 w-4/5 lg:w-2/5 my-10 bg-indigo-500 hover:bg-indigo-700 text-white border-indigo-500">
                    Guardar
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
</x-app-layout>
