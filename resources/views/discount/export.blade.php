<table>
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
                <td> {{ $discount->brand->name }}</td>
                <td> {{ $discount->region->name }}</td>
                <td> {{ $discount->name }}</td>
                <td> {{ $discount->accessType->name }}</td>
                <td>
                    @if ($discount->active === '1')
                        Activo
                    @else
                        Inactivo
                    @endif
                </td>
                <td>
                    @foreach ($discount->discountsRanges as $discountRange)
                        <p class="font-semibold">
                            {{ $discountRange->from_days }} - {{ $discountRange->to_days }}
                        </p>
                    @endforeach
                </td>
                <td>
                    @foreach ($discount->discountsRanges as $discountRange)
                        @if (!$discountRange->code)
                            <p class="font-bold">--</p>
                        @else
                            <p class="font-semibold"> {{ $discountRange->code }}</p>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($discount->discountsRanges as $discountRange)
                        @if (!$discountRange->discount)
                            <p class="font-bold">--</p>
                        @else
                            <p class="font-semibold"> {{ $discountRange->discount }}%</p>
                        @endif
                    @endforeach
                </td>
                <td>
                    <p>
                        <span class="font-semibold">{{ date('d M Y', strtotime($discount->start_date)) }}</span>
                        / <span class="font-semibold">{{ date('d M Y', strtotime($discount->end_date)) }}</span>
                    </p>
                </td>
                <td> {{ $discount->priority }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
