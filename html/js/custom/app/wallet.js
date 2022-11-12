// VARIABILI
const movementsContainer = document.getElementById("--movementsContainer");
//// Create Movements Pulsanti
const btnCreateMovement = document.getElementById("--btnCreateMovement");
const btnEntranceCreateMovement = document.getElementById(
  "--btnEntranceCreateMovement"
);
const btnExpenseCreateMovement = document.getElementById(
  "--btnExpenseCreateMovement"
);
const btnSetToday = document.getElementById("--setToday");
const btnNewCategory = document.getElementById("--btnNewCategory");
const btnResetNewCategory = document.getElementById("--btnResetNewMovement");
const btnSaveMovement = document.getElementById("--btnSaveMovement");
const btnContinueMovement = document.getElementById("--btnContinueMovement");

// MODALS
const modalcreateMovement = document.getElementById("createMovement");

//// Variabili Movements
const inputDatetimeCreateMovement = document.getElementById(
  "--datetimeCreateMovement"
);
const inputValueCreateMovement = document.getElementById(
  "--valueCreateMovement"
);
const categoryContainerNewMovements = document.getElementById(
  "--categoryContainerNewMovements"
);
const alertCreateMovement = document.getElementById("--alertCreateMovement");

// EVENTI
document.addEventListener("DOMContentLoaded", (e) => loadMovements(e));

btnCreateMovement.addEventListener("click", (e) => setTypeMovement(e));
btnEntranceCreateMovement.addEventListener("click", (e) => setTypeMovement(e));
btnExpenseCreateMovement.addEventListener("click", (e) => setTypeMovement(e));

btnSetToday.addEventListener("click", (e) => setToday(e));
btnNewCategory.addEventListener("click", (e) => displayNewCategory(e));
btnResetNewCategory.addEventListener("click", (e) => resetNewCategory(e));
btnSaveMovement.addEventListener("click", (e) => saveNewMovement(e));
btnContinueMovement.addEventListener("click", (e) => continueMovement(e));

// seleziono la categoria del movimento
function setTypeMovement(e) {
  const typeMovement = e.target.dataset?.type
    ? e.target.dataset.type
    : "expense";

  // Rimuovi la selezione a quelli attivi
  btnEntranceCreateMovement.classList.remove("active");
  btnExpenseCreateMovement.classList.remove("active");

  // In base al tipo movimento, seleziona il pulsante corretto:
  switch (typeMovement) {
    case "expense":
    default:
      btnExpenseCreateMovement.classList.add("active");
      break;

    case "entrance":
      btnEntranceCreateMovement.classList.add("active");
      break;
  }

  // Carica le categorie della selezione
  displayTypeMovements(e, typeMovement);
}

//  caricamento delle categorie della pagina /wallet sul modal "nuovo movimento"
function displayTypeMovements(e, typeMovement) {
  // console.log("carico le: ", typeMovement);
  $categories = loadTypeMovements(typeMovement);
}

// carica i tipi categorie
function loadTypeMovements(typeMovement) {
  fetch("/api/getTypeMovements/" + typeMovement, {
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
      // console.log(data);
      const list_of_category = data.list_of_category;
      categoryContainerNewMovements.innerHTML = "";

      list_of_category.forEach((category) => {
        // console.log(movement);
        const { id, name, negative, icon } = category;
        const type = data.type_movements;

        const color = type == "entrance" ? "success" : "danger";

        const displayIcon = icon
          ? `<i data-id="${id}" data-name="${name}" data-element="categoryNewMovement" class="${icon}"></i>`
          : `<i data-id="${id}" data-name="${name}" data-element="categoryNewMovement" class="fa-regular fa-circle-question"></i>`;

        const html = `
              <button class="btn btn-link text-decoration-none --btnNewMovementCategories">
                            <div class="input-group">
                                <div class="btn btn-outline-${color}" data-id="${id}" data-name="${name}" data-element="categoryNewMovement" id="category-${id}">${name}</div>
                                <label for="category-${id}" class="btn btn-${color}" data-id="${id}" data-element="categoryNewMovement" data-name="${name}">${displayIcon}</label>
                            </div>
                        </button>
                `;
        categoryContainerNewMovements.insertAdjacentHTML("afterbegin", html);
      });

      // Seleziona tutti i bottoni per gestire l'evento del click
      const btnCategories = document.querySelectorAll(
        ".--btnNewMovementCategories"
      );

      for (let element = 0; element < btnCategories.length; element++) {
        const category = btnCategories[element];

        //  aggiungi l'evento al click del bottone per selezionare
        category.addEventListener("click", (e) => {
          selectCategory(e);
        });
      }
    })
    .catch(function (error) {
      console.error(error);
    });
}

