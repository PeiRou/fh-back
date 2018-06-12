<template>
        <div class="header-bottom sub">
            <div class="show cate_menu">
                <router-link to="/gdklsf/lmp" exact :class="{ selected: changeSelect === 0 }" @click.native="changeSelected(0)">两面盘</router-link> |
                <router-link to="/gdklsf/sol" exact :class="{ selected: changeSelect === 1 }" @click.native="changeSelected(1)">单号1~8</router-link> |
                <router-link to="/gdklsf/qiu" exact :class="{ selected: changeSelect === 2 }" @click.native="changeSelected(2)">第一球</router-link> |
                <router-link to="/gdklsf/qiu" exact :class="{ selected: changeSelect === 3 }" @click.native="changeSelected(3)">第二球</router-link> |
                <router-link to="/gdklsf/qiu" exact :class="{ selected: changeSelect === 4 }" @click.native="changeSelected(4)">第三球</router-link> |
                <router-link to="/gdklsf/qiu" exact :class="{ selected: changeSelect === 5 }" @click.native="changeSelected(5)">第四球</router-link> |
                <router-link to="/gdklsf/qiu" exact :class="{ selected: changeSelect === 6 }" @click.native="changeSelected(6)">第五球</router-link> |
                <router-link to="/gdklsf/qiu" exact :class="{ selected: changeSelect === 7 }" @click.native="changeSelected(7)">第六球</router-link> |
                <router-link to="/gdklsf/qiu" exact :class="{ selected: changeSelect === 8 }" @click.native="changeSelected(8)">第七球</router-link> |
                <router-link to="/gdklsf/qiu" exact :class="{ selected: changeSelect === 9 }" @click.native="changeSelected(9)">第八球</router-link> |
                <router-link to="/gdklsf/zm" exact :class="{ selected: changeSelect === 10 }" @click.native="changeSelected(10)">正码</router-link> |
                <router-link to="/gdklsf/lm" exact :class="{ selected: changeSelect === 11 }" @click.native="changeSelected(11)">连码</router-link>
            </div>
        </div>
</template>

<script>
    export default {
        name: "header-bottom",
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