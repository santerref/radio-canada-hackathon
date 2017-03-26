<template>
    <div>
        <div class="heading">
            <span class="lead">{{ results.length }} résultats</span>
            <div class="pull-right sort">
                <a href="#bestMatch">Trier par pertinence</a> | <a href="#sortDate">Trier par date</a>
            </div>
        </div>
        <div v-for="result in results" class="result-list" itemscope itemtype="http://schema.org/RadioClip">
            <result :result="result"></result>
        </div>
    </div>
</template>

<script>
    import Result from './Result.vue';

    export default {
        props: ['results'],
        components: {
            Result
        }
    }
</script>