<table>
    <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Phone') }}</th>
            <th>{{ __('Card') }}</th>
            <th>{{ __('Months pending') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('First overdue installment') }}</th>
            <th>{{ __('Date of last card update') }}</th>
            <th>{{ __('Had investment') }}</th>
            <th>{{ __('Total Invested Amount') }}</th>
            <th>{{ __('Date of Last Investment') }}</th>
            <th>{{ __('Term of Last Investment') }}</th>
            <th>{{ __('Saldo total') }}</th>
            <th>{{ __('Saldo Tarjeta') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($request as $reques)
            <tr>
                <td class="text-xs font-semibold">
                    {{ $reques->provider }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
