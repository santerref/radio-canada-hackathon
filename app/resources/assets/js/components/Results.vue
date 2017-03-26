<template>
    <div>
        <div class="heading">
            <span class="lead">{{ results.length }} résultats</span>
            <div class="pull-right sort">
                <a href="#bestMatch">Trier par pertinence</a> | <a href="#sortDate">Trier par date</a>
            </div>
        </div>
        <div v-for="result in results" class="result-list" itemscope itemtype="http://schema.org/RadioClip">
            <div class="result-item">
                <div class="infos col-md-8">
                    <h3>Un language révolutionnaire pour communiquer avec les autistes</h3>
                    <p class="meta datetime">Diffusion: 21 mars 2017, 13h06</p>
                    <p class="meta ">Gravel le matin</p>
                    <button class="btn btn-primary btn-rounded" @click="play($event, $result.mediaId)><i class="fa fa-play"></i> | 10:00</button>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="col-md-4">
                    <img class="" src="http://placehold.it/250/E98300">
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