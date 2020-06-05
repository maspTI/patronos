<template>
    <form class="container-fluid">
        <croppie :form="form" />
        <div class="row">
            <div class="col-md-12"><hr /></div>
        </div>
        <div class="row d-flex align-items-end">
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="name" class="bmd-label-floating">Nome</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        v-model="form.name"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('name')"
                        v-if="form.errors.has('name')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label class="">Data de Nascimento</label>
                    <date-picker
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        width="100%"
                        v-model="form.birthday"
                    ></date-picker>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('birthday')"
                        v-if="form.errors.has('birthday')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="cpf" class="bmd-label-floating">CPF</label>
                    <the-mask
                        type="text"
                        name="cpf"
                        id="cpf"
                        class="form-control"
                        v-model="form.cpf"
                        :mask="['###.###.###-##']"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('occupation')"
                        v-if="form.errors.has('occupation')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="occupation" class="bmd-label-floating"
                        >Profissão</label
                    >
                    <input
                        type="text"
                        name="occupation"
                        id="occupation"
                        class="form-control"
                        v-model="form.occupation"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('occupation')"
                        v-if="form.errors.has('occupation')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="company" class="bmd-label-floating"
                        >Empresa</label
                    >
                    <input
                        type="text"
                        name="company"
                        id="company"
                        class="form-control"
                        v-model="form.company"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('company')"
                        v-if="form.errors.has('company')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Plano</label>
                    <multiselect
                        track-by="name"
                        label="name"
                        :options="categories"
                        :multiple="true"
                        placeholder="Selecione o plano"
                        selectLabel=""
                        deselectLabel=""
                        selectedLabel="Selecionado"
                        v-model="form.categories"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('categories')"
                        v-if="form.errors.has('categories')"
                    ></small>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Bio</label>
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating"
                            >Curto texto sobre o patrono.</label
                        >
                        <textarea
                            class="form-control"
                            rows="5"
                            v-model="form.bio"
                        ></textarea>
                        <small
                            class="text-danger"
                            v-text="form.errors.get('bio')"
                            v-if="form.errors.has('bio')"
                        ></small>
                    </div>
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
    props: ["categories"],
    data() {
        return {
            form: new Form({
                avatar: "",
                name: "",
                birthday: "",
                cpf: "",
                bio: "",
                occupation: "",
                company: "",
                categories: [],
            }),
        };
    },
    created() {
        window.events.$on("avatar", (avatar) => {
            this.form.avatar = avatar;
        });
        window.events.$on("remove-avatar", () => {
            this.form.avatar = "";
        });
    },
};
</script>
