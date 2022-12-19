"use strict";

// EVENTS
document.addEventListener("DOMContentLoaded", (e) => displayUsersArea(e));

async function displayUsersArea() {
  const areas = await loadAreas("");

  const areaContainer = document.getElementById("--areaContainer");
  const areaExpeseSum = document.getElementById("--textExpeseSum");

  console.log(areas);
  areaExpeseSum.innerHTML = `Ripartizione ${
    (areas.report_expese_tot / 100) * -1
  } €`;

  Object.values(areas.list_of_areas).forEach((area) => {
    displayAreaContainer(areaContainer, area, areas.expese_area);
  });
}

function displayAreaContainer(container, data, expese) {
  const balance = parseInt(data.balance / 100);
  let displayValue = "";

  if (balance == 0) {
    displayValue = `<span class="text-danger"><i class="fa-solid fa-check text-success"></i></span>`;
  }

  if (balance < 0) {
    displayValue = `<span class="text-danger">${balance} €</span>`;
  }

  if (balance > 0) {
    displayValue = `<span class="text-success">${balance} €</span>`;
  }

  let html = `
    <div class="card m-1 mb-3 mx-2" style="width: 18rem;">
      <div class="card-header d-flex" ><span class="flex-grow-1">${data.description}</span>
      ${displayValue}</div>
      <ul class="list-unstyled list-group">`;
  // console.log(data);
  Object.values(data.users).forEach((user) => {
    html += displayUserList(user);
  });

  html += `</ul></div>`;
  container.insertAdjacentHTML("afterbegin", html);
}

function displayUserList(data) {
  //console.log(data);
  const html = `<li class="list-group-item border-0 d-flex "><span class="flex-grow-1">${data.nome} ${data.cognome}</span>
  <span><i class="fa-solid fa-eye-slash text-secondary"></i></span></li>`;
  return html;
}
