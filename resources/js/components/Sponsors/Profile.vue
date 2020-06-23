<template>
    <div class="container-flui">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title" v-text="patron.name"></h4>
                        <p class="card-category" v-text="patron.occupation"></p>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >Company (disabled)</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            disabled=""
                                        />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >Username</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >Email address</label
                                        >
                                        <input
                                            type="email"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >Fist Name</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >Last Name</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >Adress</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >City</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >Country</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating"
                                            >Postal Code</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">
                                                Lamborghini Mercy, Your chick
                                                she so thirsty, I'm in that two
                                                seat Lambo.</label
                                            >
                                            <textarea
                                                class="form-control"
                                                rows="5"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="btn btn-primary pull-right"
                            >
                                Update Profile
                            </button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar" v-if="patron.avatar">
                        <a href="javascript:;"
                            ><img class="img" :src="patron.avatar"
                        /></a>
                    </div>
                    <div class="card-body">
                        <h6
                            class="card-category text-gray"
                            v-text="`${patron.occupation} / ${patron.company}`"
                        ></h6>
                        <h4 class="card-title" v-text="patron.name"></h4>
                        <p class="card-description" v-text="patron.bio"></p>
                        <div class="container-fluid">
                            <div class="row d-flex justify-content-center">
                                <div
                                    class="col-md-6 d-flex justify-content-around align-items-center flex-wrap"
                                >
                                    <a
                                        :href="social_media.content"
                                        class="btn btn-secondary btn-social"
                                        target="_blank"
                                        v-for="social_media in social_medias"
                                        ><i
                                            class="fab"
                                            :class="`fa-${social_media.name}`"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["patron"],
};
</script>
