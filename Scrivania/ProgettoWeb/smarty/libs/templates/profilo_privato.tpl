<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profilo utente privato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="../javascript/searchbar.js"></script>
</head>
<body>
<div id="searchbar"></div>

<div class="container my-3 text-center">
    <div class="container">
        <div class="main-body">
            <!-- /Breadcrumb -->
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://w7.pngwing.com/pngs/81/570/png-transparent-profile-logo-computer-icons-user-user-blue-heroes-logo-thumbnail.png" alt="Admin" class="rounded-circle" width="140">
                                <div class="mt-3">
                                    <h4>{$nome}</h4>
                                    <p class="text-muted font-size-sm">{$luogo}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                                <span class="text-secondary">{$instagram}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                                <span class="text-secondary">{$facebook}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nome</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {$nome}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Cognome</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {$cognome}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {$email}
                                </div>
                            </div>
                            <hr>

                            </p>
                            <a href="mod-profilo.tpl">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" >
                                Modifica
                            </button>
                                </a>
                            <p>
                        </div>
                    </div>
                </div>
                <p>

                </p>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Crea nuovo annuncio
                </button>
                <p>

                </p>
                <!--Annunci-->
                <div class="container">
                    <h1>Annunci online</h1>
                    {if $annuncio}
                    {if is_array($annuncio)}
                    {foreach from=$annuncio  item=ann}
                    <div class="row">
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="logo.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{$ann->getTitolo()}</h5>
                                    <p class="card-text">{$ann->getDescrizione()}</p>
                                    <a href="#" class="btn btn-primary">Visita annuncio</a>
                                </div>
                            </div>
                            <p></p>
                        </div>
                    </div>
                    {/foreach}
                    {/if}
                    {/if}
                </div>
            </div>
        </div>
    </div>
    <!-- About, Information, Contacts -->
    <footer id="footer">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="inror_box">
                            <h3>INFORMAZIONI </h3>
                            <p>Questo è un sito per la compravendita di oggetti di ogni tipo, è necessario registrarsi per pubblicare annunci mentre non è necessario registrarsi per acquistare oggetti. <a href="#shopnow">Shop now</a> </p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="inror_box">
                            <h3>ACCOUNT </h3>
                            <p>Per tornare all'area pubblica basta cliccare sulla voce <a href="#privatenavbar">Logout</a> in alto a destra. </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="inror_box">
                            <h3>ABOUT US  </h3>
                            <p>Federico Civitareale  cellulare: <a href="tel:+39 3450792613">+39 3450792613</a>  email: <a href="mailto:federico.civitareale@student.univaq.it">federico.civitareale@student.univaq.it</a> </p>
                            <p>Fabio Mastromauro  cellulare: <a href="tel:+39 3890262673">+39 3890262673</a> email: <a href="mailto:fabio.mastromauro@student.univaq.it">fabio.mastromauro@student.univaq.it</a> </p>
                            <p>Giorgio Tarquini cellulare: <a href="tel:+39 3339154764">+39 3339154764</a> email: <a href="mailto:giorgio.tarquini1@student.univaq.it">giorgio.tarquini1@student.univaq.it</a> </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="inror_box">
                            <h3>SOCIAL CONTACTS  </h3>
                            <p>Facebook:</p>
                            <p><a href="https://m.facebook.com/federico.civitareale">Federico Civitareale</a></p>
                            <p><a href="https://www.facebook.com/fabio.mastromauro.7">Fabio Mastromauro</a></p>
                            <p><a href="https://www.facebook.com/giorgio.tarquini.5">Giorgio Tarquini</a> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>© 2022 All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </main>

    <!-- modifica -->
    <div class="modal fade" id="modifica" tabindex="-1" aria-labelledby="modificaLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificaLabel">Modifica profilo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-mb-4">
                            <label for="validationCustom01" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="validationCustom02" style="background-color: whitesmoke" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-mb-4">
                            <label for="validationCustom02" class="form-label">Cognome</label>
                            <input type="text" color class="form-control" id="validationCustom03" style="background-color: whitesmoke" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-mb-4">
                            <label for="validationCustom03" class="form-label">Email</label>
                            <input type="text" class="form-control" id="validationCustom04" style="background-color: whitesmoke" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="col-mb-4">
                                <label for="validationCustom04" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="validationCustom05" style="background-color: whitesmoke" value="" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-mb-2">
                                <label for="validationCustom05" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="validationCustom06" style="background-color: whitesmoke" value="" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Applica modifiche</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- crea annuncio -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crea annuncio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Aggiungi una o più foto</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Crea annuncio</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">

</script>
</body>
</html>