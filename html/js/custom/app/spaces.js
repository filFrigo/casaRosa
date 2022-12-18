"use strict";

// EVENTS
document.addEventListener("DOMContentLoaded", (e) => displayUsersArea(e));

async function displayUsersArea() {
  const areas = await loadAreas("");

  const areaContainer = document.getElementById("--areaContainer");

  areas.forEach((area) => {
    displayAreaContainer(areaContainer, area);
    //console.log(area);
  });
}

function displayAreaContainer(container, data) {
  const html = `
    <div class="card m-1" style="width: 18rem;">
    <div class="card-header">${data.description}</div>
            <ul>
                <li>utente</li>
                <li>utente1</li>
                <li>utente2</li>
            </ul>
        </div>
    `;

  container.insertAdjacentHTML("afterbegin", html);
}
