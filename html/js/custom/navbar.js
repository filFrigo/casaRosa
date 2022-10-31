const inputSearch = document.getElementById("--searchAreas");
const displayAreas = document.getElementById("--areasLists");
const btnAreas = document.getElementById("--btnAreas");

// EVENTS

btnAreas.addEventListener("click", (e) => loadAreas(e));
inputSearch.addEventListener("keydown", (e) => searchArea(e));

// FUNZIONI
function loadAreas(e) {
  // Pulisci l'area
  displayAreas.innerHTML = "";

  // Carica le zone
  fetch("/api/zones", {
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

      // display zones on container

      data.list_of_zones.forEach((zone) => {
        displayAreas.insertAdjacentHTML(
          "afterbegin",
          `<div data-id="${zone.id}">${zone.name} [${zone.clientid}]</div>`
        );
      });
    })
    .catch(function (error) {
      console.error(error);
    });
}

function searchArea(e) {
  console.log("search input: ", e.key);
}
