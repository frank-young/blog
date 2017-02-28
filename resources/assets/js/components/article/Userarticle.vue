<template>
    <div class="row user-article">
        <div v-for="article in inArticles">
            <div class="col-md-12 user-article-item">
                <div class="body">
                    <div class="row">
                        <div class="col-md-9">
                            <h2 class="title"><a :href="'/blog/public/article/' + article.id">{{ article.title }}</a></h2>
                            <p class="description">{{ article.description }}</p>
                        </div>
                        <div class="col-md-3" v-show="article.image_path !== null">
                            <a :href="'/blog/public/article/' + article.id"> <img :src="path + article.image_path" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="foot ">
                    <div class="row">
                        <div class="col-xs-6">
                             <span class="time"> 最后编辑于 {{ article.updated_at }}</span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a :href="'/blog/public/article/' + article.id + '/edit' " class="btn btn-info btn-sm tag">编辑</a>
                            <span class="del">
                                <form @submit.prevent="deleteFunc(article.id)">  
                                    <input type="hidden" name="_token" :value="token">
                                    <button class="btn btn-default btn-sm tag">删除</button>
                                </form>
                            </span>
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
            articles: {
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
                inArticles: this.articles
            }
        },
        methods: {
            deleteFunc(id) {
                this.$http.get('/blog/public/article/del/' + id).then((res) => {
                    res = res.body
                    if (res.errno === ERR_OK) {
                        this._refresh(id)
                    }
                })
                this._refresh(id)

            },
            _refresh(id) {
                if(this.inArticles !== []) {
                    let index = 0
                    this.inArticles.forEach((v,i) => {
                        if(v.id === id) {
                            index = i
                        }
                    })
                    this.inArticles.splice(index, 1)
                }
            }
        },
        watch: {

        }
    }
</script>

<style lang="less">
    .user-article {
        .user-article-item {
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .body {
            margin-bottom: 10px;
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
                margin-top: 30px; 
                max-height: 100px;
            }
        }
        .foot {
            .time {
                color: #888;
                font-size: 12px;
            }
            .del {
                display: inline-block;
            }
        }
    }
</style>














