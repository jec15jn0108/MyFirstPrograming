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
function showGoalWindow() {
  print("Code:");
  print(getCode());
  var mapName = $("#stageName").val();

  if (mapName == "") {
    window.alert("ステージ名を設定してもう一度実行して下さい");
    $("#stageName").val("");
    $("#stageName").focus();
    return false;
  }

  var ret = window.confirm("実行したコードを模範解答に設定しますか？\n\nステージ名: " + mapName + "\nブロックの数: " + blockNum + "\n\n" + getCode() + "\n");
  if (ret) {
    var jsStr = $.cookie("map0") + $.cookie("map1") + $.cookie("map2");
    var xmlStr = Blockly.Xml.workspaceToDom(workspace);
    xmlStr.setAttribute('id', 'workspaceBlocks');
    xmlStr.setAttribute('style', 'display:none');
    xmlStr = xmlStr.outerHTML;

    // console.log(jsStr);
    // console.log(xmlStr);

    $.ajax({
      url: "/php/save_map.php",
      type: "POST",
      data: {
        teamId: $.cookie("team"),
        mapName: $("#stageName").val(),
        mapData: jsStr,
        answer: xmlStr,
        blockNum: blockNum,
        genre: $("#genre").val(),
      }
    })
    .done(function (data) {
      console.log(data);
      if (data != "true") {
        window.alert("ステージ名: " + $("#stageName").val() + " は既に存在しています。")
      } else {
        window.location.href = "/main.html";
      }
    })
    .fail(function () {
      console.err("error");
    });

    // var stageJson = {
    //   map: jsStr,
    //   answer: xmlStr
    // };
    //
    // console.log(stageJson);

  } else {

  }
}


function logout() {
  $.ajax({
    url: "/php/logout.php",
  })
  .done(function() {
    window.location.href = "/";
  })
  .fail(function() {

  });
}
