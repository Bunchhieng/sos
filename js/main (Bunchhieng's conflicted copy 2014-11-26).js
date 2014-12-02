$(document).ready(function(){
    var bodyHeight = $('body').height();
    var vwptHeight = $(window).height();
    if (vwptHeight > bodyHeight) {
        $('#footer').css("margin-top", vwptHeight - bodyHeight);
    }
});