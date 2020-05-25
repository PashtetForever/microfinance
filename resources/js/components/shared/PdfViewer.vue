<template>
    <div class="pdf-view elevation-2">
        <div class="text-center">
            <v-pagination
                    v-if="pageCount > 1"
                    v-model="currentPage"
                    :length="pageCount"
                    class="mb-4"
            ></v-pagination>
        </div>
        <pdf
                style="width: 100%"
                :src="pdfPath"
                ref="appPdf"
                @num-pages="pageCount = $event"
                @loaded="currentPage = 1"
                :page="currentPage"
        ></pdf>
    </div>
</template>

<script>
    import pdf from 'vue-pdf';

    export default {
        props: ['pdfPath'],
        data() {
            return {
                currentPage: 1,
                pageCount: 1,
            }
        },
        components: {
            pdf
        },
    }
</script>

<style scoped>
    .pdf-view {

    }
</style>