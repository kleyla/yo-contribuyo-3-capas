document.addEventListener("DOMContentLoaded", function () {
  // NUEVO ARTICULOS
  var formArticulo = document.querySelector("#formArticulo");
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
    var ajaxUrl = base_url + "articulos/setArticulo";
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
              toArticulosPage();
            }
          );
        } else {
          swal("Error", objData.msg, "error");
        }
      }
    };
  };
  var idArticulo = document.querySelector("#idArticulo").value;
  console.log("Actualizar", idArticulo);
  if (idArticulo > 0) {
    editArticulo(idArticulo);
  } else {
    // console.log("Nuevo");
  }
});

function toArticulosPage() {
  window.location.href = base_url + "articulos/";
}
function editArticulo(idArticulo) {
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var ajaxUrl = base_url + "articulos/getArticulo/" + idArticulo;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      //   console.log(request.responseText);
      var objData = JSON.parse(request.responseText);
      if (objData.status) {
        document.querySelector("#idArticulo").value = objData.data.id_articulo;
        document.querySelector("#txtTitulo").value = objData.data.titulo;
        document.querySelector("#txtContenido").value = objData.data.contenido;
        if (objData.data.estado == 1) {
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
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
