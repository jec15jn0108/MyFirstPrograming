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

if ($.cookie("is_teacher") == "false") {
  $("#teacher-header").empty();

}


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
  var clearedNumber = $.cookie("cleared_number");
  if (clearedNumber) {
    clearedNumber = JSON.parse(clearedNumber);
  } else {
    clearedNumber = [[],[],[],[]];
  }
  data = data.split(",");
  $(".stageList").each(function(i) {
    for (var j = 1; j <= data[i]; j++) {
      $(this).append("<li class='stageNumber'>" + j + "</li>");
      if (clearedNumber[i][j - 1]) {
          $("li", this).eq(j - 1).css("background-color", "#4bc600");
      }
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

function setNowStage() {
  if ($.cookie("is_teacher") == "false") {
    $.ajax({
      url: "/php/set_now_stage.php",
      type: "POST",
      data: {
        teamId: $.cookie("team"),
        accountId: $.cookie("account"),
        number: $.cookie("number"),
        map: map.name,
      }
    })
    .done(function(data) {
      console.log(data);
    })
    .fail(function() {

    });
  }
}
//===========================================================================



//ゴール時の処理
function  showGoalWindow() {
  if (workspace.getAllBlocks().length <= map.maxBlockNum) {
    var ret = window.confirm("GOOOOOOAL");


    var cleared = $.cookie("cleared");
    var clearedNumber = $.cookie("cleared_number");
    if (!cleared) {
      cleared = new Object();
      clearedNumber = [[], [], [], []];
    } else {
      cleared = JSON.parse(cleared);
      clearedNumber = JSON.parse(clearedNumber);
    }
    if (!cleared[map.name]) {
      $.ajax({
        url: "/php/progress/add_clear_num.php",
        type: "POST",
        data: {
          teamId: $.cookie("team"),
          accountId: $.cookie("account"),
          number: $.cookie("number"),
        }
      })
      .done(function(data) {
        console.log(data);
      })
      .fail(function() {
      });
      cleared[map.name] = 1;
      clearedNumber[Number($.cookie("stage_genre")) - 1][Number($.cookie("stage_number")) - 1] = 1;
    }

    cleared = JSON.stringify(cleared);
    clearedNumber = JSON.stringify(clearedNumber);
    $.cookie("cleared", cleared);
    $.cookie("cleared_number", clearedNumber);

    if (ret) {
      $.ajax({
        url: "/php/get_stage_count.php",
        type: "POST",
        data: {
          teamId: $.cookie("team"),
        }
      })
      .done(function(data) {
        data = data.split(",");
        var genre = Number($.cookie("stage_genre")) - 1;
        var num = Number($.cookie("stage_number"));

        if (num >= data[genre]) {
          if (genre == 3) {
            window.alert("おめでとう！最後の問題をクリアした！");
          } else {
            $.cookie("stage_genre", genre + 2, {path: "/"});
            $.cookie("stage_number", 1, {path: "/"});
            window.location.reload();
          }
        } else {
          $.cookie("stage_number", num + 1, {path: "/"});
          window.location.reload();
        }
      })
      .fail(function() {

      });
    }
  } else {
    window.alert("ブロック数をもっと減らせるよ！\n\nパー：" + map.maxBlockNum + "ブロック");
  }
}
