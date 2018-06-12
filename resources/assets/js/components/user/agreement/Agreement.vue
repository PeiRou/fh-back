<template>
    <agreement-form></agreement-form>
</template>

<script>
    import AgreementForm from './AgreementForm'
    export default {
        name: "agreement",
        components: {
            AgreementForm
        },
        // 开始进行登录注册的状态管理
        created() {
            //this.$store.dispatch('setAuthUser')
            // if (jwtToken.getToken()) {
            //     this.$store.dispatch('setAuthUser')
                // } else if(Cookie.get('auth_id')) {
            // } else {
                //if(Cookie.get('user_id')) {
                // this.$store.dispatch('refreshToken')
            // }
        }
    }
</script>

<style scoped>

</style>