<div class="row mt-3">
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="row border">
                <div class="col-md-12">
                    <h4>Responsável Legal</h4>
                </div>
                <div class="col-md-12 d-flex flex-wrap justify-content-center align-itens-center mt-2">
                    <span class="text-capitalize mx-2">Nome: {{ $sponsor->proxy['name'] }}</span>
                    <span class="text-capitalize mx-2">
                        Email:&nbsp;
                        <a class="text-muted text-lowercase" href="mailto:{{ $sponsor->proxy['email'] }}">{{ $sponsor->proxy['email'] }}</a>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
