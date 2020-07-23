<div class="container-fluid mt-3">
    <div class="row border">
        <div class="col-md-12"><h4>Pagamentos</h4></div>
        @foreach($sponsor->payments as $payment)
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <span class="text-capitalize mx-2">Categoria: {{ $payment->category->name }}</span>
            <span class="text-capitalize mx-2">Primeiro Vencimento: {{ $payment->due_date->format('d/m/Y') }}</span>
            <span class="text-capitalize mx-2">Valor Total: R${{ number_format($payment->value, 2, ',', '.') }}</span>
            {{-- <span class="text-capitalize mx-2">Valor Pago: R${{ number_format($paidValue, 2, ',', '.') }}</span> --}}
        </div>
        @endforeach
    </div>
</div>
