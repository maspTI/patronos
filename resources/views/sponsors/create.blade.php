@extends('layouts.dashboard.index')

@section('title', '| Adicionar Pessoa Jurídica')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Adicionar Pessoa Jurídica</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-sponsor-component
                    :categories="{{ $categories }}"
                    :projects="{{ $projects }}"
                    http_verb="post"
                    url="/sponsors"
                    message="Pessoa Jurídica criada com sucesso!"
                ></create-update-sponsor-component>
            </div>
        </div>
    </div>
</div>
@endsection
