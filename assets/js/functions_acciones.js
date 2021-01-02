// alert("hi");
document.addEventListener("DOMContentLoaded", function () {
  var formComentario = document.querySelector("#formComentario");
  if (formComentario) {
    formComentario.onsubmit = function (e) {
      // console.log("IN...");
      e.preventDefault();
      var strComentario = document.querySelector("#txtComentario").value;
      if (strComentario == "") {
        alert("Atencion: Todos los campos son obligatorios");
        // alert("daji");
        return false;
      }
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "comentarios/setComentario";
      var formData = new FormData(formComentario);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      // console.log(request);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          // console.log(request.responseText);
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            formComentario.reset();
            // alert(objData.msg);
            location.reload();
          } else {
            alert(objData.msg);
          }
        }
      };
    };
  }

  var formFavorito = document.querySelector("#formFavorito");
  if (formFavorito) {
    formFavorito.onsubmit = function (e) {
      e.preventDefault();
      var intId = document.querySelector("#idProyecto").value;
      var intFav = document.querySelector("#favorito").value;
      if (intId == "" || intFav == "") {
        alert("Atencion: Todos los campos son obligatorios");
        return false;
      }
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "favoritos/setFavoritos";
      var formData = new FormData(formFavorito);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      // console.log(request);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          // console.log(request.responseText);
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            // formFavorito.reset();
            // alert(objData.msg);
            location.reload();
          } else {
            alert(objData.msg);
          }
        }
      };
    };
  }
});
