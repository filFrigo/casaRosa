// VARIABILI
const inputName = document.getElementById("--zoneName");
const inputClientID = document.getElementById("--clientID");

// EVENTI
document.addEventListener("DOMContentLoaded", (e) => loadZones(e));

// FUNZIONI
function loadZones(e) {
  // Carica le zone
  fetch("/api/zones/1", {
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
      const { id, clientid, name } = data.list_of_zones[0];

      inputName.value = name;
      inputClientID.value = clientid;

      // console.log(id, clientid, name);
    })
    .catch(function (error) {
      console.error(error);
    });
}
