/**
 * Created by umka on 20.01.16.
 */
function deleteImage(id, $thisitem) {
    $.ajax({
        url: '/item/delete-image',
        data: {id: id},
        dataType: 'text',
        success: function () {
            $thisitem.parent().remove();
        }
    });
}