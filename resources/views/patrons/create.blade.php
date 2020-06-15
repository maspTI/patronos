@extends('layouts.dashboard.index')

@section('title', '| Adicionar Pessoa Física')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Adicionar Pessoa Física</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-patron-component
                    :categories="{{ $categories }}"
                    http_verb="post"
                    url="/patrons"
                    message="Pessoa Física criada com sucesso!"
                ></create-update-patron-component>
            </div>
        </div>
    </div>
</div>
@endsection
