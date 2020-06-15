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
                            <div
                                class="col-md-12 d-flex justify-content-around align-items-center flex-wrap"
                            ></div>
                        </div>
                    </div>
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
    computed: {
        bought_at() {
            return window.moment(this.patron.bought_at).format("DD/MM/YYYY");
        },
    },
    created() {
        window.events.$on("quick_view", (patron) => {
            this.patron = patron;
        });
    },
};
</script>
