const defaultImage = document.querySelector("#imgPerfil").src;
const submitFoto = function () {
  if ($("input[name=fotoperfil]")[0].files.length > 0) {
    const uri = base_url + "usuario/atualizar_perfil";
    const formdata = new FormData();
    formdata.append("fotoperfil", $("#campoFoto")[0].files[0]);
    $.ajax({
      url: uri,
      method: "POST",
      data: formdata,
      cache: false,
      dataType: 'json',
      beforeSend: function () {
        Swal.fire({
          title: "Enviando Imagem...",
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          },
        });
      },
      complete: function () {
        Swal.close();
      },
      processData: false,
      contentType: false,
      success: function (result) {
        toastr.success(result, "", { progressBar: true });
      },
    });
  } else {
    toastr.success("Selecione uma imagem", "", { progressBar: true });
  }
};

const submitForm = function (form) {
  let formdata = new FormData(form);
  $.ajax({
    url: form.action,
    method: "POST",
    data: formdata,
    cache: false,
    beforeSend: function () {
      Swal.fire({
        title: "Enviando...",
        allowOutsideClick: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        },
      });
    },
    complete: function () {
      Swal.close();
    },
    processData: false,
    contentType: false,
    success: function (result) {
      let resultado = JSON.parse(result);
      let e;
      switch (resultado.type) {
        case "validation":
          e = resultado.message.split("|");
          e.forEach((element) => {
            if (element.charAt(0) != "" && element.charAt(0) != "\n")
              toastr.error(element, "", { progressBar: true });
          });
          break;
        case "error":
          toastr.error(resultado.message, "", {
            progressBar: true,
          });

          break;
        case "ok":
          toastr.success(resultado.message, "", {
            progressBar: true,
          });
          break;
        default:
          toastr.error("nothing happened", "", { progressBar: true });
          console.log("nothing happened");
      }
    },
  });
};

const setDefaultImg = () => {
  $("#imgPerfil").attr("src", defaultImage);
};
$(document).ready(function () {
  $("form[common-data]").submit(function (e) {
    e.preventDefault();
    submitForm(this);
  });

  $("input[name=fotoperfil]").change(function (e) {
    previewImagem(this.files[0], "#imgPerfil");
    setTimeout(() => {
      $("#alterar-foto").modal("show");
    }, 1000);
  });
});
