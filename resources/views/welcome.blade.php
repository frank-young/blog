<!DOCTYPE html>
<html>
    <head>
        <title>博 - 客</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans|Montserrat:700' rel='stylesheet' type='text/css'>
        <style>
            html, body {
                overflow: hidden;
                margin: 0;
            }
            body {
                font-family: 'PingFang SC', 'Microsoft YaHei', 'Open Sans', 'Helvetica Neue', 'Hiragino Sans GB', 'LiHei Pro', Arial, sans-serif;
                color: #333;
            }
            #wrapper {
                position: absolute;
                left: 0;
                width: 320px;
                text-align: center;
                top: 45%;
                left: 50%;
                transform: translate(-50%, -50%);
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }
            h1 {
                font-family: 'Montserrat', 'Helvetica Neue', Arial, sans-serif;
                font-weight: 700;
                font-size: 30px;
                letter-spacing: 9px;
                text-transform: uppercase;
                margin: 12px 0;
                left: 4px;
            }
            h2 {
                color: #999;
                font-weight: normal;
                font-size: 15px;
                letter-spacing: .12em;
                margin-bottom: 30px;
                left: 3px;
            }
            h1, h2 {
                position: relative;
            }
            p {
                font-size: 14px;
                line-height: 3.2em;
                margin: 0;
                letter-spacing: 2px;
            }
            canvas {
                position: absolute;
                top: 0;
                left: 0;
                z-index: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }
            a {
                color: #999;
                text-decoration: none;
                transition: all .2s ease;
            }
            a:hover {
                color: #f33;
            }
            .b-radius {
                display: inline-block;
                margin-top: 10px;
                padding: 0px 30px;
                border: 1px solid #999;
                border-radius: 40px;
            }
            .b-radius:hover {
                border-color: #f33;
            }
        </style>
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-38965494-1']);
          _gaq.push(['_setDomainName', 'evanyou.me']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
    </head>
    <body>
        <div id="wrapper">
            <h1>博 - 客</h1>
            <h2>读你所爱,写你所见</h2>
            <p><a href="home" >主页</a></p>
            <!-- <p><a href="about" >关于我</a></p> -->
            <p><a href="login" >登录</a></p>
            <p><a class="b-radius" href="register" >注册</a></p>
        </div>
        <canvas></canvas>
        <script>
            document.addEventListener('touchmove', function (e) {
                e.preventDefault()
            })
            var c = document.getElementsByTagName('canvas')[0],
                x = c.getContext('2d'),
                pr = window.devicePixelRatio || 1,
                w = window.innerWidth,
                h = window.innerHeight,
                f = 90,
                q,
                m = Math,
                r = 0,
                u = m.PI*2,
                v = m.cos,
                z = m.random
            c.width = w*pr
            c.height = h*pr
            x.scale(pr, pr)
            x.globalAlpha = 0.6
            function i(){
                x.clearRect(0,0,w,h)
                q=[{x:0,y:h*.7+f},{x:0,y:h*.7-f}]
                while(q[1].x<w+f) d(q[0], q[1])
            }
            function d(i,j){   
                x.beginPath()
                x.moveTo(i.x, i.y)
                x.lineTo(j.x, j.y)
                var k = j.x + (z()*2-0.25)*f,
                    n = y(j.y)
                x.lineTo(k, n)
                x.closePath()
                r-=u/-50
                x.fillStyle = '#'+(v(r)*127+128<<16 | v(r+u/3)*127+128<<8 | v(r+u/3*2)*127+128).toString(16)
                x.fill()
                q[0] = q[1]
                q[1] = {x:k,y:n}
            }
            function y(p){
                var t = p + (z()*2-1.1)*f
                return (t>h||t<0) ? y(p) : t
            }
            document.onclick = i
            document.ontouchstart = i
            i()
        </script>
    </body>
</html>