// Crea la selezione della categoria:
function selectCategory(e) {
  // TARGET:
  const currentCategory = e.target.dataset;
  const target = document.getElementById("category-" + currentCategory.id);

  //Disattivo gli i precedenti:
  deselectCategory();

  // Aggiungo la visualizzazione.
  target.classList.add("active");
  // console.log(target);
}

// Disattivo la selezione delle categorie
function deselectCategory() {
  const previusSelection = document.querySelectorAll(
    '[data-element="categoryNewMovement"]'
  );
  previusSelection.forEach((ele) => {
    ele.classList.contains("active") ? ele.classList.remove("active") : "";
  });
}

// Imposta la data del form "nuovo movimento" su oggi
function setToday(e) {
  const today = new Date();
  inputDatetimeCreateMovement.value = formatDatetime(today);
}

// Permette di visualizzare il menu di creazione di una  nuova categoria
function displayNewCategory(e) {
  console.log("visualizzo la creazione delle categorie");
  // TODO: crea il modal per la creazione di una nuova categoria
}

// Resetta il form di inserimento di un nuovo movimento
function resetNewCategory(e) {
  inputDatetimeCreateMovement.value = "";
  inputValueCreateMovement.value = "";
  deselectCategory();
  hideMessage(alertCreateMovement);
}

// Salva il nuovo movimento
async function saveNewMovement(e) {
  const state = await storeNewMovement(e);

  // console.log("save new movement state", state);

  if (state.state) {
    // chiudo il modal una volta inviato con successo
    const modalcreateMovement = document.getElementById("createMovement");
    const myModal = bootstrap.Modal.getInstance(modalcreateMovement);
    myModal.hide();
    // Pulisco i dati
    resetNewCategory(e);
  } else {
    let message = new Object();
    message.message = "Errore: " + state?.message;
    message.class = "alert-danger";
    displayMessage(alertCreateMovement, message);
  }
}

// Salva e crea un nuovo movimento.
async function continueMovement(e) {
  const state = await storeNewMovement(e);
  let message = new Object();

  if (state.state) {
    // Pulisco i dati
    resetNewCategory(e);
    message.message = "Movimento inserito, puoi continuare";
    message.class = "alert-success";
    displayMessage(alertCreateMovement, message);
  } else {
    message.message = "Errore: " + state?.message;
    message.class = "alert-danger";
    displayMessage(alertCreateMovement, message);
  }
}

// Salvo i dati sul database
async function storeNewMovement(e) {
  //  Recupero i dati da salvare:
  const localData = getLocalNewMovementData();
  // Verifico i dati inseriti.
  const data_is_corrent = verifyData(localData); // boolean
  if (data_is_corrent) {
    // Crea il salvataggio del movimento
    const state = await pushNewMovement(localData);

    // Se è andato con successo creo il movimento sul DOM
    if (state.state) {
      // console.log(state);
      // inserisci il mov sul dom
      const html = displayMovementRecord(state.last_mov_data.results[0]);
      movementsContainer.insertAdjacentHTML("afterbegin", html);
    }

    // Passo il risultato per la visualizzazione dell'utente.
    return state;
  }
  return false;
}

