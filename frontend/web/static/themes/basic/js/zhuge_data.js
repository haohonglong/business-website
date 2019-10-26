(function () {
    window.zhuge = window.zhuge || [];
    window.zhuge.methods = "_init identify track getDid getSid getKey setSuperProperty setUserProperties setPlatform".split(" ");
    window.zhuge.factory = function (b) {
        return function () {
            var a = Array.prototype.slice.call(arguments);
            a.unshift(b);
            window.zhuge.push(a);
            return window.zhuge;
        }
    };
    for (var i = 0; i < window.zhuge.methods.length; i++) {
        var key = window.zhuge.methods[i];
        window.zhuge[key] = window.zhuge.factory(key);
    }
    window.zhuge.load = function (b, x) {
        if (!document.getElementById("zhuge-js")) {
            var a = document.createElement("script");
            var verDate = new Date();
            var verStr = verDate.getFullYear().toString() + verDate.getMonth().toString() + verDate.getDate().toString();

            a.type = "text/javascript";
            a.id = "zhuge-js";
            a.async = !0;
            //a.src = (location.protocol == 'http:' ? "http://sdk.zhugeio.com/zhuge.min.js?v=" : 'https://zgsdk.zhugeio.com/zhuge.min.js?v=') + verStr;
            a.src = "https://datain.longfor.com/zhuge.js?v=" + verStr;
            a.onerror = function () {
                window.zhuge.identify = window.zhuge.track = function (ename, props, callback) {
                    if (callback && Object.prototype.toString.call(callback) === '[object Function]') {
                        callback();
                    } else if (Object.prototype.toString.call(props) === '[object Function]') {
                        props();
                    }
                };
            };
            var c = document.getElementsByTagName("script")[0];
            c.parentNode.insertBefore(a, c);
            window.zhuge._init(b, x)
        }
    };
    window.zhuge.load('c9af6444e8b74cd894feefdfef579e28', { //配置应用的AppKey
        superProperty: { //全局的事件属性(选填)
            '应用名称': '龙湖官网中文版pc端'
        },
        autoTrack: false,
        //启用全埋点采集（选填，默认false）
        singlePage: false //是否是单页面应用（SPA），启用autoTrack后生效（选填，默认false）
    });
    zhuge.track("龙湖官网中文版pc端访问");

    //事件埋点start
    var pathname = window.location.pathname.toLowerCase();
    $('.innavbg a[href="/project/27/"],.c-inbanner a[href="/project/27/"]').on('click', function () {//头部栏目-产品服务-商业运营-点击
        var $this = $(this);
        zhuge.track('头部栏目-产品服务-商业运营-点击', {}, function () { location.href = $this.attr('href'); });
    });
    if (pathname == "/") {
        $('.bs-box a[href="/project/27/"]').on('click', function () {//首页-主banner下方-商业运营-点击
            var $this = $(this);
            zhuge.track('首页-主banner下方-商业运营-点击', {}, function () { location.href = $this.attr('href'); });
        });
        $('.lay-box a[href="/project/26/map/idx/"]').on('click', function () {//首页-龙湖在中国-点击
            var $this = $(this);
            zhuge.track('首页-龙湖在中国-点击', {}, function () { location.href = $this.attr('href'); });
        });
    } else if (pathname == "/project/27/") {//商业运营页面访问事件
        zhuge.track('商业运营-页面访问');
        $('.bs2-content-right a').on('click', function () {
            var text = $(this).text();
            switch (text) {
                case "天街":
                case "星悦荟":
                case "家悦荟":
                    zhuge.track("商业运营-" + text + "-点击");
                    break;
            }
        });
    } else if (/\/project\/27\/[0-9]*\//.test(pathname)) {//天街页面访问事件
        var title = document.title;
        zhuge.track(title + '-页面访问');
        $(".bd-section1 h2").hover(function () { zhuge.track(title + '-联系我们-点击'); });
        $(".bd-section1 .bd-btn2.fr").hover(function () { zhuge.track(title + '-微信公众号-点击'); });
        $(".bd-section1 .bd-btn1.fr").hover(function () { zhuge.track(title + '-新浪微博-点击', {}, function () { location.href = $this.attr('href'); }); });
        $('.bd-section3 .picList li a').on('click', function () {
            var $this = $(this);
            zhuge.track(title + '-news-点击', {}, function () { location.href = $this.attr('href'); });
        });
        $('#dituContent').on('click', function () { zhuge.track(title + '-项目地理位置-点击'); });
    }
    //事件埋点end
})();