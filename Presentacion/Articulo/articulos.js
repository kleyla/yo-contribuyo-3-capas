function initTable() {
  if ($("#tableArticulos")) {
    tableArticulos = $("#tableArticulos").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "articulo/getArticulos",
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
  }
}
function setArticulo() {
  var formArticulo = document.querySelector("#formArticulo");
  if (formArticulo) {
    formArticulo.onsubmit = function (e) {
      // console.log("IN...");
      e.preventDefault();
      var intIdArticulo = document.querySelector("#idArticulo").value;
      var strTitulo = document.querySelector("#txtTitulo").value;
      var strContenido = document.querySelector("#txtContenido").value;
      var intStatus = document.querySelector("#listStatus").value;

      if (strTitulo == "" || strContenido == "" || intStatus == "") {
        swal("Atencion", "Todos los campos son obligatorios", "error");
        // alert("daji");
        return false;
      }
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "articulo/setArticulo";
      var formData = new FormData(formArticulo);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            formArticulo.reset();
            swal(
              {
                title: "Articulo",
                text: objData.msg,
                type: "success",
                showCancelButton: false,
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
              },
              function (isConfirm) {
                window.location.href = base_url + "articulo/index";
              }
            );
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    };
  }
}
function editArticulo() {
  if (document.querySelector("#idArticulo")) {
    var idArticulo = document.querySelector("#idArticulo").value;
    if (idArticulo > 0) {
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "articulo/getArticulo/" + idArticulo;
      request.open("GET", ajaxUrl, true);
      request.send();

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          //   console.log(request.responseText);
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            updateData(objData.data);
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    }
  }
}
function updateData(data) {
  document.querySelector("#idArticulo").value = data.id_articulo;
  document.querySelector("#txtTitulo").value = data.titulo;
  document.querySelector("#txtContenido").value = data.contenido;
  if (data.estado == 1) {
    var optionSelect =
      '<option value="1" selected class="notBlock">Publicar</option>';
  } else {
    var optionSelect =
      '<option value="2" selected class="notBlock">Borrador</option>';
  }
  var htmlSelect = `${optionSelect}
                              <option value="1">Publicar</option>
                              <option value="2">Borrador</option>`;
  document.querySelector("#listStatus").innerHTML = htmlSelect;
}
function deleteArticulo(id) {
  var idArticulo = id;
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
        var ajaxUrl = base_url + "articulo/deleteArticulo";
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
              tableArticulos.api().ajax.reload();
            } else {
              swal("Atencion!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}
function enableArticulo(id) {
  var idArticulo = id;
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
        var ajaxUrl = base_url + "articulo/habilitarArticulo";
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
              tableArticulos.api().ajax.reload();
            } else {
              swal("Atencion!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

var tableArticulos;

document.addEventListener("DOMContentLoaded", function () {
  initTable();
  setArticulo();
  editArticulo();
});
