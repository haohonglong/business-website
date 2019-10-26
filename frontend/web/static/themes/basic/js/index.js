jQuery(".news-main").slide({
    titCell: ".news-xw-main li",
    mainCell: ".ss",
    autoPlay: false,
    trigger: "click"
});
$(function () {
    $('.news-main-dl li').slice(5, 10).hide();
    $(".news-xw-main li").click(function (event) {
        $(this).addClass('on').siblings().removeClass('on');
        var index = $(this).index()
    })
});
$(".news-gg-main li").click(function (event) {
    $(this).addClass('on').siblings().removeClass('on');
    var index = $(this).index();
    $(".inews-list").hide();
    $(".inews-list").eq(index).show()
});


$(function () {
    $(".hs-input:eq(0)").keydown(function (e) {
        var $this = $(this);
        if (e.keyCode == 13) {
            var searchValue = $(".hs-input:eq(0)").val();
            if (searchValue == '' || searchValue == $this.attr("placeholder")) return false;
            window.location.href = "/search/?key=" + searchValue
        }
    });
    $('.hs-submit:eq(0)').on("click",
    function () {
        var $this = $(this);
        var searchValue = $(".hs-input:eq(0)").val();
        if (searchValue == '' || searchValue == $this.attr("placeholder")) return false;
        window.location.href = "/search/?key=" + searchValue
    })
});