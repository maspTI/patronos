@extends('layouts.dashboard.index')

@section('title', '| Pessoa Física')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Pessoa Física</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <index-patron-component></index-patron-component>
            </div>
        </div>
    </div>
    <modal-patron></modal-patron>
</div>
@endsection
