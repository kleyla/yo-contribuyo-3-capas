function initTable() {
  if ($("#tableProyectos")) {
    tableProyectos = $("#tableProyectos").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "proyecto/getProyectos",
        dataSrc: "",
      },
      columns: [
        { data: "id_proyecto" },
        { data: "nombre" },
        { data: "nick" },
        { data: "repositorio" },
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
function setProyecto() {
  var formProyecto = document.querySelector("#formProyecto");
  if (formProyecto) {
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
      var ajaxUrl = base_url + "proyecto/setProyecto";
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
                window.location.href = base_url + "proyecto/index";
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
function editProyecto(idProyecto) {
  if (document.querySelector("#idProyecto")) {
    var idProyecto = document.querySelector("#idProyecto").value;
    // console.log("Editando proyecto");
    if (idProyecto > 0) {
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "proyecto/getProyecto/" + idProyecto;
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
  document.querySelector("#idProyecto").value = data.id_proyecto;
  document.querySelector("#txtNombre").value = data.nombre;
  document.querySelector("#txtDescripcion").value = data.descripcion;
  document.querySelector("#txtRepositorio").value = data.repositorio;
  document.querySelector("#txtTags").value = data.tags;
  // console.log(data);

  var arrayIdLanguajes = [];
  data.lenguajes.forEach(function (lenguaje) {
    arrayIdLanguajes.push(lenguaje.id_lenguaje);
  });

  var checkboxLenguajes = document.querySelectorAll("input[type=checkbox]");
  checkboxLenguajes.forEach(function (checkbox) {
    if (arrayIdLanguajes.includes(checkbox.value)) {
      checkbox.checked = true;
    }
  });
}
function deleteProyecto(id) {
  var idProyecto = id;
  // alert(idProyecto);
  swal(
    {
      title: "Eliminar Proyecto",
      text: "Realmente quiere eliminar el Proyecto?",
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
        var ajaxUrl = base_url + "proyecto/deleteProyecto";
        var strData = "idProyecto=" + idProyecto;
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
              tableProyectos.api().ajax.reload();
            } else {
              swal("Atencion!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}
function enableProyecto(id) {
  var idProyecto = id;
  // alert(idProyecto);
  swal(
    {
      title: "Habilitar Proyecto",
      text: "Realmente quiere habilitar el Proyecto?",
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
        var ajaxUrl = base_url + "proyecto/habilitarProyecto";
        var strData = "idProyecto=" + idProyecto;
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
              tableProyectos.api().ajax.reload();
            } else {
              swal("Atencion!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

var tableProyectos;

document.addEventListener("DOMContentLoaded", function () {
  initTable();
  setProyecto();
  editProyecto();
});