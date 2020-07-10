@extends('layouts.dashboard.index')

@section('title', '| Editar Pessoa Física')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Editar Pessoa Física</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-patron-component
                    :categories="{{ $categories }}"
                    :patron="{{ $patron }}"
                    http_verb="put"
                    url="/patrons/{{ $patron->id }}"
                    message="Pessoa Física atualizada com sucesso!"
                ></create-update-patron-component>
            </div>
        </div>
    </div>
</div>
@endsection
