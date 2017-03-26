<template>
    <section class="search">
        <h1 class="titre">Nom du projet</h1>
        <p class="headline">Ce que vous avez entendu en ondes</p>
        <input class="search-input" type="text" v-model="query"  aria-label="Recherche" title="Recherche" />
        <button type="submit" class="search-btn" @click="search()">Rechercher</button>
    </section>
</template>

<script>
    export default {
        data () {
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