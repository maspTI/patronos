<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    <label for="">Nome</label>
                    <input
                        type="text"
                        name="address-name"
                        id="address-name"
                        class="form-control"
                        v-model="form.name"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="address-zip_code">País</label>
                    <multiselect
                        track-by="name"
                        label="name"
                        :options="countries"
                        placeholder="Selecione o país"
                        selectLabel=""
                        deselectLabel=""
                        selectedLabel="Selecionado"
                        v-model="form.country"
                    >
                        <template slot="singleLabel" slot-scope="props">
                            <img
                                class="flag"
                                :src="props.option.flag"
                                :alt="props.option.name"
                            />
                            <span v-text="`${props.option.name}`"></span>
                        </template>
                        <template slot="option" slot-scope="props">
                            <img class="flag" :src="props.option.flag" />
                            <span v-text="`${props.option.name}`"></span>
                        </template>
                    </multiselect>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    <label for="address-zip_code">CEP</label>
                    <input
                        type="text"
                        name="address-zip_code"
                        id="address-zip_code"
                        class="form-control"
                        v-model="form.zip_code"
                        @blur="getAddress"
                    />
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group bmd-form-group">
                    <label for="address-street">Rua</label>
                    <input
                        type="text"
                        name="address-street"
                        id="address-street"
                        class="form-control"
                        v-model="form.street"
                    />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    <label for="address-number">Número</label>
                    <input
                        type="text"
                        name="address-number"
                        id="address-number"
                        class="form-control"
                        v-model="form.number"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group bmd-form-group">
                    <label for="address-neighborhood">Bairro</label>
                    <input
                        type="text"
                        name="address-neighborhood"
                        id="address-neighborhood"
                        class="form-control"
                        v-model="form.neighborhood"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group bmd-form-group">
                    <label for="address-additional_info">Complemento</label>
                    <input
                        type="text"
                        name="address-additional_info"
                        id="address-additional_info"
                        class="form-control"
                        v-model="form.additional_info"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group bmd-form-group">
                    <label for="address-city">Cidade</label>
                    <input
                        type="text"
                        name="address-city"
                        id="address-city"
                        class="form-control"
                        v-model="form.city"
                    />
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group bmd-form-group">
                    <label for="address-state">Estado</label>
                    <input
                        type="text"
                        name="address-state"
                        id="address-state"
                        class="form-control"
                        v-model="form.state"
                    />
                </div>
            </div>
            <add-remove-buttons
                :data="form"
                :editFromComponent="edit"
                event="remove-address"
            />
        </div>
    </div>
</template>
<script>
export default {
    props: ["address"],
    data() {
        return {
            form: this.address,
            countries: [],
            edit: true,
        };
    },
    methods: {
        getCountries() {
            window.axios
                .get("https://restcountries.eu/rest/v2/all")
                .then((result) => {
                    result.data.forEach((country) => {
                        this.countries.push({
                            name: country.translations.br,
                            flag: country.flag,
                            callingCode: country.callingCodes[0],
                        });
                        if (this.address.name == "") {
                            if (country.translations.br == "Brasil") {
                                this.form.country = {
                                    name: country.translations.br,
                                    flag: country.flag,
                                    callingCode: country.callingCodes[0],
                                };
                                this.form.phone = this.form.country.callingCode;
                            }
                        }
                    });
                })
                .catch((errors) => console.error(errors));
        },
        getAddress() {
            if (this.form.country.name == "Brasil") {
                window.axios
                    .get(`https://viacep.com.br/ws/${this.form.zip_code}/json/`)
                    .then((result) => {
                        this.form.zip_code = result.data.cep;
                        this.form.street = result.data.logradouro;
                        this.form.additional_info = result.data.complemento;
                        this.form.neighborhood = result.data.bairro;
                        this.form.city = result.data.localidade;
                        this.form.state = result.data.uf;
                    })
                    .catch((errors) => {
                        console.error(errors);
                        window.flash("CEP não encontrado", "danger");
                    });
            }
            return;
        },
    },
    created() {
        this.getCountries();
    },
};
</script>
