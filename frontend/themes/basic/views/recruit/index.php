<?php
use yii\helpers\Url;
$this->title = "我要应聘";
$css = <<<CSS
.wrapDiv{
				width: 100%;
				padding: 40px;
				box-sizing: border-box;
				background: #f6f9ff;
			}

			.wrapDiv_t{
				width: 100%;
				font-size: 0;

				display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
			    align-items: center;
			    justify-content: space-between;
			    flex-wrap: wrap;

			}
			.wrapDiv_t > *{
				display: inline-block;
			    margin-bottom: 20px;
			}
			.wrapDiv_b{
				width: 100%;
				background: #fff;
				padding: 20px;
				box-sizing: border-box;
			}

			.wrapDiv_t_input{
				display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
			    align-items: center;
			    justify-content: flex-start; 
			    flex-wrap: wrap;
			}
			.wrapDiv_t_input input{
				width: 290px;
				height: 50px;
				border: 2px solid #003894;
				text-indent: 15px;
				margin-left: -2px;
			}
			.btn{
				width: 120px;
				line-height: 54px;
				background: #003894;
				font-size: 16px;
				text-align: center;
				color: #fff;
			}
			.btn2{
				display: none;
				margin: 0 auto 20px;
			}

			.wrapDiv_b > p{
				font-size: 16px;
				color: #333333;
				line-height: 2;
				margin-top: 10px;
			}
			.wrapDiv_b li {
				list-style: none;
			    display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
			    align-items: center;
			    justify-content: space-between;
			    flex-wrap: wrap;
			}
			.wrapDiv_b li > div{
			    display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
			    align-items: center;
			    justify-content: flex-start;
			    flex-wrap: wrap;

			    font-size: 20px;
			    color: #333333;
			}
			.wrapDiv_b li > div p{
				width: 36px;
				line-height: 22px;
				text-align: center;
				background: #13478e;
				color: #fff;
				margin-left: 6px;
			}
			.wrapDiv_b li > div span{
				font-size: 14px;
				color: #999999;
				margin-left: 25px;
			}

			@media (max-width: 500px) {
				.wrapDiv{
					padding: 20px;
				}
				.wrapDiv_b li > div{
					width: 100%;
				}

				.wrapDiv_t_input input{
					width: 190px;
				}

				.btn1{
					display: none;
				}
				.btn2{
					display: block;
				}
			}
CSS;

$this->registerCss($css);
$this->registerJsFile(
    '@themes_static/basic/js/SelectBox.min.js',
    ['depends' => [\frontend\themes\basic\assets\AppAsset::className()]]
);

