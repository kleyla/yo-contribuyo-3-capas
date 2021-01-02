var tableRoles;
document.addEventListener("DOMContentLoaded", function () {
  tableRoles = $("#tableRoles").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "roles/getRoles",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "descripcion" },
      { data: "status" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
  // NUEVO ROL
  var formRol = document.querySelector("#formRol");
  formRol.onsubmit = function (e) {
    // console.log("IN...");
    e.preventDefault();
    var intIdRol = document.querySelector("#idRol").value;
    var strNombre = document.querySelector("#txtNombre").value;
    var strDescripcion = document.querySelector("#txtDescripcion").value;
    var intStatus = document.querySelector("#listStatus").value;
    if (strNombre == "" || strDescripcion == "" || intStatus == "") {
      swal("Atencion", "Todos los campos son obligatorios", "error");
      // alert("daji");
      return false;
    }
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url + "roles/setRol";
    var formData = new FormData(formRol);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    console.log(request);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        // console.log(request.responseText);
        var objData = JSON.parse(request.responseText);
        if (objData.status) {
          $("#modalFormRol").modal("hide");
          formRol.reset();
          swal("Rol de usuario", objData.msg, "success");
          tableRoles.api().ajax.reload(function () {
            fntEditRol();
            fntDelRol();
            // ftnPermisos();
          });
        } else {
          swal("Error", objData.msg, "error");
        }
      }
    };
  };
});

$("#tableRoles").DataTable();

function openModal() {
  //   console.log("Open");
  document.querySelector("#idRol").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#titleModal").innerHTML = "Nuevo Rol";
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#formRol").reset();
  $("#modalFormRol").modal("show");
}
window.addEventListener(
  "load",
  function () {
    fntEditRol();
    fntDelRol();
  },
  false
);
function fntEditRol() {
  //   console.log("Editing..");
  var btnEditRol = document.querySelectorAll(".btnEditRol");
  btnEditRol.forEach(function (btn) {
    btn.addEventListener("click", function () {
      //   console.log("Editando");
      document.querySelector("#titleModal").innerHTML = "Actualizar Rol";
      document
        .querySelector(".modal-header")
        .classList.replace("headerRegister", "headerUpdate");
      document
        .querySelector("#btnActionForm")
        .classList.replace("btn-primary", "btn-info");
      document.querySelector("#btnText").innerHTML = "Actualizar";

      var idrol = this.getAttribute("rl");
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "roles/getRol/" + idrol;
      request.open("GET", ajaxUrl, true);
      request.send();

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          //   console.log(request.responseText);
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            document.querySelector("#idRol").value = objData.data.id;
            document.querySelector("#txtNombre").value = objData.data.nombre;
            document.querySelector("#txtDescripcion").value =
              objData.data.descripcion;
            if (objData.data.status == 1) {
              var optionSelect =
                '<option value="1" selected class="notBlock">Activo</option>';
            } else {
              var optionSelect =
                '<option value="2" selected class="notBlock">Inactivo</option>';
            }
            var htmlSelect = `${optionSelect}
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>`;
            document.querySelector("#listStatus").innerHTML = htmlSelect;
            $("#modalFormRol").modal("show");
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    });
  });
}

function fntDelRol() {
  var btnDelRol = document.querySelectorAll(".btnDelRol");
  btnDelRol.forEach(function (btn) {
    btn.addEventListener("click", function () {
      var idRol = this.getAttribute("rl");
      // alert(idRol);
      swal(
        {
          title: "Eliminar Rol",
          text: "Realmente quiere eliminar el Rol?",
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
            var ajaxUrl = base_url + "roles/delRol";
            var strData = "idrol=" + idRol;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader(
              "Content-type",
              "application/x-www-form-urlencoded"
            );
            request.send(strData);
            console.log(request);
            request.onreadystatechange = function () {
              if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                  swal("Eliminar!", objData.msg, "success");
                  tableRoles.api().ajax.reload(function () {
                    fntEditRol();
                    fntDelRol();
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
