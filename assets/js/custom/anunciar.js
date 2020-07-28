const defaultImg = document.querySelector(".img-item").src;
$(document).ready(function () {
  let subs;
  $.ajax({
    url: base_url + "userLinks/get_subcategorias",
    success: function (data) {
      subs = JSON.parse(data);
    },
  });
  // habilitar funcionalidade draggable
  $(".uploads").sortable();

  // Mostrar as subcategorias dinamicamente
  $("select[name=categoria]").change(function (e) {
    e.preventDefault();
    $("select[name=subcategoria]").removeAttr("disabled");
    let subs_options =
      "<option disabled selected>Selecione a subcategoria do produto</option>";
    subs.forEach((element) => {
      if (element.referencia == $("select[name=categoria]").val()) {
        subs_options +=
          "<option value='" + element.id + "'> " + element.valor + "</option>";
      }
    });
    $("select[name=subcategoria]").html(subs_options);
    $("select[name=subcategoria]").materialSelect();
  });

  // Validação da imagem para preview
  $(".imagens").change(function (e) {
    let file = $(this)[0].files[0];
    if (file.size / 1024000 >= 2) {
      Swal.fire(
        "Imagem inválida",
        "A imagem inserida é muito grande. Cada imagem deve ter menos de 2MB.",
        "error"
      );
    } else {
      let id = $(this).attr("id");
      previewImagem(file, "#" + id + "-");
      $(".uploaded" + id[id.length - 1] + " .indice").text(id[id.length - 1]);
    }
  });

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  $("form#anunciar").submit(function (e) {
    e.preventDefault();
    const uri = base_url + "usuario/cadastrar_anuncio";
    let formData = new FormData(this);
    $.ajax({
      url: uri,
      method: "POST",
      data: formData,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        Swal.fire({
          title: "Criando Anuncio...",
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          },
        });
      },
      complete: function () {
        Swal.close();
      },
      success: function (resultado) {
        let e;
        switch (resultado.type) {
          case "validacao":
            e = resultado.message.split("|");
            e.forEach((element) => {
              if (element.charAt(0) != "" && element.charAt(0) != "\n")
                toastr.error(element, "", { progressBar: true });
            });
            break;
          case "sessao":
            toastr.error("This ain't no fucking Disney MOTHERFUCKER", "", {
              progressBar: true,
            });

            break;
          case "fotos":
            e = resultado.message.split("|");
            e.forEach((element) => {
              if (element.charAt(0) != "" && element.charAt(0) != "\n")
                toastr.error(element, "", {
                  progressBar: true,
                });
            });
            break;
          case "ok":
            setTimeout(() => {
              swalWithBootstrapButtons
                .fire({
                  title: "Anuncio publicado com sucesso.",
                  icon: "success",
                  showCancelButton: true,
                  showClass: {
                    popup: "animated zoomIn faster",
                  },
                  hideClass: {
                    popup: "animated zoomOut faster",
                  },
                  confirmButtonText: "Ver anuncio",
                  cancelButtonText: "Criar novo anuncio",
                  confirmButtonColor: "#8CD4F3",
                })
                .then((result) => {
                  if (result.value) {
                    //Success
                    window.location.href = resultado.message;
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    $("form#anunciar")[0].reset();
                    $(".img-item").attr("src", defaultImg);
                    $(".img-item").parent().next().html("-");
                    $(".mdb-select").materialSelect({
                      destroy: true,
                    });
                    $(".mdb-select").materialSelect();
                  }
                });
            }, 100);

            break;
          default:
            e = resultado.message.split("|");
            e.forEach((element) => {
              if (element.charAt(0) != "" && element.charAt(0) != "\n")
                toastr.error(element, "", {
                  progressBar: true,
                });
            });
        }
      },
    });
  });
});
