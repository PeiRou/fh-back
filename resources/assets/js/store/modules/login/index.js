import jwtToken from './../../../helpers/jwt'

export default {
    actions: {
        loginSuccess({dispatch}, tokenResponse) {
            jwtToken.setToken(tokenResponse.token)
            // jwtToken.setAuthId(tokenResponse.auth_id)
            jwtToken.setUserId(tokenResponse.user_id)
            dispatch('setAuthUser')
        },
        logoutRequest({dispatch}) {
            // return axios.post('/api/logout')
            return axios.post('/web/logout')
                .then(response => {
                    //if(response.logout === true){
                        dispatch('unsetAuthUser')
                      console.log(response.logout)
                        //location.href = '/'
                    //} else {
                        //alert('退出失败！请稍后再试')
                    //}
                    //jwtToken.removeToken();

                })
        }
    }

}