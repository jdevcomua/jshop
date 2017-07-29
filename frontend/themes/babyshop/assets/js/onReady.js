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
    $('#SortBy').change(function () {
        $('#sort_input').val($(this).val());
        $('#filterForm').submit();
        return false;
    });
    $('.show_comment').click(function () {
        $('.hidden-comment').toggleClass('drop');
    });
    var hash = window.location.hash;
    hash && $('ul.nav-tabs a[href="' + hash + '"]').tab('show');
});