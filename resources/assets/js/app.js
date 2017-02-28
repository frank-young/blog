
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueResource from 'vue-resource'
Vue.use(VueResource)

Vue.component('articlelist', require('./components/article/List.vue'));
Vue.component('articledetail', require('./components/article/Detail.vue'));
Vue.component('userarticle', require('./components/article/Userarticle.vue'));
Vue.component('comment', require('./components/article/Comment.vue'));
Vue.component('usercate', require('./components/article/Usercate.vue'));
Vue.component('message', require('./components/message/Message.vue'));
Vue.component('cate', require('./components/cate/Cate.vue'));

Vue.component('upload', require('./components/upload/Upload.vue'));
Vue.component('avatar', require('./components/upload/Avatar.vue'));
Vue.component('carousel', require('./components/carousel/Carousel.vue'));
Vue.component('auth', require('./components/userinfo/Auth.vue'));

let app = new Vue({
    el: '#app',
    data() {
    	return {
    		imagePath: '/blog/storage/app/uploads/logo.png',
    		avatarPath: '',
    		cates: [],
    		cateName: '',
    		defaultCate: '暂无分类',
    		defaultId: 0,
            num: 0
    	}
    },
    created(){
        this._getMessageNum()
    },
    methods: {
    	getImagePath() {
            this.imagePath = this.$refs.upload.showimagePath()
        },
        getavatarPath() {
            this.avatarPath = this.$refs.avatar.showavatarPath()
        },
        addCate() {
        	console.log('添加成功')
        	let options = {}
            let formData = new FormData(event.target)

            options.headers = {'Content-Type': 'application/x-www-form-urlencoded'}
            options.emulateJSON = true

            this.$http.post('/blog/public/cate', formData, options).then((res) => {
                res = res.body
                if (res.errno === 0) {
                	this.cateName = ""
                }
            })
        },
        getCate() {
        	this.$http.get('/blog/public/cate').then((res) => {
                res = res.body
                if (res.errno === 0) {
                    this.cates = res.cates
                }
            })
        },
        selectCate(id,text) {
        	this.defaultCate = text
			this.defaultId = id
			console.log(this.defaultCate)
        },
        _getMessageNum(){
            setInterval(() => {
                this.$http.get('/blog/public/message/new').then((res) => {
                    res = res.body
                    if (res.errno === 0) {
                        this.num = res.num
                    }
                })
            }, 1000)
        }
    }

});






