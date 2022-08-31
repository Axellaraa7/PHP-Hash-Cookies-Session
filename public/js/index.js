const d = document,
registerForm = d.getElementById("registerForm"),
dialSelect = d.getElementById("dial"),
alertDiv = d.createElement("div"),
dialUrl = "https://gist.githubusercontent.com/anubhavshrimal/75f6183458db8c453306f93521e93d37/raw/f77e7598a8503f1f70528ae1cbf9f66755698a16/CountryCodes.json";

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

const fillDial = (data) => {
  const fragment = d.createDocumentFragment();
  data.forEach((country) =>{
    let option = d.createElement("option");
    option.value = country.code + "-" + country.dial_code;
    // option.textContent = country.dial_code;
    option.textContent = country.code + " " + country.dial_code;
    option.classList.add("smText");
    fragment.appendChild(option);
  });
  dialSelect.appendChild(fragment);
}

const getData = async (callback) => {
  const json = await fetch(dialUrl);
  const data = await json.json();
  data.sort((el,el2) => {
    if(parseInt(el.dial_code.substring(1)) > parseInt(el2.dial_code.substring(1))) return 1;
    if(parseInt(el.dial_code.substring(1)) < parseInt(el2.dial_code.substring(1))) return -1;
    return 0;
  })
  // console.log(data);
  callback(data);
}

const inicio = () => {
  let filename = location.pathname.split("/").pop().slice(0,-4);
  switch(filename){
    case "index":
      break;
    case "login":
      getData(fillDial);
      d.addEventListener("submit",checkPassword,false);
      break;
    default:
      console.log("default");
      break;
  }
}

d.addEventListener("DOMContentLoaded",inicio,false);