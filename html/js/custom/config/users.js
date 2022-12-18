// VARIABILI
const usersContainer = document.getElementById("--usersContainer");
const btnSaveUsers = document.getElementById("--btnSaveUsers");
const btnResetUsers = document.getElementById("--btnResetUsers");
// // Modal creazione utente
const newUserName = document.getElementById("--userName");
const newUserSurname = document.getElementById("--userSurname");
const newUserEmail = document.getElementById("--userEmail");
const alertModalNewUser = document.getElementById("--alertModalNewUser");
const modalCreateUsers = document.getElementById("createUsers");

// EVENTI
document.addEventListener("DOMContentLoaded", (e) => loadUsers(e));
btnSaveUsers.addEventListener("click", (e) => saveUser(e));
btnResetUsers.addEventListener("click", (e) => resetUser(e));

// FUNZIONI
function loadUsers(e) {
  // CARICA GLI UTENTI DELLA ZONA
  fetch("/api/getUsersZone", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "GET",
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      // LISTA DEGLI UTENTI:
      const users = data.list_of_users;

      usersContainer.innerHTML = "";
      users.forEach((user) => {
        // console.log(user);
        const { cognome, email, id, nome } = user;
        displayUser(nome, cognome, email, id);
        /*
        const html = `
            <tr>
                <td>${nome}</td>
                <td>${cognome}</td>
                <td>${email}</td>
                <td class="text-end"><button class="btn btn-link --btnEditUser" data-id="${id}"><i class="fa-solid fa-pencil text-secondary"></i></button></td>
            </tr>
            `;
        usersContainer.insertAdjacentHTML("beforebegin", html);
        */
      });
    })
    .catch(function (error) {
      console.error(error);
    });
}

function displayUser(nome, cognome, email, id) {
  const html = `
            <tr>
                <td>${nome}</td>
                <td>${cognome}</td>
                <td>${email}</td>
                <td class="text-end"><button class="btn btn-link --btnEditUser" data-id="${id}"><i class="fa-solid fa-pencil text-secondary"></i></button></td>
            </tr>
            `;
  usersContainer.insertAdjacentHTML("beforebegin", html);
}

async function saveUser(e) {
  // Recupero i dati dell'utente inseriti
  const name = newUserName.value;
  const surname = newUserSurname.value;
  const email = newUserEmail.value;

  // verifico i dati inseriti

  // creo l'utente da salvare
  let user = new Object();
  user.name = name;
  user.surname = surname;
  user.email = email;

  // Salvo l'utente CR-5
  console.log(`salvataggio utente in corso...`, user);
  // disattivo il pulsante di salvataggio utente
  btnSaveUsers.classList.add("disabled");
  const userStatement = await storeUser(user);

  // TODO CR-5 verifico se il salvataggio è avvenuto correttamente.
  if (userStatement.state == false) {
    btnSaveUsers.classList.remove("disabled");
    // Visualizzo un messaggio in caso di errore.
    alertModalNewUser.innerHTML = userStatement.message;
    // CR-5 avviso l'utente.
    showMessage(alertModalNewUser, 1000);
    console.error(`Errore ${userStatement.message}`);
  }

  // const modal = new bootstrap.Modal(modalCreateUsers);
  //console.log(modalCreateUsers);
  //modal.modal("hide");

  if (userStatement.state == true) {
    // CR-5 → Chiudi il modal quando il salvataggio è avvenuto
    // $("#createUsers").modal("hide");  // Chiudo il modal?
    console.log(userStatement.new_user);
    // CR-5 → Aggiungi l'utente nell'elenco degli utenti.
    const newUser = userStatement.new_user;
    displayUser(newUser.name, newUser.surname, newUser.email, newUser.id);
    console.log(
      `✔ Salvataggio di ${newUser.name} ${newUser.surname} effettuato con successo!`
    );
    // Resetto il modal
    resetUser(e);
    // Posso premere nuovamente il bottone
    btnSaveUsers.classList.remove("disabled");
  }
}

async function storeUser(localData) {
  const res = await fetch("/api/storeUser", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "POST",
    body: JSON.stringify({ localData }),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      // Gestisci i ritorni dei messaggi
      return data;
    })
    .catch(function (error) {
      console.error(error);
    });

  return res;
}

// Pulisce il modal per la creazione di un nuovo utente.
function resetUser(e) {
  newUserName.value = "";
  newUserSurname.value = "";
  newUserEmail.value = "";

  console.log(`reset modal eseguito`);
}

function showMessage(element, milliseconds) {
  // nascondi il boxe dopo 5 secondi

  element.classList.remove("d-none");
  element.classList.add("c-prepare-show");

  setTimeout(() => {
    element.classList.remove("c-prepare-show");
    element.classList.add("c-showing");
  }, 10);

  // nascondi il boxe dopo 5 secondi
  setTimeout(() => {
    element.classList.remove("c-showing");
    element.classList.add("c-hiding");
  }, milliseconds + 1000);

  setTimeout(() => {
    element.classList.remove("c-hiding");
    element.classList.add("d-none");
  }, milliseconds + 1500);
}
