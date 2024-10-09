<table class="table auto-layout px-2">
    <tbody>
        <tr>
            <td><b>Date when joined</b></td>
            <td>{{ $joinDate }}</td>
        </tr>
        <tr>
        </tr>

        <tr>
            <td><b>Current loan size</b></td>
            <td>{{ $currentLoanSize < 0 ? $currentLoanSize : 0 }}</td>
        </tr>

        <tr>
            <td><b>Open loan at present</b></td>
            <td>{{ $openLoanAtPresent ? 'Yes' : 'No' }}</td>
        </tr>

        <tr>
            <td><b>Amount currently outstanding</b></td>
            <td>{{ $currentLoanSize < 0 ? $currentLoanSize : 0 }}</td>
        </tr>

        <tr>
            <td><b>Number of loans issued to group member</b></td>
            <td>{{ $amountOfLoansIssued }}</td>
        </tr>

        <tr>
            <td><b>Total amount loaned</b></td>
            <td>{{ $totalLoanAmount }}</td>
        </tr>

        <tr>
            <td><b>Total form fees</b></td>
            <td>{{ $totalFeeAmount }}</td>
        </tr>

        <tr>
            <td><b>Total interest</b></td>
            <td>{{ $totalInterestAmount }}</td>
        </tr>

        <tr>

            <td><b>The current loan past term</b></td>
            <td>
                *
            </td>
        </tr>
        <tr>
            <td><b>Days late</b></td>
            <td>*</td>
        </tr>

        <tr>
            <td><b>In default</b></td>
            <td>
                *
            </td>
        </tr>

        <tr>
            <td><b>% of loans paid late</b></td>
            <td>

                * </td>
        </tr>

        <tr>
            <td><b>Average days late</b></td>
            <td>
                *
            </td>
        </tr>

        <tr>
            <td><b>Longest days late</b></td>
            <td>
                *
            </td>
        </tr>

        <tr>
            <td><b>Total penalties paid</b></td>
            <td>{{ $totalPenaltyAmount }}</td>
        </tr>
        <tr>
            <td></td>
            <td><b>* not yet active.</b></td>
        </tr>
    </tbody>
</table>
