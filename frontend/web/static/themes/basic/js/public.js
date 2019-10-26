function header_init() {

    var init_idx = 0;
    //当前页面导航高亮
    if (window.location.href.indexOf(".aspx") >= 0) {
        var href = window.location.href;
        var name = href.substring(href.lastIndexOf("/") + 1, href.lastIndexOf(".aspx"));
        $('#header ul').find('li').each(function (i) {
            var $this = $(this);
            var link = $this.find("a").attr("href");
            if (link != "/" && link.indexOf(name) >= 0) {
                init_idx = $this.index();
                $('.c-inbanner .subnavbg').eq(init_idx - 1).show();
                $this.addClass("current").siblings("li").removeClass("current");
                return;
            }
        });
    } else {
        var href = window.location.pathname;
        if (href != "/") {
            var hasColumn = false;
            var reg = new RegExp("/([a-zA-Z0-9]*)/?");
            $('#header ul').find('li').each(function (i) {
                var $this = $(this);
                var link = $this.find("a").attr("href");
                if (link != "/" && href.indexOf(link) >= 0) {
                    init_idx = $this.index();
                    $('.c-inbanner .subnavbg').eq(init_idx - 1).show();
                    $this.addClass("current").siblings("li").removeClass("current");
                    hasColumn = true;
                    return;
                }
            });
            if (!hasColumn && reg.test(href)) {
                init_idx = 2;
                $('.c-inbanner .subnavbg').eq(init_idx - 1).show();
                $('#header ul').find('li').eq(init_idx).addClass("current").siblings("li").removeClass("current");
            }
        }
    }
    $(function () {
        // 搜索框显示隐藏
       $(".icon-search").hover(function(){
        $(this).addClass('show');
        $(this).find(".hs-input").focus();
        },function(){
         $(this).removeClass('show');
    });

        $(".icon-search").focusout(function() {
            $(this).removeClass('show');
        });

        //当前页面导航高亮*

        //导航滑动效果
        var navparent = $("#header"),
          navline = navparent.find(".navline"),
          navcurrent = navparent.find(".nav .current");
        if (navcurrent.length > 0) {
            thisoffsetli = navcurrent.position().left + 18,
                thiswidth = navcurrent.find("a").width();
            navline.css({ 'left': thisoffsetli });
            navline.css({ 'width': thiswidth });
            navline.show();
        }
        navparent.find(".nav li").hover(function () {
            var navlinewidth = $(this).find("a").width();
            var offsetli = $(this).position().left + 18;
            navline.css({ 'width': navlinewidth }).stop().animate({ 'left': offsetli }, 300);
        }, function (){
            //navline.css({ 'width': thiswidth }).stop().animate({ 'left': thisoffsetli }, 300);
        });

        var navparent2 = $(".fixheader"),
        navline2 = navparent2.find(".navline"),
        navcurrent2 = navparent2.find(".nav .current");
        if (navcurrent2.length > 0) {
            var thisoffsetli2 = navcurrent2.position().left + 18,
                thiswidth2 = navcurrent2.find("a").width();
            navline2.css({ 'left': thisoffsetli2 });
            navline2.css({ 'width': thiswidth2 });
            navline2.show();
        }
        navparent2.find(".nav li").hover(function () {
            var navlinewidth2 = $(this).find("a").width();
            var offsetli2 = $(this).position().left + 18;
            navline2.css({ 'width': navlinewidth2 }).stop().animate({ 'left': offsetli2 }, 300);
        }, function () {
            navline2.css({ 'width': thiswidth2 }).stop().animate({ 'left': thisoffsetli2 }, 300);
        });
        $('.nav ul li').hover(function () {
            var index = $(this).index();
            if (index > 0 && index < 9)
                $('.c-inbanner .subnavbg').eq(index - 1).show().siblings().hide();
            else
             //   $('.c-inbanner .subnavbg').eq(init_idx - 1).show().siblings().hide();
        //$('.c-inbanner .subnavbg').hide();
        $('.c-inbanner .subnavbg2').show();
        }, function () {
        });
        $('.c-header').hover(function () {
        }, function () {
            $('.c-inbanner .subnavbg').eq(init_idx - 1).show().siblings().hide();
            navline.css({ 'width': thiswidth }).stop().animate({ 'left': thisoffsetli }, 300);
        });
    });
}

