const previewImagem = function (inputField, img_destino) {
  const uri = $("#base").val() + "assets/img/add-image.png";
  if (inputField != null) {
    const ficheiro = inputField;
    const leitorFicheiro = new FileReader();
    leitorFicheiro.onloadend = function () {
      $(img_destino).attr("src", leitorFicheiro.result);
    };
    leitorFicheiro.readAsDataURL(ficheiro);
  } else {
    $(img_destino).attr("src", uri);
  }
};

let base_url = document.querySelector("#base").value;

$(document).ready(function () {
  // SideNav Button Initialization
  $(".button-collapse").sideNav({
    menuWidth: 300, // Width for sidenav
  });
  // SideNav Scrollbar Initialization
  const sideNavScrollbar = document.querySelector(".custom-scrollbar");
  const ps = new PerfectScrollbar(sideNavScrollbar);

  $(".bottom-bar a.btn-floating").each((i, e) => {
    e.onclick = function () {
      $(".bottom-bar a.btn-floating.active").removeClass("active");
      $(e).addClass("active");
    };
  });

  // Material Select Initialization
  $(".mdb-select").materialSelect();

  let cont = 0;
  $("input#pesquisa").keydown(function () {
    // let uri = $('#base').val() + 'principal/pesquisa/' + $('input#search').val();
    // autoComplete(uri, false)
  });

  $("input#pesquisa").keydown(function (e) {
    if (e.keyCode == 13) {
      e.preventDefault();
      const uri =
        base_url + "principal/pesquisaView/" + $("input#pesquisa").val();
      window.location.href = uri;
    }
  });
  window.addEventListener("scroll", function (event) {
    const scroll = this.scrollY;
    if (scroll >= 100) {
      if (!$(".online-container").hasClass("disapear"))
        $(".online-container").addClass("disapear");
    } else {
      if ($(".online-container").hasClass("disapear"))
        $(".online-container").removeClass("disapear");
    }
  });

  let interesses = [];
  $(".category-card").click(function () {
    const id = Number($(this).find("input[type=hidden]").val());
    if ($(this).hasClass("active")) {
      if (interesses.includes(id))
        interesses = interesses.filter((item) => {
          if (item == id) return false;
          return true;
        });
    } else {
      if (!interesses.includes(id)) interesses.push(id);
    }
    $(this).toggleClass("active");
    interesses.sort();
  });
  $("form#cadastrar-interesses").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: base_url + "usuario/atualizar_interesses",
      data: { interesses: JSON.stringify(interesses) },
      beforeSend: function () {
        Swal.fire({
          title: "Guardando seus interesses...",
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          },
        });
      },
      complete: function () {
        Swal.close();
      },
      success: function (data) {
        let resultado = JSON.parse(data);
        let e;
        switch (resultado.type) {
          case "ok":
            toastr.success(resultado.message, "", { progressBar: true });
            break;
          case "error":
            toastr.error(resultado.message, "", { progressBar: true });
            break;
          default:
            toastr.error("nothing happened", "", { progressBar: true });
        }
      },
    });
  });

  // function autoComplete(url, update) {
  //   $.ajax({
  //     type: "GET",
  //     url: url,
  //     success: function (response) {
  //       autoCompleteSuccess(response, update);
  //     },
  //   });
  // }

  // function autoCompleteSuccess(response, update) {
  //   let nameArray = JSON.parse(response);
  //   let dataName = {};
  //   for (let i = 0; i < nameArray.length; i++) {
  //     dataName[nameArray[i].titulo] = null;
  //   }
  //   if (update) {
  //     const pozycje_autocomplete = document.querySelector(
  //       "input#pesquisa"
  //     );
  //     let instance = M.Autocomplete.getInstance(pozycje_autocomplete);

  //     instance.updateData(dataName);
  //   } else {
  //     $("input#pesquisa").autocomplete({
  //       data: dataName,
  //       limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
  //     });
  //   }
  // }
});
const newElement = (tag, className) => {
  const element = document.createElement(tag);
  element.className = className;
  return element;
};
const newElementText = (tag, className, text) => {
  const element = document.createElement(tag);
  element.className = className;
  element.innerHTML = text;
  return element;
};

