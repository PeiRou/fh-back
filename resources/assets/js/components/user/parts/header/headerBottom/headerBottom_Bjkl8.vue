<template>
        <div class="header-bottom sub">
            <div class="show cate_menu">
                <router-link to="/bjkl8/zhbswx" exact :class="{ selected: changeSelect === 0 }" @click.native="changeSelected(0)">总和、比数、五行</router-link> |
                <router-link to="/bjkl8/zm" exact :class="{ selected: changeSelect === 1 }" @click.native="changeSelected(1)">正码</router-link>
                <!--<router-link to="/bjkl8/zhbswx" class="router-link-exact-active selected">总和、比数、五行</router-link> |-->
                <!--<router-link to="/bjkl8/zm" class="">正码</router-link>-->
            </div>
        </div>
</template>

<script>
    export default {
        name: "header-bottom",
        data () {
            return {
                changeSelect: 0
            }
        },
        methods: {
            changeSelected (k) {
                this.$store.dispatch('contSiderShowTrue')
                this.changeSelect = k
            }
        }
    }
</script>

<style scoped>


    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
    }

    .wrap {
        position: relative
    }

    a {
        text-decoration: none
    }

    a:hover {
        text-decoration: none
    }

    .trial-cls {
        display: none
    }

    .header .more-game-drop {
        position: absolute;
        right: -1px;
        top: 38px;
        width: 480px;
        height: auto;
        padding: 0 15px 8px 15px;
        overflow: hidden;
        text-align: left;
        font-weight: 400;
        color: #333
    }

    .header .more-game-drop .actions {
        position: absolute;
        right: 17px;
        bottom: 6px
    }

    .header .more-game-drop .actionBtn {
        display: inline-block;
        border-radius: 4px;
        color: #fff;
        padding: 10px 18px;
        line-height: 1em;
        font-weight: 400
    }

    .header .more-game-drop .actionBtn.action-cancel {
        background: #bbb;
        display: none
    }

    .header .lotterys.menu-editMode .editbtn {
        display: block
    }

    .header .sub {
        height: 31px;
        overflow: hidden;
        line-height: 32px;
        padding-left: 200px
    }

    .header .sub a {
        padding: 0 .5em
    }

    .header .sub .selected,
    .header .sub a:hover {
        font-weight: 700
    }

    .header .icon-new {
        position: relative;
        right: -19px;
        top: -63px
    }

    .skin_red .notice-wrap .bg {
        background: #1e5799;
        background: -moz-linear-gradient(top, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%);
        background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)
    }

    .skin_blue .sub {
        color: #666;
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        border-bottom: 1px solid #ccc
    }

    .skin_blue .sub a {
        color: #666
    }

    .skin_blue .sub .selected,
    .skin_blue .sub a:hover {
        color: #f98d5c
    }

    .skin_blue .lotterys.menu-editMode .show > a:hover {
        background: 0 0;
        color: #fff
    }

    .skin_blue #skinPanel:hover .skin_blue .skinHover ul,
    .skin_blue #skinPanel:hover ul,
    .skin_blue .skinHover {
        background: #234b95
    }

    .skin_blue .header {
        background: #3682d0
    }

    .skin_blue .header .lotterys {
        background: #2161b3
    }

</style>