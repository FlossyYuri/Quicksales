$(document).ready(function () {
  $("form#login").submit(function (e) {
    e.preventDefault();
    const uri = $("#base").val() + "usuario/entrar";
    $.ajax({
      url: uri,
      method: "POST",
      beforeSend: function () {
        Swal.fire({
          title: "Verificando...",
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          },
        });
      },
      complete: function () {
        Swal.close();
      },
      data: $("form#login").serialize(),
      success: function (result) {
        console.log(result);
        if (result.indexOf("|") == -1) {
          window.location.href = result;
        } else {
          const e = result.split("|");
          e.forEach((element) => {
            if (element.charAt(0) != "" && element.charAt(0) != "\n") {
              toastr.error(element, "", {
                progressBar: true,
              });
            }
          });
        }
      },
    });
  });

  //Form Registrar
  $("form#registro").submit(function (e) {
    e.preventDefault();
    if ($("#cbx-termos").is(":checked")) {
      const uri = $("#base").val() + "usuario/cadastrar";
      $.ajax({
        url: uri,
        method: "POST",
        data: $("form#registro").serialize(),
        beforeSend: function () {
          Swal.fire({
            title: "Verificando...",
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
          if (result.indexOf("|") == -1) {
            window.location.href = result;
          } else {
            let e = result.split("|");
            e.forEach((element) => {
              if (element.charAt(0) != "" && element.charAt(0) != "\n") {
                toastr.error(element, "", {
                  progressBar: true,
                });
              }
            });
          }
        },
      });
    } else {
      toastr.error(
        "Precisa concordar com os termos e condições. Marque a caixa de validação.",
        "",
        {
          progressBar: true,
        }
      );
    }
  });
});
