672     La soirée est encore jeune
52      Les années lumière
372     Médium large
1330    Culture club
373     Plus on est de fous, plus on lit
3851    Gravel le matin
4585    On est pas sorti de l'auberge
4586    Les grands entretiens
206     La croisée (Alberta)
377     La sphère

<template>
    <!-- Single button -->
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ label }} <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li v-for="choice in choices"><a href="#" @click="update(choice)">{{ choice.label }}</a></li>
        </ul>
    </div>
</template>

<script>
    import EmissionsChoices from './EmissionsSelectChoices'

    export default {
        props: ['choice'],
        data () {
            return {
                choices: EmissionsChoices,
            }
        },
        methods: {
            update(choice) {
                this.$emit('update', choice);
            }
        },
        computed: {
            label () {
                if (!this.choice) return "";
                return this.choice.label;
            }
        }
    }
</script>