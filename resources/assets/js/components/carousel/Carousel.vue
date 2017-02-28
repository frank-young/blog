<template>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
      </ol>

      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="img/img_01.png" alt="">
          <div class="carousel-caption">
            
          </div>
        </div>
        <div class="item">
          <img src="img/img_02.jpg" alt="">
          <div class="carousel-caption">
            
          </div>
        </div>
        <div class="item">
          <img src="img/img_03.png" alt="">
          <div class="carousel-caption">
            
          </div>
        </div>
        <div class="item">
          <img src="img/img_04.png" alt="">
          <div class="carousel-caption">
            
          </div>
        </div>
      </div>

      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span  aria-hidden="true"> </span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span  aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</template>

<script>
    export default {
        props: {
        },
        data() {
            return {
            }
        },
        created() {
        },
        methods: {
        }
    }

</script>

<style lang="less">
    .carousel {
        margin-bottom: 30px;
        .carousel-control.right,
        .carousel-control.left {
            background-image: none;
        }
    }
</style>














