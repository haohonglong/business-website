<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\phpstudy\PHPTutorial\WWW\information/application/information\view\index\index.html";i:1572259136;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">       
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <script type="text/javascript" src="__ROOT__/public/inter/js/flexible.js" ></script>
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/inter/css/style.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/inter/css/index.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/inter/css/loaders.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/inter/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/inter/css/circleContainer.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/inter/css/select.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/inter/css/date.css" />

    <link rel="icon" href="data:;base64,=">

    <style type="text/css">

    </style>
    </head>

    <body>
        <div id="loading">
            <div class="la-ball-spin-clockwise la-3x">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
			<p>加载中...</p>
        </div>
        <!--  -->
        <div id="lanren">
            <div id="audio-btn" class="on" onclick="lanren.changeClass(this,'media')">
                <audio loop="loop" src="__ROOT__/public/inter/music/气势的背景音乐.mp3" id="media" preload="preload"></audio>
            </div>
        </div>
        <div class="wrap" id="wrap">

            <div class="wrap_div wrap_div1">
                <div class="bg1"><img class="bg1_b3" src="__ROOT__/public/inter/img/imgBg.gif"></div>
                <div class="bg1_b4"></div>

                <div class="indexBg">
                    <img class="signUpImg1" src="__ROOT__/public/inter/img/signUpImg1.png">

                    <!--  -->
                    <div class="inputDiv">
                        <p>姓名:</p>
                        <input type="text" name="name" class="">
                    </div>
                    <div class="inputDiv">
                        <p>性别:</p>
                        <li>
                            <select class="select" name="state" data-value="0" id="sex">
                                <option value="1">男</option>
                                <option value="2">女</option>
                            </select>
                        </li>
                    </div>
                    <div class="inputDiv">
                        <p>年龄:</p>
                        <input type="text" name="age" class="">
                    </div>
                    <div class="inputDiv">
                        <p>民族:</p>
                        <input type="text" name="mingzu" class="">
                    </div>
                    <div class="inputDiv">
                        <p>工作单位:</p>
                        <input type="text" name="unit" class="">
                    </div>
                    <div class="inputDiv">
                        <p>职务:</p>
                        <input type="text" name="post" class="">
                    </div>
                    <div class="inputDiv">
                        <p>职称:</p>
                        <input type="text" name="professor" class="">
                    </div>

                    <!--  -->
                    <div class="imgDiv">
                        <img src="__ROOT__/public/inter/img/img1.png">
                    </div>
                    <div class="inputDiv">
                        <p>邮编:</p>
                        <input type="text" name="code" class="">
                    </div>
                    <div class="inputDiv">
                        <p>通讯地址:</p>
                        <input type="text" name="address" class="">
                    </div>
                    <div class="inputDiv">
                        <p>联系电话:</p>
                        <input type="text" name="phone" class="">
                    </div>
                    <div class="inputDiv">
                        <p>传真:</p>
                        <input type="text" name="fax" class="">
                    </div>
                    <div class="inputDiv">
                        <p>电子信箱:</p>
                        <input type="text" name="email" class="">
                    </div>

                    <!--  -->
                    <div class="imgDiv">
                        <img src="__ROOT__/public/inter/img/img2.png">
                        <img src="__ROOT__/public/inter/img/icon3.png" class="icon3">
                    </div>
                    <div class="addDiv">
                        <div>
                            <div class="inputDiv">
                                <p>姓名:</p>
                                <input type="text" name="name1" class="">
                            </div>
                            <div class="inputDiv">
                                <p>性别:</p>
                                <li>
                                    <select class="select" name="state" data-value="0" id="sex1">
                                        <option value="1">男</option>
                                        <option value="2">女</option>
                                    </select>
                                </li>
                            </div>
                            <div class="inputDiv">
                                <p>职务:</p>
                                <input type="text" name="post1" class="">
                            </div>
                            <img src="__ROOT__/public/inter/img/icon4.png" class="icon4">
                        </div>
                    </div>

                    <!--  -->
                    <div class="imgDiv">
                        <img src="__ROOT__/public/inter/img/img3.png">
                    </div>
                    <div class="inputDiv2">
                        <p>人数:</p>
                        <input type="text" name="personnum" class="">
                    </div>
                    <div class="inputDiv2">
                        <p>天数:</p>
                        <input type="text" name="fate" class="">
                    </div>
                    <div class="inputDiv2">
                        <p>是否同意合住:</p>
                        <li>
                            <select class="select" name="state" data-value="0">
                                <option value="1">同意</option>
                                <option value="2">不同意</option>
                            </select>
                        </li>
                    </div>

                    <!--  -->
                    <div class="imgDiv">
                        <img src="__ROOT__/public/inter/img/img4.png">
                    </div>
                    <div class="inputDiv3">
                        <p class="check">
                            <label><input type="checkbox" data-id="1"><span></span></label>
                        </p>
                        <li>建筑卫生陶瓷行业发展论坛</li>
                    </div>
                    <div class="inputDiv3">
                        <p class="check">
                            <label><input type="checkbox" data-id="2"><span></span></label>
                        </p>
                        <li>“一带一路”中国日用陶瓷产业发展高峰论坛</li>
                    </div>
                    <div class="inputDiv3">
                        <p class="check">
                            <label><input type="checkbox" data-id="3"><span></span></label>
                        </p>
                        <li>功能性陶瓷原辅材料高峰论坛</li>
                    </div>
                    <div class="inputDiv3">
                        <p class="check">
                            <label><input type="checkbox" data-id="4"><span></span></label>
                        </p>
                        <li>绿色智能装备引领陶瓷产业发展高峰论坛</li>
                    </div>
                    <div class="inputDiv3">
                        <p class="check">
                            <label><input type="checkbox" data-id="5"><span></span></label>
                        </p>
                        <li>中国工业陶瓷的创新与未来</li>
                    </div>
                    <div class="inputDiv3">
                        <p class="check">
                            <label><input type="checkbox" data-id="6"><span></span></label>
                        </p>
                        <li>中国古陶瓷传承与创新发展高峰论坛</li>
                    </div>

                    <!--  -->
                    <div class="imgDiv">
                        <img src="__ROOT__/public/inter/img/img5.png">
                    </div>
                    <div class="inputDiv">
                        <p>时间:</p>
                        <input type="text" name="time" class="" id="startTime">
                    </div>
                    <div class="inputDiv">
                        <p>车次/航班:</p>
                        <input type="text" name="flight" class="">
                    </div>
                    <div class="inputDiv">
                        <p>地点:</p>
                        <input type="text" name="place" class="">
                    </div>

                    <!--  -->
                    <div class="imgDiv">
                        <img src="__ROOT__/public/inter/img/img6.png">
                    </div>
                    <div class="inputDiv">
                        <p>时间:</p>
                        <input type="text" name="time1" class="" id="endTime">
                    </div>
                    <div class="inputDiv">
                        <p>车次/航班:</p>
                        <input type="text" name="flight1" class="">
                    </div>
                    <div class="inputDiv">
                        <p>地点:</p>
                        <input type="text" name="place1" class="">
                    </div>

                    <!--  -->
                    <img class="signUpImg2 heart" src="__ROOT__/public/inter/img/signUpImg2.png">

                </div>

                    <div id="datePlugin"></div>

            </div>

        </div>
        
    </body>
    <script type="text/javascript" src="__ROOT__/public/inter/js/jquery.min.js" ></script>
    <script type="text/javascript" src="__ROOT__/public/inter/js/layer.js" ></script>
    <script type="text/javascript" src="__ROOT__/public/inter/js/jquery.select.js" ></script>
    <script type="text/javascript" src="__ROOT__/public/inter/js/date.js" ></script>

    <!-- 设置宽高 -->
    <script type="text/javascript">

        $(function(){

            $('body').height($('body')[0].clientHeight);
            $("input,select").blur(function(){
                var scrollHeight = document.documentElement.scrollTop || document.body.scrollTop || 0;
                window.scrollTo(0, Math.max(scrollHeight - 1, 0));
            })

            $(".wrap_div").eq(0).show();

            $('select.select').select();

            $('#startTime').date({theme:"datetime"});
            $('#endTime').date({theme:"datetime"});
        });

        // 音乐播放
        var lanren = {
            changeClass: function (target,id) {
                var className = $(target).attr('class');
                var ids = document.getElementById(id);
                (className == 'on')
                    ? $(target).removeClass('on').addClass('off')
                    : $(target).removeClass('off').addClass('on');
                (className == 'on')
                    ? ids.pause()
                    : ids.play();
            },
            play:function(){
                document.getElementById('media').play();
            }
        }
        lanren.play();
        document.addEventListener("WeixinJSBridgeReady", function () {
             lanren.play();
        }, false);

    </script>

    <script type="text/javascript">

        // 添加
        $(document).on('click', '.icon3', function(){
            var div = '';
            div += '<div>'
            + '<div class="inputDiv"><p>姓名:</p><input type="text" name="name1" class=""></div>'
            + '<div class="inputDiv"><p>职务:</p><li><select id="sex1" class="select" name="state" data-value="0"><option value="1">男</option><option value="2">女</option></select></li></div>'
            + '<div class="inputDiv"><p>职务:</p><input type="text" name="post1" class=""></div>'
            + '<img src="__ROOT__/public/inter/img/icon4.png" class="icon4">'
            + '</div>'
            $(".addDiv").append(div);
        });

        // 删除
        $(document).on('click', '.icon4', function(){
            $(this).parent().remove();
        });

        // 提交
        $(document).on('click', '.signUpImg2', function(){
            var name = $('input[name="name"]').val();//姓名

            var sex = $('#sex').val();//性别

            var age = $('input[name="age"]').val();//年龄
            var mingzu = $('input[name="mingzu"]').val();//名族
            var unit = $('input[name="unit"]').val();//工作单位
            var post = $('input[name="post"]').val();//职务
            var professor = $('input[name="professor"]').val();//职称
            var code = $('input[name="code"]').val();//编号
            var address = $('input[name="address"]').val();//通讯地址
            var phone = $('input[name="phone"]').val();//通讯电话
            var fax = $('input[name="fax"]').val();//传真
            var email = $('input[name="email"]').val();//电子邮箱

           

            var personnum = $('input[name="personnum"]').val();//人数
            var fate = $('input[name="fate"]').val();//天数

            var time = $('input[name="time"]').val();//
            var flight = $('input[name="flight"]').val();//
            var place = $('input[name="place"]').val();//
            var time1 = $('input[name="time1"]').val();//
            var flight1 = $('input[name="flight1"]').val();//
            var place1 = $('input[name="place1"]').val();//

            // 复选框
            var arr = [];
            if($('label').find('input').attr("type") == "checkbox"){
                $('label').find('input:checkbox:checked').each(function(index, el) {
                    arr.push($(this).attr('data-id'));
                });
            }

            var lid = arr;//复选框数组
           
            // console.log(aa);
            //获取跟随人员信息
            var renyuanArr = [];
            // var arrDiv = $(".addDiv");
            var arrDiv = $(".indexBg").find(".addDiv").children();

            for(var i=0 ; i < arrDiv.length; i++){
                var obj = {
                    "name": arrDiv.eq(i).find('input[name="name1"]').val(),
                    "sex": arrDiv.eq(i).find('#sex1').val(),
                    "post":arrDiv.eq(i).find('input[name="post1"]').val(),
                }
                renyuanArr.push(obj);
            }

            // var post1 = renyuanArr;
            // console.log(renyuanArr);
            if(name == ''){
                layer.msg("请填写姓名", 2)
                return false;
            }
            if(age == ''){
                layer.msg("请填写年龄", 2)
                return false;
            }
            if(mingzu == ''){
                layer.msg("请填写民族", 2)
                return false;
            }
            if(unit == ''){
                layer.msg("请填写工作单位", 2)
                return false;
            }
            if(post == ''){
                layer.msg("请填写职务", 2)
                return false;
            }
            if(professor == ''){
                layer.msg("请填写职称", 2)
                return false;
            }
            if(code == ''){
                layer.msg("请填写编码", 2)
                return false;
            }
            if(address == ''){
                layer.msg("请填写通讯地址", 2)
                return false;
            }
            if(phone == ''){
                layer.msg("请填写通讯电话", 2)
                return false;
            }
            if(fax == ''){
                layer.msg("请填写传真", 2)
                return false;
            }
            if(email == ''){
                layer.msg("请填写电子邮件", 2)
                return false;
            }
            if(personnum == ''){
                layer.msg("请填写人数", 2)
                return false;
            }
            if(fate == ''){
                layer.msg("请填写天数", 2)
                return false;
            }
            if(time == ''){
                layer.msg("请填写时间", 2)
                return false;
            }
            if(flight == ''){
                layer.msg("请填写航班", 2)
                return false;
            }
            if(place == ''){
                layer.msg("请填写地址", 2)
                return false;
            }

            if(time1 == ''){
                layer.msg("请填写时间", 2)
                return false;
            }
            if(flight1 == ''){
                layer.msg("请填写航班", 2)
                return false;
            }
            if(place1 == ''){
                layer.msg("请填写地址", 2)
                return false;
            }
            
            var datas = {
                name:name,
                sex:sex,
                age:age,
                mingzu:mingzu,
                unit:unit,
                post:post,
                professor:professor,
                code:code,
                address:address,
                phone:phone,
                fax:fax,
                email:email,
                personnum:personnum,
                fate:fate,
                time:time,
                flight:flight,
                place:place,
                time1:time1,
                flight1:flight,
                place1:place1,
                lid:lid,
                renyuanArr:renyuanArr,

            };

            $.ajax({
            url:"<?php echo url('information/index/add'); ?>",
            dataType:'json',
            type:'POST',
            async: true,
            data: datas,
            //processData : false, // 使数据不做处理
            //contentType : false, // 不要设置Content-Type请求头
            success: function(data){
                console.log(000);
                if (data.code == '0') {
                    layer.msg("提交成功",2);
                }

            },
            
		// error:function(response){
		// 	console.log(response);
		// }
	});




        });

    </script>

    <script type="text/javascript">
        //-----------图片加载---------
            function imgLoad(arr,callBack){
                var len = arr.length;//所有图片的个数
                var loaded = 0;//记录我们加载了多少张图片

                for(var i = 0; i < len; i ++){
                    var img = new Image();
                    img.onload = function(){
                        loaded ++ ;//增加了一张图片
                        //加载完成

                        if(loaded == len){
                            //loading加载完毕
                             callBack();
                        }
                    }
                    img.src = arr[i];

                }
            }
    
            //特定预加载图片数组 
             var arr = [
                '__ROOT__/public/inter/img/music_on.png',
                '__ROOT__/public/inter/img/imgBg2.png',
            ];
          	//读取页面img链接   
           		// var arr_img=document.getElementsByTagName("img");
             //    for(var i=0;i<arr_img.length;i++){
             //        arr.push(arr_img[i].getAttribute("src"))
             //    }
            
            imgLoad(arr,function(){
                setTimeout(function(){
                    document.getElementById("loading").style.display="none";//加载图片隐藏
                    document.getElementsByClassName("wrap").item(0).style.display="block";//加载图片隐藏.

                    $(".wrap_div").eq(0).siblings(".wrap_div").hide();
                    $(".wrap_div").eq(0).show().css({"top": "100%"}).animate({"top": "0"},1000);

                },500);
                
            });
            //-----------图片加载---------
    </script>
</html>

