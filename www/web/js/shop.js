/**
 * Created by umka on 10.01.16. *
 *
 * .cart-add   - style for add to cart button
 * #countItems - quantity of elements in cart
 * #priceItems - price of elements in cart
 */
console.log;
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

function setPerPage(page) {
    $.ajax({
        url: '',
        data: {page},
        type: 'post',
        success: function () {
        }
    });
}

function setDefaultSort() {
    $.ajax({
        url: '',
        data: {data:'true'},
        type: 'post',
        success: function () {
        }
    });
}

function setPriceRange(left, right) {
    $.ajax({
        url: '',
        data: {left,right},
        type: 'post',
        success: function () {
            $.pjax.reload('#itemList');
        }
    });
}

function setSort(sort) {
    $.ajax({
        url: '',
        data: {sort},
        type: 'post',
        success: function () {
        }
    });
}

function setListType(listType) {
    $.ajax({
        url: '',
        data: {listType},
        type: 'post',
        success: function () {
        }
    });
}
function addToWishList(id) {
    $.ajax({
        url: '/site/wish',
        data: {item_id: id},
        dataType: 'json',
        success: function (data) {
            showPopup(data.html)
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

function addToCartWishList() {
    var count ;
    if(document.getElementById('qty')) {
        count = $('#qty').val();
        if(document.getElementById('qty-'+id))
            count = $('#qty-'+id).val();
    } else count = 1;
    $.ajax({
        url: '/cart/ajax',
        data: {count: count, item_id: id},
        dataType: 'json',
        success: function (data) {
            if (document.getElementById('cart_cat')) {
                $.pjax.reload({container: "#cart", async: false});
                $.pjax.reload({container: "#mobile_cart", async: false});
                $.pjax.reload({container: "#cart_cat", async: false});
            } else {
                $.pjax.reload({container: "#cart"});
                $.pjax.reload({container: "#mobile_cart", async: false});
            }
            showPopup(data.html);
        }
    });
}

function addToCart(id) {
    var count ;
    if(document.getElementById('qty')) {
        count = $('#qty').val();
        if(document.getElementById('qty-'+id))
            count = $('#qty-'+id).val();
    } else count = 1;
    $.ajax({
        url: '/cart/ajax',
        data: {count: count, item_id: id},
        dataType: 'json',
        success: function (data) {
            if (document.getElementById('cart_cat')) {
                $.pjax.reload({container: "#cart", async: false});
                $.pjax.reload({container: "#mobile_cart", async: false});
                $.pjax.reload({container: "#cart_cat", async: false});
            } else {
                $.pjax.reload({container: "#cart"});
                $.pjax.reload({container: "#mobile_cart", async: false});
            }
            showPopup(data.html);
        }
    });
}

function quickView(id) {
    console.log(id);
    $.ajax({
        url: '',
        data: {modalId : id},
        type: 'post',
        success: function (data) {
            $.pjax.reload({container: "#quick-view-modal"});
            $('#quick-view-modal')
                .on('pjax:end',   function() { $('#modal').modal() });
        }
    });
}

function showPopup(html) {
    $.fancybox.open(html, {
        type : 'html',
        width : 500,
    });
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
    $.fancybox.close();
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
function deleteFromCart(id, cart_type, pjax) {
    $.ajax({
        url: '/cart/delete',
        async: true,
        data: {item_id: id, cart_type: cart_type},
        dataType: 'json',
        success: function (data) {
            if (document.getElementById('cart_cat')) {
                $.pjax.reload({container: "#cart", async: false});
                $.pjax.reload({container: "#mobile_cart", async: false});
                $.pjax.reload({container: "#cart_cat", async: false});
            } else {
                $.pjax.reload({container: "#cart"});
                $.pjax.reload({container: "#mobile_cart", async: false});
            }
        }
    });
}
function changeCountOfItem(id, cartType, $thisItem) {
    "use strict";
    if ($thisItem.val() < 0) {
        $thisItem.val(1);
        alert('Значение должно быть больше или равно 0');
    } else if ($thisItem.val() === "0") {
        deleteFromCart(id, cartType, $thisItem.parent());

    } else if ($thisItem.val() == '') {
        $thisItem.val(1);
    }else {
        $.ajax({
            url: 'cart/change',
            async: false,
            data: {id: +id, count: $thisItem.val(), cart_type: cartType},
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
function removeWish(id) {
    $.ajax({
        url: '/site/delwish',
        data: {wish_id: id},
        dataType: 'json',
        complete: function () {
            $.pjax.reload({container: '#wishlist'})
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
function refreshCarts() {
    if (document.getElementById('cart'))
        $.pjax.reload({container: "#cart", async: false});

    if (document.getElementById('mobile_cart'))
        $.pjax.reload({container: "#mobile_cart", async: false});

    if (document.getElementById('cart_cat'))
        $.pjax.reload({container: "#cart_cat", async: false});

    if (document.getElementById('total_sum'))
        $.pjax.reload({container: "#total_sum", async: false});

    return false;
}
function cleanCart() {
    $.ajax({
        url: '/cart/ajax-reset',
        data: {},
        dataType: 'json',
        success: function () {
           refreshCarts();
        }
    });
}
function setRating(rating) {
    $('#vote-rating').val(rating);
    for (var i=1;i<=5;i++)
        $('.star-'+i).removeClass('active');
    $('.star-'+rating).addClass('active');
}

$('#submit_step_one').on('click', function(){

    if(!$('#order-form')[0].checkValidity()) {

    } else {
        document.getElementById('checkout-step-address').style.display = 'none';
        $('#opc-address').removeClass('allow active');
        document.getElementById('checkout-step-review').style.display = '';
        $('#opc-review').addClass('allow active');
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#opc-review").offset().top - 200
        }, 800);
        $('#address_view').text('Address: ' + $('#orders-address').val());
    }
    $('#submit').click();
});

$(document).on('click', '.cart__remove', function(){ // нажатие на кнопку удаления товара в корзине
    deleteFromCart($(this).data('id'), $(this).data('type'), $(this).data('reload'));
});

$(document).on('click', '#see_reviews', function(){ // изменение значения количество в корзине
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#reviews_tabs").offset().top - 260
    }, 800);
    $('#reviews_button').parent().addClass('active');
    $('#description_button').parent().removeClass('active');
    $('#tags_button').parent().removeClass('active');
});

$(document).on('click', '#add_reviews', function(){ // изменение значения количество в корзине
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#add-review").offset().top - 200
    }, 800);
    $('#reviews_button').parent().addClass('active');
    $('#description_button').parent().removeClass('active');
    $('#tags_button').parent().removeClass('active');
});

$(document).on('click', '#all_description', function(){ // изменение значения количество в корзине
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#product_tabs_description").offset().top - 260
    }, 800);
    $('#reviews_button').parent().removeClass('active');
    $('#description_button').parent().addClass('active');
    $('#tags_button').parent().removeClass('active');
});

$(document).on('click', '#update_cart_button', function(){ // изменение значения количество в корзине
    refreshCarts();
});

$(document).on('click', '#empty_cart_button', function(){ // изменение значения количество в корзине
    cleanCart();
});

$(document).on('change', '.js-qty__num', function(){ // изменение значения количество в корзине
    if($('#qty').val() !== '') {
        changeCountOfItem($(this).data('id'), $(this).data('type'), $(this),$(this).val());
        refreshCarts();
    }
});

$('#wishlist').on('pjax:end', function(){ // изменение значения количество в корзине
    // showPopup('All wish list items add to cart');
    refreshCarts();
});

$(document).ready(function () {
    $('.star-'+$('#vote-rating').val()).addClass('active');
    setTimeout(function() {
        if (window.location.hash) {
            var hash = window.location.hash.substr(1);
            var scrollPos = $('a[name="'+hash+'"]').offset().top;
            $("html, body").animate({ scrollTop: scrollPos }, 1000);
        }
    }, 1);
});
function orderCheck(check,event) {
    if(check == 0){
        showPopup('Cart is empty');
        event.preventDefault();
        return false;
    }else{
        return true;
    }
}
$(document).ready(function() { // Ждём загрузки страницы
    var element = document.getElementById('forAdults');
    if(element){
        var conteiner = document.getElementById('itemList');
        conteiner.className +=' fadeContainer';

    }
});
$(document).on('click','.toast-success',function(){
    var conteiner = document.getElementById('itemList');
    conteiner.className ='';

});
$(document).on('click','.toast-success',function(){
    var conteiner = document.getElementById('itemList');
    conteiner.className ='';

});