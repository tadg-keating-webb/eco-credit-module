<div>
    <div class="d-flex flex-row justify-content-between">
        <p>
            <b>
                Loan Record <br>
                Balance: {{ $balance }}
            </b>
        </p>
        <p>&nbsp;</p>
        <div>
            <div>
                <a href="javascript:void(0)"
                    onclick="Livewire.dispatch('openModal', {component: 'transaction-modal', arguments: {'userId': '{{ $userId }}', 'type': 'loan' }})"
                    class="btn btn-primary">
                    Create Record
                </a>
            </div>
        </div>
    </div>
    <div>
        @php
            $loans = $transactions;
        @endphp
        @if (!$loans->isEmpty())
            <table class="table">
                <tr>
                    <th>Date</th>
                    <th>Loan/Fee</th>
                    <th>Repayment</th>
                    <th>Balance</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                    @php
                        $currentBalance = $balance;
                    @endphp

                    @foreach ($loans as $loan)
                        <tr wire:key="{{ $loan->id }}">
                            <td>
                                {{ $loan->date }}</td>
                            <td>
                                {!! $loan->type !== 'repay' ? $loan->amount . '<b>(' . ucfirst($loan->type[0]) . ')</b>' : '' !!}
                            </td>
                            <td>
                                {!! $loan->type === 'repay' ? $loan->amount . '<b>(' . ucfirst($loan->type[0]) . ')</b>' : '' !!}
                            </td>
                            <td>
                                @if ($loop->first)
                                    {{ $currentBalance }}
                                @else
                                    {{ $currentBalance += $loans[$loop->index - 1]->type === 'repay' ? -$loans[$loop->index - 1]->amount : $loans[$loop->index - 1]->amount }}
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0)" role="button"
                                        id="dropdownMenuLink{{ $loan->id }}" data-dropdown-menu aria-haspopup="true"
                                        aria-expanded="false" style="z-index: 10;">
                                        <span>
                                            <img src="{{ asset('/images/system/overflow-icon.svg') }}" />
                                        </span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $loan->id }}">
                                        <a class="dropdown-item" href="javascript:void(0)"
                                            onclick="Livewire.dispatch('openModal', {component: 'delete-transaction-modal',arguments: {'transaction': '{{ $loan->id }}' }})">
                                            Delete
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)"
                                            onclick="Livewire.dispatch('openModal', {component: 'transaction-modal',  arguments: {'type': 'loan', 'transaction': '{{ $loan->id }}', 'userId': '{{ $userId }}' }})">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No loan records found</p>
        @endif
    </div>
</div>
