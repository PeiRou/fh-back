<template>
    <div>
        <pre>
            第一步，监听vuex里面的变化
            https://stackoverflow.com/questions/43270159/vuejs-2-how-to-watch-store-values-from-vuex
        You should not use component's watchers to listen to state change. I recommend you to use getters functions and then map them inside your component.

        import { mapGetters } from 'vuex'

        export default {
        computed: {
                ...mapGetters({
                myState: 'getMyState'
                })
            }
        }
        In your store:

        const getters = {
            getMyState: state => state.my_state
        }
        </pre>

        {{this.myState}}


        <pre>
            第二步，同步input与vuex
            https://vuex.vuejs.org/zh-cn/forms.html
        </pre>
        <!--<input type="text" :value="message" @input="updateMyState">-->

        <!--{{this.objMessage}}-->
        <input type="text" v-model="message">
        <input type="text" v-model="message">

        <br>
        <!--<input type="text" v-model="message_2">-->

        <!--{{this.message_2}}-->
        <!--{{this.objMessage}}-->
        <!--<input v-model="message">-->
        <!--{{message}}-->
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "test_computed_for_watch",
        computed: {
            ...mapGetters({
                myState: 'getMyState'
         }),
            message: {
                get() {
                    alert(this.$store.getters.getMyState)
                    return this.$store.getters.getMyState
                },
                set(value){
                    this.$store.commit('updateMyState', value)
                    alert(value);
                }
            }

        },
    }
</script>

<style scoped>

</style>