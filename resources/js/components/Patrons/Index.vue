<template>
    <div class="row">
        <div class="col-md-12">
            <filter-component />
        </div>
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Profissão</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <table-row
                            v-if="patrons.length"
                            v-for="patron in patrons"
                            :key="patron.id"
                            :patron="patron"
                        />
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <paginator v-if="paginate.last_page > 1" :paginate="paginate" />
        </div>
    </div>
</template>
<script>
import TableRow from "./Row";
import FilterComponent from "./Filter";
import Paginator from "../Utilities/Paginator";
export default {
    data() {
        return {
            patrons: [],
            paginate: {},
            filters: {
                department: "all",
                paginate: 10,
                search: "",
                status: "all",
                brand: "all",
                category: "all",
                seller: "all",
            },
        };
    },
    components: {
        TableRow,
        FilterComponent,
        Paginator,
    },
    methods: {
        fetch(url = null) {
            axios
                .get(
                    url === null
                        ? `/patrons?paginate=${this.filters.paginate}&search=${this.filters.search}&status=${this.filters.status}&category=${this.filters.category}`
                        : url
                )
                .then((result) => {
                    this.patrons = result.data.data;
                    delete result.data.data;
                    this.paginate = result.data;
                })
                .catch((errors) => {
                    window.flash(
                        "Algo deu errado. Tente recarregar a página.",
                        "danger"
                    );
                    console.error(errors.response.data.message);
                });
        },
    },
    created() {
        this.fetch();
        window.events.$on("search", (filter) => {
            this.filters = filter;
            this.fetch();
        });

        window.events.$on("page", (url) => {
            this.fetch(
                `${url}&paginate=${this.filters.paginate}&search=${this.filters.search}&status=${this.filters.status}&brand=${this.filters.brand}&category=${this.filters.category}`
            );
        });
    },
};
</script>
