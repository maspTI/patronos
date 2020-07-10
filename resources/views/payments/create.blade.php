@extends('layouts.dashboard.index')

@section('title', '| Adicionar Pagamento')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title text-capitalize">Adicionar Pagamento para {{ $person->name ?? $person->nome_fantasia }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Dados</h4>
            </div>
            @if($person->cpf != null)
            <x-payment-patron-data :person="$person" />
            @else
            <x-payment-sponsor-data :person="$person" />
            @endif
            <div class="col-md-12">
                <create-update-payment-component
                    :categories="{{ $categories }}"
                    :person="{{ $person }}"
                    http_verb="post"
                    url="/payments"
                    message="Pagamento criado com sucesso!"
                ></create-update-payment-component>
            </div>
        </div>
    </div>
</div>
@endsection
