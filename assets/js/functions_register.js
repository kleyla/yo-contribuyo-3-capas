document.addEventListener(
  "DOMContentLoaded",
  function () {
    if (document.querySelector("#formRegister")) {
      let formRegister = document.querySelector("#formRegister");
      formRegister.onsubmit = function (e) {
        e.preventDefault();
        // console.log("Submit");
        let strEmail = document.querySelector("#txtEmail").value;
        let strNick = document.querySelector("#txtNick").value;
        let strPassConfirm = document.querySelector("#txtPassConfirm").value;
        let strPass = document.querySelector("#txtPass").value;
        if (
          strEmail == "" ||
          strNick == "" ||
          strPass == "" ||
          strPassConfirm == ""
        ) {
          swal("Por favor", "Todos los datos son obligatorios", "error");
          return false;
        } else if (strPass != strPassConfirm) {
          swal("Por favor", "Las contrasenas no son iguales", "error");
          return false;
        } else {
          var request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          var ajaxUrl = base_url + "register/registerUser";
          var formData = new FormData(formRegister);
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
                document.querySelector("#txtPassConfirm").value = "";
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
