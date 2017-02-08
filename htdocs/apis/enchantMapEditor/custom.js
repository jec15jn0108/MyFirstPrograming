function setStart() {
  $("body").append("<div id='setStart'><p>スタート地点を設定</p></div>");
  // $("#setStart").append("x: <select id='x'></select> y: <select id='y'></select>");
  $("#setStart").append("x: <input type='number' id='sx'> y: <input type='number' id='sy'> 向き:<input type='number' id='direction'>");
  $("#sx, #sy, #direction").each(function() {
    $(this).attr("min", 0);
    $(this).attr("max", 15);
    $(this).attr("value", 0)
    $(this).attr("onclick", "$(this).focus()");
  });
  $("#direction").attr("max", 3);
}

function setGoal() {
  $("body").append("<div id='setGoal'><p>ゴール地点を設定</p></div>");
  $("#setGoal").append("x: <input type='number' id='gx'> y: <input type='number' id='gy'>");
  $("#gx, #gy").each(function() {
    $(this).attr("min", 0);
    $(this).attr("max", 15);
    $(this).attr("value", 0)
    $(this).attr("onclick", "$(this).focus()");
  });
}

// $(function() {
//   console.log("load");
//   if ($.cookie("map0") != "") {
//     loadMap();
//   }
// });
