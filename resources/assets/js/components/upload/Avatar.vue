<template>
    <div class="row avatar-wrap">
        <div class="col-xs-2">
            <div class="img">
                <img :src="src" alt="">
            </div>
            
        </div>
        <div class="col-xs-10">
            <div class="upload">
                <form @submit.prevent="submit" name="loginForm" enctype="multipart/form-data">
                    <input type="hidden" name="_token" :value="token">
                    <div class="btn-wrap">
                        <input class="btn u-file" type="file" name="file">
                        <span class="btn btn-info btn-line btn-radius u-borwer">浏览</span>
                        <input class="btn btn-info btn-radius u-submit" type="submit" value="上传图片">
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
            method: {
                type: Function
            },
            path: {
                type: String
            }
        },
        data() {
            return {
                src: '',
                avatarPath: ''
            }
        },
        created() {
            if(this.path !== ""){
                this.src = PATH + this.path
                this.avatarPath = this.path
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
                        this.avatarPath = res.path
                    }
                })
            },
            showavatarPath() {
                return this.avatarPath
            }
        }
    }
</script>

<style lang="less">
    .avatar-wrap {
        .img{
            margin-bottom: 20px;
            text-align: right;
            img {
                width: 80px;  
                height: 80px;
                background-color: #eee;
                border-radius: 5px;
            }
        }
        .upload {
            padding-bottom: 15px;
            margin-top: 20px;
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


















