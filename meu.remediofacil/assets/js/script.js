$(document).ready(function() {  
  //mascaras
  $('.cnpj').mask('00.000.000/0000-00');
  $('.telefone').mask('(00) 00000-0000');
  $('.cep').mask('00000-000');

});

//esconder e mostrar menu
$(".line_menu").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});