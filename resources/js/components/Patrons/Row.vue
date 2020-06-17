<template>
    <tr>
        <td class="text-capitalize text-break" v-text="patron.name"></td>
        <td class="text-capitalize text-break" v-text="patron.cpf"></td>
        <td class="text-capitalize text-break" v-text="patron.occupation"></td>
        <td
            class="text-capitalize text-break"
            v-text="`${patron.status ? 'Ativo' : 'Inativo'}`"
        ></td>
        <td>
            <div class="col-md-12 d-flex justify-content-around flex-wrap">
                <button
                    class="btn btn-primary"
                    type="button"
                    data-toggle="modal"
                    data-target="#view_patron"
                    data-placement="top"
                    :title="
                        `Visualização rápida de ${patron.name.toUpperCase()}`
                    "
                    @click="view"
                >
                    <i class="fas fa-binoculars"></i>
                </button>
                <a
                    :href="`/patrons/${patron.id}`"
                    class="btn btn-success"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="`Visualizar ${patron.name.toUpperCase()}`"
                    ><i class="fas fa-glasses"></i
                ></a>
                <button
                    class="btn"
                    :class="{
                        'btn-dark': patron.status,
                        'btn-success': !patron.status,
                    }"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="
                        `${
                            patron.status
                                ? `Inativar ${patron.name.toUpperCase()}`
                                : `Ativar ${patron.name.toUpperCase()}`
                        }`
                    "
                    @click.prevent="send"
                >
                    <i class="far fa-eye" v-if="!patron.status"></i>
                    <i class="far fa-eye-slash" v-else></i>
                </button>
                <a
                    :href="`/patrons/${patron.id}/edit`"
                    class="btn btn-warning"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="`Editar ${patron.name.toUpperCase()}`"
                    ><i class="far fa-edit"></i
                ></a>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["patron"],
    data() {
        return {};
    },
    methods: {
        view() {
            window.events.$emit("quick_view", this.patron);
        },
        send: _.throttle(
            function() {
                axios
                    .patch(`/patrons/${this.patron.id}`, {
                        change_status: true,
                    })
                    .then((result) => {
                        this.patron.status = result.data.status;
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
