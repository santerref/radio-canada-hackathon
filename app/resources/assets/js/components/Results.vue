<template>
    <div>
        <div class="heading">
            <span class="lead">{{ results.length }} résultats</span>
            <div class="pull-right">
                Trier par pertinence | Trier par date
            </div>
        </div>
        <div v-for="result in results" class="result-list">
            <div class="result-item">
                <div class="infos">
                    <h3>{{ result.title }}</h3>
                    <p>Diffusion: {{ result.diffusion }}</p>
                    <p>{{ result.emission }}</p>
                    <button class="btn btn-primary btn-rounded" @click="play($event, $result.mediaId)"><i class="fa fa-play"></i> | 10:00</button>
                    <p>
                        {{ result.description }}
                    </p>
                    <img src="http://placehold.it/250/E98300">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['results'],
        methods: {
            play: function(event, mediaId) {
                app
            }
        }
    }
</script>