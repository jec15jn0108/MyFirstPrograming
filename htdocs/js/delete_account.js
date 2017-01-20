function deleteTeacher(){
  var team = $.cookie("team");
  var acco = $.cookie("account");
  var isteacher = $.cookie("isTeacher");
  if(window.confirm('本当に削除してよろしいですか？')){

    $.ajax({
      type: "POST",
      url: "/php/select_check.php",
      data: {PostValue01: team, PostValue02 : acco PostValue03 : isteacher },
      success: function(data) {
        $("#result").text("戻り値 : " + data);
      }
    });
    //window.alert('削除しました');
  } else {
    ;//Do Nothing;
  }
}