$js = <<<JS
    
			var data={$addresses},
		    fnBack=function(result){
		            console.log(result);
		            console.log(result.name+' '+result.id);
		    };
		    //最全参数
		    new SelectBox($('.box'),data,fnBack,
		                {
		                    dataName:'name',//option的html
		                    dataId:'id',//option的value                      
		                    fontSize:'16',//字体大小
		                    optionFontSize:'16',//下拉框字体大小
		                    textIndent:10,//字体缩进                     
		                    color:'#000',//输入框字体颜色
		                    optionColor:'#000000',//下拉框字体颜色
		                    arrowColor:'#003894',//箭头颜色
		                    backgroundColor:'#fff',//背景色颜色
		                    borderColor:'#003894',//边线颜色
		                    hoverColor:'#ddd',//下拉框HOVER颜色 
		                    borderWidth:2,//边线宽度
		                    arrowBorderWidth:0,//箭头左侧分割线宽度。如果为0则不显示
		                    borderRadius:0,//边线圆角                       
		                    placeholder:'请输入文字',//默认提示
		                    defalut:'firstData',//默认显示内容。如果是'firstData',则默认显示第一个
		                    allowInput:true,//是否允许输入                        
		                    width:240,//宽
		                    height:50,//高
		                    optionMaxHeight:500//下拉框最大高度
		                });


		   	var data2={$jobTypes},
		    fnBack=function(result){
		            console.log(result);
		            console.log(result.name+' '+result.id);
		    };
		    //最全参数
		    new SelectBox($('.box2'),data2,fnBack,
		                {
		                    dataName:'name',//option的html
		                    dataId:'id',//option的value                      
		                    fontSize:'16',//字体大小
		                    optionFontSize:'16',//下拉框字体大小
		                    textIndent:10,//字体缩进                     
		                    color:'#000',//输入框字体颜色
		                    optionColor:'#000000',//下拉框字体颜色
		                    arrowColor:'#003894',//箭头颜色
		                    backgroundColor:'#fff',//背景色颜色
		                    borderColor:'#003894',//边线颜色
		                    hoverColor:'#ddd',//下拉框HOVER颜色 
		                    borderWidth:2,//边线宽度
		                    arrowBorderWidth:0,//箭头左侧分割线宽度。如果为0则不显示
		                    borderRadius:0,//边线圆角                       
		                    placeholder:'请输入文字',//默认提示
		                    defalut:'firstData',//默认显示内容。如果是'firstData',则默认显示第一个
		                    allowInput:true,//是否允许输入                        
		                    width:240,//宽
		                    height:50,//高
		                    optionMaxHeight:500//下拉框最大高度
		                });



		    var data3=[
		        {name:'社区招聘',id:'12岁'},
		    ],
		    fnBack=function(result){
		            console.log(result);
		            console.log(result.name+' '+result.id);
		    };
		    //最全参数
		    new SelectBox($('.box3'),data3,fnBack,
		                {
		                    dataName:'name',//option的html
		                    dataId:'id',//option的value                      
		                    fontSize:'16',//字体大小
		                    optionFontSize:'16',//下拉框字体大小
		                    textIndent:10,//字体缩进                     
		                    color:'#000',//输入框字体颜色
		                    optionColor:'#000000',//下拉框字体颜色
		                    arrowColor:'#003894',//箭头颜色
		                    backgroundColor:'#fff',//背景色颜色
		                    borderColor:'#003894',//边线颜色
		                    hoverColor:'#ddd',//下拉框HOVER颜色 
		                    borderWidth:2,//边线宽度
		                    arrowBorderWidth:0,//箭头左侧分割线宽度。如果为0则不显示
		                    borderRadius:0,//边线圆角                       
		                    placeholder:'请输入文字',//默认提示
		                    defalut:'firstData',//默认显示内容。如果是'firstData',则默认显示第一个
		                    allowInput:true,//是否允许输入                        
		                    width:135,//宽
		                    height:50,//高
		                    optionMaxHeight:500//下拉框最大高度
		                });
JS;
$this->registerJs($js,\yii\web\View::POS_END);
?>

<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/banner1.png"></div>
    <div class="wrap">
        <div class="wrapTitle">
            <span>我要应聘</span>
            <p>Team introduction</p>
            <div class="wrapTitle_dh"><img src="<?=\Yii::getAlias('@themes_static')?>/basic/images/home.png" />加入方巨 > 组织文化</div>
        </div>

        <div class="wrapDiv">
            <div class="wrapDiv_t">

                <div class="wrapDiv_t_input">
                    <div class="box3"></div>
                    <input type="text" name="">
                    <div class="btn btn1">职位搜索</div>
                </div>

                <div class="box2"></div>
                <div class="box"></div>

                <div class="btn btn2">职位搜索</div>
            </div>
            <?php foreach ($list as $item): ?>
            <div class="wrapDiv_b">
                <li>
                    <div>供应链职能负责人<p>TOP</p></div>
                    <div><span>供应链</span><span>地址：合肥</span><span>发布时间：<?=$item['time']?></span></div>
                </li>
                <p>
                    工作职责<br>
                    <?=$item['duty']?>...更多>></p>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>