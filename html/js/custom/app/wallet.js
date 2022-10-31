// VARIABILI
const movementsContainer = document.getElementById("--movementsContainer");

// EVENTI
document.addEventListener("DOMContentLoaded", (e) => loadMovements(e));

// FUNZIONI
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
      console.log(data);
      // ELENCO MOVIMENTI
      const list_of_movements = data.list_of_movements;

      movementsContainer.innerHTML = "";
      //   list_of_movements.forEach((movements) => {
      //     console.log(user);
      //     const { cognome, email, id, nome } = user;
      //     const html = `
      //           <tr>
      //               <td>${nome}</td>
      //               <td>${cognome}</td>
      //               <td>${email}</td>
      //               <td class="text-end"><button class="btn btn-link --btnEditUser" data-id="${id}"><i class="fa-solid fa-pencil text-secondary"></i></button></td>
      //           </tr>
      //           `;
      //     usersContainer.insertAdjacentHTML("beforebegin", html);
      //   });
    })
    .catch(function (error) {
      console.error(error);
    });
}
