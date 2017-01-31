//読み込み時
//ace
var width = window.innerWidth / 100 * 56.3;
var height = window.innerHeight / 100 * 88;
$("#codeEditor").css("width", width);
$("#codeEditor").css("height", height);
var editor = ace.edit("codeEditor");
editor.setTheme("ace/theme/monokai");
editor.setFontSize(22);
editor.getSession().setMode("ace/mode/html");
editor.getSession().setUseWrapMode(true);
editor.getSession().setTabSize(2);
editor.$blockScrolling = Infinity;
editor.setOptions({
  enableBasicAutocompletion: true,
  enableSnippets: true,
  enableLiveAutocompletion: true
});
editor.getSession().setMode("ace/mode/javascript");

editor.setValue(getCode(), -1);

function updateCode(event) {
  editor.setValue(getCode(), -1);
}
workspace.addChangeListener(updateCode);
workspace.addChangeListener(reset);
// workspace.addChangeListener(function () {
//   console.log(workspace.getAllBlocks().length);
// })

$(".tab.palette li").eq(1).click(function() {
  editor.focus();
});


//ステージ選択メニュー=================================================================
$.ajax({
  url: "/php/get_stage_count.php",
  type: "POST",
  data: {
    teamId: $.cookie("team"),
  }
})
.done(function (data) {
  // console.log(data);
  data = data.split(",");
  $(".stageList").each(function(i) {
    for (var j = 1; j <= data[i]; j++) {
      $(this).append("<li class='stageNumber'>" + j + "</li>");
      if (i + 1 == $.cookie("stage_genre") && j == $.cookie("stage_number")) {
        $("li", this).eq(j - 1).css("background-color", "#ff8200");
        $(".genre").eq(i).addClass("active");
        $("#genre li").eq(i).addClass("active");
      } else {
        $("li", this).eq(j - 1).attr("onclick", "chooseStage(" + (i + 1) + "," + j + ")");
      }
    }
  });
})
.fail(function () {
  console.err("error");
});

function chooseStage(genre, number) {
  console.log(genre + ":" + number);
  $.cookie("stage_genre", genre, {path: "/"});
  $.cookie("stage_number", number, {path: "/"});
  window.location.reload();
}
//===========================================================================



//ゴール時の処理
function  showGoalWindow() {
  if (workspace.getAllBlocks().length <= map.maxBlockNum) {
    window.alert("GOOOOOOAL");
  } else {
    window.alert("ちょｗｗｗｗブロックもっと減らせますよｗｗｗｗｗ");
  }
}
