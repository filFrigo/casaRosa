const table = document.getElementById("table_moviments");
const placeholder = document.getElementById("temp_placeholder");
const modalSection = document.getElementById("modals");

fetch("/users/getUsers")
  .then((response) => {
    return response.json();
  })
  .then((jsondata) => {
    let users = jsondata;

    users.map(function (user) {
      let tr = document.createElement("tr");

      /*    CREA LE VARIE RIGHE E INSERISCI I DATI    */
      let tdID = document.createElement("td");
      tdID.innerHTML = user.id;
      tr.appendChild(tdID);

      let tdemail = document.createElement("td");
      tdemail.innerHTML = user.email;
      tr.appendChild(tdemail);

      let tdname = document.createElement("td");
      tdname.innerHTML = user.name + " " + user.surname;
      tr.appendChild(tdname);

      let tdrole = document.createElement("td");
      tdrole.innerHTML = user.role;
      tr.appendChild(tdrole);

      /*    COSTRUISCI IL DROPDOWN CON LE AZIONI DA FARE    */
      let tdactions = document.createElement("td");

      let mainDiv = document.createElement("div");
      mainDiv.classList.add(
        "dropstart",
        "font-sans-serif",
        "position-static",
        "d-inline-block"
      );
      let viewButton = document.createElement("button");
      viewButton.classList.add(
        "btn",
        "btn-link",
        "text-600",
        "btn-sm",
        "btn-reveal",
        "float-end"
      );
      viewButton.dataset.bsToggle = "dropdown";
      viewButton.dataset.boundary = "window";
      viewButton.dataset.bsReference = "parent";
      viewButton.id = "dropdown" + user.id;
      viewButton.setAttribute("aria-haspopup", "true");
      viewButton.setAttribute("aria-expanded", "false");

      let iconButton = document.createElement("span");
      iconButton.classList.add("fas", "fa-ellipsis-h", "fs--1");

      let hideMenu = document.createElement("div");
      hideMenu.classList.add(
        "dropdown-menu",
        "dropdown-menu-end",
        "border",
        "py-2"
      );
      hideMenu.setAttribute("aria-labelledby", "dropdown" + user.id);

      let linkEdit = document.createElement("a");
      linkEdit.classList.add("dropdown-item");
      linkEdit.innerHTML = "Modifica";
      linkEdit.dataset.bsTarget = "#editUser-" + user.id;
      linkEdit.dataset.bsToggle = "modal";
      linkEdit.dataset.bsDismiss = "modal";

      let dropdownDivisor = document.createElement("div");
      dropdownDivisor.classList.add("dropdown-divider");

      let linkDelete = document.createElement("a");
      linkDelete.classList.add("dropdown-item", "text-danger");
      linkDelete.href = "/user/" + user.id + "/delete";
      linkDelete.innerHTML = "Elimina";

      /*    UNISCO I PEZZI    */
      hideMenu.appendChild(linkEdit);
      hideMenu.appendChild(dropdownDivisor);
      hideMenu.appendChild(linkDelete);

      viewButton.appendChild(iconButton);
      mainDiv.appendChild(viewButton);
      mainDiv.appendChild(hideMenu);
      tdactions.appendChild(mainDiv);
      tr.appendChild(tdactions);

      /*    RIMUOVI IL SEGNAPOSTO    */
      placeholder.remove();
      /*    INSERISCI I NUOVI DATI    */
      table.appendChild(tr);

      /*    CREA IL MODAL    */
      let modalname = "editUser-" + user.id;
      let modalMain = document.createElement("div");
      modalMain.classList.add("modal", "fade");
      modalMain.id = modalname;
      modalMain.dataset.bsBackdrop = "static";
      modalMain.setAttribute("tabindex", "-1");
      modalMain.setAttribute("aria-labelledby", modalname);
      modalMain.setAttribute("aria-hidden", "true");

      let modalDialog = document.createElement("div");
      modalDialog.classList.add(
        "modal-dialog",
        "modal-xl",
        "modal-dialog-centered"
      );
      let modalContent = document.createElement("div");
      modalContent.classList.add("modal-content");
      let modalheader = document.createElement("div");
      modalheader.classList.add("modal-header", "bg-light");

      let modalTitle = document.createElement("h5");
      modalTitle.classList.add("modal-title", "bg-light");
      modalTitle.id = modalname;
      modalTitle.innerHTML = "Modifica";
      let modalDimiss = document.createElement("button");
      modalDimiss.classList.add("btn-close");
      modalDimiss.type = "button";
      modalDimiss.dataset.bsDismiss = "modal";
      modalMain.setAttribute("aria-label", "Close");

      let modalInsideContent = document.createElement("div");
      modalInsideContent.classList.add("modal-body");
      modalInsideContent.innerHTML = "testo";

      let modalFooter = document.createElement("div");
      modalFooter.classList.add("modal-footer");
      //modalInsideContent

      let buttonEdit = document.createElement("button");
      buttonEdit.classList.add("btn", "btn-success");
      //buttonEdit.href = 'users/edit/'+user.id;
      buttonEdit.type = "button";
      buttonEdit.innerHTML = "Modifica";

      modalheader.appendChild(modalTitle);
      modalheader.appendChild(modalDimiss);

      modalFooter.appendChild(buttonEdit);

      modalContent.appendChild(modalheader);
      modalContent.appendChild(modalInsideContent);
      modalContent.appendChild(modalFooter);

      modalDialog.appendChild(modalContent);
      modalMain.appendChild(modalDialog);

      modalSection.appendChild(modalMain);

      var popoverTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="popover"]')
      );
      var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
      });
    });
  })
  .catch(function (error) {
    /*    SCENARIO SE NON RIESCO A RECUPERARE LA CHIAMATA    */
    let tr = document.createElement("tr");
    tr.classList.add("btn-reveal-trigger");
    let td = document.createElement("td");
    td.classList.add(
      "align-middle",
      "align-middle",
      "text-center",
      "text-dark",
      "bg-warning",
      "px-1"
    );

    td.colSpan = 5;
    let i = document.createElement("i");
    i.classList.add("fa-exclamation-triangle");
    i.classList.add("text-danger");
    i.classList.add("fas");
    i.classList.add("mx-1");
    let span = document.createElement("span");
    span.innerHTML = "Nessun records";

    td.appendChild(i);
    td.appendChild(span);

    tr.appendChild(td);

    table.appendChild(tr);
  });
