<template>
    <div class="form-row d-fle align-items-center">
        <div class="col-md-6">
            <multiselect
                track-by="name"
                label="name"
                :options="countries"
                placeholder="Selecione o país"
                selectLabel=""
                deselectLabel=""
                selectedLabel="Selecionado"
                v-model="country"
                @select="setCountry"
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Telefone</label>
                <the-mask
                    type="text"
                    name="phone"
                    :mask="mask"
                    id="phone"
                    class="form-control"
                    required
                    v-model="phone"
                />
            </div>
        </div>
    </div>
</template>
<script>
import Multiselect from "vue-multiselect";
import { TheMask } from "vue-the-mask";
export default {
    components: {
        Multiselect,
        TheMask,
    },
    data() {
        return {
            country: "",
            phone: "",
            countries: [],
            mask: [
                "+## (##) #####-####",
                "+## (##) ####-####",
                "+# (###) ###-####",
                "+### (##) ###-####",
            ],
        };
    },
    methods: {
        getCountries() {
            axios
                .get("https://restcountries.eu/rest/v2/all")
                .then((result) => {
                    result.data.forEach((country) => {
                        this.countries.push({
                            name: country.translations.br,
                            flag: country.flag,
                            callingCode: country.callingCodes[0],
                        });
                    });
                })
                .catch((errors) => console.log(errors));
        },
        setCountry(selectedOption, id) {
            this.phone = selectedOption.callingCode;
            document.querySelector("#phone").focus();
        },
    },
    created() {
        this.getCountries();
    },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.flag {
    height: 1rem;
    border-radius: 0;
    border: 1px solid #cecece;
    padding: 0.05rem;
}
</style>
