// VARIABILES
const divCurrentBalance = document.getElementById("--currentBalance");
const divCurrentExpese = document.getElementById("--currentExpese");
const divCurrentAreas = document.getElementById("--currentAreas");

// EVENTS
document.addEventListener("DOMContentLoaded", getDashboardReports());

// FUNCTIONS
function getDashboardReports() {
  //totale dei movimenti
  fetch("/api/getDashboardReports", {
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
      divCurrentBalance.innerHTML = parseFloat(data.balance).toFixed(2) + " €";
      divCurrentExpese.innerHTML = parseFloat(data.expese).toFixed(2) + " €";
      divCurrentAreas.innerHTML = parseFloat(data.areas);
    })
    .catch(function (error) {
      console.error(error);
    });
}
