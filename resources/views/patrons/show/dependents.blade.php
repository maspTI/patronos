<div class="row mt-3">
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="row border">
                <div class="col-md-12">
                    <h4>Dependente(s)</h4>
                </div>
                @foreach($patron->dependents as $dependent)
                <div class="col-md-12 d-flex flex-wrap justify-content-center align-itens-center border mt-2">
                    <span class="text-capitalize mx-2">Nome: {{ $dependent['name'] }}</span>
                    <span class="text-capitalize mx-2">
                        Email:&nbsp;
                        <a class="text-muted text-lowercase" href="mailto:{{ $dependent['content'] }}">{{ $dependent['content'] }}</a>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
