<template>
    <div class="card card-profile">
        <div class="card-avatar">
            <a href="javascript:;"><img class="img" :src="patron.avatar"/></a>
        </div>
        <div class="card-body">
            <h6 class="card-category text-gray" v-text="patron.occupation"></h6>
            <h4 class="card-title" v-text="patron.name"></h4>
            <p class="card-description" v-text="patron.bio"></p>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            patron: {},
        };
    },
};
</script>
