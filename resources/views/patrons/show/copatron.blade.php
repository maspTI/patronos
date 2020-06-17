<div class="row mt-3">
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="row border">
                <div class="col-md-12">
                    <h4>Co-Titular</h4>
                </div>
                <div class="col-md-12 d-flex flex-wrap justify-content-center align-itens-center mt-2">
                    <span class="text-capitalize mx-2">Nome: {{ $patron->copatron->name }}</span>
                    <span class="text-capitalize mx-2">Aniversário: {{ $patron->copatron->birthday->format('d/m') }}</span>
                    <span class="text-capitalize mx-2">
                        Email:&nbsp;
                        <a class="text-muted text-lowercase" href="mailto:{{ $patron->copatron->email }}">{{ $patron->copatron->email }}</a>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
