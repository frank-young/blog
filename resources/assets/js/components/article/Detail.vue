<template>
    <div class="row article-detail">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{article[0].title}} </h1>
            <div class="userinfo">
                <div class="avatar">
                    <img :src="'/blog/storage/app/' + article[0].avatar_path" alt="">
                </div>
                <div class="auth">
                    <span class="tag">作者</span>
                    <span class="name-txt"><a :href="'/blog/public/userinfo/profile/' + article[0].user_id">{{article[0].name}}</a></span>
                    <div class="des">
                        <span>{{article[0].created_at}}</span>
                        <span>阅读 {{article[0].visit_num}}</span>
                        <span>评论 {{article[0].comment_num}}</span>
                        <span>喜欢 {{article[0].like_num}}</span>
                    </div>
                </div>
                
            </div>
            <div class="content">
                <div class="img" >
                    <img :src="'/blog/storage/app/' + article[0].image_path" alt="" v-show="article[0].image_path != null ">
                </div>
                <div class="txt">
                    {{article[0].body}}
                </div>
                <div class="sign">
                    {{article[0].self_sign}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            article: {
                type: Array
            }
        },
        data() {
            return {
            }
        }
    }
</script>

<style lang="less">
    .article-detail {
        h1{
            font-size: 35px;
            font-weight: normal !important;
        }
        .userinfo {
            margin: 30px 0;
            &:after {
                content: '';
                display: block;
                clear: both;
            }
            .avatar {
                float: left;
                width: 50px;
                height: 50px;
                border: 1px solid #f5f5f5;
                img{
                    width: 50px;
                    height: 50px;
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
        .content {
            img {
                width: 100%;
                margin: 20px 0;
            }
            .txt {
                font-size: 16px;
                line-height: 1.8em;
            }
            .sign {
                padding:40px 20px;
                margin-bottom: 40px;
                font-size: 20px;
                text-align: center;
                border-bottom: 1px solid #eee;
            }
        }
    }
</style>
