var tableLenguajes;
document.addEventListener("DOMContentLoaded", function () {
  tableLenguajes = $("#tableLenguajes").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "lenguajes/getLenguajes",
      dataSrc: "",
    },
    columns: [
      { data: "id_lenguaje" },
      { data: "nombre" },
      { data: "link" },
      { data: "fecha" },
      { data: "estado" },
      { data: "opciones" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
  // NUEVO LENGUAJE
  var formLenguaje = document.querySelector("#formLenguaje");
  formLenguaje.onsubmit = function (e) {
    // console.log("IN...");
    e.preventDefault();
    var intIdLenguaje = document.querySelector("#idLenguaje").value;
    var strNombre = document.querySelector("#txtNombre").value;
    var strLink = document.querySelector("#txtLink").value;
    if (strNombre == "" || strLink == "") {
      swal("Atencion", "Todos los campos son obligatorios", "error");
      // alert("daji");
      return false;
    }
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url + "lenguajes/setLenguaje";
    var formData = new FormData(formLenguaje);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    // console.log(request);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        // console.log(request.responseText);
        var objData = JSON.parse(request.responseText);
        if (objData.status) {
          $("#modalFormLenguaje").modal("hide");
          formLenguaje.reset();
          swal("Lenguaje", objData.msg, "success");
          tableLenguajes.api().ajax.reload(function () {
            EditarLenguaje();
            DeleteLenguaje();
          });
        } else {
          swal("Error", objData.msg, "error");
        }
      }
    };
  };
});

$("#tableLenguajes").DataTable();

function openModalLenguaje() {
  console.log("open Modal Lenguaje");
  stylesFromUpdateToRegisterLenguaje();
  document.querySelector("#formLenguaje").reset();
  $("#modalFormLenguaje").modal("show");
}

function stylesFromUpdateToRegisterLenguaje() {
  document.querySelector("#idLenguaje").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#titleModalLenguaje").innerHTML = "Nuevo Lenguaje";
  document.querySelector("#btnText").innerHTML = "Guardar";
}
function stylesFromRegisterToUpdateLenguaje() {
  document.querySelector("#titleModalLenguaje").innerHTML =
    "Actualizar Lenguaje";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";
}

window.addEventListener(
  "load",
  function () {
    EditarLenguaje();
    DeleteLenguaje();
    enableLenguaje();
  },
  false
);
function EditarLenguaje() {
  var btnEditUsuario = document.querySelectorAll(".btnEditLenguaje");
  btnEditUsuario.forEach(function (btn) {
    btn.addEventListener("click", function () {
      // console.log("Editando");
      stylesFromRegisterToUpdateLenguaje();

      var idLenguaje = this.getAttribute("rl");
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "lenguajes/getLenguaje/" + idLenguaje;
      request.open("GET", ajaxUrl, true);
      request.send();

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          //   console.log(request.responseText);
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            document.querySelector("#idLenguaje").value =
              objData.data.id_lenguaje;
            document.querySelector("#txtNombre").value = objData.data.nombre;
            document.querySelector("#txtLink").value = objData.data.link;

            $("#modalFormLenguaje").modal("show");
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    });
  });
}

function DeleteLenguaje() {
  var btnDelLenguaje = document.querySelectorAll(".btnDelLenguaje");
  btnDelLenguaje.forEach(function (btn) {
    btn.addEventListener("click", function () {
      var idLenguaje = this.getAttribute("rl");
      // alert(idLenguaje);
      swal(
        {
          title: "Eliminar Lenguaje",
          text: "Realmente quiere eliminar el Lenguaje?",
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
            var ajaxUrl = base_url + "lenguajes/deleteLenguaje";
            var strData = "idlenguaje=" + idLenguaje;
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
                  tableLenguajes.api().ajax.reload(function () {
                    EditarLenguaje();
                    DeleteLenguaje();
                    enableLenguaje();
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
function enableLenguaje() {
  var btnEnableLenguaje = document.querySelectorAll(".btnEnableLenguaje");
  btnEnableLenguaje.forEach(function (btn) {
    btn.addEventListener("click", function () {
      var idLenguaje = this.getAttribute("rl");
      // alert(idLenguaje);
      swal(
        {
          title: "Habilitar Lenguaje",
          text: "Realmente quiere habilitar el Lenguaje?",
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
            var ajaxUrl = base_url + "lenguajes/habilitarLenguaje";
            var strData = "idlenguaje=" + idLenguaje;
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
                  swal("Habilitar!", objData.msg, "success");
                  tableLenguajes.api().ajax.reload(function () {
                    EditarLenguaje();
                    DeleteLenguaje();
                    enableLenguaje();
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
