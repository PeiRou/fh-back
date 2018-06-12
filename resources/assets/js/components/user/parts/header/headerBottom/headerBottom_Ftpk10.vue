<template>
    <!--上面是外围的div-->
    <div class="header-bottom sub">
        <div class="show cate_menu">
            <!--<a href="javascript:void(0)" v-for="(v,k) in game" class="router-link-exact-active" :class="{selected: changeSelect === k}" @click="changeSelected(k)">{{ v.name }} |</a>-->
            <!--<router-link to="/mspk10/lmp" class="router-link-exact-active selected">ms两面盘</router-link> |-->
            <!--<router-link to="/mspk10/sol" class="">单号1~10</router-link> |-->
            <!--<router-link to="/mspk10/com" class="">冠亚组合</router-link>-->

            <router-link to="/msft/lmp" exact :class="{ selected: changeSelect === 0 }" @click.native="changeSelected(0)">两面盘</router-link> |
            <router-link to="/msft/sol" exact :class="{ selected: changeSelect === 1 }" @click.native="changeSelected(1)">单号1~10</router-link> |
            <router-link to="/msft/com" exact :class="{ selected: changeSelect === 2 }" @click.native="changeSelected(2)">冠亚组合</router-link>
        </div>
    </div>
</template>

<script>
    // import { mapGetters } from 'vuex'
    export default {
        name: "header-bottom-mspk10",
        // computed: mapGetters({
        // headerBottom: 'getHeaderBottom',
        // }),
        data () {
            return {
                // game: [
                //     { 'name': 'ms两面盘' },
                //     { 'name': '单号1~10' },
                //     { 'name': '冠亚组合' }
                // ],
                changeSelect: 0
            }
        },
        methods: {
            changeSelected (k) {
                this.$store.dispatch('contSiderShowTrue')
                // alert(k);
                this.changeSelect = k
            }
        }
    }
</script>

<style scoped>
    /*全局样式*/
    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
    }

    .main-body {
        position: absolute;
        overflow-x: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 30px;
    }

    .clearfix:after {
        content: "";
        height: 0;
        visibility: hidden;
        display: block;
        clear: both;
    }

    .clearfix {
        zoom: 1
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    .show{
        display: block;
    }


    /*与头部有关的全局性样式*/

    .header {
        position: absolute;
        color: #fff;
        min-width: 1240px;
        width: 100%;
    }

    .header a {
        color: #fff;
        text-align: center;
    }

    /*与头部有关的全局性样式结束*/

    /*skin_blue相关的全局性样式*/
    .skin_blue .header {
        background: #3682d0;
    }


    /*skin_blue相关的全局性样式结束*/

    /*全局样式结束 将顶部固定在了左上角*/

    /*skin_blue 样式 header_bottom*/
    .skin_blue .sub {
        color: #666;
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        border-bottom: 1px solid #ccc;
    }

    .skin_blue .sub a {
        color: #666
    }

    .skin_blue .sub .selected,
    .skin_blue .sub a:hover {
        color: #f98d5c;
    }


    /*skin_blue 样式 header_bottom 结束*/



    /*header_bottom相关样式*/
    .header .sub {
        height: 31px;
        overflow: hidden;
        line-height: 32px;
        padding-left: 200px;
    }
    .header .sub a {
        padding: 0 .5em;

    }
    .header .sub .selected,
    .header .sub a:hover {
        font-weight: 700;
    }


    /*header_bottom相关样式结束*/
</style>