$(function () {
    $(document).ready(function(){
        var url = window.location.href;
        if (url.indexOf('aspx') < 0 && url.indexOf('html')>0) {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
        }
    });

    // 首页二维码显示
    $("body").delegate(".attent .wx","mouseover",function(){
        $(".attent .wx").addClass('hover');
    });

    $("body").delegate(".attent .wx","mouseout",function(){
        $(".attent .wx").removeClass('hover');
    });

    // 员工行为弹窗
    $(".bhfinger a").hover(function(event) {
        $(".bhfinger a").removeClass('current');
        $(this).addClass('current');
        var index = $(this).parent().index();
        $(".bhfinger-body").hide();
        $(".bhfinger-body").eq(index).show();
    });

    $(".soc-btn").click(function(event) {
        var id = $(this).data("id");
        var href = $(this).attr("href");
        if(href == 'javascript:;' && id){
            $("#bg-mask").fadeIn();
            $(".mailbox").each(function(){
                if($(this).data("id") == id) $(this).fadeIn();
            });
            return false;
        }
        // $("#bhdiv").fadeIn();
    });

    $(".btn-mask-close,#bg-mask,#bh-code").click(function(event) {
        $("#bg-mask").fadeOut();
        $("#bhdiv").fadeOut();
        $(".bhbox").fadeOut();
        $("#codediv").fadeOut();
        $(".tsbox").fadeOut();
    });

    // 违纪举报弹窗
    $("#a-jubao").click(function(event) {
        $("#bg-mask").fadeIn();
        $(".tsbox").fadeIn();
    });

    // 管理团队切换
    $(".teamtype a").click(function(event) {
        $(this).addClass('current').siblings().removeClass('current');
        var index = $(this).index();
        $(".team-list").hide();
        $(".team-list").eq(index).fadeIn(300);
    });

    // 自媒体
    $(".location a").hover(function(event) {
        $(this).addClass('current').siblings().removeClass('current');
        var city = $(this).data("city");
        $(".media-ewm").hide();
        $(".media-ewm").each(function(){
            if($(this).data("ewm") == city) $(this).show();
        });
    }),function(){};
//11-14修改
    $('.media-ewm').each(function(){
        if($(this).children('span').length > 2){        
           $(this).children('span').children('img').css({'width':'140px','height':'140px'});
          }
     })




    // 网上举报
    // $(".btn-jubao").click(function(event) {
    //     $(".subdiv").fadeIn(300);
    // });

    // 举报事项多选框
    $(".iform-checkbox").click(function(event) {
        $(this).find(".checkbox-span").toggleClass('current');
    });

    // 侧边栏
    $("body").delegate(".icon-menu,.btn-sitemap","click",function(){
        $("body").toggleClass('open-side');
        return false;
    });
    $("body").delegate(".side-close,#side-mask","click",function(){
        $("body").removeClass('open-side');
        return false;
    });

    $(".city-item-div a").hover(function(event) {
        $(this).addClass('current').siblings().removeClass('current');
        $(".layout-location-name h5").html($(this).text());
        var city = $(this).data("city");

        $(".layout-showcontent>div").hide();
        $(".layout-showcontent>div").each(function(){
            if($(this).data("city") == city) $(this).show();
        });
    });

    // 物业发展历程
    $(".develop-item a").click(function(event) {
        $(this).addClass('current').siblings().removeClass('current');
        var index = $(this).index();
        $(".develop-body").hide();
        $(".develop-body").eq(index).fadeIn();
        return false;
    });

    // 语言栏
    $(".lang-box").hover(function(){
        $(this).addClass('showicon');
    },function(){
        $(this).removeClass('showicon');
    });

    // 法律声明
    $("body").delegate("#btn-legal","click",function(){
        $("#lawmask").fadeIn();
        $("#lawdiv").fadeIn();
        return false;
    });
    $("body").delegate("#law-close,#lawmask","click",function(){
        $("#lawdiv").fadeOut();
        $("#lawmask").fadeOut();
    });

    // 文本框提示
    $(".queries-area").focus(function(event) {
        $(this).text("");
    });
    $(".queries-area").blur(function(event) {
        if($(this).text() == ""){
            $(this).text("建议或投诉内容");
        }
    });


    // 内页导航置顶
    var prevTop = 0,
        currTop = 0;
    if ($(window).scrollTop() >=110) {
        $('.p-header').removeClass('p-header-show').addClass('p-header-hide');
        $('.p-subnav').removeClass('p-subnav-show').addClass('p-subnav-hide');
    }
    if ($(window).scrollTop() <42) {
        $('.p-header').removeClass('p-header-hide').addClass('p-header-show');
        $('.p-subnav').removeClass('p-subnav-hide').addClass('p-subnav-show');
    }
    $(window).scroll(function () {
        currTop = $(window).scrollTop();
        if (currTop < prevTop) { //判断小于则为向上滚动
                setTimeout(function(){
                    $('.p-header').removeClass('p-header-hide').addClass('p-header-show');
                    $('.p-subnav').removeClass('p-subnav-hide').addClass('p-subnav-show');
                },100);
        } else {
            if ($(window).scrollTop() <42) {
                $('.p-header').removeClass('p-header-hide').addClass('p-header-show');
                $('.p-subnav').removeClass('p-subnav-hide').addClass('p-subnav-show');
            }
            if ($(window).scrollTop() >=110) {
                $('.p-header').removeClass('p-header-show').addClass('p-header-hide');
                $('.p-subnav').removeClass('p-subnav-show').addClass('p-subnav-hide');
            }
        }
        setTimeout(function(){prevTop = currTop},0);
    });
    $(".product2_phonelist").click(function(){
        $(".product2_phonelist .product2_phonelistd").show();
    });

    //底部友情链接
    $("#footer .select").each(function () {
        var s = $(this);
        var z = parseInt(s.css("z-index"));
        var dt = $(this).children("dt");
        var dd = $(this).children("dd");
        var _show = function () { dd.slideDown(200); dt.addClass("cur"); s.css("z-index", z + 1); };   //展开效果
        var _hide = function () { dd.slideUp(200); dt.removeClass("cur"); s.css("z-index", z); };    //关闭效果
        dt.click(function () { dd.is(":hidden") ? _show() : _hide(); });
        dd.find("a").click(function () { dt.html($(this).html()); _hide(); });     //选择效果（如需要传值，可自定义参数，在此处返回对应的“value”值 ）
        $("body").click(function (i) { !$(i.target).parents(".select").first().is(s) ? _hide() : ""; });
    })
    //组织文化
    $(".vision .box .inbox .question").eq(0).addClass("on");
    $(".vision .box .inbox .question").hover(function(){
        $(".vision .box .inbox .question").removeClass("on");
        $(this).addClass("on");
    })
});
