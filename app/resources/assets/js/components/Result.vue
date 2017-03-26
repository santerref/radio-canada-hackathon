<template>
    <div class="result-item">
        <div class="infos">
            <img class="thumbnail" v-bind:src="result._source.programme.image">
            <h3 v-html="result._source.title"></h3>
            <p class="meta datetime">Diffusion: {{ diffusion.format('YYYY MM DD HH:mm') }}</p>
            <p class="meta ">{{ result._source.programme.title }}</p>
            <button class="btn btn-primary btn-rounded"><i class="fa fa-play"></i> | {{ duration }}</button>
            <div v-html="summary"></div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: ['result'],
        computed : {
            diffusion () {
                return moment(this.result._source.broadcastedFirstTimeAt);
            },
            duration () {
                return moment("2015-01-01").startOf('day')
                    .seconds(this.result.duration)
                    .format('H:mm:ss');
            },
            summary () {
                if (this.result._source.summary.length == 0) return "Aucun sommaire";

                return this.result._source.summary;
            }
        }
    }
</script>