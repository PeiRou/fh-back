<template>
    <!-- 聊天室 -->
    <div class="chatbar" v-bind:class="{ chatWin:isChatWin  }">
        <!-- 聊天室外部 -->
        <div class="guide" v-if="chatIsTrue" @click="login">
            <a class="lnk-min"></a>
        </div>
        <!-- 聊天室内部 -->
        <div class="chatwin type-normal" v-if="!chatIsTrue">
            <div style="width: 100%;height: 100%;">
                <!--<span @click="changeChat" style="display: block; height: 2%;">×</span>-->
                <div>
                    <div class="chat-header">
                        <i class="iconfont icon-home-2" ></i>
                        <span class="title"> 聊天室</span>
                        <span style="position: absolute; right: 8px; top:9px;">
                          <a href="javascript:void(0)" @click="profile.profileDialog=true"><i class="icon iconfont icon-user-manage"></i></a>
                          <a href="javascript:void(0)" @click="isChatWin = !isChatWin"><i class="icon iconfont icon-quxiaohebingdanyuange"></i></a>
                          <a href="javascript:void(0)" @click="window.open('https://www.baidu.com')" ><i class="icon iconfont icon-icon_share"></i></a>
                          <a href="javascript:void(0)" @click="changeChat" ><i class="icon iconfont icon-close"></i></a>
                      </span>
                    </div>
                    <avatarUpload ref='avatarUpload' field="avatar"
                                  @crop-success="cropSuccess"
                                  @crop-upload-success="cropUploadSuccess"
                                  @crop-upload-fail="cropUploadFail"
                                  v-model="profile.show"
                                  :width="100"
                                  :height="100"
                                  url="chat/avatarUpload"
                                  :headers="profile.headers"
                                  img-format="png">
                    </avatarUpload>
                    <div class="profile" v-show="profile.profileDialog">
                        <div class="inner" style="animation-duration: 0.3s;">
                            <div class="avatar" @mouseenter="userAvatarHover" @mouseleave="userAvatarHover">
                                <img :src="chatUser.avatar"  alt="">
                                <label v-show="profile.avatarHover" for="avatarUploadInput" class="upload-avatar">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4273" style="width: 1em; height: 1em; vertical-align: middle; fill: currentcolor; overflow: hidden;">
                                        <path d="M118.265544 941.074336c-29.634948 0-53.766554-24.131607-53.766554-53.766554L64.49899 493.587652c0-29.634948 10.582009-51.921533 40.216957-51.921533s39.211047 22.285562 39.211047 51.921533l0 368.036167 736.108151 0L880.035144 493.587652c0-29.634948 8.252964-53.766554 37.917588-53.766554 29.634948 0 41.548278 24.131607 41.548278 53.766554l0 393.72013c0 29.635971-24.131607 53.766554-53.766554 53.766554L118.265544 941.074336zM745.824443 316.793086 554.50507 316.793086 554.50507 646.057205c0 29.664623-12.884448 53.795207-42.519396 53.795207-29.634948 0-42.528606-24.131607-42.528606-53.795207L469.457068 316.793086 278.145881 316.793086 511.985674 82.925664 745.824443 316.793086z" p-id="4274"></path>
                                    </svg>
                                    <input type="file" id="avatarUploadInput"  @change="userAvatarUpload" accept=".jpg, .png, .gif, .jpeg, image/jpeg, image/png, image/gif" style="width: 0.1px; height: 0.1px; opacity: 0; top: -20px;">
                                </label>
                            </div>
                            <p style="font-size: 12px; color: rgb(255, 127, 77);">(您还未设置头像, 请点击头像上传)</p>
                            <p>
                                <span class="txt-nick">wr***00</span>
                                <a href="javascript:void(0)" @click="userNick" style="font-size: 20px;">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="848" style="width: 1em; height: 1em; vertical-align: middle; fill: currentcolor; overflow: hidden;">
                                        <path d="M662.118 199.375s39.353-36.134 41.693-38.476c2.342-2.34 53.545-47.254 119.23 5.852 15.8 13.75 81.047 77.097 49.594 134.885-8.192 12.142-15.8 18.433-53.106 55.446-7.461-7.461-157.414-157.706-157.414-157.706zM598.041 262.283l157.267 157.703-355.352 357.692-31.891 28.381s-11.849 13.021-45.498 25.895c-33.647 13.021-82.656 31.308-140.442 44.182-16.531 2.34-46.084 7.606-42.426-30.137 3.51-37.744 27.796-102.697 41.256-144.538 17.116-39.502 30.136-51.35 54.275-76.658 24.284-25.311 362.809-362.518 362.809-362.518zM650.707 803.719h75.487v74.317h-75.487v-74.317zM496.951 803.719h75.488v74.317h-75.488v-74.317zM804.462 803.719h75.489v74.317h-75.489v-74.317z" p-id="849"></path>
                                    </svg>
                                </a>
                            </p>
                            <!--<p>当前等级: <img src="assets/icon_member0null.gif" alt=""></p>-->
                            <!--<loading>-->
                            <p>
                                <a href="javascript:void(0)" @click="profile.profileDialog=false" class="u-btn1">关闭</a>
                            </p>
                            <!--</loading>-->
                        </div>
                    </div>




                    <div class="center">

                        <div  id="content"  ref="content"  >
                            <div v-for="(item,index) in items" :key="index" >
                                <!--计划任务-->
                                <div class="item type-left" v-if="item.type==='chat-system' && item.schedule==='pk10' " v-show="schedule_type.schedule_pk10">
                                    <div class="avatar">
                                        <img src="/chat/imgs/sys.png" alt="">
                                    </div>
                                    <div class="msg-content">
                                        <div class="content-header">
                                            <h4>计划消息</h4>
                                            <span class="content-time">
                                    {{item.date}}
                                </span>
                                        </div>
                                        <div class="Bubble type-system" v-html="item.content"  ></div>
                                    </div>
                                </div>
                                <div class="item type-left" v-if="item.type==='chat-system' && item.schedule==='cqssc' " v-show="schedule_type.schedule_cqssc">
                                    <div class="avatar">
                                        <img src="/chat/imgs/sys.png" alt="">
                                    </div>
                                    <div class="msg-content">
                                        <div class="content-header">
                                            <h4>计划消息</h4>
                                            <span class="content-time">
                                    {{item.date}}
                                </span>
                                        </div>
                                        <div class="Bubble type-system" v-html="item.content"  ></div>
                                    </div>
                                </div>
                                <div class="item type-left" v-if="item.type==='chat-system' && item.schedule==='mssc' " v-show="schedule_type.schedule_mssc">
                                    <div class="avatar">
                                        <img src="/chat/imgs/sys.png" alt="">
                                    </div>
                                    <div class="msg-content">
                                        <div class="content-header">
                                            <h4>计划消息</h4>
                                            <span class="content-time">
                                    {{item.date}}
                                </span>
                                        </div>
                                        <div class="Bubble type-system" v-html="item.content"  ></div>
                                    </div>
                                </div>
                                <!--计划任务-->

                                <!--新红包-->
                                <div class="item type-left" v-else-if="item.type==='chat-packet'">
                                    <div class="avatar">
                                        <img src="/chat/imgs/packavatar.jpg" alt="">
                                    </div>
                                    <div class="msg-content">
                                        <div class="content-header">
                                            <h4 style="color: rgb(245, 0, 0);">新红包</h4>
                                            <span class="content-time">{{item.date}}</span>
                                        </div>
                                        <div class="Bubble type-system" style="background: rgb(253, 85, 85); border-right-color: rgb(253, 85, 85);">
                                            <div class="RedPack desc" style="text-align: center;">
                                                <p>机会难得，别错过哦！</p>
                                                <a href="javascript:void(0)" v-on:click="showPacket(item.id)" class="RBtn txt-t5">
                                                    拆开看看
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--红包-->

                                <!--历史消息提示框-->
                                <div class="SysMsg"  v-else-if="item.type==='SysMsg'">
                                    <div class="inner">
                                        <p>以上是历史消息</p>
                                    </div>
                                </div>
                                <!--历史消息提示框-->
                                <!--修改用户昵称 上传头像-->
                                <div class="SysMsg"  v-else-if="item.type==='UserNickSysMsg'"  >
                                    <div class="inner Txt type-warning">
                                        <p>
                                            <i class="iconfont icon-icwarming" ></i>
                                            您尚未设置昵称, 点击
                                            <a href="javascript:void(0)"  @click="userNick" style="color: rgb(25, 158, 216);">这里</a>
                                            设置
                                        </p>
                                        <p>昵称设置过后将无法再次更改哦</p>
                                    </div>
                                </div>
                                <div class="SysMsg"  v-else-if="item.type==='UserAvatarSysMsg'"  >
                                    <div class="inner Txt type-warning">
                                        <p>
                                            <i class="iconfont icon-icwarming" ></i>
                                            您可以上传自己的头像啦,点击
                                            <a href="javascript:void(0)" @click="profile.profileDialog=true" style="color: rgb(25, 158, 216);">这里</a>
                                            设置
                                        </p>
                                    </div>
                                </div>
                                <!--修改用户昵称 上传头像 end-->


                                <!--发言-->
                                <div  class="item " v-else-if="item.type==='msg'" v-bind:class="{'type-left':item.type_left, 'type-right':item.type_right}" >
                                    <div class="avatar">
                                        <img v-bind:src="item.imgSrc" alt="">
                                    </div>
                                    <div class="msg-content">
                                        <div class="content-header">
                                            <h4>{{item.name}}</h4>
                                            <span style="margin-top: 15px !important">
                                            <img v-bind:src="item.levelSrc" alt="">
                                            </span>
                                            <span class="content-time" style="margin-top: 15px !important">
                                                {{item.date}}
                                          </span>
                                        </div>
                                        <div class="Bubble">
                                            <p v-if="item.sendSrc">
                                                <a  :href="item.sendSrc" :data-lightbox="index" data-title=""  >
                                                    <img width="200"  v-bind:src="item.sendSrc" >
                                                </a>
                                            </p>
                                            <span v-html="item.content"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--发言-->
                            </div>
                        </div>

                        <!--滚屏 清屏-->
                        <div class="controls" style="top: 73px;">
                            <a v-on:click="scroll" href="javascript:void(0)" class="ListCtrl active">
                                <i class="icon iconfont icon-zhishikuguanli zhishikuguanli" ></i>
                                滚屏
                            </a>
                            <a v-on:click="clean" href="javascript:void(0)" class="ListCtrl">
                                <i class="icon iconfont icon-lajitong" ></i>
                                清屏
                            </a>
                        </div>
                        <!--滚屏 清屏 end-->

                        <!--公告-->
                        <div class="announce">
                            <div class="ttl">
                                <i class="iconfont icon-gonggao"></i>
                                公告:
                            </div>
                            <div class="scroll">
                                <marquee scrollamount="3">
                                    <ol>
                                        <li v-for="(bullet,index) in bullets">{{bullet}}</li>
                                    </ol>
                                </marquee>
                            </div>
                        </div>
                        <!--公告 end-->

                        <!--bottom div 表情栏，输入框 class="emoji_box" -->
                        <div class="compose" v-bind:class="{ left_5:isChatWin  }" >
                            <!--表情栏-->
                            <div class="control-bar">
                                <el-popover ref="emoji_popover" placement="top-start" width="204" trigger="click">
                                    <div >
                                        <div class="emoji-container">
                                            <i  v-bind:class="emojiClass(item.class)" @click="emoji(item.emoji_u)" v-for="(item,index) in emojis" ></i>
                                        </div>
                                    </div>
                                </el-popover>
                                <el-button class="btn-control" :disabled="!platcfg.is_open"  v-popover:emoji_popover><i class="icon iconfont icon-biaoqing"></i></el-button>
                                <label for="imgUploadInput" >
                                    <span title="上传图片" class="btn-control" >
                                        <i class="icon iconfont icon-img"></i>
                                        <input id="imgUploadInput" :disabled="!platcfg.is_open"  @change="upload" type="file" accept=".jpg, .png, .gif, .jpeg, image/jpeg, image/png, image/gif" style="width: 0.1px; height: 0.1px; opacity: 0; position: absolute;top: 0;left: 50px;">
                                    </span>
                                </label>
                                <el-popover ref="schedule_popover" placement="top-start" trigger="click">
                                    <div style="margin-top: 5px" >
                                        <el-checkbox-group  v-model="checkedSchedule" size="small" @change="handleCheckedScheduleChange" >
                                            <el-checkbox v-for="(schedule,index) in schedules" border :label="schedule" :key="index" >{{schedule}}</el-checkbox>
                                        </el-checkbox-group>
                                    </div>
                                </el-popover>
                                <el-button class="btn-control" :disabled="!platcfg.is_open"  v-popover:schedule_popover>计划</el-button>
                            </div>
                            <!--表情栏 end-->

                            <!--输入框-->
                            <div class="typing">
                                <div class="txtinput el-textarea ">
                                    <textarea @keyup.enter.prevent="enterSend($event)" :disabled="!platcfg.is_open"  v-model="message" v-on:paste="paste" placeholder="发言条件：前两天充值不少于10元；打码量不少于10元" type="textarea"  rows="2" autocomplete="off"  class="el-textarea__inner" style="height: 54px;"></textarea>
                                </div>
                                <div  class="sendbtn"   v-on:click="send" >
                                    <a href="javascript:void(0)"  class="u-btn1">发送</a>
                                </div>
                            </div>
                            <!--输入框 end-->

                            <div class="el-dialog__wrapper" style="display: none;">
                                <div class="el-dialog el-dialog--small chat-send-image" style="top: 15%;">
                                    <div class="el-dialog__header"><span class="el-dialog__title">发送图片</span>
                                        <button type="button" aria-label="Close" class="el-dialog__headerbtn">
                                            <i class="el-dialog__close el-icon el-icon-close"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--bottom div 表情栏，输入框 end-->

                        <!-- 图片 dialog --->
                        <div class="dialog">
                            <el-dialog title="发送图片" :before-close="dialogHandleClose" :visible.sync="sendImgVisible"  :modal-append-to-body="false">
                                <el-form :model="form">
                                    <el-form-item >
                                        <p class="tc">
                                            <img v-bind:src="form.imgUrl" alt="">
                                        </p>
                                    </el-form-item>
                                    <el-form-item >
                                        <p class="tc">
                                            <el-input v-model="form.note" autofocus auto-complete="off" placeholder="图片附言"></el-input>
                                        </p>
                                    </el-form-item>
                                </el-form>
                                <p class="tc sendbtn"  >
                                    <a  v-on:click="sendImg"  href="javascript:void(0)"  class="u-btn1">发送</a>
                                </p>
                            </el-dialog>
                        </div>
                        <!--图片 dialog end-->

                        <!--红包动画-->
                        <div id="packet" style="display: block" v-show="showPacketDialog">
                            <div class="money"></div>
                            <div class="redPack" :class="{disnone:redPackDisNone}">
                                <div class="cover">
                                    <p>恭喜發財 大吉大利</p>
                                </div>
                                <div class="sticker" @click="getPacket">
                                    <span>拆红包</span>
                                </div>
                            </div>
                            <div class="open" :class="{disblo:redPackDisNone}" >
                                <p>恭喜您中了{{packet_money}}</p>
                            </div>
                        </div>
                        <!--红包动画-->
                    </div>
                </div>
            </div>

        </div>


    </div>
