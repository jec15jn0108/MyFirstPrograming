function get_allstage() {
  var stageList = [];
  $('#select_sortableO, #select_sortableC, #select_sortableR, #select_sortableA').empty();
  var team = $.cookie("team");
  var array = ['1', '2', '3', '4'];
  var array1 = ['#select_sortableO', '#select_sortableC', '#select_sortableR', '#select_sortableA'];
  // for(var i = 0; i < array1.length; i++) {
  // (function(i){
  $.ajax({
    type: "POST",
    url: "/php/get_allstage.php",
    async: false,
    data: {
      PostValue01: team,
      // PostValue02: array[i]
    },
    // success: function(data) {
      // console.log(i);
      // var stagelist = JSON.parse(data);
      // $.each(stagelist, function(index, val) {
      //   $(array1[i]).append("<li class='span' id='" + (index + 1) + "'><span class='ui-icon ui-icon-arrowthick-2-n-s ui-corner-all ui-state-hover'></span>" + (index + 1) + ":" + val + "</li>");
      // });
    // }
  })
  .done(function(data) {
    stageList = JSON.parse(data);
    for (var i = 0, len = stageList.length; i < len; i++) {
      var list = stageList[i];
      $.each(list, function(index, val) {
        $(array1[i]).append("<li class='span' id='" + (index + 1) + "'><span class='ui-icon ui-icon-arrowthick-2-n-s ui-corner-all ui-state-hover'></span>" + (index + 1) + ":" + val + "</li>");
      });
    }
    // console.log(stageList);
  });
  return stageList;
  // })(i);
  // }
}
