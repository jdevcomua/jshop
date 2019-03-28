/**
 * Created by umka on 12.08.16.
 */
$(document).ready(function(){
    $('.clear-filter').click(function () {
        if ($(this).data('type') == 'range') {
            $('input[name="filter[' + $(this).data('id') + '][' + $(this).data('value') + ']"]').attr('name', '');
        } else {
            $('input[name="filter[' + $(this).data('id') + '][]"][value="' + $(this).data('value') + '"]').prop("checked", false);
        }
        $('#filterForm').submit();
    });
    $('#filterForm').submit(function(){
        $('.slider-input').each(function() {
            if ($(this).hasClass('slider-input-left') && $(this).val() == $(this).attr('min')) {
                $('input[name="filter[' + $(this).data('id') + '][' + $(this).data('value') + ']"]').attr('name', '');
            } else if ($(this).hasClass('slider-input-right') && $(this).val() == $(this).attr('max')) {
                $('input[name="filter[' + $(this).data('id') + '][' + $(this).data('value') + ']"]').attr('name', '');
            }
        });
    });
    $('#SortBy').change(function () { // выбор значения в дропдауне сортировки на странице каталога
        $('#sort_input').val($(this).val());
        $('#filterForm').submit();
        return false;
    });

    $('.show_comment').click(function () {
        $('.hidden-comment').toggleClass('drop');
    });
    var hash = window.location.hash;
    hash && $('ul.nav-tabs a[href="' + hash + '"]').tab('show');

    $(document).on('click', '.cart__remove', function(){ // нажатие на кнопку удаления товара в корзине
        deleteFromCart($(this).data('id'), $(this).data('type'), $(this));
    });

    $(document).on('change', '.js-qty__num', function(){ // изменение значения количество в корзине
        changeCountOfItem($(this).data('id'), $(this).data('type'), $(this));
    });

    $(document).on('click', '.js-qty__adjust--plus', function(){ // нажатие нопку + количество в корзине
        var $input = $(this).parent().find('.js-qty__num').first();
        if ($input.length > 0) {
            $input.val(+$input.val() + 1);
            changeCountOfItem($input.data('id'), $input.data('type'), $input);
        }
    });

    $(document).on('click', '.js-qty__adjust--minus', function(){ // нажатие нопку - количество в корзине
        var $input = $(this).parent().find('.js-qty__num').first();
        if ($input.length > 0) {
            $input.val(+$input.val() - 1);
            changeCountOfItem($input.data('id'), $input.data('type'), $input);
        }
    });

    $(document).on('click', '.product-quick-view', function(){ // нажатие на кнопку быстрого просмотра товара в каталоге
        var item_id = $(this).data('id');
        $.ajax({
            url: '/item/quick-view',
            data: {id: item_id},
            type: 'get',
            success: function (html) {
                $.fancybox.open(html);
            }
        });
    });

    $(document).on('click', '.quickview-product .owl-wrapper a', function(){ // нажатие на кнопку быстрого просмотра товара в каталоге
        var image = $(this).data('image');
        $('#ProductPhotoImg').attr('src', image);
    });
});
