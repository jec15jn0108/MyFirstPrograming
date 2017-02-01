// $(function(){
//   get_allstage();
// });

var selected = new Array();
var stageList;
$(function () {
  stageList = get_allstage();
  // console.log(get_allstage());
  // .done(function(data) {
    // stageList = data;
    $('#select_sortableO,#select_sortableC,#select_sortableR,#select_sortableA').sortable({
      handle: 'span',
      opacity: 0.5,
    }).selectable({
      cansel: 'span',
      filter: 'li',
    });

    $("button").each(function(i) {
      // $(this).attr("onclick", "onClickSort()");
      // $(this).attr("onclick", "onClickSort(" + genreId + ")");
      $(this).click(function() {
        var genreId = $(this).attr("value");
        // console.log(genreId);
        console.log(stageList[genreId - 1]);

        if (confirm(result + "の順番でいいかい？")) {
          $.ajax({
            type: "POST",
            url: "/php/stage_sort.php",
            data: {
              list: stageList[genreId - 1], 
              genre: genreId
            },
            success: function(data) {
              //$("#teamname").text("団体名 : " + data);
            }
          });
        } else {
          alert("キャンセルボタンがクリックされました");
        }

      });

    });
  // });

  // $("#submitO").click(function() {
  //   var result = $('#select_sortableO').sortable('toArray');
  //   // var nameList = [];
  //   // $("#select_sortableO li")
  //
  //   var genrecode = $(this).val();
    // if (confirm(result + "の順番でいいかい？")) {
    //   $.ajax({
    //     type: "POST",
    //     url: "/php/stage_o_sort.php",
    //     data: {list: sortlist, genre: genrecode},
    //     success: function(data) {
    //       //$("#teamname").text("団体名 : " + data);
    //     }
    //   });
    // } else {
    //   alert("キャンセルボタンがクリックされました");
    // }
  // });


});


function setStageList() {
  stageList = get_allstage();
  return stageList;
}
