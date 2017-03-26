<template>
    <section class="search">
        <h1 class="titre">Nom du projet</h1>
        <p class="headline">Ce que vous avez entendu en ondes</p>
        <input class="search-input" @keyup.enter="search()" type="text" v-model="query" v-on:keyup="type" aria-label="Recherche" title="Recherche" />
        <button type="submit" class="search-btn" @click="search()">Rechercher <i class="fa fa-refresh fa-spin" v-show="searching"></i></button>
    </section>
</template>

<script>
    export default {
        props: ['searching'],
        data () {
            return {
                'query': ""
            }
        },
        methods: {
            search () {
                this.$emit('search')
            },
            type () {
                this.$emit('type', this.query)
            }
        }
    }
</script>