<table>
    <tbody>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Via</th>
            <th>Paypal ID / Proff</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        @foreach ($payments as $payment)
            <tr>
                <td>{{$payment->id}}</td>
                <td>{{$payment->teacher->user->name}}</td>
                @if ($payment->type == "Bank Transfer")
                    <td><i class="fas fa-university"></i> Bank</td>
                @else
                    <td><i class="fab fa-paypal"></i> Paypal</td>
                @endif
                @if ($payment->type == "Bank Transfer")
                    <td>{{asset('storage/proffs') . "/" . $payment->proff}}</td>
                @else
                    <td>{{$payment->proff}}</td>
                @endif
                <td>${{$payment->amount}}</td>
                <td>{{$payment->created_at->format("d M, Y")}}</td>
            </tr>
        @endforeach

    </tbody>
</table>