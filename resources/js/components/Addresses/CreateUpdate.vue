<template>
    <div class="container-fluid">
        <div class="row" v-if="edit">
            <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    <label for="">Nome*</label>
                    <input
                        type="text"
                        name="address-name"
                        id="address-name"
                        class="form-control text-capitalize"
                        v-model="form.name"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="address-zip_code">País*</label>
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
                    <label for="address-zip_code">CEP*</label>
                    <input
                        type="text"
                        name="address-zip_code"
                        id="address-zip_code"
                        class="form-control text-capitalize"
                        v-model="form.zip_code"
                        @blur="getAddress"
                    />
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group bmd-form-group">
                    <label for="address-street">Rua*</label>
                    <input
                        type="text"
                        name="address-street"
                        id="address-street"
                        class="form-control text-capitalize"
                        v-model="form.street"
                    />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    <label for="address-number">Número*</label>
                    <input
                        type="text"
                        name="address-number"
                        id="address-number"
                        class="form-control text-capitalize"
                        v-model="form.number"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group bmd-form-group">
                    <label for="address-neighborhood">Bairro*</label>
                    <input
                        type="text"
                        name="address-neighborhood"
                        id="address-neighborhood"
                        class="form-control text-capitalize"
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
                        class="form-control text-capitalize"
                        v-model="form.additional_info"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group bmd-form-group">
                    <label for="address-city">Cidade*</label>
                    <input
                        type="text"
                        name="address-city"
                        id="address-city"
                        class="form-control text-capitalize"
                        v-model="form.city"
                    />
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group bmd-form-group">
                    <label for="address-state">Estado*</label>
                    <input
                        type="text"
                        name="address-state"
                        id="address-state"
                        class="form-control text-uppercase"
                        v-model="form.state"
                    />
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div
                class="col-md-12 d-flex justify-content-around align-itens-center border"
            >
                <span
                    class="text-capitalize"
                    v-text="`Tipo: ${form.name}`"
                ></span>
                <span
                    class="text-capitalize"
                    v-text="`País: ${form.country.name}`"
                ></span>
                <span
                    class="text-capitalize"
                    v-text="`CEP: ${form.zip_code}`"
                ></span>
                <span
                    class="text-capitalize"
                    v-text="`Logradouro: ${form.street}`"
                ></span>
                <span
                    class="text-capitalize"
                    v-text="`Número: ${form.number}`"
                ></span>
                <span
                    class="text-capitalize"
                    v-text="`Bairro: ${form.neighborhood}`"
                ></span>
                <span
                    class="text-capitalize"
                    v-text="`Complemento: ${form.additional_info}`"
                ></span>
                <span
                    class="text-capitalize"
                    v-text="`Cidade: ${form.city}`"
                ></span>
                <span
                    class="text-capitalize"
                    v-html="
                        `Estado: <span class='text-uppercase'>${form.state}</span>`
                    "
                ></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button
                    type="button"
                    class="btn"
                    :class="`${edit ? 'btn-success' : 'btn-warning'}`"
                    @click.prevent="add"
                >
                    <i class="fas fa-plus" v-if="edit"></i>
                    <i class="far fa-edit" v-else></i>
                </button>
                <button
                    type="button"
                    class="btn btn-danger"
                    @click.prevent="remove"
                >
                    <i class="fas fa-minus"></i>
                </button>
            </div>
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
        add() {
            if (
                this.form.name != "" &&
                this.form.zip_code != "" &&
                this.form.street != "" &&
                this.form.number != "" &&
                this.form.neighborhood != "" &&
                this.form.city != "" &&
                this.form.state != ""
            ) {
                if (this.edit) {
                    this.form.name = this.form.name.toLowerCase();
                    this.form.zip_code = this.form.zip_code.toLowerCase();
                    this.form.street = this.form.street.toLowerCase();
                    this.form.number = this.form.number.toLowerCase();
                    this.form.neighborhood = this.form.neighborhood.toLowerCase();
                    this.form.additional_info = this.form.additional_info.toLowerCase();
                    this.form.city = this.form.city.toLowerCase();
                    this.form.state = this.form.state.toLowerCase();
                }
                this.edit = !this.edit;
                return;
            }
            window.flash("Preencha os campos para adicionar.", "danger");
        },
        remove() {
            window.events.$emit("remove-address", this.form);
        },
    },
    created() {
        this.getCountries();
        this.edit = this.form.name != "" ? false : true;
    },
};
</script>
