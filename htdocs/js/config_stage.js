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
  $("ul").sortable({
    handle: 'span',
    opacity: 0.5,
  }).selectable({
    cansel: 'span',
    filter: 'li',
    selected: function (event, ui) {
      if (selected.indexOf(ui.selected.id) === -1) {
        selected.push($(ui.selected).text());
      }
    },
    unselected: function (event, ui) {
      var id = ui.unselected.id;
      //remove an selected item from an array with splice.
      selected.splice(selected.indexOf($(ui.selected).text()), 1);
    }
  });

  $(".submit").each(function(i) {
    // $(this).attr("onclick", "onClickSort()");
    // $(this).attr("onclick", "onClickSort(" + genreId + ")");
    $(this).click(function() {
      var listname = ["#select_sortable1", "#select_sortable2", "#select_sortable3", "#select_sortable4"];
      var genreId = $(this).attr("value");
      var i = (genreId - 1);
      var listnum = $(listname[i]).sortable("toArray");
      // console.log(genreId);

      if (confirm(listnum + "の順番でいいかい？")) {
        $.ajax({
          type: "POST",
          url: "/php/stagesort.php",
          data: {
            list: stageList[genreId - 1],
            genre: genreId,
            sortlist: listnum
          },
          success: function(data) {
            window.location.href = "/config_stage.html";
          }
        });
      } else {
        ;//donothig
      }
    });
  });
  $("#delete").click(function(){
    console.log(selected);
    if(confirm(selected + "を削除します")){
      $.ajax({
        type: "POST",
        url: "/php/stagedelete.php",
        data: {
          deletelist: selected
        },
        success: function(data) {
          window.location.href = "/config_stage.html";
        }
      });
    } else {
      ;//donothig
    }
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
