// VARIABILI
const movementsContainer = document.getElementById("--movementsContainer");
//// Create Movements
const btnCreateMovement = document.getElementById("--btnCreateMovement");
const btnEntranceCreateMovement = document.getElementById(
  "--btnEntranceCreateMovement"
);
const btnExpeseCreateMovement = document.getElementById(
  "--btnExpeseCreateMovement"
);
const btnSetToday = document.getElementById("--setToday");

// EVENTI
document.addEventListener("DOMContentLoaded", (e) => loadMovements(e));
btnCreateMovement.addEventListener("click", (e) => loadTypeMovements(e));
btnEntranceCreateMovement.addEventListener("click", (e) =>
  loadTypeMovements(e)
);
btnExpeseCreateMovement.addEventListener("click", (e) => loadTypeMovements(e));
btnSetToday.addEventListener("click", (e) => setToday(e));

// caricamento delle categorie della pagina /wallet sul modal "nuovo movimento"
function loadTypeMovements(e) {
  console.log("carico le categorie");
  // caricamentodelle categorie
}

// Imposta la data del form "nuovo movimento" su oggi
function setToday(e) {
  console.log("sovrascrivo la data ad oggi");
  //Cerca l'imput
  // imposta sull'imput la data di oggi
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
        // console.log(movement);
        const { datetime, id, name, negative, userid, value, wallet_type_id } =
          movement;

        const expeseDescription = negative == 1 ? "spesa" : "entrata";
        const color = negative == 1 ? "danger" : "success";

        const date = new Date(datetime);

        const html = `
                <tr class="text-start">
                    <td>
                      <span data-date="${datetime}">  
                        <span>${formatDate(date)}</span>
                        <span class="d-none d-md-inline">${formatTime(
                          date
                        )}</span>
                      </span>
                    </td>
                    <td>${name}</td>
                    <td class="text-center"><div class="badge bg-${color}">${expeseDescription}</div></td>
                    <td class="text-end">€${parseFloat(value / 100).toFixed(
                      2
                    )}</td>
                    <td class="text-end"><button class="btn btn-link --btnEditUser" data-id="${id}"><i class="fa-solid fa-pencil text-secondary"></i></button></td>
                </tr>
                `;
        movementsContainer.insertAdjacentHTML("beforebegin", html);
      });
    })
    .catch(function (error) {
      console.error(error);
    });
}
