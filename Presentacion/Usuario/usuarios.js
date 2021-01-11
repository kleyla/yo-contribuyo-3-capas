function initTable() {
  tableUsuarios = $("#tableUsuarios").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "usuario/getUsuarios",
      dataSrc: "",
    },
    columns: [
      { data: "id_usuario" },
      { data: "nick" },
      { data: "email" },
      { data: "fecha" },
      { data: "rol" },
      { data: "estado" },
      { data: "opciones" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
}
function setUsuario() {
  var formUsuario = document.querySelector("#formUsuario");
  if (formUsuario) {
    formUsuario.onsubmit = function (e) {
      // console.log("IN...");
      e.preventDefault();
      var intIdUsuario = document.querySelector("#idUsuario").value;
      var strNick = document.querySelector("#txtNick").value;
      var strEmail = document.querySelector("#txtEmail").value;
      var strRol = document.querySelector("#listaRol").value;
      if (strNick == "" || strEmail == "" || strRol == "") {
        swal("Atencion", "Todos los campos son obligatorios", "error");
        // alert("daji");
        return false;
      }
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "usuario/setUsuario";
      var formData = new FormData(formUsuario);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      // console.log(request);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          // console.log(request.responseText);
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            $("#modalFormUsuario").modal("hide");
            formUsuario.reset();
            swal("Usuario", objData.msg, "success");
            tableUsuarios.api().ajax.reload();
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    };
  }
}
function editUsuario(id) {
  stylesFromRegisterToUpdate();

  var idUsuario = id;
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var ajaxUrl = base_url + "usuario/getUsuario/" + idUsuario;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      //   console.log(request.responseText);
      var objData = JSON.parse(request.responseText);
      if (objData.status) {
        updateData(objData.data);
        $("#modalFormUsuario").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
function updateData(data) {
  document.querySelector("#idUsuario").value = data.id_usuario;
  document.querySelector("#txtNick").value = data.nick;
  document.querySelector("#txtEmail").value = data.email;
  if (data.rol == "Administrador") {
    var optionSelect =
      '<option value="Administrador" selected class="notBlock">Administrador</option>';
  } else {
    var optionSelect =
      '<option value="Contribuidor" selected class="notBlock">Contribuidor</option>';
  }
  var htmlSelect = `${optionSelect}
                        <option value="Administrador">Administrador</option>
                        <option value="Contribuidor">Contribuidor</option>`;
  document.querySelector("#listaRol").innerHTML = htmlSelect;
}
function deleteUsuario(id) {
  var idUsuario = id;
  // alert(idUsuario);
  swal(
    {
      title: "Eliminar Usuario",
      text: "Realmente quiere eliminar el Usuario?",
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
        var ajaxUrl = base_url + "usuario/deleteUsuario";
        var strData = "idusuario=" + idUsuario;
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
              tableUsuarios.api().ajax.reload();
            } else {
              swal("Atencion!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}
function enableUsuario(id) {
  var idUsuario = id;
  // alert(idUsuario);
  swal(
    {
      title: "Habilitar Usuario",
      text: "Realmente quiere habilitar el Usuario?",
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
        var ajaxUrl = base_url + "usuario/habilitarUsuario";
        var strData = "idusuario=" + idUsuario;
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
              swal("Habilitar!", objData.msg, "success");
              tableUsuarios.api().ajax.reload();
            } else {
              swal("Atencion!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

var tableUsuarios;

document.addEventListener("DOMContentLoaded", function () {
  initTable();
  setUsuario();
});

// $("#tableUsuarios").DataTable();

function openModalUsuario() {
  console.log("open Modal Usuario");
  stylesFromUpdateToRegister();
  document.querySelector("#formUsuario").reset();
  $("#modalFormUsuario").modal("show");
}
function stylesFromUpdateToRegister() {
  document.querySelector("#idUsuario").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#titleModalUsuario").innerHTML = "Nuevo Usuario";
  document.querySelector("#btnText").innerHTML = "Guardar";
}
function stylesFromRegisterToUpdate() {
  document.querySelector("#titleModalUsuario").innerHTML = "Actualizar Usuario";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";
}
