<template>
    <div v-if="!isFail" class="pagination">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item" :class="isFirstPage ? 'disabled' : ''">
                    <a class="page-link" href="#" tabindex="-1"
                       @click.prevent="prev">Previous</a>
                </li>
                <li class="page-item" :class="isLastPage ? 'disabled' : ''">
                    <a class="page-link" href="#"
                       @click.prevent="next">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "PageNavigation",
        props: ['current', 'last'],
        computed: {
            isLastPage() {
                return parseInt(this.current) === parseInt(this.last);
            },
            isFirstPage() {
                return parseInt(this.current) === 1;
            },
            isFail() {
                const current = parseInt(this.current);
                const last = parseInt(this.last);

                return current > last || current < 1;
            }
        },
        methods: {
            next() {
                this.$emit('nextPage');
            },
            prev() {
                this.$emit('prevPage');
            }
        }
    }
</script>

<style scoped>

</style>
