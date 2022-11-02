const btnLogin = document.getElementById("--btnLogin");
const inputEmail = document.getElementById("--email");
const inputPassword = document.getElementById("--password");
const outputMessage = document.getElementById("--outputMessage");

btnLogin.addEventListener("click", (e) => login(e));

function login(event) {
  let userMessage = "";

  // disattivo il form
  event.preventDefault();

  // Disattiva il pulsante
  btnLogin.classList.add("disabled");

  // Disattivo l'output precedente
  outputMessage.classList.add("d-none");
  outputMessage.innerHTML = "";

  // verifica l'email
  if (!inputEmail.value) {
    userMessage = "email non valida";
    outputMessage.innerHTML = userMessage;
    outputMessage.classList.remove("d-none");
    inputEmail.focus();
    // Riatt il pulsante
    btnLogin.classList.remove("disabled");
    return false;
  }

  // verifica la password
  if (!inputPassword.value) {
    userMessage = "password non valida";
    outputMessage.innerHTML = userMessage;
    outputMessage.classList.remove("d-none");
    inputPassword.focus();
    // Riatt il pulsante
    btnLogin.classList.remove("disabled");
    return false;
  }

  // verifico le credenziali
  fetch("/api/login", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "POST",
    body: JSON.stringify({
      login: inputEmail.value,
      password: inputPassword.value,
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      // console.log(data);

      if (!data.success) {
        userMessage = data.message;
        outputMessage.innerHTML = userMessage;
        outputMessage.classList.remove("d-none");
        // Riatt il pulsante => riattivare solo se cambiano gli input
        btnLogin.classList.remove("disabled");
        return false;
      }
      window.location.replace("/");
    })
    .catch(function (error) {
      console.error(error);
    });

  // visualizza un messaggi di errore || fai il redirect
  userMessage = "Errore Interno, riprova più tardi..";
  outputMessage.innerHTML = userMessage;
  outputMessage.classList.remove("d-none");
  // Riatt il pulsante
  btnLogin.classList.remove("disabled");
}
