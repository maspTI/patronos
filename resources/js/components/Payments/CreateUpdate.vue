<template>
    <form
        class="container-fluid"
        enctype="multipart/form-data"
        @keydown="form.errors.clear($event.target.name)"
        @submit.prevent="send"
    >
        <div class="row d-flex align-items-end">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Categoria</label>
                    <multiselect
                        track-by="name"
                        label="name"
                        :options="categories"
                        :multiple="false"
                        :close-on-select="true"
                        placeholder="Selecione a categoria"
                        selectLabel=""
                        deselectLabel=""
                        selectedLabel="Selecionado"
                        v-model="form.category"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('category')"
                        v-if="form.errors.has('category')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Método de Pagamento</label>
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
                        @select="updatePaymentInfo"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('payment_method')"
                        v-if="form.errors.has('payment_method')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="">Vencimento</label>
                    <date-picker
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        :not-before="new Date()"
                        input-class="form-control"
                        width="100%"
                        v-model="form.due_date"
                    ></date-picker>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('due_date')"
                        v-if="form.errors.has('due_date')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="value" class="bmd-label-floating">Valor</label>
                    <money
                        name="value"
                        id="value"
                        class="form-control"
                        v-model="form.value"
                        @keyup.native="divide"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('value')"
                        v-if="form.errors.has('value')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Parcelamento</label>
                    <multiselect
                        track-by="text"
                        label="text"
                        :options="type"
                        :multiple="false"
                        :close-on-select="true"
                        :disabled="type.length ? false : true"
                        placeholder="Selecione"
                        selectLabel=""
                        deselectLabel=""
                        selectedLabel="Selecionado"
                        v-model="form.type"
                        @select="addPaymentInfo"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('type')"
                        v-if="form.errors.has('type')"
                    ></small>
                </div>
            </div>
            <submit-button />
        </div>
    </form>
</template>
<script>
import Form from "../../form-validation/Form";
import DatePicker from "vue2-datepicker";
export default {
    components: {
        DatePicker,
    },
    props: ["categories", "http_verb", "url", "message", "person"],
    data() {
        return {
            form: new Form({
                category: "",
                person: this.person,
                type: "",
                value: "",
                payment_method: "",
                due_date: new Date(),
                payment_info: [],
            }),
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
            type: [],
        };
    },
    methods: {
        send: _.throttle(
            function() {
                window.events.$emit("loading", true);
                this.form.due_date = moment(this.form.due_date).format(
                    "YYYY-MM-DD"
                );
                this.form[this.http_verb](this.url)
                    .then((result) => {
                        window.events.$emit("loading", false);
                        window.flash(this.message);
                        window.location = "/payments";
                    })
                    .catch((errors) => {
                        window.events.$emit("loading", false);
                        window.flash("Algo deu errado.", "danger");
                    });
            },
            500,
            { trailing: false }
        ),
        divide() {
            this.type = [];
            this.form.type = "";
            for (var i = 1; i < 13; i++) {
                let value = (this.form.value / i).toFixed(2);
                this.type.push({
                    text: `${i}x R$ ${value}`,
                    value: value,
                    parcel: i,
                });
            }
        },
        addPaymentInfo(selectedOption, id) {
            this.form.payment_info = [];
            for (var i = 1; i <= selectedOption.parcel; i++) {
                this.form.payment_info.push({
                    id: this.add(),
                    value: selectedOption.value,
                    parcel: i,
                    due_date: moment(this.form.due_date)
                        .add(i - 1, "M")
                        .format("YYYY-MM-DD"),
                    payment_method: this.form.payment_method,
                    status: null,
                });
            }
        },
        updatePaymentInfo(selectedOption, id) {
            if (this.form.payment_info.length) {
                this.form.payment_info.forEach((payment) => {
                    payment.payment_method = selectedOption;
                });
            }
        },
        add() {
            return (
                Math.random()
                    .toString(36)
                    .substring(2, 15) +
                Math.random()
                    .toString(36)
                    .substring(2, 12)
            );
        },
    },
};
</script>
