document.addEventListener("DOMContentLoaded", function () {
  // NUEVO LENGUAJE
  var formProyecto = document.querySelector("#formProyecto");
  formProyecto.onsubmit = function (e) {
    // console.log("IN...");
    e.preventDefault();
    var intIdProyecto = document.querySelector("#idProyecto").value;
    var strNombre = document.querySelector("#txtNombre").value;
    var strDescripcion = document.querySelector("#txtDescripcion").value;
    var strRepositorio = document.querySelector("#txtRepositorio").value;
    var strTags = document.querySelector("#txtTags").value;
    // var arrayLenguajes = document.querySelector("#listaEstado").value;
    var arrayLenguajes = document.querySelectorAll(
      "input[type=checkbox]:checked"
    );

    if (
      strNombre == "" ||
      strDescripcion == "" ||
      strRepositorio == "" ||
      arrayLenguajes.length == 0 ||
      strTags == ""
    ) {
      swal("Atencion", "Todos los campos son obligatorios", "error");
      // alert("daji");
      return false;
    }
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url + "proyectos/setProyecto";
    var formData = new FormData(formProyecto);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var objData = JSON.parse(request.responseText);
        if (objData.status) {
          formProyecto.reset();
          swal(
            {
              title: "Proyecto",
              text: objData.msg,
              type: "success",
              showCancelButton: false,
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
            },
            function (isConfirm) {
              toProyectosPage();
            }
          );
        } else {
          swal("Error", objData.msg, "error");
        }
      }
    };
  };
  var idProyecto = document.querySelector("#idProyecto").value;
  if (idProyecto > 0) {
    console.log("Actualizar");
    editProyecto(idProyecto);
  } else {
    // console.log("Nuevo");
  }
});

function editProyecto(idProyecto) {
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var ajaxUrl = base_url + "proyectos/getProyecto/" + idProyecto;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      //   console.log(request.responseText);
      var objData = JSON.parse(request.responseText);
      if (objData.status) {
        document.querySelector("#idProyecto").value = objData.data.id_proyecto;
        document.querySelector("#txtNombre").value = objData.data.nombre;
        document.querySelector("#txtDescripcion").value =
          objData.data.descripcion;
        document.querySelector("#txtRepositorio").value =
          objData.data.repositorio;
        document.querySelector("#txtTags").value = objData.data.tags;
        // console.log(objData.data);

        var arrayIdLanguajes = [];
        objData.data.lenguajes.forEach(function (lenguaje) {
          arrayIdLanguajes.push(lenguaje.id_lenguaje);
        });

        var checkboxLenguajes = document.querySelectorAll(
          "input[type=checkbox]"
        );
        checkboxLenguajes.forEach(function (checkbox) {
          if (arrayIdLanguajes.includes(checkbox.value)) {
            checkbox.checked = true;
          }
        });
        $("#modalFormLenguaje").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
function toProyectosPage() {
  window.location.href = base_url + "proyectos/";
}
function openModalProyecto() {
  console.log("open Modal Proyecto");
  stylesFromUpdateToRegisterLenguaje();
  document.querySelector("#formProyecto").reset();
  $("#modalFormProyecto").modal("show");
}

function stylesFromUpdateToRegisterLenguaje() {
  document.querySelector("#idProyecto").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#titleModalProyecto").innerHTML = "Nuevo Proyecto";
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
