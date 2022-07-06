const d = document;

const inicio = () => {
  let filename = location.pathname.split("/").pop().slice(0,-4);
  switch(filename){
    case "index":
      break;
    case "register":
      d.addEventListener("submit",(e) => checkPassword(e),false);
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
    console.log("NO COINCIDEN LOS PASSWORDS");
  }else{ e.target.submit(); console.log("COINCIDEN");}
}

d.addEventListener("DOMContentLoaded",inicio,false);