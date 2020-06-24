<template>
    <div class="container-fluid border">
        <div class="row" v-if="edit">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Nome</label>
                    <input
                        type="text"
                        class="form-control text-capitalize"
                        v-model="form.name"
                    />
                </div>
            </div>
            <div class="container-fluid">
                <div class="row d-flex align-items-start">
                    <div class="col-md-6 ">
                        <div class="container-fluid border">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Telefones</h4>
                                </div>
                                <phone
                                    v-for="phone in form.phones"
                                    :phone="phone"
                                    :key="phone.id"
                                />
                                <div class="col-md-12">
                                    <button
                                        class="btn btn-success"
                                        type="button"
                                        @click.prevent="
                                            addComponent('phones', {
                                                phone: '',
                                                name: '',
                                                country: {},
                                            })
                                        "
                                    >
                                        Adicionar Telefone
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="container-fluid border">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Emails</h4>
                                </div>
                                <general
                                    v-for="email in form.emails"
                                    label_1="Tipo"
                                    label_2="Email"
                                    type="email"
                                    :data="email"
                                    event="remove-email"
                                    :key="email.id"
                                />
                                <div class="col-md-12">
                                    <button
                                        class="btn btn-success"
                                        type="button"
                                        @click.prevent="
                                            addComponent('emails', {
                                                name: '',
                                                content: '',
                                            })
                                        "
                                    >
                                        Adicionar Email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-md-3">
                <span v-text="`Nome: `"></span
                ><span class="text-capitalize" v-text="form.name"></span>
            </div>
            <div class="col-md-3" v-for="phone in form.phones" :key="phone.id">
                <span class="text-capitalize" v-text="`${phone.name}: `"></span>
                <span class="text-capitalize" v-text="phone.phone"></span>
            </div>
            <div class="col-md-3" v-for="email in form.emails" :key="email.id">
                <span class="text-capitalize" v-text="`${email.name}: `"></span>
                <span class="text-lowercase" v-text="email.content"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button
                    type="button"
                    class="btn"
                    :class="`${edit ? 'btn-success' : 'btn-warning'}`"
                    @click.prevent="add"
                >
                    <i class="fas fa-plus" v-if="edit"></i>
                    <i class="far fa-edit" v-else></i>
                </button>
                <button
                    type="button"
                    class="btn btn-danger"
                    @click.prevent="remove"
                >
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["secretary"],
    data() {
        return {
            form: this.secretary,
            edit: true,
        };
    },
    methods: {
        addComponent(data, properties) {
            properties.id =
                Math.random()
                    .toString(36)
                    .substring(2, 15) +
                Math.random()
                    .toString(36)
                    .substring(2, 12);
            this.form[data].push(properties);
        },
        add() {
            if (this.form.name != "") {
                if (this.edit) {
                    this.form.name = this.form.name.toLowerCase();
                }
                this.edit = !this.edit;
                return;
            }
            window.flash("Preencha os campos para adicionar.", "danger");
        },
        remove() {
            window.events.$emit("remove-secretary", this.form);
        },
    },
    created() {
        window.events.$on("remove-phone", (removedPhone) => {
            this.form.phones.forEach((phone, index) => {
                if (phone.id == removedPhone.id) {
                    this.form.phones.splice(index, 1);
                }
            });
        });

        window.events.$on("remove-email", (removedEmail) => {
            this.form.emails.forEach((email, index) => {
                if (email.id == removedEmail.id) {
                    this.form.emails.splice(index, 1);
                }
            });
        });
    },
};
</script>