// Crea il salvataggio del movimento
async function pushNewMovement(localData) {
  const res = await fetch("/api/storeMovement", {
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

// Recupero i dati da salvare:
function getLocalNewMovementData() {
  let newMovement = new Object();
  // recupero la data
  newMovement.data = inputDatetimeCreateMovement.value ?? null;

  //  recupero l'importo
  newMovement.value = inputValueCreateMovement.value ?? null;

  // recupero la categoria
  newMovement.category = "";
  const currentCategory = document.querySelectorAll(
    '[data-element="categoryNewMovement"]'
  );
  currentCategory.forEach((category) => {
    category.classList.contains("active")
      ? (newMovement.category = category.dataset.id)
      : "";
  });

  // console.log("object new movement", newMovement);
  return newMovement;
}

function verifyData(localData) {
  // variabili
  let state = false;
  const { data, value, category } = localData;

  let message = new Object();
  hideMessage(alertCreateMovement);

  // verifico i dati inseriti
  if (!data) {
    // console.log(inputDatetimeCreateMovement);
    inputDatetimeCreateMovement.focus();

    // Visualizzo l'errore
    message.message = "Inserisci la data";
    message.class = "alert-danger";
    displayMessage(alertCreateMovement, message);
    return state;
  }
  //TODO: verifico se la data è valida

  // Verifico se l'importo è inserito l'importo
  if (!value) {
    inputValueCreateMovement.focus();

    message.message = "Inserisci l'importo";
    message.class = "alert-danger";
    displayMessage(alertCreateMovement, message);

    return state;
  }

  // Verifico l'importo
  if (value < 0) {
    inputValueCreateMovement.focus();

    message.message = "L'importo deve essere maggiore a 0";
    message.class = "alert-warning";
    displayMessage(alertCreateMovement, message);

    return state;
  }
  // VERIFICO SE c'è una categoria
  if (!category) {
    // console.log(categoryContainerNewMovements);
    categoryContainerNewMovements.focus();

    message.message = "Inserisci la categoria";
    message.class = "alert-danger";
    displayMessage(alertCreateMovement, message);

    return state;
  }
  // TODO: Verifico se la categoria esiste.

  state = true;
  return state;
}

//  Visualizza i messaggi
function displayMessage(where, content) {
  where.classList.remove("d-none");

  // Se passo una classe, l'inserisco
  content?.class ? where.classList.add(content.class) : "alert-secondary";

  where.innerHTML = content.message;
}

// Nasconde i messaggi
function hideMessage(where) {
  where.classList.add("d-none");
  // TODO: rimuovi qualsiasi classe che inizia con alert-
  where.classList.remove("alert-secondary", "alert-danger", "alert-success");
}

// Azioni da fare al caricamento della pagina /wallet
function loadMovements(e) {
  // CARICA GLI UTENTI DELLA ZONA
  fetch("/api/getMovements", {
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
      // console.log(data);
      // ELENCO MOVIMENTI
      const list_of_movements = data.list_of_movements;

      movementsContainer.innerHTML = "";
      list_of_movements.forEach((movement) => {
        html = displayMovementRecord(movement);
        movementsContainer.insertAdjacentHTML("afterbegin", html);
      });

      //TODO: crea il modal per la modifica
      const btnEditUser = document.querySelectorAll(".--btnEditUser");
      btnEditUser.forEach((btn) => {
        btn.addEventListener("click", () => {
          const data = btn.dataset;
          //Recupera il modal
          const editModal = document.getElementById("editMovement");
          const editValue = document.getElementById("--valueEditMovement");
          const datetimeEditMovement = document.getElementById(
            "--datetimeEditMovement"
          );
          const wTypeContainer = document.getElementById(
            "--categoryContainerEditMovements"
          );
          const btnExpese = document.getElementById("--btnEditMovement");

          editValue.value = data.value;
          datetimeEditMovement.value = data.datetime;
          datetimeEditMovement.placeholder = data.datetime;
          wTypeContainer.innerHTML =
            data.wallet_type_id + " " + data.expesename;

          btnExpese.classList.remove("btn-success");
          btnExpese.classList.remove("btn-danger");
          btnExpese.classList.add("btn-" + data.expesecolor);

          btnExpese.innerHTML = data.expesedescription;

          // console.log(btn);
          // sovrascrivi i movimenti
        });
      });
    })
    .catch(function (error) {
      console.error(error);
    });
}

// SHOW MOVEMENTS
function displayMovementRecord(movement) {
  // console.log(movement);
  const { datetime, id, name, negative, userid, value, walletTypeId } =
    movement;

  const expeseDescription = negative == 1 ? "spesa" : "entrata";
  const expeseColor = negative == 1 ? "danger" : "success";

  const date = new Date(datetime);
  const oDate = formatDate(date);
  const oTime = formatTime(date);

  const valueFixed = parseFloat(value / 100).toFixed(2);

  const html = `
                <tr class="text-start">
                    <td>
                      <span data-date="${datetime}">  
                        <span>${oDate}</span>
                        <span class="d-none d-md-inline">${oTime}</span>
                      </span>
                    </td>
                    <td>${name}</td>
                    <td class="text-center"><div class="badge bg-${expeseColor}">${expeseDescription}</div></td>
                    <td class="text-end">€${valueFixed}</td>
                    <td class="text-end"><button class="btn btn-link --btnEditUser" data-id="${id}" data-datetime="${datetime}" data-date="${oDate}" data-time="${oTime}" data-value="${valueFixed}" data-expeseName="${name}" data-expeseDescription="${expeseDescription}" data-expeseColor="${expeseColor}" data-wallet_type_id="${walletTypeId}" data-bs-toggle="modal" 
                        data-bs-target="#editMovement"><i class="fa-solid fa-pencil text-secondary"></i></button></td>
                </tr>
                `;
  return html;
}
