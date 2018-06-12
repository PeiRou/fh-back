<template>
    <div>
    <!--第一个弹窗-->

    <el-dialog title="外层 Dialog" :visible.sync="Message_outerVisible1">
        <el-alert
                title="紧急通告"
                type="info"
                :description="message.type_4[0].message"
                show-icon>
        </el-alert>

        <el-dialog
                width="30%"
                title="内层 Dialog中间弹出的相当于把所有的页面都消息放在一起"
                :visible.sync="innerVisible"
                append-to-body>
        </el-dialog>
        <div slot="footer" class="dialog-footer">
            <el-button type="primary" @click="innerVisible = true">更多</el-button>
            <el-button @click="Message_outerVisible1 = false">取 消</el-button>
            <el-button @click="message_outer_next1()">我知道了(打开下一个)</el-button>

        </div>
    </el-dialog>

    <!--第二个弹窗-->
    <el-dialog title="外层 Dialog" :visible.sync="Message_outerVisible2">
        <el-alert
                title="紧急通告"
                type="info"
                :description="message.type_3[0].message"
                show-icon>
        </el-alert>

        <el-dialog
                width="30%"
                title="内层 Dialog中间弹出的相当于把所有的页面都消息放在一起"
                :visible.sync="innerVisible"
                append-to-body>
        </el-dialog>
        <div slot="footer" class="dialog-footer">
            <el-button type="primary" @click="innerVisible = true">更多</el-button>
            <el-button @click="Message_outerVisible1 = false">取 消</el-button>
            <el-button @click="message_outer_next2()">我知道了(打开下一个)</el-button>

        </div>
    </el-dialog>

    <!--第二个弹窗结束-->

    <!--第三个弹窗-->
    <el-dialog title="外层 Dialog" :visible.sync="Message_outerVisible3">
        <el-alert
                title="紧急通告"
                type="info"
                :description="message.type_2[0].message"
                show-icon>
        </el-alert>

        <el-dialog
                width="30%"
                title="内层 Dialog中间弹出的相当于把所有的页面都消息放在一起"
                :visible.sync="innerVisible"
                append-to-body>
        </el-dialog>
        <div slot="footer" class="dialog-footer">
            <el-button type="primary" @click="innerVisible = true">更多</el-button>
            <el-button @click="Message_outerVisible1 = false">取 消</el-button>
            <el-button @click="message_outer_next3()">我知道了(打开下一个)</el-button>

        </div>
    </el-dialog>
    <!--第三个弹窗结束-->


    <!--第四个弹窗-->
    <el-dialog title="外层 Dialog" :visible.sync="Message_outerVisible4">
        <el-alert
                title="紧急通告"
                type="info"
                :description="message.type_1[0].message"
                show-icon>
        </el-alert>

        <el-dialog
                width="30%"
                title="内层 Dialog中间弹出的相当于把所有的页面都消息放在一起"
                :visible.sync="innerVisible"
                append-to-body>
        </el-dialog>
        <div slot="footer" class="dialog-footer">
            <el-button type="primary" @click="innerVisible = true">更多</el-button>
            <el-button @click="Message_outerVisible1 = false">取 消</el-button>
            <el-button @click="message_outer_next4()">我知道了(打开下一个)</el-button>

        </div>
    </el-dialog>
    <!--第四个弹窗结束-->
    </div>
</template>

<script>
    //20180219　引入开始的提示
    import {MESSAGES} from './../../../../../../../public/static/data/message.js'


    export default {
        name: "lay_important",
        data () {
            return {
            //　20180219 最开始的消息弹出开始
            Message_outerVisible1: true,
                Message_outerVisible2: false,
                Message_outerVisible3: false,
                Message_outerVisible4: false,
                innerVisible: false,
                message: [],
            }
        },
        methods: {
            getMessage() {
                // 真实环境通过　ajax 获取，这里用异步模拟
                setTimeout(() => {
                    //1. 获取数据
                    this.message = MESSAGES;
                }, 500);
                // console.log(MESSAGES);
                // alert(MESSAGES);

            },

            // 20180219 最开始的消息弹出
            handleClose(done) {
                this.$confirm('确认关闭？')
                    .then(_ => {
                        done();
                    })
                    .catch(_ => {});
            },
            // 打开下一个弹窗
            message_outer_next1() {
                alert(1);
                this.Message_outerVisible1=false;
                this.Message_outerVisible2=true;
                this.Message_outerVisible3=false;
                this.Message_outerVisible4=false;
            },
            message_outer_next2() {
                alert(2);
                this.Message_outerVisible1=false;
                this.Message_outerVisible2=false;
                this.Message_outerVisible3=true;
                this.Message_outerVisible4=false;
            },
            message_outer_next3() {
                alert(3);
                this.Message_outerVisible1=false;
                this.Message_outerVisible2=false;
                this.Message_outerVisible3=false;
                this.Message_outerVisible4=true;
            },
            message_outer_next4() {
                alert(4);
                this.Message_outerVisible1=false;
                this.Message_outerVisible2=false;
                this.Message_outerVisible3=false;
                this.Message_outerVisible4=false;
            }

            // 20180219 最开始的消息弹出结束
        },
        mounted () {
            //　20180219 开始遍历页面 这里开始获取首页弹出的的消息
            // 1.获取数据并且将数据放入
            this.getMessage();




            //　20180219 开始遍历页面 结束
        }
    }
</script>

<style scoped>

</style>