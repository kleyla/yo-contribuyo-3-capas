document.addEventListener(
  "DOMContentLoaded",
  function () {
    if (document.querySelector("#formLogin")) {
      let formLogin = document.querySelector("#formLogin");
      formLogin.onsubmit = function (e) {
        e.preventDefault();
        // console.log("Submit");
        let strEmail = document.querySelector("#txtEmail").value;
        let strPass = document.querySelector("#txtPass").value;
        if (strEmail == "" || strPass == "") {
          swal("Por favor", "Escribe usuario y contrasena", "error");
          return false;
        } else {
          var request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          var ajaxUrl = base_url + "login/loginUser";
          var formData = new FormData(formLogin);
          request.open("POST", ajaxUrl, true);
          request.send(formData);
          console.log(request);
          request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
              var objData = JSON.parse(request.responseText);
              if (objData.status) {
                window.location = base_url + "dashboard";
              } else {
                swal("Atencion", objData.msg, "error");
                document.querySelector("#txtPass").value = "";
              }
            } else {
              swal("Atencion", "Error en el proceso", "error");
            }
            return false;
          };
        }
      };
    }
  },
  false
);
