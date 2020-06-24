<template>
    <div
        class="modal fade"
        id="view_patron"
        tabindex="-1"
        role="dialog"
        aria-labelledby="view_patron"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" v-if="patron.hasOwnProperty('id')">
                <div class="modal-header">
                    <h5
                        class="modal-title text-capitalize"
                        id="view_patron"
                        v-text="`${patron.name}`"
                    ></h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        id="close-add-pattern"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="container-fluid">
                                    <div class="row border">
                                        <div class="col-md-12">
                                            <h4>Email(s)</h4>
                                        </div>
                                        <div
                                            class="col-md-12 d-flex justify-content-around align-items-center flex-wrap"
                                        >
                                            <span
                                                class="text-capitalize"
                                                v-for="email in patron.emails"
                                                :key="email.id"
                                                >{{ email.name }}:&nbsp;<a
                                                    :href="
                                                        `mailto:${email.content}`
                                                    "
                                                    class="text-lowercase text-muted"
                                                    v-text="email.content"
                                                ></a
                                            ></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="container-fluid">
                                    <div class="row border">
                                        <div class="col-md-12">
                                            <h4>Telefones</h4>
                                        </div>
                                        <div
                                            class="col-md-12 d-flex justify-content-around align-items-center flex-wrap"
                                        >
                                            <span
                                                class="text-capitalize d-flex align-items-center"
                                                v-for="phone in patron.phones"
                                                :key="phone.id"
                                                >{{ phone.name }}:&nbsp;
                                                <img
                                                    class="flag"
                                                    :src="phone.country.flag"
                                                    alt="Bandeira do país"/><a
                                                    :href="
                                                        `tel:${phone.content}`
                                                    "
                                                    class="text-lowercase text-muted"
                                                    v-text="phone.phone"
                                                ></a
                                            ></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="container-fluid">
                                    <div class="row border">
                                        <div class="col-md-12">
                                            <div class="h4">Endereço(s)</div>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div
                                                    class="col-md-12 d-flex flex-wrap justify-content-around align-itens-center border mt-2"
                                                    v-for="address in patron.addresses"
                                                    :key="address.id"
                                                >
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-text="
                                                            `Tipo: ${address.name}`
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-text="
                                                            `País: ${address.country.name}`
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-text="
                                                            `CEP: ${address.zip_code}`
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-text="
                                                            `Logradouro: ${address.street}`
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-text="
                                                            `Número: ${address.number}`
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-text="
                                                            `Bairro: ${address.neighborhood}`
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-text="
                                                            `Complemento: ${address.additional_info}`
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-text="
                                                            `Cidade: ${address.city}`
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-capitalize mx-1"
                                                        v-html="
                                                            `Estado: <span class='text-uppercase'>${address.state}</span>`
                                                        "
                                                    ></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a
                        :href="`/patrons/${patron.id}`"
                        class="btn btn-success"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="`Visualizar ${patron.name.toUpperCase()}`"
                        ><i class="fas fa-glasses"></i
                    ></a>
                    <a
                        :href="`/patrons/${patron.id}/edit`"
                        class="ml-2 btn btn-warning"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="`Editar ${patron.name.toUpperCase()}`"
                        ><i class="far fa-edit"></i
                    ></a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Form from "../../form-validation/Form";
export default {
    data() {
        return {
            patron: {},
        };
    },
    created() {
        window.events.$on("quick_view", (patron) => {
            this.patron = patron;
        });
    },
};
</script>
