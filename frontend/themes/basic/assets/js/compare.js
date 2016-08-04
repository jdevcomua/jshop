/**
 * Created by umka on 04.08.16.
 */
$(document).ready(function(){
    $('.btn-def-all').click(function(){
        $('.btn-def-only').removeClass('active');
        $(this).addClass('active');
        $('.compare-characteristic').find('li').removeClass('hide');
    });
    $('.btn-def-only').click(function(){
        $('.btn-def-all').removeClass('active');
        $(this).addClass('active');
        var arraysLi = [];
        var array1 = [];
        var arrayCompare = [];
        $('.items-carousel.active').find('.items-compare').find('.compare-characteristic').each(function(index){
            var arrayNew = [];
            var arrayLi = [];
            $(this).find('li').each(function(index){
                arrayLi.push($(this));
                arrayNew.push($(this).find('.characteristic-value').html());
            });
            arraysLi.push(arrayLi);
            array1.push(arrayNew);
        });
        if (array1.length > 1) {
            for (var k = 1; k < array1.length; k++) {
                for (var i = 0; i < array1[0].length; i++) {
                    if (arrayCompare[i] == undefined || arrayCompare[i] == true) {
                        arrayCompare[i] = (array1[k][i] == array1[0][i]);
                    }
                }
            }
            var newArray = [];
            $('.characteristic-names').find('li').each(function (index) {
                newArray.push($(this));
            });
            arraysLi.push(newArray);
            for (i = 0; i < array1[0].length; i++) {
                if (arrayCompare[i] == true) {
                    for (k = 0; k < arraysLi.length; k++) {
                        arraysLi[k][i].addClass('hide');
                    }
                }
            }
        }
    });
});