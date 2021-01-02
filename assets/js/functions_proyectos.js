var tableProyectos;
document.addEventListener("DOMContentLoaded", function () {
  tableProyectos = $("#tableProyectos").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "proyectos/getProyectos",
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
});

$("#tableProyectos").DataTable();

window.addEventListener(
  "load",
  function () {
    deleteProyecto();
    enableProyecto();
  },
  false
);

function deleteProyecto() {
  var btnDelProyecto = document.querySelectorAll(".btnDelProyecto");
  btnDelProyecto.forEach(function (btn) {
    btn.addEventListener("click", function () {
      console.log("Deleting");
      var idProyecto = this.getAttribute("rl");
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
            var ajaxUrl = base_url + "proyectos/deleteProyecto";
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
                  tableProyectos.api().ajax.reload(function () {
                    deleteProyecto();
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
function enableProyecto() {
  var btnEnableProyecto = document.querySelectorAll(".btnEnableProyecto");
  btnEnableProyecto.forEach(function (btn) {
    btn.addEventListener("click", function () {
      // console.log("Enable");
      var idProyecto = this.getAttribute("rl");
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
            var ajaxUrl = base_url + "proyectos/habilitarProyecto";
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
                  tableProyectos.api().ajax.reload(function () {
                    deleteProyecto();
                    enableProyecto();
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
