function logout() {
  $.ajax({
    url: "/php/logout.php",
  })
  .done(function() {
    window.location.href = "/";
  })
  .fail(function() {

  });
}
