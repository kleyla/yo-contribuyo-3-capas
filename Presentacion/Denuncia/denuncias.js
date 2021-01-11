function initTable() {
  if (document.querySelector("#tableDenuncias")) {
    var idArticulo = document.querySelector("#idArticulo").value;
    tableDenuncias = $("#tableDenuncias").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "denuncia/getDenuncias/" + idArticulo,
        dataSrc: "",
      },
      columns: [
        { data: "usuario_id" },
        { data: "nick" },
        { data: "razones" },
        { data: "fecha" },
        { data: "opciones" },
      ],
      resonsieve: "true",
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
    });
  }
}
function setDenuncia() {
  var formDenuncia = document.querySelector("#formDenuncia");
  if (formDenuncia) {
    formDenuncia.onsubmit = function (e) {
      // console.log("IN...");
      e.preventDefault();
      var intArticulo = document.querySelector("#idArticulo").value;
      var strRazones = document.querySelector("#txtRazones").value;
      if (intArticulo == "" || strRazones == "") {
        alert("Atencion: Todos los campos son obligatorios");
        // alert("daji");
        return false;
      }
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "denuncia/setDenuncia";
      var formData = new FormData(formDenuncia);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      // console.log(request);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          console.log(request.responseText);
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            formDenuncia.reset();
            // alert(objData.msg);
            location.reload();
          } else {
            alert(objData.msg);
          }
        }
      };
    };
  }
}
function btnDeleteDenuncia(idUsuario) {
  var idArticulo = document.querySelector("#idArticulo").value;
  console.log(idUsuario);
  swal(
    {
      title: "Eliminar Denuncia",
      text: "Realmente quiere eliminar esta denuncia?",
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
        var ajaxUrl = base_url + "denuncia/deleteDenuncia";
        var strData = "idArticulo=" + idArticulo + "&idUsuario=" + idUsuario;
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
              tableDenuncias.api().ajax.reload();
            } else {
              swal("Atencion!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

var tableDenuncias;

document.addEventListener("DOMContentLoaded", function () {
  initTable();
  setDenuncia();
});
