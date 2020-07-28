const defaultImg = document.querySelector(".img-item").src;
$(document).ready(function () {
  // habilitar funcionalidade draggable
  $(".uploads").sortable({
    update: function () {
      let cont = 0;
      let imgs = $(".uploads").children();
      imgs.each(function (i, e) {
        $(this).attr("prioridade", cont);
        $(this)
          .find("span")
          .html(cont++);
      });
    },
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
    },
    buttonsStyling: false,
  });

  $("form#editar").submit(function (e) {
    e.preventDefault();
    const uri = base_url + "usuario/editar_anuncio";
    let formData = new FormData(this);

    let imgs = $(".uploads").children();
    let fotos = [];
    imgs.each(function (i, e) {
      let foto = {
        url: $(this).find("img").attr("src"),
        prioridade: Number($(this).attr("prioridade")),
      };
      fotos.push(foto);
    });
    formData.append("novaOrdem", JSON.stringify(fotos));
    $.ajax({
      url: uri,
      method: "POST",
      data: formData,
      cache: false,
      contentType: false,
      dataType: 'json',
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
      success: function (result) {
        let resultado = JSON.parse(result);
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
                  title: "Anuncio editado com sucesso.",
                  icon: "success",
                  showClass: {
                    popup: "animated zoomIn faster",
                  },
                  hideClass: {
                    popup: "animated zoomOut faster",
                  },
                  confirmButtonText: "Ver anuncio",
                  confirmButtonColor: "#8CD4F3",
                })
                .then((result) => {
                  if (result.value) {
                    //Success
                    window.location.href = resultado.message;
                  }
                });
            }, 100);

            break;
          default:
            toastr.error("nothing happened", "", { progressBar: true });
        }
      },
    });
  });
});
