function deleteTeacher(){
  var team = $.cookie("team");
  var acco = $.cookie("account");
  var isteacher = $.cookie("is_teacher");
  if(window.confirm('本当に削除してよろしいですか？')){

    $.ajax({
      type: "POST",
      url: "/php/delete_id.php",
      data: {PostValue01: team, PostValue02: acco, PostValue03: isteacher },
      success: function(data) {
        // if(data === "true"){
        //   window.alert('全て削除しました');
        // } else {
        //   window.alert('削除しました');
        // }
        $.ajax({
          type: "POST",
          url: "/php/logout.php",
          data: {},
          success: function(data) {
            window.parent.location.href="/"
          }
        });
      }
    });
  } else {
    ;//Do Nothing;
  }
}
