/**
 * Created by umka on 12.08.16.
 */
$(document).ready(function(){
    $('.clear-filter').click(function () {
        $('input[name="filter[' + $(this).data('id') + '][]"][value="' + $(this).data('value') + '"]').prop("checked", false);
        $('#filterForm').submit();
    });
    $('.sort_a').click(function () {
        $('#sort_input').val($(this).data('value'));
        $('#filterForm').submit();
        return false;
    });
    $('.show_comment').click(function () {
        $('.hidden-comment').toggleClass('drop');
    });
});