<div class="row mt-3">
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="row border">
                <div class="col-md-12">
                    <div class="h4">Endereço(s)</div>
                </div>
                @foreach($sponsor->addresses as $address)
                <div class="col-md-12 d-flex flex-wrap justify-content-around align-itens-center border mt-2">
                    <span class="text-capitalize mx-2">Tipo: {{ $address['name'] }}</span>
                    <span class="text-capitalize mx-2">País: {{ $address['country']['name'] }}</span>
                    <span class="text-capitalize mx-2">CEP: {{ $address['zip_code'] }}</span>
                    <span class="text-capitalize mx-2">Logradouro: {{ $address['street'] }}</span>
                    <span class="text-capitalize mx-2">Número: {{ $address['number'] }}</span>
                    <span class="text-capitalize mx-2">Bairro: {{ $address['neighborhood'] }}</span>
                    <span class="text-capitalize mx-2">Complemento: {{ $address['additional_info'] }}</span>
                    <span class="text-capitalize mx-2">Cidade: {{ $address['city']}}</span>
                    <span class="text-capitalize mx-2">
                        Estado:&nbsp;
                        <span class='text-uppercase'>{{ $address['state'] }}</span>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
