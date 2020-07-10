<template>
    <tr>
        <td
            class="text-uppercase text-break"
            v-text="sponsor.nome_fantasia"
        ></td>
        <td
            class="text-capitalize text-break"
            v-text="sponsor.razao_social"
        ></td>
        <td class="text-capitalize text-break" v-text="sponsor.cnpj"></td>
        <td
            class="text-capitalize text-break"
            v-text="sponsor.occupation_area"
        ></td>
        <td
            class="text-capitalize text-break"
            v-text="`${sponsor.status ? 'Ativo' : 'Inativo'}`"
        ></td>
        <td>
            <div class="col-md-12 d-flex justify-content-around flex-wrap">
                <button
                    class="btn btn-primary"
                    type="button"
                    data-toggle="modal"
                    data-target="#view_sponsor"
                    data-placement="top"
                    :title="
                        `Visualização rápida de ${sponsor.nome_fantasia.toUpperCase()}`
                    "
                    @click="view"
                >
                    <i class="fas fa-binoculars"></i>
                </button>
                <a
                    :href="`/sponsors/${sponsor.id}`"
                    class="btn btn-success"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="`Visualizar ${sponsor.nome_fantasia.toUpperCase()}`"
                    ><i class="fas fa-glasses"></i
                ></a>
                <button
                    class="btn"
                    :class="{
                        'btn-dark': sponsor.status,
                        'btn-success': !sponsor.status,
                    }"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="
                        `${
                            sponsor.status
                                ? `Inativar ${sponsor.nome_fantasia.toUpperCase()}`
                                : `Ativar ${sponsor.nome_fantasia.toUpperCase()}`
                        }`
                    "
                    @click.prevent="send"
                >
                    <i class="far fa-eye" v-if="!sponsor.status"></i>
                    <i class="far fa-eye-slash" v-else></i>
                </button>
                <a
                    :href="`/sponsors/${sponsor.id}/edit`"
                    class="btn btn-warning"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="`Editar ${sponsor.nome_fantasia.toUpperCase()}`"
                    ><i class="far fa-edit"></i
                ></a>
                <a
                    :href="`/payments/create?sponsor=${sponsor.id}`"
                    class="btn btn-secondary"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="
                        `Criar Pagamento para ${sponsor.nome_fantasia.toUpperCase()}`
                    "
                    v-if="sponsor.status"
                    ><i class="fas fa-shopping-cart"></i
                ></a>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["sponsor"],
    data() {
        return {};
    },
    methods: {
        view() {
            window.events.$emit("quick_view", this.sponsor);
        },
        send: _.throttle(
            function() {
                axios
                    .patch(`/sponsors/${this.sponsor.id}`, {
                        change_status: true,
                    })
                    .then((result) => {
                        this.sponsor.status = result.data.status;
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
