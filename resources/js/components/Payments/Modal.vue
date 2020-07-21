<template>
    <div
        class="modal fade"
        id="view_payment"
        tabindex="-1"
        role="dialog"
        aria-labelledby="view_payment"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" v-if="payment.hasOwnProperty('id')">
                <div class="modal-header">
                    <h5
                        class="modal-title text-capitalize"
                        id="view_payment"
                        v-text="
                            `${
                                payment.paymentable.hasOwnProperty('name')
                                    ? payment.paymentable.name.toUpperCase()
                                    : payment.paymentable.nome_fantasia.toUpperCase()
                            }`
                        "
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
                    <div class="container-fluid mb-3">
                        <div class="row">
                            <div
                                class="col-md-12 d-flex justify-content-around align-items-center flex-wrap"
                            >
                                <span
                                    class="text-capitalize d-flex align-items-center mx-2"
                                    v-text="
                                        `Valor Total: ${formatedTotalValue}`
                                    "
                                ></span>
                                <span
                                    class="text-capitalize d-flex align-items-center mx-2"
                                    v-text="
                                        `Parcelamento: ${payment.type.parcel}x de ${formatedParcelValue}`
                                    "
                                ></span>
                                <span
                                    class="text-capitalize d-flex align-items-center mx-2"
                                    v-text="`Vencimento: ${due_date}`"
                                ></span>
                                <span
                                    class="text-capitalize d-flex align-items-center mx-2"
                                    v-text="
                                        `Categoria: ${payment.category.name}`
                                    "
                                ></span>
                            </div>
                        </div>
                    </div>
                    <payment-confirmation-form
                        v-for="parcel in payment.payment_info"
                        :key="parcel.id"
                        :parcel="parcel"
                        :paymentId="payment.id"
                    ></payment-confirmation-form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import PaymentConfirmationForm from "./PaymentConfirmation/PaymentConfirmationForm";
export default {
    components: {
        PaymentConfirmationForm,
    },
    data() {
        return {
            payment: {},
        };
    },
    computed: {
        formatedTotalValue() {
            return window.currencyFormatter.format(this.payment.value, {
                code: "BRL",
            });
        },
        formatedParcelValue() {
            return window.currencyFormatter.format(this.payment.type.value, {
                code: "BRL",
            });
        },
        due_date() {
            return window.moment(this.payment.due_date).format("DD/MM/YYYY");
        },
    },
    created() {
        window.events.$on("quick_view", (payment) => {
            this.payment = payment;
        });

        window.events.$on("update_payment", (payment_infoUpdated) => {
            this.payment.payment_info.map((payment_info) => {
                if (payment_info.id == payment_infoUpdated.id) {
                    console.log(payment_infoUpdated);
                    payment_info = payment_infoUpdated;
                }
            });
        });
    },
};
</script>
