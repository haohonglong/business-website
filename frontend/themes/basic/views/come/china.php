<?php
use yii\helpers\Url;

$this->title = '方巨在中国';
$images = \Yii::getAlias('@themes_static/basic/images');
$css = <<<CSS
.wrapDiv{
				width: 100%;
				padding: 20px calc((100% - 1200px) / 2);
				box-sizing: border-box;
				font-size: 0;
				background: #f6f9ff;	
				position: relative;			
			}
			
			.w_le{position:relative; width:660px; height:534px; background:url("{$images}/mapImg.png") no-repeat 34px 34px; display: inline-block;}
			.w_le .province{position:absolute; left:0; top:0; width:100%; height:100%;}
			.w_le .province i{position:absolute; display: block; font-weight: bold; line-height: 16px; font-size: 12px; color:#333333; font-style: normal; cursor: pointer; -webkit-transition: all .3s;
			   -moz-transition: all .3s;
			    -ms-transition: all .3s;
			     -o-transition: all .3s;
			        transition: all .3s;}
			.w_le .province i.on,.w_le .province i:hover{z-index: 5; width:42px; height:46px; line-height: 40px; color:#fff; padding:11px 0; margin:-45px 0 0 -10px; text-align: center; background:url("{$images}/mapImgBtn.png") no-repeat center; background-size: 100%;}

			.w_le2{position:relative; width:100%; height:8rem; background:url("{$images}/mapImg.png") no-repeat; display: inline-block; background-size: 100% auto; display: none;}
			.w_le2 .province{position:absolute; left:0; top:0; width:100%; height:100%;}
			.w_le2 .province i{position:absolute; display: block; font-weight: bold; line-height: 16px; font-size: 12px; color:#333333; font-style: normal; cursor: pointer; -webkit-transition: all .3s;
			   -moz-transition: all .3s;
			    -ms-transition: all .3s;
			     -o-transition: all .3s;
			        transition: all .3s;}
			.w_le2 .province i.on,.w_le .province i:hover{z-index: 5; width:42px; height:46px; line-height: 40px; color:#fff; padding:11px 0; margin:-45px 0 0 -10px; text-align: center; background:url("{$images}/mapImgBtn.png") no-repeat center; background-size: 100%;}

			.w_le_fixed{
				position: absolute;
				top: 10%;
				left: 55%;
				z-index: 6;

				background: #bfdcef;
				width: 470px;
				height: 280px;
				padding-left: 10px;
				padding-top: 10px;
				box-sizing: border-box;

				display: none;
			}
			.w_le_fixed:after{
				content:'';
				position:absolute;
				right:100%;
				top:50%;
				transform: translate(0,-50%);
				-webkit-transform:translate(0,-50%);
				width:0;height:0;
				border-width:10px;
				border-style:solid;
				border-color:transparent;
				border-right-width:16px;
				border-right-color:currentColor;
				color:#bfdcef;
			}
			.w_le_fixed > div{
				background: #89bfe0;
				width: 470px;
				height: 280px;
				position: relative;
				padding: 30px;
				box-sizing: border-box;
				font-size: 0;
			}
			.w_le_fixed > div:after{
				content:'';
				position:absolute;
				right:100%;
				top:50%;
				transform: translate(0,-50%);
				-webkit-transform:translate(0,-50%);
				width:0;height:0;
				border-width:10px;
				border-style:solid;
				border-color:transparent;
				border-right-width:16px;
				border-right-color:currentColor;
				color:#89bfe0;
				z-index: 3;
			}

			.w_le_fixed > div p{
				font-size: 16px;
				color: #000000;
				display: inline-block;
				margin-right: 15px;
				margin-bottom: 20px;
			}

			.shut{
				width: 40px;
				height: 40px;
				position: absolute;
				top: -40px;
				right: 0;
				cursor: pointer;
			}

			.wrapDiv_r{
				padding-left: 30px;
				display: inline-block;
				vertical-align: top;
			}
			.wrapDiv_r p{
				color: #003894;
				font-size: 30px;
				font-weight: bold;
				padding-top: 80px;
				padding-bottom: 20px;
			}
			.wrapDiv_r p font{
				font-size: 16px;
				color: #003894;
				margin-left: 5px;
			}
			.wrapDiv_r span{
				font-size: 16px;
				color: #333333;
				line-height: 2;
			}

			@media (max-width: 500px) {
				.w_le{
					display: none;
				}

				.wrapDiv_r{
					padding: 0 20px;
				}
				.wrapDiv_r p{
					padding-top: 10px;
				}

				.w_le2{
					display: block;
				}


				.w_le_fixed{
					width: 90%;
					left: 25px;
				}
				.w_le_fixed > div{
					width: 100%;
				}
			}
CSS;
$this->registerCss($css);

$js = <<<JS
            

		    
JS;
$this->registerJs($js,\yii\web\View::POS_END);

?>

<script type="text/javascript">
<?php $this->beginBlock('js'); ?>
    var $div_cities = $('#cities');
    $(".province").on("click", "i", function () {
        var $this = $(this);
        var province_code =$this.data('provinces_id');
        $.ajax({
            url: "<?=Url::to(['/come/china'])?>",
            type:"post",
            data: {
                'province_code': province_code
            },
            success: function( result ) {
                var cities = [];
                var data = "";
                if('0' == result.status){
                    $.each(result.data,function () {
                        cities.push('<p data-city_code="'+this.city_code+'">',this.city_name,'</p>');
                    });
                    data = cities.join('');
                }else{
                    data = result.data;
                }

                $div_cities.html(data);
            }
        });
        $(this).addClass("on").siblings('i').removeClass("on");
        $(".w_le_fixed").delay(500).fadeIn();
    });

    $(".shut").click(function () {
        $(".province i").removeClass("on");

        $(".w_le_fixed").fadeOut();
    });



    var dataArr = [
        {'name':'辽宁', 'left':'489', 'top':'173', 'arr':[]}
    ];


<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js'],\yii\web\View::POS_END); ?>
<!-- 内容 -->
<div class="container">
    <div class="wrapBanner1"><img src="<?=$images?>/banner1.png"></div>
    <div class="wrap">
        <div class="wrapTitle">
            <span>方巨在中国</span>
            <p>Fang Ju in China</p>
            <!-- <div class="wrapTitle_dh"><img src="../images/home.png" />加入方巨 > 组织文化</div> -->
        </div>
    </div>

    <div class="wrapDiv">
        <div class="w_le">
            <div class="province">
                <i data-provinces_id="<?=$provinces['辽宁省'];?>" data-title="辽宁" data-entitle="" style="left: 489px; top: 173px;">辽宁</i>
                <i data-provinces_id="<?=$provinces['北京'];?>" data-title="北京" data-entitle="" style="left: 424px; top: 191px;">北京</i>
                <i data-provinces_id="<?=$provinces['内蒙古自治区'];?>" data-title="内蒙古" data-entitle="" style="left: 346px; top: 196px;">内蒙古</i>
                <i data-provinces_id="<?=$provinces['河北省'];?>" data-title="河北" data-entitle="" style="left: 417px; top: 227px;">河北</i>
                <i data-provinces_id="<?=$provinces['山东省'];?>" data-title="山东" data-entitle="" style="left: 446px; top: 244px;">山东</i>
                <i data-provinces_id="<?=$provinces['陕西省'];?>" data-title="陕西" data-entitle="" style="left: 351px; top: 279px;">陕西</i>
                <i data-provinces_id="<?=$provinces['河南省'];?>" data-title="河南" data-entitle="" style="left: 404px; top: 278px;">河南</i>
                <i data-provinces_id="<?=$provinces['江苏省'];?>" data-title="江苏" data-entitle="" style="left: 474px; top: 270px;">江苏</i>
                <i data-provinces_id="<?=$provinces['安徽省'];?>" data-title="安徽" data-entitle="" style="left: 447px; top: 303px;">安徽</i>
                <i data-provinces_id="<?=$provinces['湖北省'];?>" data-title="湖北" data-entitle="" style="left: 401px; top: 319px;">湖北</i>
                <i data-provinces_id="<?=$provinces['四川省'];?>" data-title="四川" data-entitle="" style="left: 298px; top: 325px;">四川</i>
                <i data-provinces_id="<?=$provinces['重庆'];?>" data-title="重庆" data-entitle="" style="left: 347px; top: 330px;">重庆</i>
                <i data-provinces_id="<?=$provinces['浙江省'];?>" data-title="浙江" data-entitle="" style="left: 478px; top: 328px;">浙江</i>
                <i data-provinces_id="<?=$provinces['贵州省'];?>" data-title="贵州" data-entitle="" style="left: 339px; top: 367px;">贵州</i>
                <i data-provinces_id="<?=$provinces['湖南省'];?>" data-title="湖南" data-entitle="" style="left: 393px; top: 354px;">湖南</i>
                <i data-provinces_id="<?=$provinces['江西省'];?>" data-title="江西" data-entitle="" style="left: 434px; top: 351px;">江西</i>
                <i data-provinces_id="<?=$provinces['福建省'];?>" data-title="福建" data-entitle="" style="left: 462px; top: 367px;">福建</i>
                <i data-provinces_id="<?=$provinces['云南省'];?>" data-title="云南" data-entitle="" style="left: 285px; top: 397px;">云南</i>
                <i data-provinces_id="<?=$provinces['广西壮族自治区'];?>" data-title="广西" data-entitle="" style="left: 364px; top: 406px;">广西</i>
                <i data-provinces_id="<?=$provinces['广东省'];?>" data-title="广东" data-entitle="" style="left: 411px; top: 406px;">广东</i>
                <i data-provinces_id="<?=$provinces['上海'];?>" data-title="上海" data-entitle="" style="left: 490px; top: 289px;">上海</i>
                <i data-provinces_id="<?=$provinces['天津'];?>" data-title="天津" data-entitle="" style="left: 438px; top: 208px;">天津</i>
                <i data-provinces_id="<?=$provinces['海南省'];?>" data-title="海南" data-entitle="" style="left: 372px; top: 461px;">海南</i>
                <i data-provinces_id="<?=$provinces['黑龙江省'];?>" data-title="黑龙江" data-entitle="" style="left: 510px; top: 100px;">黑龙江</i>
                <i data-provinces_id="<?=$provinces['吉林省'];?>" data-title="吉林" data-entitle="" style="left: 506px; top: 139px;">吉林</i>
                <i data-provinces_id="<?=$provinces['山西省'];?>" data-title="山西" data-entitle="" style="left: 388px; top: 238px;">山西</i>
                <i data-provinces_id="<?=$provinces['甘肃省'];?>" data-title="甘肃" data-entitle="" style="left: 311px; top: 266px;">甘肃</i>
                <i data-provinces_id="<?=$provinces['青海省'];?>" data-title="青海" data-entitle="" style="left: 230px; top: 255px;">青海</i>
                <i data-provinces_id="<?=$provinces['西藏自治区'];?>" data-title="西藏" data-entitle="" style="left: 141px; top: 303px;">西藏</i>
                <i data-provinces_id="<?=$provinces['新疆维吾尔自治区'];?>" data-title="新疆" data-entitle="" style="left: 130px; top: 185px;">新疆</i>
                <i data-provinces_id="<?=$provinces['台湾'];?>" data-title="台湾" data-entitle="" style="left: 499px; top: 392px;">台湾</i>
                <i data-provinces_id="<?=$provinces['宁夏回族自治区'];?>" data-title="宁夏" data-entitle="" style="left: 328px; top: 237px;">宁夏</i>
            </div>
        </div>

        <div class="w_le2">
            <div class="province">
                <i data-pid="" data-title="辽宁" data-entitle="" style="left: 7.52rem; top: 2.306667rem;">辽宁</i>
                <i data-pid="" data-title="北京" data-entitle="" style="left: 6.5rem; top: 2.5rem;">北京</i>
                <i data-pid="" data-title="内蒙古" data-entitle="" style="left: 5rem; top: 2.613333rem;">内蒙古</i>
                <i data-pid="" data-title="河北" data-entitle="" style="left: 6.41rem; top: 3.026667rem;">河北</i>
                <i data-pid="" data-title="山东" data-entitle="" style="left: 6.946667rem; top: 3.4rem;">山东</i>
                <i data-pid="" data-title="陕西" data-entitle="" style="left: 5.2rem; top: 4rem;">陕西</i>
                <i data-pid="" data-title="河南" data-entitle="" style="left: 6.03rem; top: 4.0rem;">河南</i>
                <i data-pid="" data-title="江苏" data-entitle="" style="left: 7.32rem; top: 3.85rem;">江苏</i>
                <i data-pid="" data-title="安徽" data-entitle="" style="left: 6.8rem; top: 4.4rem;">安徽</i>
                <i data-pid="" data-title="湖北" data-entitle="" style="left: 6rem; top: 4.6rem;">湖北</i>
                <i data-pid="" data-title="四川" data-entitle="" style="left: 4.2rem; top: 4.75rem;">四川</i>
                <i data-pid="" data-title="重庆" data-entitle="" style="left: 5.1rem; top: 4.8rem;">重庆</i>
                <i data-pid="" data-title="浙江" data-entitle="" style="left: 7.5rem; top: 4.85rem;">浙江</i>
                <i data-pid="" data-title="贵州" data-entitle="" style="left: 5.0rem; top: 5.5rem;">贵州</i>
                <i data-pid="" data-title="湖南" data-entitle="" style="left: 5.85rem; top: 5.3rem;">湖南</i>
                <i data-pid="" data-title="江西" data-entitle="" style="left: 6.55rem; top: 5.2rem;">江西</i>
                <i data-pid="" data-title="福建" data-entitle="" style="left: 7.16rem; top: 5.5rem;">福建</i>
                <i data-pid="" data-title="云南" data-entitle="" style="left: 4.0rem; top: 6.0rem;">云南</i>
                <i data-pid="" data-title="广西" data-entitle="" style="left: 5.4rem; top: 6.146667rem;">广西</i>
                <i data-pid="" data-title="广东" data-entitle="" style="left: 6.4rem; top: 6.08rem;">广东</i>
                <i data-pid="" data-title="上海" data-entitle="" style="left: 7.533333rem; top: 4.2rem;">上海</i>
                <i data-pid="" data-title="天津" data-entitle="" style="left: 6.84rem; top: 2.8rem;">天津</i>
                <i data-pid="" data-title="海南" data-entitle="" style="left: 5.5rem; top: 7.05rem;">海南</i>
                <i data-pid="" data-title="黑龙江" data-entitle="" style="left: 7.7rem; top: 1.0rem;">黑龙江</i>
                <i data-pid="" data-title="吉林" data-entitle="" style="left: 7.75rem; top: 1.7rem;">吉林</i>
                <i data-pid="" data-title="山西" data-entitle="" style="left: 5.8rem; top: 3.25rem;">山西</i>
                <i data-pid="" data-title="甘肃" data-entitle="" style="left: 4.5rem; top: 3.9rem;">甘肃</i>
                <i data-pid="" data-title="青海" data-entitle="" style="left: 3.066667rem; top: 3.6rem;">青海</i>
                <i data-pid="" data-title="西藏" data-entitle="" style="left: 1.88rem; top: 4.4rem;">西藏</i>
                <i data-pid="" data-title="新疆" data-entitle="" style="left: 1.733333rem; top: 2.466667rem;">新疆</i>
                <i data-pid="" data-title="台湾" data-entitle="" style="left: 7.6rem; top: 6rem;">台湾</i>
                <i data-pid="" data-title="宁夏" data-entitle="" style="left: 4.8rem; top: 3.3rem;">宁夏</i>
            </div>
        </div>

        <div class="w_le_fixed">
            <div>
                <div class="shut"><img src="<?=$images?>/img16.png"></div>
                <div id="cities"></div>

            </div>
        </div>

        <div class="wrapDiv_r">
            <p>方巨在重庆<font>Fang Ju in Chongqing</font></p>
            <span>“领航中国，飞跃世界”，是方巨集团的现实驱动和未来畅想。<br>
						未来，方巨人将承载着荣耀与梦想，继往开来再续华章。</span>
        </div>

    </div>

</div>