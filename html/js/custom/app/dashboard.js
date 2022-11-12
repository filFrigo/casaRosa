// VARIABILES
const divCurrentBalance = document.getElementById("--currentBalance");

// EVENTS
document.addEventListener("DOMContentLoaded", getMovementBalance());

// FUNCTIONS
function getMovementBalance() {
  //totale dei movimenti
  fetch("/api/getMovementTotal/", {
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
      divCurrentBalance.innerHTML =
        parseFloat(data.movement_total / 100).toFixed(2) + " €";
    })
    .catch(function (error) {
      console.error(error);
    });
}
