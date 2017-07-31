/**
 * Created by umka on 10.01.16. *
 *
 * .cart-add   - style for add to cart button
 * #countItems - quantity of elements in cart
 * #priceItems - price of elements in cart
 */

var Shop = {
    init:function(){
        this.Cart.init();
    },
    isGuest: true
};
var Cart = {
    countItems: null,
    priceItems: null,
    init: function(){
        var self = this;
        this.priceItems = $('#priceItems');
        this.countItems = $('#countItems');
        $('.cart-add').click(function(){
            self.add($(this).data('id'));
        });
    },
    setCountItems:function(val){
        if (this.countItems)
            this.countItems.html(val);
    },
    setPriceItems:function(val){
        if (this.priceItems)
            this.priceItems.html(val);
    },
    add:function(id, count){
        var self = this;
        count = typeof count !== 'undefined' ?  count : 1;
        $.ajax({
            url: '/cart/ajax',
            data: {count: count, item_id: id},
            dataType: 'json',
            success: function (data) {
                if (data.count == 0) {
                    $('#cartEmpty').toggleClass('d_n');
                    $('#cartFull').toggleClass('d_n');
                }
                self.setCountItems(data.count);
                self.setPriceItems(data.price);
                $('#toCart-' + id).toggleClass('d_n');
                $('#inCart-' + id).toggleClass('d_n');
            }
        });
    }
};

Shop.Cart = Cart;

$(document).ready(function(){
    Shop.init();
});

