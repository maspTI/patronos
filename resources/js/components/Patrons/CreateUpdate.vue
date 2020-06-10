<template>
    <form class="container-fluid">
        <croppie />
        <div class="row">
            <div class="col-md-12"><hr /></div>
        </div>
        <div class="row d-flex align-items-end">
            <div class="col-md-6">
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
            <div class="col-md-3">
                <div class="form-group bmd-form-group">
                    <label for="">Data de Nascimento</label>
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
            <div class="col-md-3">
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
                    <label for="">Estado Civil</label>
                    <multiselect
                        track-by="name"
                        label="name"
                        :options="marital_status"
                        :multiple="false"
                        placeholder="Selecione o Estado Civil"
                        selectLabel=""
                        deselectLabel=""
                        selectedLabel="Selecionado"
                        v-model="form.marital_status"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('categories')"
                        v-if="form.errors.has('categories')"
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
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="pointed_by" class="bmd-label-floating"
                        >Indicado por</label
                    >
                    <input
                        type="text"
                        name="pointed_by"
                        id="pointed_by"
                        class="form-control"
                        v-model="form.pointed_by"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('pointed_by')"
                        v-if="form.errors.has('pointed_by')"
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
            <div class="col-md-12"><hr /></div>
            <div class="container-fluid">
                <div class="row d-flex align-items-start">
                    <div class="col-md-6">
                        <div class="container-fluid">
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
                                            add('phones', {
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
                    <div class="col-md-6">
                        <div class="container-fluid">
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
                                            add('emails', {
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
            <div class="col-md-12"><hr /></div>
            <div class="container-fluid">
                <div class="row d-flex align-items-start">
                    <div class="col-md-6">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Dependentes</h4>
                                </div>
                                <general
                                    v-for="dependent in form.dependents"
                                    label_1="Nome"
                                    label_2="Email"
                                    type="email"
                                    :data="dependent"
                                    event="remove-dependent"
                                    :key="dependent.id"
                                />
                                <div class="col-md-12">
                                    <button
                                        class="btn btn-success"
                                        type="button"
                                        @click.prevent="
                                            add('dependents', {
                                                name: '',
                                                content: '',
                                            })
                                        "
                                    >
                                        Adicionar Dependente
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Redes Sociais</h4>
                                </div>
                                <general
                                    v-for="social_media in form.social_medias"
                                    label_1="Nome"
                                    label_2="Link"
                                    type="url"
                                    :data="social_media"
                                    event="remove-social_media"
                                    :key="social_media.id"
                                />
                                <div class="col-md-12">
                                    <button
                                        class="btn btn-success"
                                        type="button"
                                        @click.prevent="
                                            add('social_medias', {
                                                name: '',
                                                content: '',
                                            })
                                        "
                                    >
                                        Adicionar Rede Social
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12"><hr /></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Secretários(as)</h4>
                    </div>
                    <create-update-secretary-component
                        v-for="secretary in form.secretaries"
                        :key="secretary.id"
                        :secretary="secretary"
                    />
                    <div class="col-md-12">
                        <button
                            class="btn btn-success"
                            type="button"
                            @click.prevent="
                                add('secretaries', {
                                    name: '',
                                    phones: [],
                                    emails: [],
                                })
                            "
                        >
                            Adicionar Secretário(a)
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12"><hr /></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Endereços</h4>
                    </div>
                    <create-update-address-component
                        v-for="address in form.addresses"
                        :key="address.id"
                        :address="address"
                    />
                    <div class="col-md-12">
                        <button
                            class="btn btn-success"
                            type="button"
                            @click.prevent="
                                add('addresses', {
                                    name: '',
                                    zip_code: '',
                                    street: '',
                                    number: '',
                                    neighborhood: '',
                                    additional_info: '',
                                    city: '',
                                    state: '',
                                    country: {},
                                })
                            "
                        >
                            Adicionar Endereço
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12"><hr /></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Co-Titular</h4>
                    </div>
                    <create-update-copatron-component
                        :copatron="form.copatron"
                    />
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
                pointed_by: "",
                categories: [],
                phones: [],
                emails: [],
                dependents: [],
                social_medias: [],
                secretaries: [],
                addresses: [],
                copatron: {
                    name: "",
                    email: "",
                    birthday: "",
                },
            }),
            marital_status: [
                {
                    name: "Solteiro",
                    value: "single",
                },
                {
                    name: "Casado",
                    value: "married",
                },
                {
                    name: "Viúvo",
                    value: "widower",
                },
                {
                    name: "Divorciado",
                    value: "divorced",
                },
            ],
        };
    },
    methods: {
        add(data, properties) {
            properties.id =
                Math.random()
                    .toString(36)
                    .substring(2, 15) +
                Math.random()
                    .toString(36)
                    .substring(2, 12);
            this.form[data].push(properties);
        },
    },
    created() {
        window.events.$on("avatar", (avatar) => {
            this.form.avatar = avatar;
        });
        window.events.$on("remove-avatar", () => {
            this.form.avatar = "";
        });

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

        window.events.$on("remove-dependent", (removedDependent) => {
            this.form.dependents.forEach((dependent, index) => {
                if (dependent.id == removedDependent.id) {
                    this.form.dependents.splice(index, 1);
                }
            });
        });

        window.events.$on("remove-social_media", (removedSocial_media) => {
            this.form.social_medias.forEach((social_media, index) => {
                if (social_media.id == removedSocial_media.id) {
                    this.form.social_medias.splice(index, 1);
                }
            });
        });

        window.events.$on("remove-secretary", (removedSecretary) => {
            this.form.secretaries.forEach((secretary, index) => {
                if (secretary.id == removedSecretary.id) {
                    this.form.secretaries.splice(index, 1);
                }
            });
        });

        window.events.$on("remove-address", (removedAddress) => {
            this.form.addresses.forEach((address, index) => {
                if (address.id == removedAddress.id) {
                    this.form.addresses.splice(index, 1);
                }
            });
        });
    },
};
</script>
