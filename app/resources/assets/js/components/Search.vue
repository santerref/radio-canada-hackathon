<template>
    <div class="container">
        <form>
            <p>Ceci est ma valeur: {{a}}</p>
            <input type="button" @click="increment()" value="Incrémente-moi ça" />
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                a: 1
            }
        },
        methods: {
            increment() {
                this.a += 1;
            }
        }
    }
</script>