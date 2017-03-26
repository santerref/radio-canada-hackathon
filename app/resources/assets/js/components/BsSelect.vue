<template>
    <!-- Single button -->
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ label }} <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li v-for="c in choices"><a href="#" @click="update(c)">{{ c.label }}</a></li>
        </ul>
    </div>
</template>

<script>
    import EmissionsChoices from './EmissionsSelectChoices'

    export default {
        props: ['choice', 'choices'],
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