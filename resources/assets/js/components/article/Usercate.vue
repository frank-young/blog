<template>
    <div class="row user-cate">
		<div class="row">
			<div class="col-xs-6 col-md-4" v-for="cate in cates">
				<span class="tag">
					<a :href="'/blog/public/cate/' + cate.id">{{cate.cate}}</a>
   
				</span>
			</div>
		</div>
    </div>
</template>

<script>
	const ERR_OK = 0

    export default {
        data() {
            return {
                cates: []
            }
        },
        created() {
            this.$http.get('/blog/public/cate/self').then((res) => {
                res = res.body
                if (res.errno === ERR_OK) {
                    this.cates = res.cates
                }
            })
        }
    }
</script>

<style lang="less">
	.user-cate{
		.tag {
			display: inline-block;
			padding:3px 6px;
			color: #f66;
			border: 1px solid #f66;
			border-radius: 4px;
			font-size: 14px;
		}
	}
	
</style>














