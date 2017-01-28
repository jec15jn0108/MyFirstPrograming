var print = function(str) {
  var before = ( $("#console").val() != "\n" ) ? $("#console").val() : "";
  $("#console").val(before + str + "\n");
  $("#console").scrollTop( $("#console")[0].scrollHeight );
}
