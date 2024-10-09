<table class="table auto-layout">
    <tbody>
        <tr>
            <td><b>Date when group created</b></td>
            <td>{{ $groupJoinDate }}</td>
        </tr>
        <tr>
            <td><b>Value of loans to group members currently outstanding</b></td>
            <td>{{ $totalLoanAmount }}</td>
        </tr>
        <tr>
            <td><b>Total loans to group members</b></td>
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
            <td><b>Number of loans currently past term</b></td>
            <td>*</td>
        </tr>
        <tr>
            <td><b>% of loans paid late</b></td>
            <td>*</td>
        </tr>
        <tr>
            <td><b>Average days late</b></td>
            <td>*</td>
        </tr>
        <tr>
            <td><b>Longest days late</b></td>
            <td>*</td>
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
