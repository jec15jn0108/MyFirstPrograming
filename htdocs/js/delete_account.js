function deleteTeacher(){
  var team = $.cookie("team");
  var acco = $.cookie("account");
  if(window.confirm('本当に削除してよろしいですか？')){

    $.ajax({
      type: "POST",
      url: "/php/delete_account.php",
      data: {PostValue01: team, PostValue02 : account },
      success: function(data) {
        $("#result").text("戻り値 : " + data);
      }
    });
    //window.alert('削除しました');
  } else {
    ;//Do Nothing;
  }
}
