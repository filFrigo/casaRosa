<div class="container">


    <h3><i class="fa-solid fa-message mt-5"></i> Comunicazioni </h3>
    <div class="col-12 card card-hover-shadow h-100 px-0">
        <div class="card-body px-0">

            <div class="text-end w-100 px-3">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createDeadline"
                    id="--btnCreateDeadline">Nuova Scadenza</button>
            </div>

            <div class="table-responsive">
                <table
                    class="mt-2 table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer p-0">
                    <thead class=" table-secondary">
                        <tr>
                            <th class="col-auto">Creazione</th>
                            <th class="col-auto">Scadenza</th>
                            <th class="col text-start">Descrizione</th>

                            <th class="col-1"></th>
                        </tr>
                    </thead>
                    <tbody id="--deadlineContainer">
                        <tr>
                            <td class="col-auto">2/12/2022</td>
                            <td class="col-auto">19/12/2022</td>
                            <td class="col text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Temporibus
                                aperiam expedita alias quidem obcaecati quasi quos modi doloremque saepe voluptatum quia
                                molestias facilis voluptas, veritatis odio consequatur sit itaque tempore.</td>
                            <td class="col-1"></td>
                        </tr>
                        <tr>
                            <td class="col-auto">1/12/2022</td>
                            <td class="col-auto">31/12/2022</td>
                            <td class="col text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
                                quidem,
                                odio aut, nobis ullam harum ducimus, quod autem rem ad incidunt! Hic quos magnam
                                eligendi
                                officiis harum commodi nulla velit.</td>
                            <td class="col-1"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>



<!-- MODAL MODIFICA -->
<div class="modal fade" id="createDeadline" tabindex="-1" role="dialog" aria-labelledby="createDeadlineLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-message"></i> Nuova Scadenza</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">


                <div class="mb-3 me-3 row">
                    <label for="--deadline" class="col-sm-2 col-form-label">Scadenza</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" placeholder="" id="--deadline">
                    </div>
                </div>

                <div class="mb-3 me-3 row">
                    <label for="--note" class="col-sm-2 col-form-label">Note</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="--note" rows="5"></textarea>
                    </div>
                </div>



            </div>
            <div class="modal-footer d-flex">
                <div class="flex-grow-1">
                    <button type="button" class="btn btn-link link-danger text-decoration-none"" data-dismiss=" modal"
                        id="--reset"><i class="fa-solid fa-trash-can"></i> Elimina</button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" id="--saveDeadine"><i
                            class="fa-regular fa-floppy-disk"></i>
                        Salva</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END MODAL MODIFICA -->