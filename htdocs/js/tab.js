$(function() {
    $(".tab li").click(function() {
        // var name = event.target.parentNode.classList[1];
        var name = $(this).parent().attr("class").split(" ")[1];
        // console.log(name);
        var num = $(".tab." + name + " li").index(this);
        $(".tabContent.active." + name).removeClass('active');
        $(".tab." + name + " li.active").removeClass('active');
        $(".tabContent." + name).eq(num).addClass('active');
        $(this).addClass('active');
    });
});
