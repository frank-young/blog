<template>
    <div class="row comment">
        <div class="col-md-8 col-md-offset-2" v-show="!isLog">
            <h5 class="text-center">赶紧登录参与评论吧</h5>
            <div class="text-center">
                <a class="btn btn-primary" href="/blog/public/login">登录</a>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2" v-show="isLog">
            <form @submit.prevent="submit"  method="POST" class="form-horizontal comment-input">
                <input type="hidden" name="_token" :value="token">
                <input type="hidden" name="article_id" v-model="article[0].id">
                <input type="hidden" name="message_id" v-model="article[0].user_id">
                <input type="hidden" name="user_id" v-model="userinfo.user_id">
                <input type="hidden" name="name" v-model="userinfo.name">
                <input type="hidden" name="avatar_path" v-model="userinfo.avatar_path">
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        <div class="avatar">
                            <img :src="src" alt="">
                        </div>
                    </label>
                    <div class="col-xs-10">
                        <textarea name="content" v-model="content" rows="4" class="form-control" placeholder="请输入评论内容..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 control-label">
                    </div>
                    <div class="col-sm-8 text-right" v-show="content !== '' ">
                        <button class="btn btn-primary">评论</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="alert alert-success text-center" v-show="showFlag">
                        评论成功！
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 col-md-offset-2 comment-list" id="position">
            <h4><span class="color-red">{{count}}</span> 条评论</h4>
            <div class="items" v-for="comment in comments">
                <div class="item">
                    <div class="userinfo">
                        <div class="avatar">
                            <img :src="'/blog/storage/app/' +comment.avatar_path" alt="">
                        </div>
                        <div class="auth">
                            <span class="name-txt"><a href="">{{comment.name}}</a></span>
                            <div class="des">
                                <span>{{comment.created_at}}</span>
                            </div>
                        </div>
                        <div class="delete" v-show="comment.user_id === userinfo.user_id">
                            <form @submit.prevent="deleteFunc(comment.id)">  
                                <input type="hidden" name="_token" :value="token">
                                <button class="btn btn-danger">删除</button>
                            </form>
                            
                        </div>
                    </div>
                    <div class="content">
                        <p>{{comment.content}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    const ERR_OK = 0
    const ERR_NO_LOGIN = 3000
    const PATH = '/blog/storage/app/'

    export default {
        props: {
            token: {
                type: String
            },
            article: {
                type: Array
            }
        },
        data() {
            return {
                content: '',
                src: '',
                userinfo: {},
                comments: [],
                count: 0,
                showFlag: false,
                isLog: false
            }
        },
        created() {            
            this.$http.get('/blog/public/api/userinfo').then((res) => {
                res = res.body
                if (res.errno === ERR_OK) {
                    this.isLog = true
                    this.src = PATH + res.userinfo.avatar_path
                    this.userinfo = res.userinfo
                }else if (res.errno === ERR_NO_LOGIN) {
                    this.isLog = false
                    console.log(res.msg)
                }
            })
            this._getComments(this.article[0].id)

        },
        methods: {
            submit(event) {
                let options = {}
                let formData = new FormData(event.target)

                options.headers = {'Content-Type': 'application/x-www-form-urlencoded'}
                options.emulateJSON = true

                this.$http.post('/blog/public/comment', formData, options).then((res) => {
                    res = res.body
                    if (res.errno === ERR_OK) {
                        this.content = ''
                        this._alert()
                        this._getComments(this.article[0].id)
                    }
                })
            },
            deleteFunc(id) {
                this.$http.get('/blog/public/comment/' + id).then((res) => {
                    res = res.body
                    if (res.errno === ERR_OK) {
                        this._getComments(this.article[0].id)
                    }
                })
            },
            _getComments(id) {
                this.$http.get('/blog/public/comment/list/' + id).then((res) => {
                    res = res.body
                    if (res.errno === ERR_OK) {
                        this.comments = res.comments
                        this.count = res.count
                    }
                })
            },
            _alert(){
                this.showFlag = true
                setTimeout(() => {
                    this.showFlag = false
                }, 3000)
            }

        }
    }
</script>

<style lang="less">
    .comment {
        margin-bottom: 40px;
        .avatar {
            img{
                width: 50px;
                height: 50px;
                border-radius: 50%;
            }
        }
        .comment-input {
            
        }
        .comment-list {
            h4 {
                padding: 15px 0;
                border-bottom: 1px solid #eee;
            }
            .items {
                .item {
                    padding: 15px 0;
                    border-bottom: 1px solid #eee;
                    .userinfo {
                        margin-bottom: 15px;
                        &:after {
                            content: '';
                            display: block;
                            clear: both;
                        }
                        .avatar {
                            float: left;
                        }
                        .auth {
                            float: left;
                            margin-left: 10px;

                            .tag {
                                border: 1px solid #f66;
                                padding: 0px 5px;
                                border-radius: 4px;
                                color: #f66;
                                font-size: 12px;
                                line-height: 18px;
                            }
                            .name-txt {
                                margin-left: 5px;
                                font-size: 16px;
                                line-height: 18px;
                                a {
                                    color: #34495e;
                                    &:hover{
                                        color: #34495e;
                                    }
                                }
                            }
                            .des {
                                margin-top: 8px;
                                font-size: 12px;
                                color: #777;
                            }
                        }
                        .delete {
                            float: right;
                            .btn-danger {
                                border-color: #aaa;
                                color: #aaa;
                                background-color: #fff;
                                &:hover,&:focus{
                                    border-color: #aaa;
                                    color: #aaa;
                                    background-color: #fff;
                                }
                            }
                        }
                    }
                    .content {
                        p {
                            font-size: 16px;
                            padding: 0 20px;
                        }
                    }
                    
                }
            }
        }
        .color-red {
            font-size: 24px;
            color: #f66;
        }
        .alert-success {
            font-size: 16px;
            color: #42b983;
            border-color: #42b983;
            background-color: #fff;
        }
        
    }
</style>






















