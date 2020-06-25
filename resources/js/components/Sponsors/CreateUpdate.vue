<template>
    <form
        class="container-fluid"
        enctype="multipart/form-data"
        @keydown="form.errors.clear($event.target.name)"
        @submit.prevent="send"
    >
        <croppie :avatar="sponsor ? form.avatar : undefined" />
        <div class="row">
            <div class="col-md-12"><hr /></div>
        </div>
        <div class="row d-flex align-items-end">
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="razao_social" class="bmd-label-floating"
                        >Razão Social</label
                    >
                    <input
                        type="text"
                        name="razao_social"
                        id="razao_social"
                        class="form-control text-capitalize"
                        v-model="form.razao_social"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('razao_social')"
                        v-if="form.errors.has('razao_social')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="nome_fantasia" class="bmd-label-floating"
                        >Nome Fantasia</label
                    >
                    <input
                        type="text"
                        name="nome_fantasia"
                        id="nome_fantasia"
                        class="form-control text-capitalize"
                        v-model="form.nome_fantasia"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('nome_fantasia')"
                        v-if="form.errors.has('nome_fantasia')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="cnpj" class="bmd-label-floating">CNPJ</label>
                    <the-mask
                        type="text"
                        name="cnpj"
                        id="cnpj"
                        class="form-control text-capitalize"
                        v-model="form.cnpj"
                        :mask="['##.###.###/####-##']"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('cnpj')"
                        v-if="form.errors.has('cnpj')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    <label for="occupation_area" class="bmd-label-floating"
                        >Área de Atuação</label
                    >
                    <input
                        type="text"
                        name="occupation_area"
                        id="occupation_area"
                        class="form-control text-capitalize"
                        v-model="form.occupation_area"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('occupation_area')"
                        v-if="form.errors.has('occupation_area')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Plano</label>
                    <multiselect
                        track-by="name"
                        label="name"
                        :options="categories"
                        :multiple="false"
                        :close-on-select="true"
                        placeholder="Selecione o plano"
                        selectLabel=""
                        deselectLabel=""
                        selectedLabel="Selecionado"
                        v-model="form.category"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('category')"
                        v-if="form.errors.has('category')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Projeto</label>
                    <multiselect
                        track-by="name"
                        label="name"
                        :options="projects"
                        :multiple="false"
                        :close-on-select="true"
                        placeholder="Selecione o projeto"
                        selectLabel=""
                        deselectLabel=""
                        selectedLabel="Selecionado"
                        v-model="form.project"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('project')"
                        v-if="form.errors.has('project')"
                    ></small>
                </div>
            </div>
            <div class="col-md-12"><hr /></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Responsável Legal</h4>
                    </div>
                    <create-update-copatron-component :copatron="form.proxy" />
                </div>
            </div>
            <div class="col-md-12"><hr /></div>
            <div class="container-fluid">
                <div class="row d-flex align-items-start">
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
                        <small
                            class="text-danger"
                            v-text="form.errors.get('social_medias')"
                            v-if="form.errors.has('social_medias')"
                        ></small>
                    </div>
                    <div class="col-md-12 mt-2">
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
            <div class="col-md-12"><hr /></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Contatos</h4>
                    </div>
                    <create-update-secretary-component
                        v-for="contact in form.people_to_contact"
                        :key="contact.id"
                        :secretary="contact"
                    />
                    <div class="col-md-12">
                        <small
                            class="text-danger"
                            v-text="form.errors.get('people_to_contact')"
                            v-if="form.errors.has('people_to_contact')"
                        ></small>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button
                            class="btn btn-success"
                            type="button"
                            @click.prevent="
                                add('people_to_contact', {
                                    name: '',
                                    phones: [],
                                    emails: [],
                                })
                            "
                        >
                            Adicionar Contato
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
                        <small
                            class="text-danger"
                            v-text="form.errors.get('addresses')"
                            v-if="form.errors.has('addresses')"
                        ></small>
                    </div>
                    <div class="col-md-12 mt-2">
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
    props: ["categories", "projects", "http_verb", "url", "message", "sponsor"],
    data() {
        return {
            form: new Form({
                avatar: "",
                logo: "",
                razao_social: "",
                nome_fantasia: "",
                cnpj: "",
                occupation_area: "",
                category: {},
                project: {},
                social_medias: [],
                people_to_contact: [],
                addresses: [],
                proxy: {
                    name: "",
                    email: "",
                    birthday: "",
                },
            }),
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
        send: _.throttle(
            function() {
                window.events.$emit("loading", true);
                let addresses = this.form.addresses.filter((address) => {
                    return (
                        address.name == "" ||
                        address.zip_code == "" ||
                        address.street == "" ||
                        address.number == "" ||
                        address.neighborhood == "" ||
                        address.city == "" ||
                        address.state == ""
                    );
                });
                if (addresses.length) {
                    swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text:
                            "Preencha os campos obrigatórios do(s) endereço(s).",
                    });
                    window.events.$emit("loading", false);
                    return;
                }

                let people_to_contact = this.form.people_to_contact.filter(
                    (contact) => {
                        return contact.name == "";
                    }
                );

                if (people_to_contact.length) {
                    swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Preencha os campos na seção Contatos.",
                    });
                    window.events.$emit("loading", false);
                    return;
                }

                if (
                    this.form.proxy.name == "" ||
                    this.form.proxy.email == "" ||
                    this.form.proxy.birthday == ""
                ) {
                    window.flash(
                        "Preencha todos os campos do Responsável Legal",
                        "danger"
                    );
                    window.events.$emit("loading", false);
                    return;
                }

                this.form[this.http_verb](this.url)
                    .then((result) => {
                        window.events.$emit("loading", false);
                        window.flash(this.message);
                        window.location = "/sponsors";
                    })
                    .catch((errors) => {
                        window.events.$emit("loading", false);
                        window.flash("Algo deu errado.", "danger");
                    });
            },
            500,
            { trailing: false }
        ),
    },
    created() {
        if (this.sponsor) {
            this.form = new Form(this.sponsor);
        }

        window.events.$on("avatar", (avatar) => {
            this.form.avatar = avatar;
        });

        window.events.$on("remove-avatar", () => {
            this.form.avatar = "";
            this.form.logo = "";
        });

        window.events.$on("logo", (logo) => {
            this.form.logo = logo;
        });

        window.events.$on("remove-social_media", (removedSocial_media) => {
            this.form.social_medias.forEach((social_media, index) => {
                if (social_media.id == removedSocial_media.id) {
                    this.form.social_medias.splice(index, 1);
                }
            });
        });

        window.events.$on("remove-secretary", (removedSecretary) => {
            this.form.people_to_contact.forEach((secretary, index) => {
                if (secretary.id == removedSecretary.id) {
                    this.form.people_to_contact.splice(index, 1);
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
