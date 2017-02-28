<template>
    <div class="row img-wrap">
        <div class="col-md-6 col-md-offset-3">
            <div class="img">
                <img :src="src" alt="">
            </div>
            <div class="upload">
                <form @submit.prevent="submit" name="loginForm" enctype="multipart/form-data">
                    <input type="hidden" name="_token" :value="token">
                    <div class="btn-wrap">
                        <input class="btn u-file" type="file" name="file">
                        <span class="btn btn-info btn-line btn-radius u-borwer">浏览</span>
                        <input class="btn btn-info btn-radius u-submit" type="submit" value="上传封面图片">
                    </div>
                    
                </form>
            </div>
        </div>
            
    </div>
</template>

<script>
    const ERR_OK = 0
    const PATH = '/blog/storage/app/'

    export default {
        props: {
            token: {
                type: String
            },
            path: {
                type: String
            }
        },
        data() {
            return {
                src: '',
                imagePath: ''
            }
        },
        created() {
            if(this.path !== ""){
                this.src = PATH + this.path
                this.imagePath = this.path
            }
        },
        methods: {
            submit(event) {
                let options = {}
                let formData = new FormData(event.target)

                options.headers = {'Content-Type': 'application/x-www-form-urlencoded'}
                options.emulateJSON = true

                this.$http.post('/blog/public/image/upload', formData, options).then((res) => {
                    res = res.body
                    if (res.errno === ERR_OK) {
                        this.src = PATH + res.path
                        this.imagePath = res.path
                    }
                })
            },
            showimagePath() {
                return this.imagePath
            }
        }
    }
</script>

<style lang="less">
    .img-wrap {
        .img{
            min-height: 200px;
            max-height: 400px;
            margin-bottom: 20px;
            margin-top: 10px;
            background-color: #eee;
            overflow: hidden;
            border-radius: 5px;
            img {
                width: 100%;
                height: 100%;
            }
        }
        .upload {
            padding-bottom: 15px;
            border-bottom: 1px solid #f2f6f8;
            margin-bottom: 30px;
            .btn-wrap {
                position: relative;
                height: 35px;
                .btn {
                    position: absolute;
                    top: 0;
                    left: 0;
                }
                .u-file {
                    display: block;
                    width: 70px;
                    opacity: 0;
                    filter: alpha(opacity=0);
                    z-index: 1;
                    outline: none;
                    cursor: pointer;
                }
                .u-borwer {
                    z-index: 0;
                }
                .u-submit{
                    left: 100px;
                }
            }
        }
    }
</style>


















