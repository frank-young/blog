<template>
    <div class="row auth-wrap">
    	<div class="col-md-12">
    		<div class="panel panel-default">
			    <div class="panel-heading">推荐作者</div>
			    <div class="panel-body">
                    <div class="items">
                        <div class="item" v-for="auth in auths">
                            <div class="avatar">
                                <a :href="'/blog/public/userinfo/profile/' + auth.user_id">
                                    <img :src="'/blog/storage/app/' +auth.avatar_path" alt="">
                                </a>
                            </div>
                            <div class="auth">
                                <span class="name-txt"><a :href="'/blog/public/userinfo/profile/' + auth.user_id">{{auth.name}}</a></span>
                                <div class="des">
                                    <span>注册时间：{{auth.created_at}}</span>
                                </div>
                            </div>
                        </div>
                    </div>         
                </div>
			</div>
    	</div>
    </div>
</template>

<script>
    const ERR_OK = 0
    const PATH = '/blog/storage/app/'

    export default {
        props: {
        },
        data() {
            return {
                auths: []
            }
        },
        created() {
            this._getAuth()
        },
        methods: {
            _getAuth() {
                this.$http.get('/blog/public/userinfo/auth').then((res) => {
                    res = res.body
                    if (res.errno === 0) {
                        this.auths = res.auths
                    }
                })
            }
        }
    }
</script>

<style lang="less">
    .auth-wrap {
        margin-top: 12px;
        .item {
            margin-bottom: 15px;
            &:after {
                content: '';
                display: block;
                clear: both;
            }
            .avatar {
                float: left;
                img{
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                }
            }
            .auth {
                float: left;
                margin-left: 10px;
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
        }
        
    }
</style>


















