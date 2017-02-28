
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

let app = new Vue({
    el: '#app',
    data() {
    	return {

    	}
    },
    created(){

    },
    methods: {

    }

});






