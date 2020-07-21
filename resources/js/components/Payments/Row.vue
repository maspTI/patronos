<template>
    <tr>
        <td
            class="text-capitalize text-break font-weight-bold"
            v-text="`${payment.id}`"
        ></td>
        <td
            class="text-capitalize text-break"
            v-text="
                payment.paymentable.hasOwnProperty('name')
                    ? payment.paymentable.name
                    : payment.paymentable.nome_fantasia
            "
        ></td>
        <td
            class="text-capitalize text-break"
            v-text="
                payment.paymentable.hasOwnProperty('cpf')
                    ? payment.paymentable.cpf
                    : payment.paymentable.cnpj
            "
        ></td>
        <td class="text-capitalize text-break" v-text="totalValue"></td>
        <td>
            <div class="col-md-12 d-flex justify-content-around flex-wrap">
                <button
                    class="btn btn-primary"
                    type="button"
                    data-toggle="modal"
                    data-target="#view_payment"
                    data-placement="top"
                    :title="
                        `Visualização rápida de pagamento de ${
                            payment.paymentable.hasOwnProperty('name')
                                ? payment.paymentable.name.toUpperCase()
                                : payment.paymentable.nome_fantasia.toUpperCase()
                        }`
                    "
                    @click="view"
                >
                    <i class="fas fa-binoculars"></i>
                </button>
                <!-- <a
                    :href="`/payments/${payment.id}`"
                    class="btn btn-success"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="
                        `Visualizar pagamento de ${
                            payment.paymentable.hasOwnProperty('name')
                                ? payment.paymentable.name.toUpperCase()
                                : payment.paymentable.nome_fantasia.toUpperCase()
                        }`
                    "
                    ><i class="fas fa-glasses"></i
                ></a> -->
                <!-- <a
                    :href="`/payments/${payment.id}/edit`"
                    class="btn btn-warning"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="
                        `Editar pagamento de ${
                            payment.paymentable.hasOwnProperty('name')
                                ? payment.paymentable.name.toUpperCase()
                                : payment.paymentable.nome_fantasia.toUpperCase()
                        }`
                    "
                    ><i class="far fa-edit"></i
                ></a> -->
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["payment"],
    computed: {
        totalValue() {
            return window.currencyFormatter.format(this.payment.value, {
                code: "BRL",
            });
        },
    },
    methods: {
        view() {
            window.events.$emit("quick_view", this.payment);
        },
        send: _.throttle(
            function() {
                axios
                    .patch(`/payments/${this.payment.id}`, {
                        change_status: true,
                    })
                    .then((result) => {
                        this.payment.status = result.data.status;
                        window.flash("Status alterado com sucesso!");
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
    },
};
</script>