</template>

<script>

    const  $  = require('jquery')
        // io = require('this.socket.io-client'),
        // this.socket = io(':6003'),
    ;

    // const  user = parseInt(Math.random()*10000);
    import { Notification } from 'element-ui';
    import { Message } from 'element-ui';
    import imgUpload from 'vue-image-crop-upload';



    /**lightbox2  js and css **/
    import 'lightbox2/dist/css/lightbox.min.css';
    import  lightbox  from 'lightbox2';
    // lightbox.option({
    //     'resizeDuration': 200,
    //     'wrapAround': true,
    //     'positionFromTop':'30%',
    //     'maxWidth':'60%',
    //     'maxHeight':'60%',
    //     'fadeDuration':700,
    //     'showImageNumberLabel':false,
    //     'alwaysShowNavOnTouchDevices':true,
    // });
    /**lightbox2  js and css end**/




    export default  {
        components: {
            avatarUpload: imgUpload
        },
        data(){
            return{
                isChatWin:false,   //调节聊天室宽度
                chatUser:{
                    username:'',
                    avatar:'',
                    chatRole:'',
                },
                chatIsTrue : true,
                // avatar_img:'chat/imgs/avatar.png',
                chat_system:true,
                checkedSchedule: [],
                schedules:[],
                schedule_type: {
                    schedule_pk10: true,
                    schedule_mssc: true,
                    schedule_cqssc: true,
                },
                items:[],           //消息记录
                message:'',         //消息
                packet_id:'',
                packet_money:'',
                text_disables:'',
                bullets:{},
                sendImgVisible: false,
                emojiVisible: false,
                showPacketDialog:false,
                setTimeoutHandler:null,
                redPackDisNone:false,
                emojis:[
                    {'class':'emoji-smile', 'emoji_u':'😄'},
                    {'class':'emoji-laughing', 'emoji_u':'😆'},
                    {'class':'emoji-blush', 'emoji_u':'😊'},
                    {'class':'emoji-heart_eyes', 'emoji_u':'😍'},
                    {'class':'emoji-smirk', 'emoji_u':'😏'},
                    {'class':'emoji-flushed', 'emoji_u':'😳'},
                    {'class':'emoji-grin', 'emoji_u':'😁'},
                    {'class':'emoji-kissing_smiling_eyes', 'emoji_u':'😚'},
                    {'class':'emoji-wink', 'emoji_u':'😉'},
                    {'class':'emoji-kissing_closed_eyes', 'emoji_u':'😘'},
                    {'class':'emoji-stuck_out_tongue_winking_eye', 'emoji_u':'😜'},
                    {'class':'emoji-sleeping', 'emoji_u':'😪'},
                    {'class':'emoji-worried', 'emoji_u':'😔'},
                    {'class':'emoji-sweat_smile', 'emoji_u':'😅'},
                    {'class':'emoji-cold_sweat', 'emoji_u':'😰'},
                    {'class':'emoji-joy', 'emoji_u':'😂'},
                    {'class':'emoji-sob', 'emoji_u':'😭'},
                    {'class':'emoji-angry', 'emoji_u':'😠'},
                    {'class':'emoji-mask', 'emoji_u':'😷'},
                    {'class':'emoji-scream', 'emoji_u':'😱'},
                    {'class':'emoji-sunglasses', 'emoji_u':'😎'},
                    {'class':'emoji-thumbsup', 'emoji_u':'👍'},
                    {'class':'emoji-clap', 'emoji_u':'👏'},
                    {'class':'emoji-ok_hand', 'emoji_u':'👌'},
                ],
                emojiReg:"😄|😆|😊|😍|😏|😳|😁|😚|😉|😘|😜|😪|😔|😅|😰|😂|😭|😠|😷|😱|😎|👍|👏|👌",
                emojiMap:{"😄":"emoji-smile","😆":"emoji-laughing","😊":"emoji-blush","😍":"emoji-heart_eyes","😏":"emoji-smirk","😳":"emoji-flushed","😁":"emoji-grin",
                    "😚":"emoji-kissing_smiling_eyes","😉":"emoji-wink","😘":"emoji-kissing_closed_eyes","😜":"emoji-stuck_out_tongue_winking_eye","😪":"emoji-sleeping","😔":"emoji-worried",
                    "😅":"emoji-sweat_smile","😰":"emoji-cold_sweat","😂":"emoji-joy","😭":"emoji-sob","😠":"emoji-angry","😷":"emoji-mask","😱":"emoji-scream","😎":"emoji-sunglasses",
                    "👍":"emoji-thumbsup","👏":"emoji-clap","👌":"emoji-ok_hand"},
                form: {
                    imgUrl: '',
                    note: '',
                    file:{},
                },
                platcfg:{
                    is_open:true,
                },
                profile:{
                    show: false,
                    headers: {
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    avatarHover : false,
                    profileDialog : false,
                },
            }
        },
        methods:{
            login:function(){
                let _this = this;
                _this.chatIsTrue = !_this.chatIsTrue;
                window.axios.post('chat/login').then(function (response) {
                    let res = response.data;
                    if(res.is_auto==="1"){ //是否自动展开聊天室  false 为自动展开
                        /**判断下注最低推送额**/
                        _this.chatIsTrue = false;
                    }
                    if(res.code===-1){       //聊天室已关闭
                        _this.platcfg.is_open = false;
                        _this.$message.error(res.msg);
                        return ;
                    }

                    /**用户信息**/
                    _this.chatUser.username = res.user.username;
                    _this.chatUser.avatar   = res.user.avatar;
                    _this.chatUser.chatRole = res.user.chatRole;

                    // _this.text_disables = eval('/'+res.disables+'/gi');
                    _this.text_disables = new RegExp(res.disables,'gi');   //违禁词
                    _this.bullets   = res.bullets;                           //公告
                    _this.schedules = res.schedules;
                    _this.checkedSchedule = res.schedules;
                    for(var i=0 ; i<res.messages.length; i++) {
                        _this.items.push(JSON.parse(res.messages[i]));
                    }
                    if(_this.items.length>0){
                        _this.items.push({type:'SysMsg'});
                    }
                    _this.items.push({type:'UserNickSysMsg'});
                    _this.items.push({type:'UserAvatarSysMsg'});
                }).catch(function (error) {
                    console.log(error);
                });

                this.socket.on('welcome',function(data){
                    if(this.chatUser.username!=data){
                        Notification({
                            message: '欢迎游客'+data+'进入聊天室',
                            showClose: false,
                            duration: 1000
                        });
                    }
                });

                /*message channel*/
                this.socket.on('message',function (data) {
                    let msg = {
                        name:this.chatUser.username,
                        imgSrc:this.chatUser.avatar,
                        levelSrc:'/chat/imgs/icon_member03.gif',
                        sendSrc:data.imgUrl,
                        date:data.date,
                        type:data.type,
                        content:data.message,
                    };
                    if(this.chatUser.username == data.uid){
                        msg.type_right = true;
                        msg.type_left  = false;
                    }else{
                        msg.type_right = false;
                        msg.type_left  = true;
                    }
                    this.items.push(msg);
                });

                /**redis channel**/
                this.socket.on('chat-room',function (data) {
                    console.log(data)
                });
                this.socket.on('chat-packet',function (data) {
                    this.items.push({
                        type:'chat-packet',
                        date:data.date,
                        id:data.data,
                    });
                });
                this.socket.on('chat-system',function (data) {
                    this.items.push({
                        type:'chat-system',
                        date:data.date,
                        schedule:data.schedule,
                        content:data.content,
                    });
                });
            },
            send:function (){
                let _this = this;
                //_this.message = _this.message.replace(/(\r\n)|(\n)/g, "");    //过滤换行
                if(_this.message.replace(/(^\s*)|(\s*$)|(\r\n)|(\n)/g, "")==''){  // /(^\s*)|(\s*$)/g    // 过滤空格 ,过滤换行
                    return false;
                }
                let _m  = _this.message.replace(new RegExp(_this.emojiReg,'gi'),function(index){
                    return "<i class='emoji "+_this.emojiMap[index]+" '></i>";
                });
                let data = {
                    message:_m.replace(_this.text_disables, function(sMatch){
                        return sMatch.replace(/./g,"*");
                    }),
                    uid:_this.chatUser.username,
                };
                this.socket.emit('message',data);
                _this.message = '';
            },
            enterSend:function(e){
                let _this = this;
                if(e.keyCode === 13){
                    e.cancelBubble=true;
                    e.preventDefault();
                    e.stopPropagation();
                    _this.send();
                }
            },
            clean:function (){
                this.items = [];
            },
            scroll:function (){
                this.$nextTick(function(){
                    document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
                })
            },
            paste:function(e){
                let _this = this;
                if (((e.clipboardData  || e.originalEvent )&& e.clipboardData.items)) {
                    if(e.clipboardData.items[0].kind == 'file'){    //  e.clipboardData.items[0].type =  image/png
                        _this.form.file         = e.clipboardData.items[0].getAsFile();
                        _this.form.imgUrl       = _this.createObjURL(_this.form.file);
                        _this.sendImgVisible = true;
                    }
                }
            },
            emoji:function(index){
                let _this = this;
                _this.message += index;
                _this.emojiVisible = false;
                $('textarea').focus();
            },
            upload:function(e){
                let _this = this,
                    files = e.target.files || e.dataTransfer.files;
                _this.form.file         = files[0];
                _this.form.imgUrl       = _this.createObjURL(files[0]);
                _this.sendImgVisible = true;
            },
            dialogHandleClose:function(done){
                let _this         = this ;
                _this.form.imgUrl = '';
                _this.form.note   = '';
                done();
            },
            createObjURL:function(obj){
                let blobUrl = null;
                if (window.createObjectURL != undefined) { // basic
                    blobUrl = window.createObjectURL(obj) ;
                } else if (window.URL!=undefined) { // mozilla(firefox)
                    blobUrl = window.URL.createObjectURL(obj) ;
                } else if (window.webkitURL!=undefined) { // webkit or chrome
                    blobUrl = window.webkitURL.createObjectURL(obj) ;
                }
                return blobUrl;
            },
            sendImg:function(){
                let _this = this;
                let _form = new FormData();
                _form.append("file", _this.form.file);
                _form.append("note", _this.form.note);
                if(_this.form.imgUrl!=''){
                    window.axios.post('chat/upload',_form).then(function (response) {
                        let data = response.data;
                        let _data = {
                            message:data.message,
                            imgUrl:data.imgUrl,
                            uid:user,
                        };
                        this.socket.emit('message',_data);
                        _this.form.imgUrl = '';
                        _this.form.note   = '';
                        _this.sendImgVisible = false;
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            showPacket:function(id){
                let _this = this;
                _this.packet_id = id;
                _this.redPackDisNone    = false;
                _this.showPacketDialog  = true;
                _this.setTimeoutHandler = _this.setTimeout();
            },
            setTimeout:function () {
                setTimeout(() => {
                    this.showPacketDialog = false;
                }, 5000);
            },
            getPacket:function(){
                let _this = this;
                window.axios.post('chat/getPacket', { packet: _this.packet_id}).then(function (response) {
                    let res = response.data;
                    if(res.code===0){
                        _this.redPackDisNone = true;
                        _this.packet_money   = res.money;
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            emojiClass: function (index) {
                return 'emoji '+index;
            },
            handleCheckedScheduleChange:function(val){
                var diff = this.schedules.filter(key => !val.includes(key));
                for(var i=0; i<diff.length; i++){
                    if(diff[i]==='北京赛车'){
                        this.schedule_type.schedule_pk10 = false;
                    }
                    if(diff[i]==='秒速赛车'){
                        this.schedule_type.schedule_mssc = false;
                    }
                    if(diff[i]==='重庆时时彩'){
                        this.schedule_type.schedule_cqssc = false;
                    }
                }
                for(var j=0; j<val.length; j++){
                    if(val[j]==='北京赛车'){
                        this.schedule_type.schedule_pk10 = true;
                    }
                    if(val[j]==='秒速赛车'){
                        this.schedule_type.schedule_mssc = true;
                    }
                    if(val[j]==='重庆时时彩'){
                        this.schedule_type.schedule_cqssc = true;
                    }
                }
            },
            userNick(){
                this.$prompt('请输入昵称, 昵称设置后将无法更改', '修改昵称', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    inputPattern:/^\S+$/,
                    inputErrorMessage: '昵称格式不正确'
                }).then(({ value }) => {
                    window.axios.post('chat/updateUserNick',{nick:value}).then(function (response) {
                        let res = response.data;
                        if(res.code===0){
                            Message({
                                message: '修改成功！',
                                type: 'success'
                            });
                        }else {
                            Message({
                                message: '修改失败！',
                                type: 'error'
                            });
                        }

                    }).catch(function (error) {
                        console.log(error);
                    });
                }).catch(() => {

                });
            },
            userAvatarUpload(e) {
                let _this = this,
                    files = e.target.files || e.dataTransfer.files;
                _this.$refs.avatarUpload.setSourceImg(files[0]);
                _this.profile.show = true;
            },
            userAvatarHover:function(){
                this.profile.avatarHover = !this.profile.avatarHover
            },
            /* crop success  [param] imgDataUrl   [param] field */
            cropSuccess(imgDataUrl, field){
                // this.aUpload.imgDataUrl = imgDataUrl;
            },
            /* upload success [param] jsonData   服务器返回数据，已进行json转码  [param] field */
            cropUploadSuccess(jsonData, field){
                _this.$refs.avatarUpload.off();
                // off() {
                //     setTimeout(()=> {
                //         this.$emit('input', false);
                //         if(this.step == 3 && this.loading == 2){
                //             this.setStep(1);
                //         }
                //     }, 200);
                // },
            },
            /* upload fail [param] status    server api return error status, like 500  [param] field */
            cropUploadFail(status, field){
                _this.$refs.avatarUpload.off();
            },
            changeChat(){
                this.chatIsTrue = !this.chatIsTrue;
                this.isChatWin  = false;
            }
        },
        mounted () {

        },
        watch: {
            items:function(){

                this.$nextTick(function(){
                    document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
                })
            }
        },
    };
</script>

<style scoped>

    .chatbar {
        position: fixed;
        right: 0;
        top: 0;
        height: calc(100% - 30px);
        max-height: 1080px;
        padding-left: 6px;
        z-index: 200;
    }

    /* 聊天室外部样式 */
    .chatbar .guide {
        position: absolute;
        top: 38%;
        right: 2px;
        padding-left: 6px;
    }

    .skin_blue .chatbar .guide .lnk-min {
        width: 40px;
        height: 152px;
        margin-top: 20px;
        background: url('/static/game/images/chatbar/chat_float_blue.png') no-repeat;
        background-size: 100% auto;
        display: block;
        cursor: pointer;
    }
    .skin_red .chatbar .guide .lnk-min {
        width: 40px;
        height: 152px;
        margin-top: 20px;
        background: url('/static/game/images/chatbar/chat_float_red.png') no-repeat;
        background-size: 100% auto;
        display: block;
        cursor: pointer;
    }
    /* 聊天室内部样式 */
    .chatbar .chatwin.type-normal {
        width: 310px;
        padding-left: 2px;
    }
    .chatWin {
        width: 400px !important;
        padding-left: 0px;
        background-color: #2161b3;
    }
    .left_5{
        left: 5px !important;
    }
    .chatbar .chatwin {
        height: 100%;
        background: #2161b3;
    }
    .chatbar .chatwin.type-normal {
        width: 310px;
    }
    .skin_blue .chatbar .chatwin {
        height: 100%;
        background: #2161b3;
    }
    .skin_red .chatbar .chatwin {
        height: 100%;
        background: #bb445a;
    }


    /***el*/
    /*
    .el-notification {
    display: flex;
    width: 330px;
    padding: 14px 26px 14px 13px;
    border-radius: 8px;
    box-sizing: border-box;
    border: 1px solid #ebeef5;
    position: fixed;
    background-color: #fff;
    box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
    transition: opacity .3s,transform .3s,left .3s,right .3s,top .4s,bottom .3s;
    overflow: hidden;
    }
    .el-notification__content {
    font-size: 14px;
    line-height: 21px;
    margin: 6px 0 0;
    color: #606266;
    text-align: justify;
    }
    .el-notification__group {
    margin-left: 13px;
    }
    .el-notification.right {
    right: 16px;
    }
    */
    .el-notification{
        top:90px ! important;
        display: flex;
        width: 150px;
        padding: 2px;
        border: 1px solid #f44336;
        position: fixed;
        border-radius: 0px;
        /*transition: opacity .3s,transform .3s,left .3s,right .3s,top .4s,bottom .3s;*/
        overflow: hidden;
        background:#f44336;
        background:-webkit-linear-gradient(left,#f44336,#f97619);
        background:-moz-linear-gradient(left,#f44336,#f97619);
        background:-ms-linear-gradient(left,#f44336,#f97619);
        background:-o-linear-gradient(left,#f44336,#f97619);
        background:linear-gradient(to right,#f44336,#f97619);
        opacity:.75;
        text-align:right;
        z-index:100;
    }
    .el-notification__group {
        margin-left: 10px;
    }
    .el-notification.right {
        right: 0;
    }
    .el-notification__content {
        font-size: 12px;
        line-height: 16px;
        margin: 6px 0 4px 0;
        color: #fff;
        text-align: justify;
    }

    /*body{*/
    /*font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;*/
    /*overflow-y: hidden;*/
    /*margin:0;*/
    /*padding:0;*/
    /*height:100%;*/
    /*}*/
    p{
        margin: 0;
    }
    a:-webkit-any-link {
        cursor: pointer;
        text-decoration: none;
    }
    ::-webkit-scrollbar {
        width: 5px;
    }
    ::-webkit-scrollbar-thumb {
        border-radius: 5px;
        background-color: #9d9d9d;
    }
    ol ul{
        list-style: none;
    }
    li{
        display: list-item;
        text-align: -webkit-match-parent;
        line-height: 20px;
        font-size: 12px;
        color: black;
    }
    .chat-header {
        width: 100%;
        min-height: 38px;
        background-color: #2161b3;
        /*background: #bb445a;*/
        padding: 0 14px;
    }
    .chat-header span a{
        color: white;
    }
    .title{
        display: inline-block;
        color: #fff;
        font-size: 15px;
        line-height: 38px;
        padding: 0 14px;
    }

    .center{
        width:100%;
        height: 100%;
        overflow: hidden;
    }
    .center .compose .typing .txtinput {
        display: block;
        width: auto;
        margin-right: 58px;
    }
    #content {
        width:100%;
        overflow: hidden;
        overflow-y: auto;
        background: url("/chat/imgs/bg.jpg") no-repeat right bottom ;
        background-size: 100% auto !important;
        box-sizing: border-box;
        background-attachment: fixed;
        background-color: #fffef9;
        border-left: 3px solid #2161b3;
        border-bottom: 1px solid #2161b3;
        position: absolute;
        bottom: 99px;
        top: 38px;
    }

    .center .item{
        margin-top: 30px;
        margin-bottom: 10px;
        padding: 5px 10px;
    }

    .center .avatar{
        width: 42px;
        height: 42px;
        margin-top: 6px;
        float: left;
    }
    .center .type-right .avatar{
        float: right;
    }

    .center .item .avatar img{
        display: block;
        width: 100%;
        height: 100%;
        border-radius: 7px;
    }
    .center .type-left .msg-content{
        margin-left: 57px;
        width: 77%;
    }

    .type-right {
        overflow: hidden;
    }
    .center .type-right .msg-content{
        width: 77%;
        margin-right:15px;
        float:right;
    }



    .center .item .msg-content .content-header{
        display: block;
        margin-bottom:-6px;
        margin-top:-8px;
    }

    .center .type-right .msg-content .content-header{
        display: block;
        margin-bottom:-6px;
        margin-top:-8px;
        overflow: hidden;
    }

    .center .item .msg-content .content-header h4{
        font-size: 12px;
        color: #4f77ab;
        display: inline-block;
        font-weight: 400;
        cursor: pointer;
    }

    .center .type-right .msg-content .content-header h4{
        float: right;
    }

    .center .item .msg-content .content-header span{
        display: inline-block;
        margin: 0 2px;
    }
    .center .type-right .msg-content .content-header span{
        float: right;
    }

    .center .item .msg-content .content-header img{
        vertical-align: middle;
    }

    .center .type-right .msg-content .content-header img{
        vertical-align: -moz-middle-with-baseline;
        margin: 0px 2px;
    }

    .content-time{
        display: inline-block;
        background: rgba(70,70,70,.12);
        color: #a0a0a0;
        padding: 0 6px;
        border-radius: 10px;
        font-weight: 400;
        font-size: 10px;
    }

    .center .type-right .msg-content .content-time{
        margin-top: 8px !important;
    }

    .Bubble.type-system {
        background: #ab47bc;
        background: -webkit-linear-gradient(left,#ab47bc,#5169DE);
        background: -moz-linear-gradient(left,#ab47bc,#5169DE);
        background: -ms-linear-gradient(left,#ab47bc,#5169DE);
        background: -o-linear-gradient(left,#ab47bc,#5169DE);
        background: linear-gradient(to right,#ab47bc,#5169DE);
        border-left-color: #5169de;
        border-right-color: #ab47bc;
    }
    .Bubble {
        position: relative;
        color: #fff;
        background: #199ed8;
        border-left-color: #199ed8;
        border-right-color: #199ed8;
        border-radius: 5px;
        padding: 6px 9px;
        font-size: 13px;
        line-height: 1.2;
        display: inline-block;
        text-shadow: 0 0 1px #35406d;
    }
    .Bubble:after {
        content: '';
        position: absolute;
        top: 14px;
        width: 0;
        height: 0;
        border: 9px solid transparent;
        border-top: 0;
        margin-top: -7px;
    }


    .type-left .Bubble:after {
        left: 0;
        border-left: 0;
        margin-left: -9px;
        border-right-color: inherit;
    }
    .type-right .Bubble{
        float: right;
    }

    .type-right .Bubble:after {
        right: 0;
        border-right: 0;
        margin-right: -9px;
        border-left-color: inherit;
    }

    .RedPack {
        position: relative;
        box-sizing: border-box;
    }
    .RedPack .txt-t5 {
        font-size: 14px;
    }
    .RBtn {
        display: inline-block;
        border-radius: 3px;
        padding: 2px 5px;
        background: #f5c91f;
        background: -moz-linear-gradient(top,#f5c91f 0,#f5a61b 100%);
        background: -webkit-linear-gradient(top,#f5c91f 0,#f5a61b 100%);
        background: linear-gradient(to bottom,#f5c91f 0,#f5a61b 100%);
        font-size: 12px;
        color: #553216;
        border-radius: 5px;
        padding: 3px 10px;
        text-decoration: none!important;
    }
    .Bubble a {
        color: inherit;
        text-decoration: underline;
    }
    .center .controls{
        position: absolute;
        top: 3px;
        left: 0;
        width: 100%;
        text-align: center;
    }
    .controls {
        position: absolute;
        right: 0;
        top: 0;
        z-index: 200;
    }
    .center .controls a{
        text-decoration: none;
    }
    .center .controls .ListCtrl{
        margin:0 5px;
    }
    .ListCtrl{
        display: inline-block;
        background: #fff;
        border: 1px solid #e2e2e2;
        padding: 1px 9px;
        padding-left: 7px;
        border-radius: 15px;
        color: #a5a5a5;
        height: 22px;
        font-size: 14px;
    }
    .center .controls .ListCtrl.active {
        color: #ff9d6d;
    }
    .center .announce{
        position: absolute;
        top: 41px;
        left: 15px;
        right: 5px;
        background: rgba(237,244,254,.91);
        border: 1px solid #c2cfe2;
        border-radius: 5px;
        padding-right: 10px;
        height: 29px;
        overflow: hidden;
    }
    .center .announce .ttl{
        display: block;
        float: left;
        width: 60px;
        background: #e1edfd;
        color: red;
        padding: 6px 2px 5px 6px;
        font-size: 12px;
    }
    .center .announce .scroll{
        display: block;
        margin-left: 72px;
        padding-top: 5px;
        overflow: hidden;
    }
    .center .announce .scroll li{
        display: inline;
        margin-right: 10px;
    }
    marquee {
        display: inline-block;
        width: -webkit-fill-available;
    }


    .compose{
        background: #fffef9;
        position: absolute;
        width: 100%;
        bottom: 0;
        left: 11px;
    }
    .center .compose .control-bar {
        height: 36px;
        background: #f0f0f0;
        border: 1px solid #adadad;
        border-left: 0;
        border-right: 0;
        position: relative;
        z-index: 100;
    }
    .el-popover {
        position: absolute;
        background: #fff;
        min-width: 150px;
        border-radius: 2px;
        border: 1px solid #d1dbe5;
        padding: 10px;
        z-index: 2000;
        font-size: 12px;
        box-shadow: 0 2px 4px 0 rgba(0,0,0,.12), 0 0 6px 0 rgba(0,0,0,.04);
    }

    .center .compose .typing {
        position: relative;
        padding: 5px;
    }
    .el-textarea__inner {
        display: block;
        resize: vertical;
        padding: 5px 7px;
        line-height: 1.5;
        width: 100%;
        font-size: 14px;
        color: #1f2d3d;
        background-color: #fff;
        border: 1px solid #bfcbd9;
        border-radius: 4px;
        transition: border-color .2s cubic-bezier(.645,.045,.355,1);
    }
    .el-input__inner, .el-textarea__inner {
        box-sizing: border-box;
        background-image: none;
    }
    .el-textarea__inner {
        display: block;
        resize: vertical;
        padding: 5px 7px;
        line-height: 1.5;
        width: 100%;
        font-size: 14px;
        color: #1f2d3d;
        background-color: #fff;
        border: 1px solid #bfcbd9;
        border-radius: 4px;
        transition: border-color .2s cubic-bezier(.645,.045,.355,1);
    }
    .el-input__inner, .el-textarea__inner {
        box-sizing: border-box;
        background-image: none;
    }

    input, select, textarea {
        font-family: Arial,Helvetica,sans-serif;
    }
    .center .compose .typing .sendbtn {
        position: absolute;
        right: 5px;
        bottom: 5px;
    }

    .center .compose .typing .sendbtn .u-btn1 {
        width: 53px;
        height: 53px;
        font-size: 14px;
        line-height: 53px;
        color: #fff;
    }
    .center .compose .typing .sendbtn a{
        text-decoration: none;
    }
    .sendbtn .u-btn1 {
        color: #fff;
    }
    .sendbtn a:hover{
        color: #F98D5C;
        text-decoration:none;
    }
    .center .compose .typing .sendbtn a:hover{
        color: #F98D5C;
        text-decoration:none;
    }

    .u-btn1 {
        display: inline-block;
        width: 56px;
        height: 20px;
        line-height: 20px;
        text-align: center;
        vertical-align: bottom;
        border-radius: 3px;
        font-size: 12px;
        margin-left: 3px;
        background: #5b8ac7;
        background: -moz-linear-gradient(top,#5b8ac7 0,#2765b5 100%);
        background: -webkit-linear-gradient(top,#5b8ac7 0,#2765b5 100%);
        background: linear-gradient(to bottom,#5b8ac7 0,#2765b5 100%);
        border: 1px solid #1e57a0;
        color: #fff;
        /*background: #aa3748;*/
        /*background: -moz-linear-gradient(top,#d87c86 0,#6a1f2d 100%);*/
        /*background: -webkit-linear-gradient(top,#d87c86 0,#6a1f2d 100%);*/
        /*background: linear-gradient(to bottom,#d87c86 0,#6a1f2d 100%);*/
        /*border: 1px solid #ab374a;*/
        /*color: #fff;*/
    }
    .u-btn1:hover{
        color: #F98D5C;
        text-decoration:none;
    }
    .dialog img{
        max-height: 300px;
        max-width: 300px;
    }
    .tc{
        text-align: center;
    }
    .SysMsg {
        text-align: center;
        margin-bottom: 10px;
    }
    .SysMsg .inner {
        display: inline-block;
        background: #efefef;
        border-radius: 8px;
        border: 1px solid #dddddc;
        padding: 5px 10px;
    }
    .Txt.type-warning {
        color: #f60;
    }

    /***icon style***/
    .zhishikuguanli{
        font-size: 13px !important;
        vertical-align: 0 !important;
    }
    .icon-img{
        line-height: 36px;
    }
    .icon-lajitong{
        font-size: 16px !important;
        vertical-align: 0px !important;
    }
    .icon-gonggao{
        font-size: 20px !important;
        vertical-align: -2px !important;
    }
    .center .compose .btn-control {
        /*height: 100%;*/
        display: block;
        line-height: 32px;
        padding: 0 12px 2px 12px;
        background: #e5e5e5;
        color: #717171;
        margin-right: 1px;
        float: left;
        cursor: pointer;
        border-radius: 0 !important;
        border: 1px solid #e5e5e5;
    }
    .center .compose .btn-control:hover{
        background: #ffd9c7;
    }
    .iconfont {
        font-family: iconfont!important;
        font-size: 20px;
        line-height: 0px;
        vertical-align: -4px;
    }
    .icon-home-2 {
        color: #fff;
        font-weight: 700;
        vertical-align: 0!important;
    }
    /***icon style end***/

    /***packet style start***/
    .money {
        position: fixed;
        width: 514px;
        height: 350px;
        background: url('/chat/imgs/red.png') no-repeat;
        margin: auto;
        top: 200px;
        left: 0;
        right: 0;
        animation: money 1.5s;
    }

    @keyframes money {
        0% {
            transform: scale(0)
        }
        100% {
            transform: scale(1)
        }
    }

    .redPack {
        position: fixed;
        width: 220px;
        height: 250px;
        background: #cc453b;
        border-radius: 10px;
        margin: auto;
        left: 0;
        right: 0;
        animation: redPack 1.5s;
        top: 300px;
        z-index: 5;
    }

    .redPack .cover {
        height: 140px;
        border: 1px solid #bd503a;
        background-color: #de5c42;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 50% 15%;
        border-bottom-left-radius: 50% 15%;
        box-shadow: 0 4px 0 -1px rgba(0, 0, 0, .2);
        color: #fff;
    }

    .redPack .cover p {
        text-align: center;
        font-size: 18px;
        line-height: 100px;
    }

    .redPack .sticker {
        width: 100px;
        height: 100px;
        border: 1px solid #ffa73a;
        background-color: #ffa73a;
        border-radius: 50%;
        color: #fff;
        font-size: 26px;
        display: inline-block;
        position: relative;
        left: 55px;
        top: -50px;
        box-shadow: 0 4px 0 0 rgba(0, 0, 0, .2);
        cursor: pointer;
        text-align: center;
        line-height: 100px;

    }

    @keyframes redPack {
        0% {
            transform: scale(0);
            top: 0;
        }
        40% {
            top: 318px;
        }
        60% {
            top: 290px;
        }
        80% {
            top: 306px;
        }
        100% {
            top: 300px;
            transform: scale(1)
        }
    }

    .open {
        position: fixed;
        width: 224px;
        height: 316px;
        background: url("/chat/imgs/red.png") no-repeat -290px -360px;
        margin: auto;
        left: 0;
        right: 0;
        top: 280px;
        opacity: 0;
        transition: all 1s;
    }

    .open p {
        text-align: center;
        margin: 0;
        color: #fff;
        font-size: 16px;
        line-height: 380px;
    }

    .disnone {
        display: none;
    }

    .disblo {
        opacity: 1;
    }

    /***packet style end***/
    /***emoji  style***/
    .emoji_box{
        background: #fff;
        width: 185px;
        height: 120px;
        border-radius: 2px;
        box-sizing: content-box;
        border: 1px solid #d1dbe5;
        padding: 14px 2px 14px 14px;
        z-index: 2000;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .12), 0 0 6px 0 rgba(0, 0, 0, .04);
        font-size: 0px;
        position: fixed;
        bottom: 110px;
        left:5px;
    }

    .emoji_box .emoji-container {
        width: 180px;
    }

    .emoji {
        position: relative;
        margin-bottom: 5px;
        margin-right: 5px;
        display: inline-block;
        width: 25px;
        height: 25px;
        cursor: pointer;
        background: url('/chat/imgs/emoji@2x.png') no-repeat;
        background-size: 25px auto
    }

    .emoji:hover:after {
        box-sizing: content-box;
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        padding: 2px;
        left: -5px;
        top: -5px;
        border: 2px solid #f60;
    }
    .Bubble .emoji:hover:after{
        border: none ! important;
    }

    .emoji-container .emoji.emoji-smile {
        background-position: 0 0
    }

    .emoji-container .emoji.emoji-laughing {
        background-position: 0 -25px
    }

    .emoji-container .emoji.emoji-blush {
        background-position: 0 -50px
    }

    .emoji-container .emoji.emoji-heart_eyes {
        background-position: 0 -75px
    }

    .emoji.emoji-smirk {
        background-position: 0 -100px
    }

    .emoji.emoji-flushed {
        background-position: 0 -125px
    }

    .emoji.emoji-grin {
        background-position: 0 -150px
    }

    .emoji.emoji-kissing_smiling_eyes {
        background-position: 0 -175px
    }

    .emoji.emoji-wink {
        background-position: 0 -200px
    }

    .emoji.emoji-kissing_closed_eyes {
        background-position: 0 -225px
    }

    .emoji.emoji-stuck_out_tongue_winking_eye {
        background-position: 0 -250px
    }

    .emoji.emoji-sleeping {
        background-position: 0 -275px
    }

    .emoji.emoji-worried {
        background-position: 0 -300px
    }

    .emoji.emoji-sweat_smile {
        background-position: 0 -325px
    }

    .emoji.emoji-cold_sweat {
        background-position: 0 -350px
    }

    .emoji.emoji-joy {
        background-position: 0 -375px
    }

    .emoji.emoji-sob {
        background-position: 0 -400px
    }

    .emoji.emoji-angry {
        background-position: 0 -425px
    }

    .emoji.emoji-mask {
        background-position: 0 -450px
    }

    .emoji.emoji-scream {
        background-position: 0 -475px
    }

    .emoji.emoji-sunglasses {
        background-position: 0 -500px
    }

    .emoji.emoji-thumbsup {
        background-position: 0 -525px
    }

    .emoji.emoji-clap {
        background-position: 0 -550px
    }

    .emoji.emoji-ok_hand {
        background-position: 0 -575px
    }

    .popper__arrow {
        width: 15px;
        height: 12px;
        background: url('/chat/imgs/sj.png') no-repeat -8px -10px;
        margin: 10px 0 0 -5px;
    }
    .chatBox{
        padding: 5px;
        width: 297px;
        height: 54px;
    }
    .h{
        float: left;
        width: 25px;
        height: 25px;
        background-color: red;
    }
    /***emoji style end**/

    /***profile style***/
    .profile {
        width: 100%;
        height: 100%;
        position: relative;
        top: 0;
        left: 0;
        z-index: 300;
        font-size: 14px;
        color: #4f77ab;
    }
    .profile .inner {
        max-width: 310px;
        border-radius: 5px;
        background: rgba(255,255,255,.93);
        margin: 50px auto 0;
        position: relative;
        min-height: 200px;
        border: 1px solid #c8d4e4;
        text-align: center;
        padding: 20px 0;
        width: 90%;
    }
    .profile .avatar {
        display: inline-block;
        border-radius: 50%;
        width: 90px;
        height: 90px;
        border: 1px solid #c8d4e4;
        overflow: hidden;
        cursor: pointer;
    }
    .profile .avatar img {
        display: block;
        width: 100%;
        height: 100%;
    }
    .profile .avatar label {
        /*display: none;*/
        position: absolute;
        top: 22px;
        left: 8px;
        width: 100%;
        text-align: center;
        font-size: 50px;
        color: #909090;
        cursor: pointer;
    }
    .profile p {
        margin-top: 5px;
    }
    .profile .txt-nick {
        font-size: 20px;
    }
    /***profile style***/
</style>
