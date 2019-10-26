$(function () {

    //地产布局切换
    function p1s4show() {
        var p1s4a = $(".p1s4-selectbox a"),
			  p1s4content = $(".p1s4-showcontent > div"),
			  p1s4_idx = 0;

        p1s4s(p1s4_idx);

        p1s4a.click(function () {
            //console.log(0);
            p1s4_idx = $(this).index();
            p1s4s(p1s4_idx);
        });

        function p1s4s(p1s4_idx) {
            p1s4a.eq(p1s4_idx).addClass("current").siblings().removeClass("current");
            p1s4content.eq(p1s4_idx).show().siblings().hide();
        }
    }

    //地产项目内页切换
    function rdshow() {
        var rdli = $(".rd-s4left-mid .rd-s4left-midcontent"),
			  rda = $(".rd-s4left-mid .rd-s4left-midnav a"),
			  spl = $(".smallprolist .spl-box"),
			  page = $(".rd-s4left-mid .pageState"),
			  rdidx = 0;
        rda.on('click', function () {
            rdidx = $(this).index();
            rds(rdidx);
            resizeWidth();
        })
        rds(rdidx);
        function rds(rdidx) {
            rda.eq(rdidx).addClass("current").siblings().removeClass("current");
            rdli.stop(false, true).hide();
            rdli.eq(rdidx).stop(false, true).fadeIn(400);
            spl.stop(false, true).hide();
            spl.eq(rdidx).stop(false, true).fadeIn(400);
            page.stop(false, true).hide();
            page.eq(rdidx).stop(false, true).fadeIn(400);
        }
    }

    function resizeWidth() {
        $(".rd-s4left-midcontent-4").find("img").each(function () {
            var _this = $(this);
            var img = new Image();
            img.src = _this.attr("src");
            img.onload = function () {
                if (img.height > img.width) {
                    _this.attr({ "width": "" });
                }
            }

        });
        $(".spl-box-4").find("img").each(function () {
            var _this = $(this);
            var img = new Image();
            img.src = _this.attr("src");
            img.onload = function () {
                if (img.height > img.width) {
                    _this.attr({ "width": "" });
                }
            }
        });
        $(".rd-s4left-midcontent-4").find("li").css("text-align", "center");
        $(".spl-box-4").find("a").css("text-align", "center");
    }


    //商业&&物业选项卡切换
    function bshow() {
        var bselecta = $(".bselect a"),
			  bshow = $(".bshow > div"),
			  bnowcontent = null,
			  bidx = 0;
        bselecta.eq(0).addClass("on").siblings().removeClass("on");
        bselecta.each(function () {
            if ($(this).index() == 0) {
                $(this).addClass("on");
            }
        })
        bshow.each(function () {
            if ($(this).index() == 0) {
                $(this).show();
            }
        })
        bselecta.click(function () {
            bidx = $(this).index();
            $(this).addClass("on").siblings().removeClass("on");
            if ($(this).parent().index() != $(this).parent().siblings().length) {
                bnowcontent = $(this).parent().next();
            } else {
                bnowcontent = $(this).parent().prev();
            }
            bs(bidx);
        });
        function bs(bidx) {
            bnowcontent.children().eq(bidx).show().siblings().hide();
        }
    }

    //商业logo处理
    function bs4fixed() {
        $(".bs4list li:nth-child(5n-1)").addClass("leftside");
        $(".bs4list li:nth-child(5n)").addClass("leftside");
    }

    //商业详情二维码
    function bdsecwm() {
        var bdbtn1 = $(".bd-section1 a.bd-btn2"),
			  bdsecwm = $(".bd-section1 .bd-secwm");
        bdbtn1.hover(function () {
            bdsecwm.addClass("on");
        }, function () {
            bdsecwm.removeClass("on");
        })
    }

    //项目内页详情地图展开
    function bdmapshow() {
        var bdmapbtn = $("a.pd-mapbtn"),
			  bdmap = $("#dituContent");

        bdmapbtn.on('click', function () {
            bdmap.stop(false, true).slideToggle(400);
        })
    }

    //物业二维码
    function psecwm() {
        var ps2c3btn = $(".ps2-c3btn"),
			  ps2secwm = $(".ps2-c3secwm");

        ps2c3btn.hover(function () {
            ps2secwm.addClass("on");
        }, function () {
            ps2secwm.removeClass("on");
        });

        $(".ps2-c4btn").hover(function () {
            $(this).next().addClass("on");
        }, function () {
            $(this).next().removeClass("on");
        })
    }

    //物业底部切换 一堆切换阿西吧
    function rbshow() {
        var ps7li = $(".ps7-list li"),
			  ps7idx = 0,
			  ps7max = ps7li.length,
			  ps7leftbtn = $("a.ps7-leftbtn"),
			  ps7rightbtn = $("a.ps7-rightbtn"),
			  ps7rbcontent = $(".ps7-rb > div");

        rbcontentshow(ps7idx);

        ps7leftbtn.on('click', function () {
            if (ps7idx != 0) {
                ps7idx--;
                rbcontentshow(ps7idx);
            }
        })

        ps7rightbtn.on('click', function () {
            if (ps7idx < ps7max - 1) {
                ps7idx++;
                rbcontentshow(ps7idx);
            }
        })

        function rbcontentshow(ps7idx) {
            ps7li.eq(ps7idx).stop(false, true).fadeIn(400).siblings().stop(false, true).fadeOut(400);
            ps7rbcontent.eq(ps7idx).show().siblings().hide();
        }
    }

    //p1slider(); //地产切换
    p1s4show();//地产布局切换
    rdshow();//地产项目内页切换
    bshow();//商业切换
    bs4fixed();//商业logo处理
    bdsecwm();//商业详情二维码
    bdmapshow();//项目内页详情地图展开
    psecwm();//物业二维码
    rbshow();//物业底部切换 一堆切换阿西吧
    // var bsrlist;
    // console.log(bsrlist);
    // $(".bs4list li").hover(function(){
    // 	var kk=$(this).find("img").attr("src");
    // 	bsrlist=kk;
    // 	$(this).find("img").attr("src","img/p2.jpg");
    // 	$(this).css({"paddingTop":"0"});
    // },function(){
    // 	$(this).find("img").attr("src",bsrlist);
    // 	$(this).css({"paddingTop":"27"});
    // });
    $(".bs4list li").hover(function () {
        $(this).find(".bsrlist_hover").show();
    }, function () {
        $(this).find(".bsrlist_hover").hide();
    });
    // for(var i=0;i<$(".rd-s4left-mid img").length;i++){
    // 	var imgh=$(".rd-s4left-mid img").eq(i).height();
    // 	var imgw=$(".rd-s4left-mid img").eq(i).width();
    // 	console.log(imgh);
    // 	console.log(imgw);
    // 	if(imgw>imgh){
    //        $(".rd-s4left-mid img").eq(i).css({"width":"100%","height":"491"});
    // 	}
    // 	if(imgw<=imgh){
    //        $(".rd-s4left-mid img").eq(i).css({"width":"auto","height":"100%"});
    // 	}
    //    }
    var timenull = null;
    timenull = setTimeout(function () {
        $(".rd-s4left-mid li , .rd-s4left-mid ul").show();
        for (var i = 0; i < $(".rd-s4left-mid img").length; i++) {

            var imgh = $(".rd-s4left-mid img").eq(i).height();
            var imgw = $(".rd-s4left-mid img").eq(i).width() - 1;

            if (imgw > imgh) {
                if (880 / 491 > imgw / imgh) {
                    $(".rd-s4left-mid img").eq(i).css({ "width": "auto", "height": "100%" });
                }
                else if (880 / 491 < imgw / imgh) {
                    $(".rd-s4left-mid img").eq(i).css({ "width": "100%", "height": "auto " });
                }

            }
            else if (imgw <= imgh) {
                $(".rd-s4left-mid img").eq(i).css({ "width": "auto", "height": "100%" });
            }

        }
        $(".rd-s4left-mid ul").eq(0).show().siblings("ul").hide();
        $(".rd-s4left-midcontent-1 li").eq(0).show().siblings().hide();
        $(".rd-s4left-midcontent-2 li").eq(0).show().siblings().hide();
        $(".rd-s4left-midcontent-3 li").eq(0).show().siblings().hide();
        $(".rd-s4left-midcontent-4 li").eq(0).show().siblings().hide();
    }, 3000);
    $(".bd-section1 h2").hover(function () {
        $(".project_phone_2d,.project_phone_2dc").stop(true, true).slideDown(200);

    }, function () {
        $(".project_phone_2d,.project_phone_2dc").stop(true, true).slideUp(200);
    });
    //产品详情鼠标经过
    $(".rds5-list li,#country ul li").hover(function () {
        $(this).find(".rds5-list-intro").stop(true, true).fadeIn(400);
    }, function () {
        $(this).find(".rds5-list-intro").stop(true, true).fadeOut(400);
    });

})

//地产切换
function p1slider() {
    var p1list = $(".p1s2-list"),
        p1left = $(".p1s2-leftbtn"),
        p1right = $(".p1s2-rightbtn"),
        p1idx = 0,
        p1max = p1list.find("li").length / 4 - 1;

    p1left.on('click', function () {
        if (p1idx != 0) {
            p1idx--;
            p1list.stop(false, true).animate({
                marginLeft: '+=' + 301 * 4 + 'px'
            }, 300);
        }
    })

    p1right.on('click', function () {
        if (p1idx < p1max) {
            p1idx++;
            p1list.stop(false, true).animate({
                marginLeft: '-=' + 301 * 4 + 'px'
            }, 300);
        }
    })
}