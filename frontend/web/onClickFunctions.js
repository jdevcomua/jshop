/**
 * Created by umka on 10.01.16.
 */
function openWishWindow(bool, id) {
    if (bool) {
        $('#forCenterAuth').toggleClass('d_n');
    } else {
        $('#forCenter').toggleClass('d_n');
        $('#forCenter').attr('vid', id);
    }
}
function closeWishWindow() {
    $('#forCenter').toggleClass('d_n');
}
function closeWishAuthWindow() {
    $('#forCenterAuth').toggleClass('d_n');
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
        data: {item_id: $('.forCenter').attr('vid'), list_id: list, textt: $('.wish_list_name').val()},
        dataType: 'text',
        success: function () {
            $('#towish-' + $('.forCenter').attr('vid')).toggleClass('d_n');
            $('#inwish-' + $('.forCenter').attr('vid')).toggleClass('d_n');
            $('#forCenter').toggleClass('d_n');
        }
    });
}
function addToCompareList(id) {
    $.ajax({
        url: '/site/compare',
        data: {item_id: id},
        dataType: 'text',
        success: function (data) {
            $('#toCompare').toggleClass('d_n');
            $('#inCompare').toggleClass('d_n');
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
        dataType: 'text',
        success: function (data) {
            var count = +$('#countItems ').html();
            if (count == 0) {
                $('#cartEmpty').toggleClass('d_n');
                $('#cartFull').toggleClass('d_n');
            }
            $('#countItems ').html(+count + 1);
            $('#toCart-' + id).toggleClass('d_n');
            $('#inCart-' + id).toggleClass('d_n');
        }
    });
}
function openFilterContent($thisItem) {
    $thisItem.parent('div').find('.filters-content').toggleClass('d_n');
}
function addToCartFromItemPage(id) {
    $.ajax({
        url: 'cart/ajax',
        data: {count: $('#test').val(), item_id: id},
        dataType: 'text',
        success: function (data) {
            var count = +$('#countItems').html();
            if (count == 0) {
                $('#cartEmpty').toggleClass('d_n');
                $('#cartFull').toggleClass('d_n');
            }
            $('#countItems').html(+count + +$('#test').val());
        }
    });
}
function deleteFromCart(id, $thisitem) {
    $.ajax({
        url: 'cart/delete',
        async: true,
        data: {item_id: id},
        dataType: 'text',
        success: function (data) {
            $thisitem.parent().parent().remove();
            var obj = eval(data);
            $('.sum').html(obj.sumAll);
            $('#countItems ').html(obj.countAll);
            if (obj.countAll == 0) {
                $('#cartFull').toggleClass('d_n');
                $('#cartEmpty').toggleClass('d_n');
            }
        }
    });
}
function changeCountOfItem(id, $thisItem) {
    if ($thisItem.val() < 0) {
        $thisItem.val(array[$thisItem.attr('id').split('-')[1]]);
        alert('Значение должно быть больше или равно 0');
    } else if ($thisItem.val() == 0) {
        $.ajax({
            url: 'cart/delete',
            async: false,
            data: {item_id: id},
            dataType: 'text',
            success: function (data) {
                var obj = eval(data);
                $('.sum').html(obj.sumAll);
                $('#countItems ').html(obj.countAll);
                $thisItem.parent().parent().parent().remove();
            }
        });
    } else {
        if ($thisItem.val() > array[$thisItem.attr('id').split('-')[1]]) {
            var toChange = $thisItem.val() - array[$thisItem.attr('id').split('-')[1]];
            $.ajax({
                url: 'cart/add',
                async: false,
                data: {item_id: id, count: toChange},
                dataType: 'text',
                success: function (data) {
                    var obj = eval(data);
                    $('.sum').html(obj.sumAll);
                    $('#price-' + $thisItem.attr('id').split('-')[1]).html(obj.sumItem);
                    $thisItem.val(obj.countItem);
                    array[$thisItem.attr('id').split('-')[1]] = obj.countItem;
                    $('#countItems ').html(obj.countAll);
                }
            });
        } else if ($thisItem.val() < array[$thisItem.attr('id').split('-')[1]]) {
            var toChange = array[$thisItem.attr('id').split('-')[1]] - $thisItem.val();
            $.ajax({
                url: 'cart/delete',
                async: false,
                data: {item_id: id, count: toChange},
                dataType: 'text',
                success: function (data) {
                    var obj = eval(data);
                    $('.sum').html(obj.sumAll);
                    $('#price-' + $thisItem.attr('id').split('-')[1]).html(obj.sumItem);
                    $thisItem.val(obj.countItem);
                    array[$thisItem.attr('id').split('-')[1]] = obj.countItem;
                    $('#countItems ').html(obj.countAll);
                    if (obj.countAll == 0) {
                        $('#cartFull').toggleClass('d_n');
                        $('#cartEmpty').toggleClass('d_n');
                    }
                }
            });
        }
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
function tabMyData() {
    $('.activeTab').toggleClass('d_n');
    $('.activeTab').toggleClass('activeTab');
    $('.active').toggleClass('active');
    $(this).toggleClass('active');
    $('#my_data').toggleClass('d_n');
    $('#my_data').toggleClass('activeTab');
}
function tabChangePassword() {
    $('.activeTab').toggleClass('d_n');
    $('.activeTab').toggleClass('activeTab');
    $('.active').toggleClass('active');
    $(this).toggleClass('active');
    $('#change_pass').toggleClass('d_n');
    $('#change_pass').toggleClass('activeTab');
}
function tabOrderHistory() {
    $('.activeTab').toggleClass('d_n');
    $('.activeTab').toggleClass('activeTab');
    $('.active').toggleClass('active');
    $(this).toggleClass('active');
    $('#history_order').toggleClass('d_n');
    $('#history_order').toggleClass('activeTab');
}
function tabWishList() {
    $('.activeTab').toggleClass('d_n');
    $('.activeTab').toggleClass('activeTab');
    $('.active').toggleClass('active');
    $(this).toggleClass('active');
    $('#wish_list').toggleClass('d_n');
    $('#wish_list').toggleClass('activeTab');
}