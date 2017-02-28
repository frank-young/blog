<template>
    <div class="row list">
        <div v-for="article in pageArticles">
            <div class="col-md-12 list-item">
                <div class="head">
                    <div class="avatar">
                        <a :href="'/laravel/public/userinfo/profile/' + article.user_id"><img :src="'/laravel/storage/app/' +article.avatar_path" alt=""></a>
                    </div>
                    <div class="auth">
                        <span class="name-txt">
                            <a :href="'/laravel/public/userinfo/profile/' + article.user_id">{{article.name}}</a>
                        </span>
                        <div class="des">
                            <span>{{article.created_at}}</span>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-9">
                            <h2 class="title"><a :href="'/laravel/public/article/' + article.id">{{ article.title }}</a></h2>
                            <p class="description">{{ article.description}}</p>
                        </div>
                        <div class="col-md-3" v-show="article.image_path !== null">
                            <a :href="'/laravel/public/article/' + article.id"> <img :src="path + article.image_path" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <a href="" class="tag">
                        <a :href="'/laravel/public/cate/' + article.cate_id">{{article.cate_id | setCate(cates)}}</a>
                    </a>
                    <span class="visit">{{ article.visit_num }}</span>
                    <span class="comment">{{ article.comment_num }}</span>
                    <!-- <span class="like">{{ article.like_num }}</span> -->
                </div>
            </div>
        </div>
        <div class="more" v-show="articles.length >= 10">
            <button class="btn btn-info btn-block mb-60" @click="getMore(start,end)">
                点击加载更多
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            articles: {
                type: Array
            }
        },
        data() {
            return {
                path: '/laravel/storage/app/',
                cates: [],
                inArticles: this.articles.reverse(),
                pageArticles:[],
                start: 0,
                end:10,
                len:10
            }
        },
        created() {
            this.$http.get('/laravel/public/cate').then((res) => {
                res = res.body
                if (res.errno === 0) {
                    this.cates = res.cates
                }
            })
            this._setPage(this.start, this.end)
        },
        methods: {
            _setPage(start, end) {
                this.pageArticles = this.inArticles.slice(start,end)
                this.end += this.len
            },
            getMore() {
                this._setPage(this.start, this.end)
                console.log(this.start)
            }
        },
        filters: {
            setCate(id,cates) {
                let name = ''
                cates.forEach((v,i) => {
                    if (v.id === id) {
                        name = v.cate
                    }
                })
                return name
            }
        }
    }

</script>

<style lang="less">
    .list {
        .mb-60 {
            margin-bottom: 60px;
        }
        .list-item {
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
        .body {
            margin-bottom: 20px;
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
            .description {
                line-height: 1.8em;
                max-height: 75px;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            img {
                width: 100%;
                height: 100%;
                max-height: 100px;
                margin-top: 30px; 
            }
        }
        
        .foot {
            .tag {
                padding: 0px 8px;
                border: 1px solid #f66;
                color: #f66;
                font-weight: normal;
                border-radius: 4px;

            }
            .visit {
                
            }
            .comment {
                
            }
            .like {
                
            }
        }


    }
</style>














