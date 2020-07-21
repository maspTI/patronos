<template>
    <div class="container-fluid mt-2">
        <div class="row">
            <div
                class="col-md-12 d-flex justify-content-center align-items-center"
            >
                <span
                    class="text-capitalize mx-2"
                    v-text="`${parcel.parcel}ª`"
                ></span>
                <span class="text-capitalize mx-2" v-text="due_date"></span>
                <span class="text-capitalize mx-2" v-text="paid_at"></span>
                <span
                    class="text-capitalize mx-2"
                    v-text="parcel.payment_method.name"
                ></span>
                <a href="" class="btn btn-warning mx-2" v-if="parcel.recipt"
                    ><i class="fas fa-download"></i
                ></a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["parcel"],
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
};
</script>
