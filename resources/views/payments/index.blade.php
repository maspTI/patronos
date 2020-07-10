@extends('layouts.dashboard.index')

@section('title', '| Pagamentos')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Pagamentos</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <index-payment-component></index-payment-component>
            </div>
        </div>
    </div>
    <modal-payment></modal-payment>
</div>
@endsection
