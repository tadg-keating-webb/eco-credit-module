<div>
    <div class="d-flex flex-row justify-content-between">
        <p>
            <b>
                Saving Record<br>
                Balance: {{ $balance }}
            </b>
        </p>
        <p>&nbsp;</p>
        <div>
            <div>
                <a href="javascript:void(0)"
                    onclick="Livewire.dispatch('openModal', {component: 'transaction-modal', arguments: {'userId': '{{ $userId }}', 'type': 'saving' }})"
                    class="btn btn-primary">
                    Create Record
                </a>
            </div>
        </div>
    </div>
    <div>
        @php
            $savings = $transactions;
        @endphp

        @if (!$savings->isEmpty())
            <table class="table">
                <tr>
                    <th>Date</th>
                    <th>Deposit</th>
                    <th>Withdrawal</th>
                    <th>Balance</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                    @php
                        $currentBalance = $balance;
                    @endphp

                    @foreach ($savings as $saving)
                        <tr wire:key="{{ $saving->id }}">
                            <td>
                                {{ $saving->date }}</td>
                            <td>
                                {!! $saving->type === 'deposit' ? $saving->amount . '<b>(' . ucfirst($saving->type[0]) . ')</b>' : '' !!}
                            </td>
                            <td>
                                {!! $saving->type === 'withdrawal' ? $saving->amount . '<b>(' . ucfirst($saving->type[0]) . ')</b>' : '' !!}
                            </td>
                            <td>
                                @if ($loop->first)
                                    {{ $currentBalance }}
                                @else
                                    {{ $currentBalance += $savings[$loop->index - 1]->type === 'deposit' ? -$savings[$loop->index - 1]->amount : $savings[$loop->index - 1]->amount }}
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0)" role="button"
                                        id="dropdownMenuLink{{ $saving->id }}" data-dropdown-menu aria-haspopup="true"
                                        aria-expanded="false" style="z-index: 10;">
                                        <span>
                                            <img src="{{ asset('/images/system/overflow-icon.svg') }}" />
                                        </span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $saving->id }}">
                                        <a class="dropdown-item" href="javascript:void(0)"
                                            onclick="Livewire.dispatch('openModal', {component: 'delete-transaction-modal',arguments: {'transaction': '{{ $saving->id }}' }})">
                                            Delete
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)"
                                            onclick="Livewire.dispatch('openModal', {component: 'transaction-modal',  arguments: {'type': 'saving', 'transaction': '{{ $saving->id }}', 'userId': '{{ $userId }}' }})">
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
            <p>No saving records found</p>
        @endif
    </div>
</div>
