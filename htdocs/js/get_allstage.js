function get_allstage() {
  $('#select_sortableO, #select_sortableC, #select_sortableR, #select_sortableA').empty();
  var team = $.cookie("team");
  var array = ['O', 'C', 'R', 'A'];
  var array1 = ['#select_sortableO', '#select_sortableC', '#select_sortableR', '#select_sortableA'];
  for(var i = 0; i < array1.length; i++) {
    (function(i){
      $.ajax({
        type: "POST",
        url: "/php/get_allstage.php",
        data: {PostValue01: team, PostValue02: array[i]},
        success: function(data) {
          console.log(i);
          var stagelist = JSON.parse(data);
          $.each(stagelist, function(index, val) {
            $(array1[i]).append("<li class='span'><span class='ui-icon ui-icon-arrowthick-2-n-s ui-corner-all ui-state-hover'></span>" + (index + 1) + ":" + val + "</li>");
          });
        }
      });
    })(i);
  }
}
