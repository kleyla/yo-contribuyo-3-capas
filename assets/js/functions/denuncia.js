document.addEventListener("DOMContentLoaded", function () {
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
          // console.log(request.responseText);
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
});
