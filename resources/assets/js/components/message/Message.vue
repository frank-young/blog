<template>
    <div class="row user-message">
        <div v-for="message in inmessages">
            <div class="col-md-12 user-message-item">
                <div class="head">
                    <div class="avatar">
                        <a :href="'/blog/public/userinfo/profile/' + message.user_id"><img :src="'/blog/storage/app/' +message.avatar_path" alt=""></a>
                    </div>
                    <div class="auth">
                        <span class="name-txt">
                            <a :href="'/blog/public/userinfo/profile/' + message.user_id">{{message.name}}</a>
                            <span class="new" v-show="message.tag === 0">新消息</span>
                        </span>
                        <div class="des">
                            <span>{{message.created_at}}</span>
                        </div>
                    </div>
                    <div class="detail">
                        <button class="btn btn-danger" @click="read(message.id, message.article_id)">详情</button>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-9">
                            <h2 class="title">{{ message.title }}</h2>
                            <p class="content">{{ message.content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const ERR_OK = 0;
    export default {
        props: {
            messages: {
                type: Array
            },
            token: {
                type: String
            }
        },
        data() {
            return {
                src: '',
                path: '/blog/storage/app/',
                inmessages: this.messages
            }
        },
        methods: {
            read(id, articleId) {
                this._changeStatus(id,articleId)

            },
            _changeStatus(id, articleId) {
                this.$http.get('/blog/public/message/' + id).then((res) => {
                    res = res.body
                    if (res.errno === ERR_OK) {
                        window.location.href="/blog/public/article/" + articleId +"#position"
                    }
                })
            }
        }
    }
</script>

<style lang="less">
    .user-message {
        .user-message-item {
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .head {
            margin-bottom: 0px;
            &:after {
                content: '';
                display: block;
                clear: both;
            }
            .avatar {
                float: left;
                img{
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                }
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
                    .new {
                        margin-left: 10px;
                        background-color: #f66;
                        padding: 4px 8px;
                        font-size: 14px;
                        color: #fff;
                        border-radius: 5px;
                    }
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
            .detail {
                float: right;
                .btn-danger {
                    border-color: #42b983;
                    color: #42b983;
                    background-color: #fff;
                    &:hover,&:focus{
                        border-color: #42b983;
                        color: #42b983;
                        background-color: #fff;
                    }
                }
            }
        }
        .body {
            .title {
                font-size: 22px;
                a {
                    color: #2c3e50;
                    transition: all .3s;
                    &:hover {
                        text-decoration: underline;
                    }
                    &:link {
                        color: #2c3e50;
                    }
                    &:visited {
                        color: #969696;
                    }
                }
            }
            .content {
                font-size: 16px;
                line-height: 1.8em;
                max-height: 75px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

        }
    }
</style>














