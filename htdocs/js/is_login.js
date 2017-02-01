if (!($.cookie("team") && $.cookie("account") && $.cookie("is_teacher"))) {
  //ログイン処理がなされていないとき
  $.ajax({
    url: "/php/logout.php",
  })
  .done(function() {
    window.location.href = "/";
  })
  .fail(function() {
    window.location.href = "/";
  });
  console.log("not");
} else if ($.cookie("is_teacher") == "false") {
  var url = window.location.href.split('/').pop();
  if (url != "main.html" && url != "main") {
    window.location.href = "/main";

  }
} else {
  console.log("loged in");
}
