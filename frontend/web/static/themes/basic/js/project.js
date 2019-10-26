$(function () {
    var $tab_li = $('.p1-section4_header a');
    var aDiv = $('.p1-section4-inner');
    $tab_li.hover(function () {

        $(this).addClass('curt').siblings().removeClass('curt');
        var index = $tab_li.index(this);

        aDiv.eq(index).show().siblings().hide();
    });
});

//商业
function business_init() {
    $('.rd-slide').carousel();
    $('.slide').on('slid.bs.carousel', function () {
        var index = $(".carousel-inner").find(".active").index();

        $(".carousel-indicators h6").hide();
        $(".carousel-indicators h6").eq(index).fadeIn(300);
    });
    $(".carousel-indicators h6").eq(0).show();

    $(".bs4list li").click(function (event) {
        var info = $(this).data('info'),
            link = $(this).data('link'),
            img = $(this).find("img").attr("src");
        setData(info, link, img);
        $("#bg-mask").fadeIn();
        $("#brandbox").fadeIn();
    });

    $(".btn-mask-close,#bg-mask").click(function (event) {
        $("#bg-mask").fadeOut();
        $("#brandbox").fadeOut();
    });

    function setData(info, link, img) {
        $(".brandcont .intro").text(info);
        $(".alink").html(link);
        $(".brandimg").find("img").attr("src", img);
    }
}
//商业详情
function business_detail_init(PointX, PointY, Title, Address) {

    $('.bd-slide').carousel();
    jQuery(".picScroll-top1").slide({ titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "top", autoPlay: true, vis: 1, trigger: "mouseover" });
    jQuery(".bd-section42").slide({ titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "left", autoPlay: false, vis: 6, trigger: "click", pnLoop: false });
    $(document).ready(function () {

        //创建和初始化地图函数：
        function initMap() {
            setTimeout(function () {
                createMap();//创建地图
                setMapEvent();//设置地图事件
                addMapControl();//向地图添加控件
                addMarker();//向地图中添加marker
            }, 100)
        }


        //创建地图函数：
        function createMap() {
            var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
            var point = new BMap.Point(PointX, PointY);//定义一个中心点坐标
            map.centerAndZoom(point, 17);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent() {
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
//          map.enableScrollWheelZoom();//启用地图滚轮放大缩小
			map.disableScrollWheelZoom(true);
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        //地图控件添加函数：
        function addMapControl() {
            var scaleControl = new BMap.ScaleControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });
            scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
            map.addControl(scaleControl);
          //  var navControl = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_LARGE });
          //  map.addControl(navControl);
            var overviewControl = new BMap.OverviewMapControl({ anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: true });
            map.addControl(overviewControl);
            var top_right_navigation = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL }); //右上角，仅包含平移和缩放按钮
        	map.addControl(top_right_navigation);  // 右导航平移与缩放 
        }

        //标注点数组
        var markerArr = [{ title: "", content: "", point: PointX + "|" + PointY, isOpen: 0, icon: { w: 23, h: 25, l: 46, t: 21, x: 9, lb: 12 } }
        ];

        //创建marker
        function addMarker() {
            for (var i = 0; i < markerArr.length; i++) {
                var json = markerArr[i];
                var p0 = json.point.split("|")[0];
                var p1 = json.point.split("|")[1];
                var point = new BMap.Point(p0, p1);
                var iconImg = createIcon(json.icon);
                var marker = new BMap.Marker(point, { icon: iconImg });
                var iw = createInfoWindow(i);
                var label = new BMap.Label(json.title, { "offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20) });
                marker.setLabel(label);
                iw.open(marker);
                map.addOverlay(marker);
                label.setStyle({
                    borderColor: "#808080",
                    color: "#333",
                    cursor: "pointer"
                });

                (function () {
                    var index = i;
                    var _iw = createInfoWindow(i);
                    var _marker = marker;
                    _marker.addEventListener("click", function () {
                        _iw.open(_marker);
                        //this.openinfowindow(_iw);
                    });
                    _iw.addEventListener("open", function () {
                        _marker.getLabel().hide();
                    })
                    _iw.addEventListener("close", function () {
                        _marker.getLabel().show();
                    })
                    label.addEventListener("click", function () {
                        _marker.openInfoWindow(_iw);
                    })
                    if (!!json.isOpen) {
                        label.hide();
                        _marker.openInfoWindow(_iw);
                    }
                })()
            }
        }
        //创建InfoWindow
        function createInfoWindow(i) {
            var json = markerArr[i];
            var iw = new BMapLib.SearchInfoWindow(map, "<b class='iw_poi_title' style='width:250px;'>地址：" + Address + "</b>", {
                title: Title,      //标题
                width: 290,             //宽度
                height: 105,              //高度
                panel: "panel",         //检索结果面板
                enableAutoPan: true,     //自动平移
                searchTypes: [
                    BMAPLIB_TAB_SEARCH,   //周边检索
                    BMAPLIB_TAB_TO_HERE,  //到这里去
                    BMAPLIB_TAB_FROM_HERE //从这里出发
                ]
            });
            return iw;
        }
        //创建一个Icon
        function createIcon(json) {
            var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w, json.h), { imageOffset: new BMap.Size(-json.l, -json.t), infoWindowOffset: new BMap.Size(json.lb + 5, 1), offset: new BMap.Size(json.x, json.h) })
            return icon;
        }

        initMap();//创建和初始化地图
    });
}
//地产
function estate_init() {
    //plscity = DropDownList.create({
    //    select: $('#plscity'),
    //    attrs: {
    //        column: 5,
    //        width: 90
    //    }
    //});
    plsstatus = DropDownList.create({
        select: $('#plsstatus'),
        attrs: {
            column: 5,
            width: 138
        }
    });
    plssale = DropDownList.create({
        select: $('#sale'),
        attrs: {
            column: 5,
            width: 138
        }
    });

    $("#SearchCon").keydown(function (e) {
        if (e.keyCode == 13) {
            search();
        }
    });
    $("#SearchBtn").on("click", function () {
        search();
    });
    function search() {
        var value = encodeURIComponent($("#SearchCon").val());
        var city = $('.p1s1-top-arr').attr("data-id") == undefined || !new RegExp(/^[0-9]+.?[0-9]*$/).test($('.p1s1-top-arr').attr("data-id")) ? 0 : parseInt($('.p1s1-top-arr').attr("data-id"));
        var status = plsstatus.val();
        var sale = plssale.val();
        if (value.length > 0) {
            window.location.href = "/project/26/s/cts/" + city + "-" + status + "-" + sale + "/?k=" + value + "";
        } else {
            window.location.href = "/project/26/s/cts/" + city + "-" + status + "-" + sale + "/";
        }

    }
}
//地产详情
function estate_detail_init(pointX, pointY, address, phone, title) {

    $(function () {
        $(".rd-s4left-midcontent li a").eq(0).show();
        $('.rd-slide').carousel();
    });
    $(".spl-box").each(function (i) {
        var $this = $(this);
        var autoPlay = false;
        jQuery(".rd-s4left").slide({
            titCell: $this.find("li"),
            mainCell: ".rd-s4left-mid ul:eq(" + i + ")",
            effect: "fade",
            autoPlay: autoPlay,
            delayTime: 200,
            prevCell: ".ps7-leftbtn",
            nextCell: ".ps7-rightbtn",
            startFun: function (i, p) {
                if (i == 0) {
                    jQuery(".rd-s4left .btn-spl-left").click();
                } else if (i % 5 == 0) {
                    jQuery(".rd-s4left .btn-spl-right").click();
                }
            },
            pageStateCell: '#pageState' + i
        });
        jQuery(".rd-s4left").slide({
            mainCell: $this.find("ul"),
            delayTime: 100,
            vis: 5,
            scroll: 5,
            effect: "left",
            autoPage: autoPlay,
            prevCell: ".btn-spl-left",
            nextCell: ".btn-spl-right",
            pnLoop: false,
            pageStateCell: '.a'
        });
    });

    ////创建和初始化地图函数：
    //function initMap() {
    //    setTimeout(function () {
    //        createMap();//创建地图
    //        setMapEvent();//设置地图事件
    //        addMapControl();//向地图添加控件
    //        addMarker();//向地图中添加marker
    //    }, 100)
    //}


    ////创建地图函数：
    //function createMap() {
    //    var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
    //    var point = new BMap.Point(pointX, pointY);//定义一个中心点坐标
    //    map.centerAndZoom(point, 17);//设定地图的中心点和坐标并将地图显示在地图容器中
    //    window.map = map;//将map变量存储在全局
    //}

    ////地图事件设置函数：
    //function setMapEvent() {
    //    map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
    //    //map.enableScrollWheelZoom();//启用地图滚轮放大缩小
    //    map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
    //    map.enableKeyboard();//启用键盘上下左右键移动地图
    //}

    ////地图控件添加函数：
    //function addMapControl() {
    //    var scaleControl = new BMap.ScaleControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });
    //    scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
    //    map.addControl(scaleControl);
    //    var navControl = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_LARGE });
    //    map.addControl(navControl);
    //    var overviewControl = new BMap.OverviewMapControl({ anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: true });
    //    map.addControl(overviewControl);
    //}

    ////标注点数组
    //var markerArr = [{ title: "", content: "", point: pointX + "|" + pointY, isOpen: 0, icon: { w: 23, h: 25, l: 46, t: 21, x: 9, lb: 12 } }
    //];

    ////创建marker
    //function addMarker() {
    //    for (var i = 0; i < markerArr.length; i++) {
    //        var json = markerArr[i];
    //        var p0 = json.point.split("|")[0];
    //        var p1 = json.point.split("|")[1];
    //        var point = new BMap.Point(p0, p1);
    //        var iconImg = createIcon(json.icon);
    //        var marker = new BMap.Marker(point, { icon: iconImg });
    //        var iw = createInfoWindow(i);
    //        var label = new BMap.Label(json.title, { "offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20) });
    //        marker.setLabel(label);
    //        iw.open(marker);
    //        map.addOverlay(marker);
    //        label.setStyle({
    //            borderColor: "#808080",
    //            color: "#333",
    //            cursor: "pointer"
    //        });

    //        (function () {
    //            var index = i;
    //            var _iw = createInfoWindow(i);
    //            var _marker = marker;
    //            _marker.addEventListener("click", function () {
    //                _iw.open(_marker);
    //                //this.openinfowindow(_iw);
    //            });
    //            _iw.addEventListener("open", function () {
    //                _marker.getLabel().hide();
    //            })
    //            _iw.addEventListener("close", function () {
    //                _marker.getLabel().show();
    //            })
    //            label.addEventListener("click", function () {
    //                _marker.openInfoWindow(_iw);
    //            })
    //            if (!!json.isOpen) {
    //                label.hide();
    //                _marker.openInfoWindow(_iw);
    //            }
    //        })()
    //    }
    //}
    ////创建InfoWindow
    //function createInfoWindow(i) {
    //    var json = markerArr[i];
    //    var iw = new BMapLib.SearchInfoWindow(map, "<b class='iw_poi_title' style='width:250px;'>" + address + "</b><div class='iw_poi_content'>" + phone + "</div>", {
    //        title: title,      //标题
    //        width: 290,             //宽度
    //        height: 105,              //高度
    //        panel: "panel",         //检索结果面板
    //        enableAutoPan: true,     //自动平移
    //        searchTypes: [
    //            BMAPLIB_TAB_SEARCH,   //周边检索
    //            BMAPLIB_TAB_TO_HERE,  //到这里去
    //            BMAPLIB_TAB_FROM_HERE //从这里出发
    //        ]
    //    });
    //    return iw;
    //}
    ////创建一个Icon
    //function createIcon(json) {
    //    var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w, json.h), { imageOffset: new BMap.Size(-json.l, -json.t), infoWindowOffset: new BMap.Size(json.lb + 5, 1), offset: new BMap.Size(json.x, json.h) })
    //    return icon;
    //}

    //initMap();//创建和初始化地图

    //楼盘动态切换
    if ($(".rd-box-view > div").length > 2) {
        $(".rd-box-index").show();
        renderDom();

        $(".rd-box-index a").hover(function () {
            $(".rd-box-index a").removeClass('cur');
            $(this).addClass('cur');
            var index = $(this).index(),
                topNum = -172;
            runTop(index, topNum);
        });
        // 渲染DOM节点
        function renderDom() {
            var len = $(".rd-box-view>div").length,
                num = Math.ceil(len / 2),
                dom = '<a href="javascript:void(0);" class=""></a>';
            $(".rd-box-index").html("");
            for (var i = 0; i < num; i++) {
                $(".rd-box-index").append(dom);
            }
            $(".rd-box-index a").eq(0).addClass('cur');
        }
        // 切换动作
        function runTop(index, topNum) {
            $(".rd-box-view").stop().animate({ "top": topNum * index + "px" }, 400);
        }
    }

    SlideBox.init($(".rd-section5"));
    SlideBox.init($(".rd-section6"));

    $(".rd-s4-rbox3").click(function () {
        $("#pd-mapbox-scroll").ScrollTo(1000);
    });
}
//地产搜索
function estate_search_init(CityID, Status, k, Sale) {
    var ul_obj = $('.search-list');//内容ul
    var more_btn = $('.btn-ajax');//更多按钮
    var pageIndex = 1;
    $(function () {
        var c = parseInt(CityID), s = parseInt(Status), sell = parseInt(Sale);
        //$("#KeyValue").val(k);
        if (c != 0) {
            GetAreaByCity(c);
            //GetLineByCity(c);
            $("#CitySelect a[data-value=" + c + "]").addClass("selected").siblings("a").removeClass("selected");
        }
        if (s != 0) {
            $("#TypeSelect a[data-value=" + s + "]").addClass("selected").siblings("a").removeClass("selected");
        }
        if (sell != 0) {
            $("#SaleSelect a[data-value=" + sell + "]").addClass("selected").siblings("a").removeClass("selected");
        }

        GetInitProject(pageIndex);
        //点击选择事件
        $(".searchbox-select").delegate("#CitySelect a,#AreaSelect a,#LineSelect a,#SpecialSelect a,#TypeSelect a,#SaleSelect a", "click", function () {
            $(this).addClass("selected").siblings("a").removeClass("selected");
            pageIndex = 1;
            ul_obj.empty();
            GetInitProject(pageIndex);
        });

        //搜索输入框回车事件
        $("#KeyValue").keydown(function (e) {
            if (e.keyCode == 13) {
                pageIndex = 1;
                ul_obj.empty();
                GetInitProject(pageIndex);
            }
        });
        //搜索按钮
        $("#proSearchBtn").on("click", function () {
            pageIndex = 1;
            ul_obj.empty();
            GetInitProject(pageIndex);
        });

        function GetInitProject(pageIndex) {
            var param = {};
            if ($("#KeyValue").val() != '') {
                param["key"] = $("#KeyValue").val();
            }
            if ($("#CitySelect a.selected").text() != '全部') {
                param["city"] = $("#CitySelect a.selected").text();
            }
            if ($("#AreaSelect a.selected").text() != '全部') {
                param["area"] = $("#AreaSelect a.selected").text();
            }

            if ($("#TypeSelect a.selected").text() != '全部') {
                param["type"] = $("#TypeSelect a.selected").text();
            }
            if ($("#SaleSelect a.selected").text() != '全部') {
                param["sale"] = $("#SaleSelect a.selected").text();
            }
            param["pageIndex"] = pageIndex;
            GetProject(param);
        }

        //城市点击选择事件
        $("#CitySelect a").on("click", function () {
            GetAreaByCity($(this).data("value"));
        });
        more_btn.on('click', function () {
            GetInitProject(++pageIndex);
        });
    });
    //根据城市获取区域
    function GetAreaByCity(c) {
        $.ajax({
            type: "post",
            async: false,
            url: "/WebUserControl/project/estate_search_handler.ashx",
            data: { mode: "Area", city: c },
            success: function (data) {
                if (data == "") {
                    $("#AreaSelect").parent("div").css({ "display": "none" });
                } else {
                    $("#AreaSelect").parent("div").css({ "display": "block" });
                    $("#AreaSelect").empty().append("<a class=\"selected\" href=\"javascript:\" data-value=\"0\">全部</a>").append(data);
                }
            }
        });
    }
    //根据城市获取地铁线
    function GetLineByCity(c) {
        $.ajax({
            type: "post",
            async: false,
            url: "/WebUserControl/project/estate_search_handler.ashx",
            data: { mode: "Line", city: c },
            success: function (data) {
                if (data == "") {
                    $("#LineSelect").parent("div").css({ "display": "none" });
                } else {
                    $("#LineSelect").parent("div").css({ "display": "block" });
                    $("#LineSelect").empty().append("<a class=\"selected\" href=\"javascript:\" data-value=\"0\">全部</a>").append(data);
                }
            }
        });
    }

    function GetProject(param) {

        $.ajax({
            type: "post",
            async: false,
            url: "/WebUserControl/project/searchProjectLuceneHyq.ashx",
            data: param,
            success: function (data) {

                if (data.Status) {
                    $('.search-list.w1200').append(data.List);
                    more_btn.css({ "display": "block" });
                    if (pageIndex > 1) {
                        ul_obj.find('.page' + pageIndex).ScrollTo(1000);
                    }
                    if (ul_obj.find('li').length >= parseInt(data.TotalCount))
                        more_btn.css({ "display": "none" });
                } else
                    more_btn.css({ "display": "none" });
            }
        });
    }
}

