const inputSearch = document.getElementById("--searchAreas");
const displayAreas = document.getElementById("--areasLists");
const btnAreas = document.getElementById("--btnAreas");

const btnLogout = document.getElementById("--btnLogout");

// EVENTS

btnAreas.addEventListener("click", (e) => loadAreas(e));
inputSearch.addEventListener("keydown", (e) => searchArea(e));

btnLogout.addEventListener("click", (e) => logout(e));

// FUNZIONI
function loadAreas(e) {
  // Pulisci l'area
  displayAreas.innerHTML = "";

  // Carica le zone
  fetch("/api/zones_allowed", {
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
        console.log(zone);
        displayAreas.insertAdjacentHTML(
          "afterbegin",
          `<div class="--changeZone" data-id="${zone.id}">${zone.zone_name} [${zone.zone_clientid}]</div>`
        );
      });

      const btnChangeZone = document.getElementsByClassName("--changeZone");
      Array.from(btnChangeZone).forEach((btn) => {
        // console.log(btn.dataset.id);
        btn.addEventListener("click", () => changeZone(btn.dataset.id));
      });
    })
    .catch(function (error) {
      console.error(error);
    });
}

// Funzione per chiamare zona
function changeZone(zoneid) {
  fetch(`/api/changeZone/${zoneid}`, {
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
    })
    .catch(function (error) {
      console.error(error);
    });
}

function searchArea(e) {
  console.log("search input: ", e.key);
}

function logout(e) {
  fetch("/logout", {
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
    })
    .catch(function (error) {
      console.error(error);
    });
}