function openWishWindow(id) {
    $.ajax({
        url: '/popup/add-to-wish',
        dataType: 'json',
        success: function (data) {
            $('#forCenter').data('vid', id);
            showPopup(data.html, data.title);
        }
    });
}
function openWishEditWindow(id) {
    $.ajax({
        url: '/user/edit-wish-list',
        dataType: 'json',
        data: {id: id},
        success: function (data) {
            $('#forCenter').data('vid', id);
            showPopup(data.html, data.title);
        }
    });
}
function closePopup() {
    $('#forCenter').toggleClass('d_n');
}
function addToWishList() {
    var list = '0';
    var textt = '_';
    if ($('.wishRadio').filter(':checked').val() == '1') {
        list = $('#wishSelect').val();
    } else {
        textt = $('.wish_list_name').val();
    }
    $.ajax({
        url: '/site/wish',
        data: {item_id: $('.forCenter').data('vid'), list_id: list, textt: $('.wish_list_name').val()},
        dataType: 'text',
        success: function () {
            $('#towish-' + $('.forCenter').data('vid')).toggleClass('d_n');
            $('#inwish-' + $('.forCenter').data('vid')).toggleClass('d_n');
            $('#forCenter').toggleClass('d_n');
        }
    });
}
function addToCompareList(id, $thisElement) {
    $.ajax({
        url: '/site/compare',
        data: {item_id: id},
        dataType: 'text',
        success: function (data) {
            $thisElement.parent().parent().find('#toCompare').toggleClass('d_n');
            $thisElement.parent().parent().find('#inCompare').toggleClass('d_n');
            //$('#toCompare').toggleClass('d_n');
            //$('#inCompare').toggleClass('d_n');
        }
    });
}
function deleteFromCompareList(id, $thisButton) {
    $.ajax({
        url: '/compare/delete',
        async: true,
        data: {item_id: id},
        dataType: 'text',
        success: function (data) {
            $thisButton.parent().parent().parent().parent().parent().remove();
        }
    });
}
function changeCategoryInCompare($thisElement) {
    $('.items-carousel').filter('.active').attr('style', 'display: none;');
    $('.items-carousel').filter('.active').toggleClass('active');
    $('#tab-' + $thisElement.parent().attr('id').split('-')[1]).toggleClass('active');
    $('#tab-' + $thisElement.parent().attr('id').split('-')[1]).attr('style', 'display: block;');
    $('.categoryLink').filter('.active').toggleClass('active');
    $thisElement.parent().toggleClass('active');
}
function addToCart(id) {
    $.ajax({
        url: '/cart/ajax',
        data: {count: 1, item_id: id},
        dataType: 'json',
        success: function (data) {
            var count = +$('#countItems ').html();
            if (count == 0) {
                $('#cartEmpty').toggleClass('d_n');
                $('#cartFull').toggleClass('d_n');
            }
            $('#countItems ').html(+count + 1);
            $('#toCart-' + id).toggleClass('d_n');
            $('#inCart-' + id).toggleClass('d_n');
            showPopup(data.html, data.title);
        }
    });
}
function showPopup(html, title) {
    $.fancybox.open(html);
    /*var forCenter = $('#forCenter');
    var popup = $('#popup');
    forCenter.find('.title').html(title);
    forCenter.find('.drop-content').html(html);
    forCenter.toggleClass('d_n');
    popup.css('left', ($(window).width() - popup.width())/2);
    popup.css('top', ($(window).height() - popup.height())/2);*/
}
function addKit(id) {
    $.ajax({
        url: '/cart/ajaxkit',
        data: {count: 1, item_id: id},
        dataType: 'json',
        success: function (data) {
            var count = +$('#countItems').html();
            if (count == 0) {
                $('#cartEmpty').toggleClass('d_n');
                $('#cartFull').toggleClass('d_n');
            }
            $('#countItems ').html(+count + 1);
            showPopup(data.html, data.title);
        }
    });
}
function openFilterContent($thisItem) {
    $thisItem.parent('div').find('.filters-content').toggleClass('d_n');
}
function addToCartFromItemPage(id) {
    $.ajax({
        url: '/cart/ajax',
        data: {count: $('#test').val(), item_id: id},
        dataType: 'json',
        success: function (data) {
            var count = +$('#countItems').html();
            if (count == 0) {
                $('#cartEmpty').toggleClass('d_n');
                $('#cartFull').toggleClass('d_n');
            }
            $('#countItems').html(+count + +$('#test').val());
            $('#toCart').toggleClass('d_n');
            $('#inCart').toggleClass('d_n');
            showPopup(data.html, data.title);
        }
    });
}
function deleteFromCart(id, cart_type, $thisitem) {
    $.ajax({
        url: 'cart/delete',
        async: true,
        data: {item_id: id, cart_type: cart_type},
        dataType: 'json',
        success: function (data) {
            $thisitem.parent().parent().remove();
            $('.sum').html(data.sumAll);
            $('#countItems ').html(data.countAll);
            if (data.countAll == 0) {
                $('#cartFull').toggleClass('d_n');
                $('#cartEmpty').toggleClass('d_n');
            }
        }
    });
}
function changeCountOfItem(id, cartType, $thisItem) {
    if ($thisItem.val() < 0) {
        $thisItem.val(1);
        alert('Значение должно быть больше или равно 0');
    } else if ($thisItem.val() == 0) {
        deleteFromCart(id, cartType, $thisItem.parent());
    } else {
        $.ajax({
            url: 'cart/change',
            async: false,
            data: {id: +id, count: +$thisItem.val(), cart_type: cartType},
            dataType: 'json',
            success: function (data) {
                $('.sum').html(data.sumAll);
                var tr = $thisItem.parent().parent().parent();
                tr.find('.price-new').find('.price').html(data.sumItem);
                if (data.sumItem != data.oldPriceItem) {
                    tr.find('.price-discount').find('.price').html(data.oldPriceItem);
                }
                $thisItem.val(data.countItem);
                $('#countItems ').html(data.countAll);
            }
        });
    }
}
function removeWishList(id) {
    $.ajax({
        url: '/site/dellist',
        data: {list_id: id},
        dataType: 'text',
        success: function () {
            $('#list-' + id).toggleClass('d_n');
        }
    });
}
function removeItemFromWishList(id) {
    $.ajax({
        url: '/site/delwish',
        data: {wish_id: id},
        dataType: 'text',
        success: function () {
            $('#wish-' + id).toggleClass('d_n');
        }
    });
}