$(function() {
    $(".tab li").click(function() {
        var name = event.target.parentNode.classList[1];
        // console.log(name);
        var num = $(".tab li").index(this);
        $(".tabContent." + name).removeClass('active');
        $(".tabContent").eq(num).addClass('active');
        $(".tab." + name + " li").removeClass('active');
        $(this).addClass('active')
    });
});
