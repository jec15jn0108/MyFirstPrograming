function get_allaccount() {
  var team = $.cookie("team");
  var isteacher = 0;
  $('#accountlist').empty();
  $('#acclist').empty();
  $('#accountlist').append($("<option>").val("").text("---  [" + team + "]  の生徒ID一覧  ---"));
  $('#acclist').append($("<option>").val("").text("---   変更するアカウントを以下より選んでください   ---"));

  $.ajax({
    type: "POST",
    url: "/php/get_studentid.php",
    data: {
      teamId: team,
    },
    success: function(data) {
      var accountlist = JSON.parse(data);
      var i;
      for(i = 0; i < accountlist.length; i++){
        $('#accountlist').append($("<option>").val(accountlist[i]).text(accountlist[i]));
        $('#acclist').append($("<option>").val(accountlist[i]).text(accountlist[i]));
      }
    }
  });
}