//物业
function property_init() {
    $('.b-slide').carousel();

    jQuery(".ps7-left").slide({
        titCell: ".ps7-small-pic-box li",
        mainCell: ".ps7-list-box ul",
        effect: "fade",
        autoPlay: true,
        delayTime: 200,
        prevCell: ".ps7-leftbtn",
        nextCell: ".ps7-rightbtn",
        startFun: function (i, p) {
            if (i == 0) {
                jQuery(".ps7-left .ps7-small-left").click();
            } else if (i % 5 == 0) {
              //  jQuery(".ps7-left .ps7-small-right").click();
            }
        },
        endFun: function (i) {
            $(".ps7-rb>div").hide();
            $(".ps7-rb>div").eq(i).show();
            $(".ps7-left .pageState").hide();
            $(".ps7-left .pageState").eq(i).show();
        },
        pageStateCell: '.a'
    });
    jQuery(".ps7-left").slide({
        mainCell: ".ps7-small-pic-box ul",
        delayTime: 100,
        vis: 5,
        scroll: 5,
        effect: "left",
        autoPage: true,
        prevCell: ".ps7-small-left",
        nextCell: ".ps7-small-right",
        pnLoop: false,
        pageStateCell: '.a'
    });
    $(".ps7-rb>div").eq(0).show();
    $(".ps7-left .pageState").eq(0).show();

    $(".ps4-morebtn").click(function (event) {
        var city = $(this).data("city");
        $("#bg-mask").fadeIn();
        $(".bhbox").each(function () {
            if ($(this).data("city") == city) {
                $(this).fadeIn();
            }
        });
    });

    $(".ps5list li").click(function (event) {
        $("#bg-mask").fadeIn();
        var index = $(this).index();
        $(".codeadv-top a").removeClass('current');
        $(".codeadv-top a").eq(index).addClass('current');
        $(".codeadv-bd").hide();
        $(".codeadv-bd").eq(index).show();
        $("#codediv").fadeIn();
    });

    // 核心优势弹窗切换
    $(".codeadv-top a").click(function (event) {
        $(this).addClass('current').siblings().removeClass('current');
        var index = $(this).index();
        $(".codeadv-bd").hide();
        $(".codeadv-bd").eq(index).show();
        return false;
    });
}
//物业-历史沿革
function property_history_init() {
    var advanced = $(".develop-list"),
            advli = advanced.find("li"),
            advliwidth = advli.eq(0).outerWidth(true),
            advlilen = advli.length,
            i = parseInt(advlilen / 3),
            j = 0,
            timer = 0;
    if (advlilen >= 3) {
        advanced.find("ul").width($(".develop-list ul li").length * advliwidth);
        i = parseInt(advlilen / 3);
        if ((advlilen % 3) == 0) {
            i = i - 1;
        }
        $(".btn-developRight").click(function () {
            clearTimeout(timer);
            runNext();
            return false;
        });
        $(".btn-developLeft").click(function () {
            clearTimeout(timer);
            runPrev();
            return false;
        });
    }
    //切换下一个
    function runNext() {
        if (j < i) {
            ++j;
            advanced.find("ul").stop(false, true).animate({ "left": j * -advliwidth * 3 }, 300);
        }
    }
    //切换上一个
    function runPrev() {
        if (j != 0) {
            --j;
            advanced.find("ul").stop(false, true).animate({ "left": j * -advliwidth * 3 }, 300);
        }
    }
}
//物业-荣誉墙
function property_honor_init() {
    var ul_obj = $('.historybox ul');
    var more_btn = $('.btn-ajax');
    var pageSize = 5;
    $(function () {
        var pageIndex = 1;
        loadMore(pageIndex);
        more_btn.on('click', function () {
            loadMore(++pageIndex);
        });
    });
    function loadMore(pageIndex, typeId) {
        $.ajax({
            type: 'post',
            async: false,
            url: '/WebUserControl/project/property_honorHandler.ashx',
            data: { pageIndex: pageIndex },
            success: function (data) {
                var json = eval("(" + data + ")");
                if (json.list != '') {
                    ul_obj.append(json.list);
                    more_btn.css({ "display": "block" });
                    if (pageIndex > 1) {
                        ul_obj.find('.page' + pageIndex).ScrollTo(1000);
                    }
                    if (ul_obj.find('li').length >= parseInt(json.count))
                        more_btn.remove();
                } else
                    more_btn.remove();
            }
        });
    }
}
//物业-大事记
function property_story_init() {
    var advanced = $(".histhing-bg"),
                advli = advanced.find("li"),
                advliwidth = advli.eq(0).outerWidth(true),
                advlilen = advli.length,
                i = parseInt(advlilen / 3),
                j = 0,
                timer = 0;
    if (advlilen >= 3) {
        advanced.find("ul").width($(".histhing-list ul li").length * advliwidth);
        i = parseInt(advlilen / 3);
        if ((advlilen % 3) == 0) {
            i = i - 1;
        }
        $(".dev-right").click(function () {
            clearTimeout(timer);
            runNext();
            return false;
        });
        $(".dev-left").click(function () {
            clearTimeout(timer);
            runPrev();
            return false;
        });
    }
    //切换下一个
    function runNext() {
        if (j < i) {
            ++j;
            advanced.find("ul").stop(false, true).animate({ "left": j * -advliwidth * 3 }, 300);
        }
    }
    //切换上一个
    function runPrev() {
        if (j != 0) {
            --j;
            advanced.find("ul").stop(false, true).animate({ "left": j * -advliwidth * 3 }, 300);
        }
    }
}


$(function () {
    $('.p1s4-selectbox a').click(function () {
        cityText = $(this).text();
        $('.map1 i').each(function () {
            cityMap = $(this).attr('value');
            if (cityText == cityMap) {
                $(this).addClass('animate-bounce-up').siblings().removeClass('animate-bounce-up');
            }
        })
    })
    $('.bs3-select a').click(function () {
        cityText = $(this).text();
        $('.map2 i').each(function () {
            cityMap = $(this).attr('value');
            if (cityText == cityMap) {
                $(this).addClass('animate-bounce-up').siblings().removeClass('animate-bounce-up');
            }
        })
    })
    $('.ps4-selectbox a').click(function () {
        cityText = $(this).text();
        $('.map3 i').each(function () {
            cityMap = $(this).attr('value');
            if (cityText == cityMap) {
                $(this).addClass('animate-bounce-up').siblings().removeClass('animate-bounce-up');
            }
        })
    })
})