const verticalItem = function (
  productID,
  img,
  title,
  description,
  price,
  local,
  publisher,
  btnDesejo
) {
  const div1 = newElement(
    "div",
    "col-sm-6 col-lg-4 col-xl-3 mb-4 animated fadeIn"
  );
  const div2 = newElement("div", "card card-vertical z-depth-0");

  const divImage = newElement(
    "div",
    "view overlay card-image d-flex align-items-center"
  );
  const aLink = newElement("a", "img-link");
  aLink.href =
    "http://localhost/projects/QuickSales/principal/produto/" + productID;
  const linkImg = newElement("img", "card-img-top h-100");
  linkImg.src = img;
  const floatEdit = newElement("a", "btn-floating btn-action orange");
  floatEdit.href = base_url + "userLinks/editar/" + productID;
  const iconEdit = newElement("i", "fas fa-pen");
  const floatDelete = newElement("a", "btn-floating btn-action orange");
  floatDelete.href = base_url + "usuario/apagar_anuncio/" + productID;
  const iconDelete = newElement("i", "fas fa-trash");
  const floatHeart = newElement("a", "btn-floating btn-action orange");
  floatHeart.href = base_url + "usuario/cadastrar_desejo/" + productID;
  const iconHeart = newElement("i", "fas fa-heart");
  aLink.appendChild(linkImg);
  divImage.appendChild(aLink);
  floatEdit.appendChild(iconEdit);
  floatDelete.appendChild(iconDelete);
  floatHeart.appendChild(iconHeart);

  const divButtons = newElement("div", "d-flex justify-content-end");
  if (btnDesejo) {
    divButtons.appendChild(floatHeart);
  } else {
    divButtons.appendChild(floatEdit);
    divButtons.appendChild(floatDelete);
  }

  const divContent = newElement("div", "card-body px-4 pt-4 pb-2");
  const h4 = newElementText("h4", "card-title truncate mb-1", title);
  const hr = newElement("hr", "my-2");
  const descrip = newElementText("p", "card-text truncate-wrap", description);
  divContent.appendChild(h4);
  divContent.appendChild(hr);
  divContent.appendChild(descrip);

  const divFooter = newElement(
    "div",
    "rounded-bottom rgba-blue-grey-slight px-4 py-2"
  );
  const itemList = newElement("ul", "list-unstyled");
  const li1 = newElement("li", "price-item");
  const preco = newElementText("a", "", priceFormat(price));
  preco.href =
    "http://localhost/projects/QuickSales/principal/produto/" + productID;
  const li2 = newElement("li", "location-item");
  const loc = newElementText("span", "blue-grey-text", local);
  const li3 = newElement("li", "user-item");
  const user = newElementText("span", "black-text", publisher);

  li1.appendChild(preco);
  li2.appendChild(loc);
  li3.appendChild(user);
  itemList.appendChild(li1);
  itemList.appendChild(li2);
  itemList.appendChild(li3);
  divFooter.appendChild(itemList);

  div2.appendChild(divImage);
  div2.appendChild(divButtons);

  div2.appendChild(divContent);
  div2.appendChild(divFooter);
  div1.appendChild(div2);
  return div1;
};
const horizontalItem = function (
  productID,
  img,
  title,
  description,
  price,
  local,
  publisher,
  btnDesejo
) {
  const div1 = newElement("div", "col-md-12 col-lg-6 mb-3 animated fadeIn");
  const div2 = newElement("div", "card h-100");
  const div3 = newElement("div", "row no-gutters h-100");

  const divImage = newElement(
    "div",
    "col-md-5 d-flex justify-content-center align-items-center"
  );
  const aLink = newElement("a", "h-100");
  aLink.href =
    "http://localhost/projects/QuickSales/principal/produto/" + productID;
  const linkImg = newElement("img", "card-img obj-fit-cover h-100");
  linkImg.src = img;

  const divContentSide = newElement("div", "col-md-7");
  const divContent = newElement("div", "card-body pb-2");
  const h4 = newElementText("h5", "card-title mb-1 truncate", title);
  const descrip = newElementText("p", "card-text truncate-wrap", description);
  divContent.appendChild(h4);
  divContent.appendChild(descrip);

  const divButtons = newElement("div", "d-flex justify-content-end");
  const floatEdit = newElement("a", "btn-floating btn-action orange");
  floatEdit.href = base_url + "userLinks/editar/" + productID;
  const iconEdit = newElement("i", "fas fa-pen");
  const floatDelete = newElement("a", "btn-floating btn-action orange");
  floatDelete.href = base_url + "usuario/apagar_anuncio/" + productID;
  const iconDelete = newElement("i", "fas fa-trash");
  const floatHeart = newElement("a", "btn-floating btn-action orange");
  floatHeart.href = base_url + "usuario/cadastrar_desejo/" + productID;
  const iconHeart = newElement("i", "fas fa-heart");
  aLink.appendChild(linkImg);
  divImage.appendChild(aLink);
  floatEdit.appendChild(iconEdit);
  floatDelete.appendChild(iconDelete);
  floatHeart.appendChild(iconHeart);

  //floating action buttons displayed
  if (btnDesejo) {
    divButtons.appendChild(floatHeart);
  } else {
    divButtons.appendChild(floatEdit);
    divButtons.appendChild(floatDelete);
  }

  const hr = newElement("hr", "my-0");

  const divFooter = newElement("div", "py-2 mt-3 px-4");
  const itemList = newElement("ul", "list-unstyled");
  const li1 = newElement("li", "price-item");
  const preco = newElementText("a", "", priceFormat(price));
  preco.href =
    "http://localhost/projects/QuickSales/principal/produto/" + productID;
  const li2 = newElement("li", "location-item");
  const loc = newElementText("span", "blue-grey-text", local);
  const li3 = newElement("li", "user-item");
  const user = newElementText("span", "black-text", publisher);

  li1.appendChild(preco);
  li2.appendChild(loc);
  li3.appendChild(user);
  itemList.appendChild(li1);
  itemList.appendChild(li2);
  itemList.appendChild(li3);
  divFooter.appendChild(itemList);

  divContentSide.appendChild(divContent);
  divContentSide.appendChild(divButtons);
  divContentSide.appendChild(hr);
  divContentSide.appendChild(divFooter);
  div3.appendChild(divImage);
  div3.appendChild(divContentSide);
  div2.appendChild(div3);
  div1.appendChild(div2);
  return div1;
};
