const d = document,
registerForm = d.getElementById("registerForm"),
alertDiv = d.createElement("div");

const inicio = () => {
  let filename = location.pathname.split("/").pop().slice(0,-4);
  switch(filename){
    case "index":
      break;
    case "login":
      d.addEventListener("submit",checkPassword,false);
      break;
    default:
      console.log("default");
      break;
  }
}

const checkPassword = (e) => {
  let password = d.getElementById("password").value,
  confirmPassword = d.getElementById("confirmPassword").value;
  if(password !== confirmPassword){
    e.preventDefault();
    alertDiv.textContent = "Las contraseñas no coinciden";
    ["alert","redAlert"].forEach(style => alertDiv.classList.add(style));    
    registerForm.insertAdjacentElement("beforebegin",alertDiv);
  }else e.target.submit();
}

d.addEventListener("DOMContentLoaded",inicio,false);