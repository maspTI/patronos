@extends('layouts.dashboard.index')

@section('title', '| Editar Pessoa Jurídica')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Editar Pessoa Jurídica</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-sponsor-component
                    :categories="{{ $categories }}"
                    :projects="{{ $projects }}"
                    :sponsor="{{ $sponsor }}"
                    http_verb="put"
                    url="/sponsors/{{ $sponsor->id }}"
                    message="Pessoa Física atualizada com sucesso!"
                ></create-update-sponsor-component>
            </div>
        </div>
    </div>
</div>
@endsection
