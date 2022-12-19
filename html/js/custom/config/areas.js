// VARIABILI
const areasContainer = document.getElementById("--areasContainer");

// EVENTS
document.addEventListener("DOMContentLoaded", (e) => loadAreas(e));

// FUNCTIONS
function loadAreas(e) {
  // Carica le zone
  fetch("/api/areas", {
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
      //console.log(data.list_of_areas);

      const areas = data.list_of_areas;
      const areasNumber = data.number_of_areas;

      areasContainer.innerHTML = "";

      Object.values(areas).forEach((area) => {
        const { civic, description, id, zonesid } = area;
        const html = `<tr><td>${description}</td><td>${civic}</td><td class="text-end"><button class="btn btn-link --btnEditArea" data-id="${id}"><i class="fa-solid fa-pencil text-secondary"></i></button></td></tr>`;
        areasContainer.insertAdjacentHTML("afterbegin", html);
      });

      //console.log(areasNumber);
    })
    .catch(function (error) {
      console.error(error);
    });
}
