$(document).ready(function () {
  $(".icone").click(function () {
    $("#imagem-principal").attr("src", $(this).attr("src"));
  });
});
