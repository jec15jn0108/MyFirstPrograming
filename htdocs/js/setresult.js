function setresult() {
  var changeResult = $.cookie("result");
  var ovcheck = $.cookie("ovcheck");
  var registsuccess = $.cookie("registsuccess");

  $("#result").text(changeResult);
  $("#ovcheck").text(ovcheck);
  $("#registsuccess").text(registsuccess);
}
