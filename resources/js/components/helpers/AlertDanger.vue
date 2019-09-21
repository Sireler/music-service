<template>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" v-show="error">
        <strong>{{ title }}</strong>
        <div class="error-text">
            {{ error }}
        </div>
        <button type="button" class="close" aria-label="Close"
                @click="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
    export default {
        name: "AlertDanger",
        props: ['title', 'error'],
        methods: {
            close() {
                this.$emit('closed');
            }
        }
    }
</script>

<style scoped>

</style>
