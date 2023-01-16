<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Phoenix Trophy</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/application.min.css') }}">

    <!-- Styles -->


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
  <?php
  /* Host name of the MySQL server */
  $host = 'localhost';
  /* MySQL account username */
  $user = 'root';
  /* MySQL account password */
  $passwd = '';
  /* Connection with MySQLi, procedural-style */
  $mysqli = mysqli_connect($host, $user, $passwd, "laravel");
  /* Check if the connection succeeded */
  if (!$mysqli)
  {
     echo 'Connection failed<br>';
     echo 'Error number: ' . mysqli_connect_errno() . '<br>';
     echo 'Error message: ' . mysqli_connect_error() . '<br>';
     die();
  }

  $list = "";
  $fullname = "error";
  $user = null;
  $sql = "SELECT * FROM rp_users";
  $result = $mysqli->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $list .="<option value='" . $row["id"] . "'>" . $row["fullname"] . "</option>\n";
      if ($row["id"] == Auth::user()["id"]) {
        $fullname = $row["fullname"];
        $user = $row;
      }
    }
  }


  $compact = null;
  $sport = null;
  $sql = "SELECT * FROM courses";
  $result = $mysqli->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if ($row["id"] == 3) {
        $sport = $row;
      }
      if ($row["id"] == 4) { // TEMPORAIRE
        $compact = $row;
      }
    }
  }

  ?>
    @if (Route::has('login'))
        @auth
          <?php if ($user['admin'] == 1) {?>
            @include('header')
            <div class="content-wrap">
                <main id="content" class="content" role="main">
                    <h1 class="page-title"><b>Bienvenue</b> <?php echo $fullname ?>
                        <small>
                            <small></small>
                        </small>
                    </h1>
                    <div class="row">
                      <div class="col-lg-12">
                    <?php

                    switch ($info) {
                      case 'success':
                        echo "<div class='alert alert-success alert-sm'>";
                        echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                        echo "<span class='fw-semi-bold'>Parfait !</span> Tout s'est bien passé";
                        echo "</div>";
                        break;
                      case 'successInfo':
                        echo "<div class='alert alert-success alert-sm'>";
                        echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                        echo "<span class='fw-semi-bold'>Parfait !</span> Tout s'est bien passé";
                        echo "</div>";
                        break;
                      case "duplicateError":
                      echo "<div class='alert alert-danger alert-sm'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                      echo "<span class='fw-semi-bold'>Erreur :</span> L'utilisateur est déjà enregistré";
                      echo "</div>";
                        break;
                      case "pariError":
                      echo "<div class='alert alert-danger alert-sm'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                      echo "<span class='fw-semi-bold'>Erreur :</span> Cette personne a déjà parié";
                      echo "</div>";
                        break;
                      case "noPariError":
                      echo "<div class='alert alert-danger alert-sm'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                      echo "<span class='fw-semi-bold'>Erreur :</span> Cette personne n'a pas parié";
                      echo "</div>";
                        break;
                      case "error":
                      echo "<div class='alert alert-danger alert-sm'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                      echo "<span class='fw-semi-bold'>Erreur :</span> Une erreur inconnue est survenue";
                      echo "</div>";
                        break;
                    }
                      ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="widget-body">
                                        <form action="/add_user" method="POST" class="form-horizontal" role="form">
                                            @csrf
                                            <fieldset>
                                                <legend><strong>Ajouter</strong> une personne</legend>
                                                <div class="form-group row">
                                                    <label for="normal-field" class="col-md-4 form-control-label">Identifiant</label>
                                                    <div class="col-md-8">
                                                        <input name="id" type="text" id="id" class="form-control"
                                                            placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="hint-field" class="col-md-4 control-label">
                                                        Prénom Nom
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input name="name" type="text" id="name" class="form-control">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="offset-md-2 col-md-9 col-12">
                                                        <center>
                                                          <button type="submit" class="btn btn-success mr-3">Ajouter</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                      <div class="col-lg-6">
                        <div class="widget-body">
                                        <form action="/add_pari" method="POST" class="form-horizontal" role="form">
                                          @csrf
                                            <fieldset>
                                                <legend><strong>Enregistrer</strong> un pari</legend>

                                            <div class="form-group row">
                                                <label class="col-md-4 control-label" for="country-select">Qui ?</label>
                                                <div class="col-md-8">
                                                  <input list="cars" name="id" type="text">
                                                  <datalist id="cars">
                                                  <?php echo $list ?>
                                                  </datalist>
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="col-md-4 control-label" for="country-select">Course</label>
                                                 <div class="col-md-8">
                                                     <select id="country-select" data-placeholder="Select country"
                                                         class="select2 form-control" tabindex="-1" name="course">
                                                         <option value=""></option>
                                                         <option value="Sportives">Sportives</option>
                                                         <option value="Compactes">Compactes</option>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="col-md-4 control-label" for="country-select">Numéro du Pilote</label>
                                                 <div class="col-md-8">
                                                     <select id="country-select" data-placeholder="Select country"
                                                         class="select2 form-control" tabindex="-1" name="pilote">
                                                         <option value=""></option>
                                                         <option value=1>Numéro 1</option>
                                                         <option value=2>Numéro 2</option>
                                                         <option value=3>Numéro 3</option>
                                                         <option value=4>Numéro 4</option>
                                                         <option value=5>Numéro 5</option>
                                                         <option value=6>Numéro 6</option>
                                                         <option value=7>Numéro 7</option>
                                                         <option value=8>Numéro 8</option>
                                                     </select>
                                                 </div>
                                             </div>
                                              <div class="form-group row">
                                                  <label class="col-md-4  col-form-label" for="combined-input">Mise</label>
                                                  <div class="col-md-8">
                                                      <div class="input-group">
                                                          <span class="input-group-prepend">
                                                              <span class="input-group-text">$</span>
                                                          </span>
                                                          <input id="combined-input" class="form-control" size="16" type="text" name="mise">

                                                      </div>
                                                  </div>
                                              </div>
                                            </fieldset>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="offset-md-2 col-md-9 col-12">
                                                        <center>
                                                          <button type="submit" class="btn btn-success mr-3">Ajouter</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>

                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="widget-body">
                                          <form action="/edit_pari" method="POST" class="form-horizontal" role="form">
                                            @csrf
                                              <fieldset>
                                                  <legend><strong>Modifier</strong> un pari</legend>
                                                  <p>Renseigner le nouveau pari, faire payer la différence</p>

                                              <div class="form-group row">
                                                  <label class="col-md-4 control-label" for="country-select">Qui ?</label>
                                                  <div class="col-md-8">
                                                    <input list="cars" name="id" type="text">
                                                    <datalist id="cars">
                                                    <?php echo $list ?>
                                                    </datalist>
                                                  </div>
                                               </div>
                                               <div class="form-group row">
                                                   <label class="col-md-4 control-label" for="country-select">Course</label>
                                                   <div class="col-md-8">
                                                       <select id="country-select" data-placeholder="Select country"
                                                           class="select2 form-control" tabindex="-1" name="course">
                                                           <option value=""></option>
                                                           <option value="Sportives">Sportives</option>
                                                           <option value="Compactes">Compactes</option>
                                                       </select>
                                                   </div>
                                               </div>
                                               <div class="form-group row">
                                                   <label class="col-md-4 control-label" for="country-select">Numéro du Pilote</label>
                                                   <div class="col-md-8">
                                                       <select id="country-select" data-placeholder="Select country"
                                                           class="select2 form-control" tabindex="-1" name="pilote">
                                                           <option value=""></option>
                                                           <option value=1>Numéro 1</option>
                                                           <option value=2>Numéro 2</option>
                                                           <option value=3>Numéro 3</option>
                                                           <option value=4>Numéro 4</option>
                                                           <option value=5>Numéro 5</option>
                                                           <option value=6>Numéro 6</option>
                                                           <option value=7>Numéro 7</option>
                                                           <option value=8>Numéro 8</option>
                                                       </select>
                                                   </div>
                                               </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4  col-form-label" for="combined-input">Mise</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </span>
                                                            <input id="combined-input" class="form-control" size="16" type="text" name="mise">

                                                        </div>
                                                    </div>
                                                </div>
                                              </fieldset>
                                              <div class="form-actions">
                                                  <div class="row">
                                                      <div class="offset-md-2 col-md-9 col-12">
                                                          <center>
                                                            <button type="submit" class="btn btn-info mr-3">Modifier</button>
                                                          </center>
                                                      </div>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </section>
                              </div>
                              <div class="col-lg-6">
                                <div class="widget-body">
                                                <form action="/admin" method="get" class="form-horizontal" role="form">
                                                  @csrf
                                                    <fieldset>
                                                        <legend><strong>Voir</strong> un pari</legend>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 control-label" for="country-select">Qui ?</label>
                                                        <div class="col-md-8">
                                                          <input list="cars" name="id" type="text">
                                                          <datalist id="cars">
                                                          <?php echo $list ?>
                                                          </datalist>
                                                        </div>
                                                     </div>
                                                     <div class="form-group row">
                                                         <label class="col-md-4 control-label" for="country-select">Course</label>
                                                         <div class="col-md-8">
                                                             <select id="country-select" data-placeholder="Select country"
                                                                 class="select2 form-control" tabindex="-1" name="course">
                                                                 <option value=""></option>
                                                                 <option value="Sportives">Sportives</option>
                                                                 <option value="Compactes">Compactes</option>
                                                             </select>
                                                         </div>
                                                     </div>
                                                    </fieldset>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="offset-md-2 col-md-9 col-12">
                                                                <center>
                                                                  <button type="submit" class="btn btn-inverse mr-3">Voir</button>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <h3>
                                                  <?php
                                                  if ($_GET != null) {
                                                    if ($_GET["id"] != null && $_GET["course"] != null) {

                                                      $host = 'localhost';
                                                      /* MySQL account username */
                                                      $user = 'root';
                                                      /* MySQL account password */
                                                      $passwd = 'c$k7i!5#mfoYSgc9oc';
                                                      /* Connection with MySQLi, procedural-style */
                                                      $mysqli = mysqli_connect($host, $user, $passwd, "laravel");
                                                      /* Check if the connection succeeded */
                                                      if (!$mysqli)
                                                      {
                                                         die();
                                                         return redirect('/admin/error');
                                                      }

                                                      $course = null;

                                                      $selectSQL = "SELECT * FROM `pari` WHERE discord=" . $_GET["id"] . " AND course='" . $_GET["course"] . "'";
                                                      $result = $mysqli->query($selectSQL);
                                                      if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                          $course = $row;
                                                        }
                                                      }


                                                      echo "<br><center>Numéro du pilote : <strong>" . $course["NumPilote"] . "</strong><br>\n";
                                                      echo "Mise : <strong>" . $course["Montant"] . " $</strong></center>";
                                                    }
                                                  }
                                                   ?>
                                                </h3>
                                            </div>
                                        </section>
                                    </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                            <section class="widget pb-0">
                                <header>
                                    <h4>
                                        Compactes
                                    </h4>
                                    <div class="widget-controls mt-2">
                                        <a href="#"><i class="la la-cog text-white"></i></a>
                                        <a href="#" data-widgster="close"><i class="la la-remove text-white"></i></a>
                                    </div>
                                </header>
                                <div class="widget-body p-0 support table-wrapper">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr class="text-white">
                                                <th scope="col"><span class=" pl-3">Numéro</span></th>
                                                <th scope="col">Participant</th>
                                                <th scope="col">Véhicule du participant</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-white-50">
                                            <tr>
                                                <th class="pl-4 fw-normal">1</th>
                                                <td><?php echo $compact["P1_name"] ?></td>
                                                <td><?php echo $compact["P1_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">2</th>
                                                <td><?php echo $compact["P2_name"] ?></td>
                                                <td><?php echo $compact["P2_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">3</th>
                                                <td><?php echo $compact["P3_name"] ?></td>
                                                <td><?php echo $compact["P3_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">4</th>
                                                <td><?php echo $compact["P4_name"] ?></td>
                                                <td><?php echo $compact["P4_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">5</th>
                                                <td><?php echo $compact["P5_name"] ?></td>
                                                <td><?php echo $compact["P5_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">6</th>
                                                <td><?php echo $compact["P6_name"] ?></td>
                                                <td><?php echo $compact["P6_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">7</th>
                                                <td><?php echo $compact["P7_name"] ?></td>
                                                <td><?php echo $compact["P7_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">8</th>
                                                <td><?php echo $compact["P8_name"] ?></td>
                                                <td><?php echo $compact["P8_car"] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-6">
                            <section class="widget pb-0">
                                <header>
                                    <h4>
                                        Sportives
                                    </h4>
                                    <div class="widget-controls mt-2">
                                        <a href="#"><i class="la la-cog text-white"></i></a>
                                        <a href="#" data-widgster="close"><i class="la la-remove text-white"></i></a>
                                    </div>
                                </header>
                                <div class="widget-body p-0 support table-wrapper">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr class="text-white">
                                                <th scope="col"><span class=" pl-3">Numéro</span></th>
                                                <th scope="col">Participant</th>
                                                <th scope="col">Véhicule du participant</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-white-50">
                                            <tr>
                                                <th class="pl-4 fw-normal">1</th>
                                                <td><?php echo $sport["P1_name"] ?></td>
                                                <td><?php echo $sport["P1_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">2</th>
                                                <td><?php echo $sport["P2_name"] ?></td>
                                                <td><?php echo $sport["P2_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">3</th>
                                                <td><?php echo $sport["P3_name"] ?></td>
                                                <td><?php echo $sport["P3_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">4</th>
                                                <td><?php echo $sport["P4_name"] ?></td>
                                                <td><?php echo $sport["P4_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">5</th>
                                                <td><?php echo $sport["P5_name"] ?></td>
                                                <td><?php echo $sport["P5_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">6</th>
                                                <td><?php echo $sport["P6_name"] ?></td>
                                                <td><?php echo $sport["P6_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">7</th>
                                                <td><?php echo $sport["P7_name"] ?></td>
                                                <td><?php echo $sport["P7_car"] ?></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-4 fw-normal">8</th>
                                                <td><?php echo $sport["P8_name"] ?></td>
                                                <td><?php echo $sport["P8_car"] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </section>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="widget-body">
                                          <form action="/updateNext" method="POST" class="form-horizontal" role="form">
                                            @csrf
                                              <fieldset>
                                                  <legend><strong>Modifier</strong> le prochaine course (avec pari)</legend>
                                               <div class="form-group row">
                                                   <label class="col-md-4 control-label" for="country-select">Course</label>
                                                   <div class="col-md-8">
                                                       <select id="country-select" data-placeholder="Select country"
                                                           class="select2 form-control" tabindex="-1" name="course">
                                                           <option value=""></option>
                                                           <option value="3">Sportives</option>
                                                           <option value="4">Compactes</option>
                                                       </select>
                                                   </div>
                                               </div>


                                              </fieldset>
                                              <div class="form-actions">
                                                  <div class="row">
                                                      <div class="offset-md-2 col-md-9 col-12">
                                                          <center>
                                                            <button type="submit" class="btn btn-info mr-3">Modifier</button>
                                                          </center>
                                                      </div>
                                                  </div>
                                              </div>

                                          </form>
                                      </div>
                                  </section>
                              </div>
                              <div class="col-lg-6">
                                <div class="widget-body">
                                                <form action="/updatePilote" method="post" class="form-horizontal" role="form">
                                                  @csrf
                                                    <fieldset>
                                                        <legend><strong>Modifier</strong> un pilote</legend>


                                                     <div class="form-group row">
                                                         <label class="col-md-4 control-label" for="country-select">Course</label>
                                                         <div class="col-md-8">
                                                             <select id="country-select" data-placeholder="Select country"
                                                                 class="select2 form-control" tabindex="-1" name="course">
                                                                 <option value=""></option>
                                                                 <option value="Sportives">Sportives</option>
                                                                 <option value="Compactes">Compactes</option>
                                                             </select>
                                                         </div>
                                                     </div>
                                                     <div class="form-group row">
                                                         <label class="col-md-4 control-label" for="country-select">Numéro du Pilote</label>
                                                         <div class="col-md-8">
                                                             <select id="country-select" data-placeholder="Select country"
                                                                 class="select2 form-control" tabindex="-1" name="pilote">
                                                                 <option value=""></option>
                                                                 <option value=P1>Numéro 1</option>
                                                                 <option value=P2>Numéro 2</option>
                                                                 <option value=P3>Numéro 3</option>
                                                                 <option value=P4>Numéro 4</option>
                                                                 <option value=P5>Numéro 5</option>
                                                                 <option value=P6>Numéro 6</option>
                                                                 <option value=P7>Numéro 7</option>
                                                                 <option value=P8>Numéro 8</option>
                                                             </select>
                                                         </div>
                                                     </div>
                                                     <div class="form-group row">
                                                         <label for="normal-field" class="col-md-4 form-control-label">Prénom Nom</label>
                                                         <div class="col-md-8">
                                                             <input name="fullname" type="text" id="id" class="form-control"
                                                                 placeholder="">
                                                         </div>
                                                     </div>
                                                     <div class="form-group row">
                                                         <label for="normal-field" class="col-md-4 form-control-label">Véhicule</label>
                                                         <div class="col-md-8">
                                                             <input name="car" type="text" id="id" class="form-control"
                                                                 placeholder="">
                                                         </div>
                                                     </div>
                                                    </fieldset>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="offset-md-2 col-md-9 col-12">
                                                                <center>
                                                                  <button type="submit" class="btn btn-inverse mr-3">Voir</button>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <h3>
                                                  <?php
                                                  if ($_GET != null) {
                                                    if ($_GET["id"] != null && $_GET["course"] != null) {

                                                      $host = 'localhost';
                                                      /* MySQL account username */
                                                      $user = 'root';
                                                      /* MySQL account password */
                                                      $passwd = 'c$k7i!5#mfoYSgc9oc';
                                                      /* Connection with MySQLi, procedural-style */
                                                      $mysqli = mysqli_connect($host, $user, $passwd, "laravel");
                                                      /* Check if the connection succeeded */
                                                      if (!$mysqli)
                                                      {
                                                         die();
                                                         return redirect('/admin/error');
                                                      }

                                                      $course = null;

                                                      $selectSQL = "SELECT * FROM `pari` WHERE discord=" . $_GET["id"] . " AND course='" . $_GET["course"] . "'";
                                                      $result = $mysqli->query($selectSQL);
                                                      if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                          $course = $row;
                                                        }
                                                      }


                                                      echo "<br><center>Numéro du pilote : <strong>" . $course["NumPilote"] . "</strong><br>\n";
                                                      echo "Mise : <strong>" . $course["Montant"] . " $</strong></center>";
                                                    }
                                                  }
                                                   ?>
                                                </h3>
                                            </div>
                                        </section>
                                    </div>
                      </div>
                    </div>
                  <?php } ?>
        @else
        <div class="container-fluid">
            <main id="content" class="content" role="main">
              <center>
                <a href="{{ route('login') }}" class=""><button class="button-64" role="button"><span class="text">Login With Discord</span></button></a>
              </center>
            </main>
          </div>

        @endauth
    @endif


</body>
</html>
