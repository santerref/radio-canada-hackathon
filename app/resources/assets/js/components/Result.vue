<template>
    <div class="result-item">
        <div class="infos">
            <img :alt="alt" class="thumbnail" v-bind:src="result._source.programme.image">
            <p class="meta ">{{ result._source.programme.title }}</p>
            <h2 v-html="result._source.title"></h2>
            <p class="meta datetime">Diffusion: {{ diffusion.format('YYYY MM DD HH:mm') }}</p>
            <radioplayer :mediaId="result._source.mediaId" :startAt="result._source.startAt" :endAt="result._source.endAt" :duration="duration" :diffusion="diffusion"></radioplayer>
            <div class="summary" v-html="summary"></div>
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
            },
            alt () {
                return "";
            }
        }
    }
</script>

<style scoped rel="stylesheet/scss" lang="scss">
    h2 {
        margin-top: 10px;
    }

    .meta {
        font-size: 1rem;
        text-transform: uppercase;
        color: #555;
    }

    img {
        margin: 0 0 35px 35px;
    }

    .summary {
        margin-top: 1rem;
    }
</style>
