function filterHideShow(el) {
    el = $(el);
    if (el.hasClass("full")){
        el.parents("div").find(".filter-top.full").addClass("hidden");
        el.parents("div").find(".filter-top.top-10").removeClass("hidden");
    }else{
        el.parents("div").find(".filter-top.full").removeClass("hidden");
        el.parents("div").find(".filter-top.top-10").addClass("hidden");
    }
}

function removeManufacturer() {
    var removeManufacturer = true;
    $.ajax({
        url: "",
        data: {removeManufacturer},
        type: "post",
        success: function () {
            $.pjax.reload("#itemList");
        }
    });
    $(".manufacturer").each(function (key,elem) {
        $(elem).prop("checked",false);
    });
}