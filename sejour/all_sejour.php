<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["../assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/plugins.min.css" />
  <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="../assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark" >
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.html" class="logo">
          <p style="color:white; font-family: fantasy; margin-top: 50%;">Gestion de <br> logement</p>
          </a>
         
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item">

            <hr><i class="fas far fa-home" style="margin-left: 5%">    LOGEMENT</i><hr>
            <a href="../logements/add_logement.php">
              <span class="sub-item">Ajout de logement</span>
            </a>
            <a href="../logements/all_logements.php">
              <span class="sub-item">Liste des logements</span>
            </a>

            <hr><i class="fas far fa-user" style="margin-left: 5%">    VOYAGEUR</i><hr>            
            <a href="../voyageur/add_voyageur.php">
              <span class="sub-item">Ajout de voyageur</span>
            </a>     
            <a href="../voyageur/all_voyageur.php">
              <span class="sub-item">Liste des voyageurs</span>
            </a>

            <hr><i class="fas far fa-sun" style="margin-left: 5%">    SEJOUR</i><hr>
            <a href="add_sejour.php">
              <span class="sub-item">Ajout de séjour</span>
            </a>            
            <a href="all_sejour.php">
              <span class="sub-item">Liste des séjours</span>
            </a>

          </li>
        </ul>        
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="../assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

        </nav>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <h4 class="card-title">Liste des Séjours</h4>
                    
                  </div>
                </div>
                <div class="card-body">
              
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold">Modification de Séjour</span>
                          </h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div id="message" class="alert d-none" role="alert"></div>

                          <form action="update_sejour.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <input type="hidden" id="sejourId" name="id_sejour">

                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Date de début</label>
                                  <input id="addDateDebut" type="date" name="debut" class="form-control" required />
                                </div>
                              </div>
                          
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Date de fin</label>
                                  <input id="addDateFin" type="text" name="fin" class="form-control" required />
                                </div>
                              </div>
                          
                              <div class="col-12 mt-3 d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-primary me-2">Modifier</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                              </div>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Voyageur</th>
                          <th>Logement</th> 
                          <th>Photo</th>                     
                          <th>Date de début</th>
                          <th>Date de fin</th>
                          <th style="width: 10%">Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        require('../based.php');

                        if (!$connection) {
                            die("Pas de connexion : " . mysqli_connect_error());
                        }

                        $sql = "SELECT 
                          sejour.id_sejour,
                          sejour.debut,
                          sejour.fin,
                          voyageur.nom AS voyageur_nom, 
                          voyageur.prenom AS voyageur_prenom, 
                          logement.nom AS logement_nom,
                          logement.photo AS logement_photo
                          FROM sejour
                          INNER JOIN voyageur ON sejour.id_voyageur = voyageur.id_voyageur
                          INNER JOIN logement ON sejour.code_logement = logement.code";

                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["id_sejour"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["voyageur_nom"] . " " . $row["voyageur_prenom"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["logement_nom"]); ?></td>
                                    <td><img src="../uploads/<?php echo htmlspecialchars($row["logement_photo"]); ?>" width="150" alt="Photo du logement"></td>
                                    <td><?php echo htmlspecialchars($row["debut"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["fin"]); ?></td>
                                    <td>
                                      <div class="form-button-action">
                                        <button type="button" class="btn btn-link btn-primary btn-lg btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addRowModal"
                                            data-id="<?php echo $row['id_sejour']; ?>"
                                            data-date-debut="<?php echo $row['debut']; ?>"
                                            data-date-fin="<?php echo $row['fin']; ?>"
                                            data-logement="<?php echo $row['logement_nom']; ?>"
                                            data-voyageur="<?php echo $row['voyageur_nom'] . ' ' . $row['voyageur_prenom']; ?>"
                                            title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-link btn-danger btn-delete" 
                                                data-id="<?php echo $row['id_sejour']; ?>" title="Supprimer">
                                            <i class="fa fa-times"></i>
                                        </button>
                                      </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="7" class="text-center">Aucun séjour enregistré.</td></tr>';
                        }

                        // Fermeture de la connexion
                        mysqli_close($connection);
                        ?>
                      </tbody>


                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End Custom template -->
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Datatables -->
  <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
  <!-- Kaiadmin JS -->
  <script src="../assets/js/kaiadmin.min.js"></script>
  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="../assets/js/setting-demo2.js"></script>

  <script>
  $(document).ready(function () {
    // Modification : Remplir automatiquement le formulaire
    $(document).ready(function () {
    $(".btn-edit").click(function () {
        let id = $(this).data("id");
        let dateDebut = $(this).data("date-debut");
        let dateFin = $(this).data("date-fin");
        let logement = $(this).data("logement");
        let voyageur = $(this).data("voyageur");

        // Remplir les champs du formulaire
        $("#sejourId").val(id);
        $("#addDateDebut").val(dateDebut);
        $("#addDateFin").val(dateFin);
        $("#addLogement").val(logement);
        $("#addVoyageur").val(voyageur);
    });
    });


    $(".btn-delete").click(function () {
    if (confirm("Voulez-vous vraiment supprimer ce séjour ?")) {
        let id = $(this).data("id");

        $.post("delete_sejour.php", { id: id }, function (response) {
            if (response.trim() === "success") {
                location.reload(); // Rafraîchir la page après suppression
            }   
        });
    }
    });

  });
</script>

<script>
  $(document).ready(function () {
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
      pageLength: 5,
      initComplete: function () {
        this.api()
          .columns()
          .every(function () {
            var column = this;
            var select = $(
              '<select class="form-select"><option value=""></option></select>'
            )
              .appendTo($(column.footer()).empty())
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                  .search(val ? "^" + val + "$" : "", true, false)
                  .draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
              });
          });
      },
    });

    // Add Row
    $("#add-row").DataTable({
      pageLength: 5,
    });

    var action =
      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function () {
      $("#add-row")
        .dataTable()
        .fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action,
        ]);
      $("#addRowModal").modal("hide");
    });
  });
</script>
</body>

</html>