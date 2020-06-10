<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="copatron-name" class="bmd-label-floating"
                        >Nome</label
                    >
                    <input
                        type="text"
                        name="copatron-name"
                        id="copatron-name"
                        class="form-control"
                        v-model="form.name"
                    />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="">Data Nascimento</label>
                    <date-picker
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        width="100%"
                        v-model="form.birthday"
                    ></date-picker>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="copatron-email" class="bmd-label-floating"
                        >Email</label
                    ><input
                        type="email"
                        name="copatron-email"
                        id="copatron-email"
                        class="form-control"
                        v-model="form.email"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DatePicker from "vue2-datepicker";
export default {
    props: ["copatron"],
    data() {
        return {
            form: this.copatron,
        };
    },
};
</script>
