const itemsPerTime = 12;
let allListed = false;
let anuncios = data.anuncios;
let auxAnuncios = Array.from(data.anuncios);

const ordem = {
  recent: true,
  preco: true,
  views: true,
};
const filterPrice = (anuncio) => {
  const min = Number($("#preco-min").val());
  const max = Number($("#preco-max").val());
  if (min && max) {
    return anuncio.preco >= min && anuncio.preco <= max;
  } else if (min) return anuncio.preco >= min;
  else return anuncio.preco <= max;
};

$(document).ready(function () {
  if (anuncios.length <= itemsPerTime) allListed = true;
  displaySeeMore();
  $("a.btn-filtro").each((i, e) => {
    e.onclick = function () {
      $("a.btn-filtro.active").removeClass("active");
      $(e).addClass("active");
    };
  });

  $("#preco-min").blur(function () {
    data.anuncios = anuncios.filter(filterPrice);
  });
  $("#preco-max").blur(function () {
    data.anuncios = anuncios.filter(filterPrice);
  });

  $("a#recent").click(function () {
    const ordemUpRecent = (a, b) => Date.parse(a.data) - Date.parse(b.data);
    const ordemDownRecent = (a, b) => Date.parse(b.data) - Date.parse(a.data);
    if (ordem.recent) {
      data.anuncios.sort(ordemUpRecent);
      ordem.recent = false;
    } else {
      data.anuncios.sort(ordemDownRecent);
      ordem.recent = true;
    }
    listarProdutos();
  });
  $("a#views").click(function () {
    const ordemUpViews = (a, b) => a.views - b.views;
    const ordemDownViews = (a, b) => b.views - a.views;
    if (ordem.views) {
      data.anuncios.sort(ordemUpViews);
      ordem.views = false;
    } else {
      data.anuncios.sort(ordemDownViews);
      ordem.views = true;
    }

    listarProdutos();
  });
  $("a#preco").click(function () {
    const ordemUpPreco = (a, b) => a.preco - b.preco;
    const ordemDownPreco = (a, b) => b.preco - a.preco;
    if (ordem.preco) {
      data.anuncios.sort(ordemUpPreco);
      ordem.preco = false;
    } else {
      data.anuncios.sort(ordemDownPreco);
      ordem.preco = true;
    }
    listarProdutos();
  });

  $("a#listagem").click(function () {
    if (data.tipo_cartao == "vertical_complete") {
      data.tipo_cartao = "horizontal_half";
    } else {
      data.tipo_cartao = "vertical_complete";
    }
    listarProdutos();
  });

  $(".see-more").click(function () {
    printOnList();
  });

  $(".pagination li").click(function () {
    $(this).addClass("active").siblings().removeClass("active");
  });
});

const listarProdutos = function () {
  auxAnuncios = Array.from(data.anuncios);
  painelListagem.innerHTML = "";
  printOnList();
};

const printOnList = () => {
  let cont = 0;
  let eliminar = [];
  for (i in auxAnuncios) {
    const {
      id,
      localizacao_anunciante,
      preco,
      titulo,
      nome_anunciante,
      descricao,
    } = auxAnuncios[i];
    if (cont < itemsPerTime) {
      if (data.tipo_cartao == "horizontal_half") {
        painelListagem.appendChild(
          horizontalItem(
            id,
            auxAnuncios[i].foto[0].nome,
            titulo,
            descricao,
            preco,
            localizacao_anunciante,
            nome_anunciante,
            true
          )
        );
      } else {
        painelListagem.appendChild(
          verticalItem(
            id,
            auxAnuncios[i].foto[0].nome,
            titulo,
            descricao,
            preco,
            localizacao_anunciante,
            nome_anunciante,
            true
          )
        );
      }
      eliminar.push(auxAnuncios[i]);
    } else {
      break;
    }
    cont++;
  }
  auxAnuncios = auxAnuncios.filter((ad) => !eliminar.includes(ad));
  if (auxAnuncios.length <= 0) allListed = true;
  else allListed = false
  displaySeeMore();
};

const displaySeeMore = () => {
  if (allListed) $(".see-more").addClass("d-none");
  else if ($(".see-more").hasClass("d-none"))
    $(".see-more").removeClass("d-none");
};

const priceFormat = (price) => {
  const formatter = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "MZN",
  });
  return formatter.format(price);
};

const painelListagem = document.querySelector("#painelListagem");
