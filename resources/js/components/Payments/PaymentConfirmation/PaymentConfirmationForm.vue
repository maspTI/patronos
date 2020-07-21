<template>
    <div class="container-fluid mt-2">
        <form class="row" enctype="multipart/form-data" @submit.prevent="send">
            <div
                class="col-md-12 d-flex justify-content-center align-items-center"
            >
                <span
                    class="text-capitalize mx-2"
                    v-text="`${parcel.parcel}ª`"
                ></span>

                <span class="text-capitalize mx-2" v-text="due_date"></span>
                <span class="text-capitalize mx-2" v-text="paid_at"></span>
                <multiselect
                    track-by="name"
                    label="name"
                    :options="payment_method"
                    :multiple="false"
                    :close-on-select="true"
                    placeholder="Selecione"
                    selectLabel=""
                    deselectLabel=""
                    selectedLabel="Selecionado"
                    v-model="form.payment_method"
                    v-if="!parcel.status"
                />
                <span
                    class="text-capitalize mx-2"
                    v-text="parcel.payment_method.name"
                    v-else
                ></span>
                <div
                    class="custom-file mx-2"
                    v-if="!parcel.status && !parcel.recipt"
                >
                    <input
                        type="file"
                        class="custom-file-input"
                        name="anexo"
                        :id="`anexo-${parcel.id}`"
                        @change="uploadImage"
                    />
                    <label
                        class="custom-file-label form-control"
                        :id="`anexo_nome-${parcel.id}`"
                        :for="`anexo-${parcel.id}`"
                        >Escolha um arquivo</label
                    >
                </div>
                <a href="" class="btn btn-warning mx-2" v-if="parcel.recipt"
                    ><i class="fas fa-download"></i
                ></a>
                <button
                    class="btn btn-success mx-2"
                    type="submit"
                    v-if="!parcel.status"
                >
                    Enviar
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import Form from "../../../form-validation/Form";
export default {
    props: ["parcel", "paymentId"],
    data() {
        return {
            form: {},
            payment_method: [
                {
                    name: "Cartão de Crédito",
                    value: 1,
                },
                {
                    name: "Boleto",
                    value: 2,
                },
                {
                    name: "Transferência Bancária",
                    value: 3,
                },
            ],
        };
    },
    computed: {
        due_date() {
            return moment(this.parcel.due_date).format("DD/MM/YYYY");
        },
        parcelValue() {
            return window.currencyFormatter.format(this.parcel.value, {
                code: "BRL",
            });
        },
        paid_at() {
            return this.parcel.status != null ? "Pago" : "Aberto";
        },
    },
    methods: {
        send: _.throttle(
            function() {
                this.form
                    .patch(
                        `/payments/${this.paymentId}/parcel/${this.parcel.id}`
                    )
                    .then((result) => {
                        this.parcel.status = result.status;
                        this.parcel.payment_method = result.payment_method;
                        this.parcel.recipt = result.recipt;

                        window.events.$emit("update_payment", result);
                    })
                    .catch((errors) =>
                        window.flash(
                            "Aldo deu errado. Contate o setor de TI.",
                            "danger"
                        )
                    );
            },
            500,
            { trailing: false }
        ),
        uploadImage(event) {
            this.cropped = false;
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                document.querySelector(
                    `#anexo_nome-${this.parcel.id}`
                ).innerText = event.target.files[0].name;
                this.form.recipt = event.target.files[0];
            }
        },
    },
    created() {
        if (this.parcel.hasOwnProperty("recipt")) {
            this.form = new Form(this.parcel);
        } else {
            this.parcel.recipt = "";
            this.form = new Form(this.parcel);
        }
    },
};
</script>
