<template>
    <section class="search">
        <h2 class="titre">Nom du projet</h2>
        <p class="headline">Ce que vous avez entendu en ondes</p>
        <input class="search-input" type="text" v-model="query" />
        <button type="button" class="search-btn" @click="search()">Rechercher</button>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                query: ""
            }
        },
        methods: {
            search () {
                this.$emit('search', this.query)
            }
        }
    }
</script>