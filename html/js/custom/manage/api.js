"use strict";

async function loadAreas(params) {
  // Carica le zone
  const res = await fetch("/api/areas", {
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
      console.log(data.list_of_areas_array);

      return data.list_of_areas;
    })
    .catch(function (error) {
      console.error(error);
    });

  return res;
}
