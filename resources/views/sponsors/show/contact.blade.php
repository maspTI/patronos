<div class="row mt-3">
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="row border">
                <div class="col-md-12">
                    <h4>Contato</h4>
                </div>
                @foreach($sponsor->people_to_contact as $person)
                <div class="col-md-12 d-flex flex-wrap justify-content-center align-itens-center border mt-2">
                    <span class="text-capitalize mx-2">Nome: {{ $person['name'] }}</span>
                    <div class="container-fluid">
                        <div class="row">
                            @if(count($person['emails']))
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <h6 class="text-center">Email(s):</h6>
                                </div>
                                <div class="col-md-12 d-flex flex-wrap justify-content-center align-itens-center">
                                    @foreach($person['emails'] as $email)
                                    <span class="text-capitalize mr-1">
                                        {{ $email['name'] }}:&nbsp;<a class="text-muted text-lowercase mx-1" href="mailto:{{ $email['content'] }}">{{ $email['content'] }}</a>
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if(count($person['phones']))
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <h6 class="text-center">Telefone(s):</h6>
                                </div>
                                <div class="col-md-12 d-flex flex-wrap justify-content-center align-itens-center">
                                    @foreach($person['phones'] as $phone)
                                    <span class="text-capitalize mr-1">
                                        {{ $phone['name'] }}:&nbsp;<a class="text-muted text-lowercase mx-1" href="tel:{{ $phone['phone'] }}">{{ $phone['phone'] }}</a>
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
