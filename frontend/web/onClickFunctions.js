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
    if ($('.wishRadio').filter(':checked').val() == '1') {
        var list = $('#wishSelect').val();
        var textt = '_';
    } else {
        var list = '0';
        var textt = $('.wish_list_name').val();
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
function openFilterContent() {
    $(this).parent('div').find('.filters-content').toggleClass('d_n');
}
function addToCartFromItemPage(id) {
    $.ajax({
        url: 'cart/ajax',
    data: { count: $('#test').val(), item_id: id },
        dataType: 'text',
        success: function(data){
            var count = +$('#countItems').html();
            if (count == 0) {
                $('#cartEmpty').toggleClass('d_n');
                $('#cartFull').toggleClass('d_n');
            }
            $('#countItems').html(+count + +$('#test').val());
        }
    });
}
function deleteFromCart(id){
    var $thisitem = $(this);
    $.ajax({
        url: 'cart/delete',
        async: false,
        data: { item_id: id},
        dataType: 'text',
        success: function(data){
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
function changeCountOfItem(id){
    var $thisItem = $(this);
    if ($(this).val() < 0) {
        $(this).val(array[$(this).attr('id').split('-')[1]]);
        alert('Значение должно быть больше или равно 0');
    } else if ($(this).val() == 0) {
        $.ajax({
            url: 'cart/delete',
            async: false,
            data: { item_id: id},
            dataType: 'text',
            success: function(data){
                var obj = eval(data);
                $('.sum').html(obj.sumAll);
                $('#countItems ').html(obj.countAll);
                $thisItem.parent().parent().parent().remove();
            }
        });
    } else {
        if ($(this).val() > array[$(this).attr('id').split('-')[1]]) {
            var toChange = $(this).val() - array[$(this).attr('id').split('-')[1]];
            $.ajax({
                url: 'cart/add',
                async: false,
                data: { item_id: id, count: toChange},
                dataType: 'text',
                success: function(data){
                    var obj = eval(data);
                    $('.sum').html(obj.sumAll);
                    $('#price-' + $thisItem.attr('id').split('-')[1]).html(obj.sumItem);
                    $thisItem.val(obj.countItem);
                    array[$thisItem.attr('id').split('-')[1]] = obj.countItem;
                    $('#countItems ').html(obj.countAll);
                }
            });
        } else if ($(this).val() < array[$(this).attr('id').split('-')[1]]) {
            var toChange = array[$(this).attr('id').split('-')[1]] - $(this).val();
            $.ajax({
                url: 'cart/delete',
                async: false,
                data: { item_id: id, count: toChange},
                dataType: 'text',
                success: function(data){
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