// function readFunc() {
//   var team = $.cookie("team");
//   var acco = $.cookie("account");
//   var changeResult = $.cookie("pass_change_ok_ng")
//   var ovcheck = $.cookie("ovcheck")
//   dispCountFunc();
// }
// function dispCountFunc(team, acco, changeResult) {
//   $("#team").text("団体ID : " + dispteamid);
//   $("#teamname").text("団体名 : " + dispteamname);
//   $("#account").text("アカウントID : " + dispaccountid);
//   $("#pass_change_ok_ng").text(disppass_change_ok_ng);
// }
// function dispTeamId(){
//   var dispteamid = $.cookie("team");
//   $.ajax({
//     type: "POST",
//     url: "/php/getteamname.php",
//     data: {PostValue01: dispteamid},
//     success: function(data) {
//       $("#teamname").text("団体名 : " + data);
//     }
//   });
// }

function initialize() {
  var team = $.cookie("team");
  var acco = $.cookie("account");
  var changeResult = $.cookie("pass_change_ok_ng");
  var ovcheck = $.cookie("ovcheck");
  var registsuccess = $.cookie("registsuccess");

  // var name = "";
  $.ajax({
    type: "POST",
    url: "/php/getteamname.php",
    data: {PostValue01: team},
    success: function(data) {
      $("#teamname").text("団体名 : " + data);
    }
  });



  $("#team").text("団体ID : " + team);
  // $("#teamname").text("団体名 : " + name);
  $("#account").text("アカウントID : " + acco);
  $("#pass_change_ok_ng").text(changeResult);
  $("#ovcheck").text(ovcheck);
  $("#registsuccess").text(registsuccess);
}
