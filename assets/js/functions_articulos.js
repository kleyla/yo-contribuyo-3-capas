var tableArticulos;
document.addEventListener("DOMContentLoaded", function () {
  tableArticulos = $("#tableArticulos").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "articulos/getArticulos",
      dataSrc: "",
    },
    columns: [
      { data: "id_articulo" },
      { data: "titulo" },
      { data: "nick" },
      { data: "fecha" },
      { data: "estado" },
      { data: "opciones" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
});

$("#tableArticulos").DataTable();

window.addEventListener(
  "load",
  function () {
    deleteArticulo();
    enableArticulo();
  },
  false
);

function deleteArticulo() {
  var btnDelArticulo = document.querySelectorAll(".btnDelArticulo");
  btnDelArticulo.forEach(function (btn) {
    btn.addEventListener("click", function () {
      console.log("Deleting");
      var idArticulo = this.getAttribute("rl");
      // alert(idProyecto);
      swal(
        {
          title: "Eliminar Articulo",
          text: "Realmente quiere eliminar el Articulo?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, eliminar",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: true,
        },
        function (isConfirm) {
          if (isConfirm) {
            var request = window.XMLHttpRequest
              ? new XMLHttpRequest()
              : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url + "articulos/deleteArticulo";
            var strData = "idArticulo=" + idArticulo;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader(
              "Content-type",
              "application/x-www-form-urlencoded"
            );
            request.send(strData);
            request.onreadystatechange = function () {
              if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                  swal("Eliminar!", objData.msg, "success");
                  tableArticulos.api().ajax.reload(function () {
                    deleteArticulo();
                    enableArticulo();
                  });
                } else {
                  swal("Atencion!", objData.msg, "error");
                }
              }
            };
          }
        }
      );
    });
  });
}
function enableArticulo() {
  var btnEnableArticulo = document.querySelectorAll(".btnEnableArticulo");
  btnEnableArticulo.forEach(function (btn) {
    btn.addEventListener("click", function () {
      console.log("Deleting");
      var idArticulo = this.getAttribute("rl");
      // alert(idProyecto);
      swal(
        {
          title: "Habilitar Articulo",
          text: "Realmente quiere habilitar el Articulo?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, habilitar",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: true,
        },
        function (isConfirm) {
          if (isConfirm) {
            var request = window.XMLHttpRequest
              ? new XMLHttpRequest()
              : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url + "articulos/habilitarArticulo";
            var strData = "idArticulo=" + idArticulo;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader(
              "Content-type",
              "application/x-www-form-urlencoded"
            );
            request.send(strData);
            request.onreadystatechange = function () {
              if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                  swal("Eliminar!", objData.msg, "success");
                  tableArticulos.api().ajax.reload(function () {
                    deleteArticulo();
                    enableArticulo();
                  });
                } else {
                  swal("Atencion!", objData.msg, "error");
                }
              }
            };
          }
        }
      );
    });
  });
}
