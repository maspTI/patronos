@extends('layouts.dashboard.index')

@section('title', '| Pessoa Jurídica')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Pessoa Jurídica</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <index-sponsor-component></index-sponsor-component>
            </div>
        </div>
    </div>
    <modal-sponsor></modal-sponsor>
</div>
@endsection
