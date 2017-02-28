<template>
    <div class="row cate">
        <div class="col-md-2 mb-20" v-for="cate in cates">
        	<a :href="path + cate.id" class="btn btn-cate">
        		{{cate.cate}}
        	</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
        },
        data() {
            return {
                path: '/blog/public/cate/',
                cates: [],
            }
        },
        created() {
            this.$http.get('/blog/public/cate').then((res) => {
                res = res.body
                if (res.errno === 0) {
                    this.cates = res.cates
                }
            })
        },
        methods: {

        }
    }

</script>

<style lang="less">
	.cate {
		border-top: 1px solid #eee;
		border-bottom: 1px solid #eee;
		padding-top: 30px;
		margin-top: 30px;
		margin-bottom: 30px;
		.mb-20 {
			margin-bottom: 20px;
		}
		.btn-cate {
			border: 2px solid #f66;
			color: #f66;
			font-weight: normal;
			font-weight: 16px;
			padding: 5px 10px;
			border-radius: 6px;
            &:hover {
                color: #fff;
                background-color: #f66;
            }
		}
	}
</style>














