/**
 * FileName : progress.js
 * @author Onogaki
 * Date     : 2017.01.31
 * Remark   : 進捗管理画面のスクリプト
 */


$(function() {
  //生徒アカウントの取得、selectに登録
  $.ajax({
    url: "/php/get_studentid.php",
    type: "POST",
    data: {
      teamId: $.cookie("team"),
    },
  })
  .done(function (data) {
    data = JSON.parse(data);
    // console.log(data);
    for (var i = 0, len = data.length; i < len; i++) {
      // console.log(data[i]);
      $("#idList").append("<option value='" + data[i] + "'>" + data[i] + "</option>");
    }
    if ($.cookie("selectedId")) {
      $("#idList").val($.cookie("selectedId"));
      $.removeCookie("selectedId", {path: "/"});
    }
    showProgress($("#idList").val());
  })
  .fail(function () {
    console.err("error");
  });
  //================================
  //select changeイベント登録
  $("#idList").change(function() {
    // console.log($(this).val());
    showProgress($(this).val());
  });

});


//1分ごとにページを更新
function reloadEveryMinute() {
  setInterval(reload, 60000);
}

function reload() {
  $.cookie("selectedId", $("#idList").val(), {path: "/"});
  window.location.reload();
}


//テーブルに進捗状況表示
function showProgress(studentId) {
  $.ajax({
    url: "/php/progress/get_progress_by_id.php",
    type: "POST",
    data: {
      teamId: $.cookie("team"),
      stId: studentId,
    },
  })
  .done(function (data) {
    var list = JSON.parse(data);
    console.log(list);
    var col = -1;
    for (var i = 0, len = list.length; i < len; i++) {
      if (i % 20 == 0) {
        col++;
        $("#tables").append("<table class='progressTable'><thead><tr><th>番号</th><th>ステージクリア数</th><th>挑戦中のステージ</th></tr></thead><tbody></tbody></table>");
      }
      $("tbody").eq(col).append("<tr><th>" + list[i].number + "</th><td>" + list[i].clearNum + "</td><td>" + list[i].nowStage + "</td></tr>");
    }
  })
  .fail(function () {
    console.err("error");
  });

}
