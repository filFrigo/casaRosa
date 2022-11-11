// VARIABILI
const usersContainer = document.getElementById("--usersContainer");

// EVENTI
document.addEventListener("DOMContentLoaded", (e) => loadUsers(e));

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
        console.log(user);
        const { cognome, email, id, nome } = user;
        const html = `
            <tr>
                <td>${nome}</td>
                <td>${cognome}</td>
                <td>${email}</td>
                <td class="text-end"><button class="btn btn-link --btnEditUser" data-id="${id}"><i class="fa-solid fa-pencil text-secondary"></i></button></td>
            </tr>
            `;
        usersContainer.insertAdjacentHTML("beforebegin", html);
      });
    })
    .catch(function (error) {
      console.error(error);
    });
}
