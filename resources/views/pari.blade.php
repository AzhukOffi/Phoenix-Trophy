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
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>

    @if (Route::has('login'))
        @auth
            <?php
            /* Host name of the MySQL server */
            $host = 'localhost';
            /* MySQL account username */
            $sql_user = 'root';
            /* MySQL account password */
            $passwd = '';
            /* The schema you want to use */
            $schema = 'mySchema';
            /* Connection with MySQLi, procedural-style */
            $mysqli = mysqli_connect($host, $sql_user, $passwd, "laravel");
            /* Check if the connection succeeded */
            if (!$mysqli)
            {
               echo 'Connection failed<br>';
               echo 'Error number: ' . mysqli_connect_errno() . '<br>';
               echo 'Error message: ' . mysqli_connect_error() . '<br>';
               die();
            }

            $fullname = "Inconnu (Merci de contacter Mr Connor Parker au 051-8321)";
            $user = null;
            $sql = "SELECT * FROM rp_users WHERE id=" . Auth::user()["id"];
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $fullname = $row["fullname"];
                $user = $row;
              }
            }


            $course = null;
            $sql = "SELECT * FROM courses WHERE next=1";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $course = $row;
              }
            }
            $Sport_P1_cote = 0;
            $Sport_P2_cote = 0;
            $Sport_P3_cote = 0;
            $Sport_P4_cote = 0;
            $Sport_P5_cote = 0;
            $Sport_P6_cote = 0;
            $Sport_P7_cote = 0;
            $Sport_P8_cote = 0;

            $Sport_P1_mise = 0;
            $Sport_P2_mise = 0;
            $Sport_P3_mise = 0;
            $Sport_P4_mise = 0;
            $Sport_P5_mise = 0;
            $Sport_P6_mise = 0;
            $Sport_P7_mise = 0;
            $Sport_P8_mise = 0;
            $Sport_totalMise = 0;

            $Compact_P1_cote = 0;
            $Compact_P2_cote = 0;
            $Compact_P3_cote = 0;
            $Compact_P4_cote = 0;
            $Compact_P5_cote = 0;
            $Compact_P6_cote = 0;
            $Compact_P7_cote = 0;
            $Compact_P8_cote = 0;

            $Compact_P1_mise = 0;
            $Compact_P2_mise = 0;
            $Compact_P3_mise = 0;
            $Compact_P4_mise = 0;
            $Compact_P5_mise = 0;
            $Compact_P6_mise = 0;
            $Compact_P7_mise = 0;
            $Compact_P8_mise = 0;
            $Compact_totalMise = 0;

            $Sport_miseFor = "";
            $Sport_mise = 0;
            $Sport_cote = 0;

            $Compact_miseFor = "";
            $Compact_mise = 0;
            $Compact_cote = 0;
            if ($course["pari"] == 1) {
              $resultOne = $mysqli->query("SELECT * FROM pari WHERE NumPilote=1");

              if ($resultOne->num_rows > 0) {
                while($row = $resultOne->fetch_assoc()) {
                  if ($row["course"] == "Sportives") {
                    if ($row["discord"] == $user["id"]) {
                      $Sport_miseFor = "P1";
                      $Sport_mise = $row["Montant"];
                    }

                    $Sport_P1_mise = $Sport_P1_mise + $row["Montant"];
                    $Sport_totalMise = $Sport_totalMise + $row["Montant"];
                  }
                  if ($row["course"] == "Compactes") {
                    if ($row["discord"] == $user["id"]) {
                      $Compact_miseFor = "P1";
                      $Compact_mise = $row["Montant"];
                    }

                    $Compact_P1_mise = $Compact_P1_mise + $row["Montant"];
                    $Compact_totalMise = $Compact_totalMise + $row["Montant"];
                  }
                }
              }

              $resultTwo = $mysqli->query("SELECT * FROM pari WHERE NumPilote=2");
              if ($resultTwo->num_rows > 0) {
                while($row = $resultTwo->fetch_assoc()) {
                  if ($row["course"] == "Sportives") {
                    if ($row["discord"] == $user["id"]) {
                      $Sport_miseFor = "P2";
                      $Sport_mise = $row["Montant"];
                    }

                    $Sport_P2_mise = $Sport_P2_mise + $row["Montant"];
                    $Sport_totalMise = $Sport_totalMise + $row["Montant"];
                  }
                  if ($row["course"] == "Compactes") {
                    if ($row["discord"] == $user["id"]) {
                      $Compact_miseFor = "P2";
                      $Compact_mise = $row["Montant"];
                    }

                    $Compact_P2_mise = $Compact_P2_mise + $row["Montant"];
                    $Compact_totalMise = $Compact_totalMise + $row["Montant"];
                  }
                }
              }

              $resultThree = $mysqli->query("SELECT * FROM pari WHERE NumPilote=3");
              if ($resultThree->num_rows > 0) {
                while($row = $resultThree->fetch_assoc()) {
                  if ($row["course"] == "Sportives") {
                    if ($row["discord"] == $user["id"]) {
                      $Sport_miseFor = "P3";
                      $Sport_mise = $row["Montant"];
                    }

                    $Sport_P3_mise = $Sport_P3_mise + $row["Montant"];
                    $Sport_totalMise = $Sport_totalMise + $row["Montant"];
                  }
                  if ($row["course"] == "Compactes") {
                    if ($row["discord"] == $user["id"]) {
                      $Compact_miseFor = "P3";
                      $Compact_mise = $row["Montant"];
                    }

                    $Compact_P3_mise = $Compact_P3_mise + $row["Montant"];
                    $Compact_totalMise = $Compact_totalMise + $row["Montant"];
                  }
                }
              }

              $resultFour = $mysqli->query("SELECT * FROM pari WHERE NumPilote=4");
              if ($resultFour->num_rows > 0) {
                while($row = $resultFour->fetch_assoc()) {
                  if ($row["course"] == "Sportives") {
                    if ($row["discord"] == $user["id"]) {
                      $Sport_miseFor = "P4";
                      $Sport_mise = $row["Montant"];
                    }

                    $Sport_P4_mise = $Sport_P4_mise + $row["Montant"];
                    $Sport_totalMise = $Sport_totalMise + $row["Montant"];
                  }
                  if ($row["course"] == "Compactes") {
                    if ($row["discord"] == $user["id"]) {
                      $Compact_miseFor = "P4";
                      $Compact_mise = $row["Montant"];
                    }

                    $Compact_P4_mise = $Compact_P4_mise + $row["Montant"];
                    $Compact_totalMise = $Compact_totalMise + $row["Montant"];
                  }
                }
              }

              $resultFive = $mysqli->query("SELECT * FROM pari WHERE NumPilote=5");
              if ($resultFive->num_rows > 0) {
                while($row = $resultFive->fetch_assoc()) {
                  if ($row["course"] == "Sportives") {
                    if ($row["discord"] == $user["id"]) {
                      $Sport_miseFor = "P5";
                      $Sport_mise = $row["Montant"];
                    }

                    $Sport_P5_mise = $Sport_P5_mise + $row["Montant"];
                    $Sport_totalMise = $Sport_totalMise + $row["Montant"];
                  }
                  if ($row["course"] == "Compactes") {
                    if ($row["discord"] == $user["id"]) {
                      $Compact_miseFor = "P5";
                      $Compact_mise = $row["Montant"];
                    }

                    $Compact_P5_mise = $Compact_P5_mise + $row["Montant"];
                    $Compact_totalMise = $Compact_totalMise + $row["Montant"];
                  }
                }
              }

              $resultSix = $mysqli->query("SELECT * FROM pari WHERE NumPilote=6");
              if ($resultSix->num_rows > 0) {
                while($row = $resultSix->fetch_assoc()) {
                  if ($row["course"] == "Sportives") {
                    if ($row["discord"] == $user["id"]) {
                      $Sport_miseFor = "P6";
                      $Sport_mise = $row["Montant"];
                    }

                    $Sport_P6_mise = $Sport_P6_mise + $row["Montant"];
                    $Sport_totalMise = $Sport_totalMise + $row["Montant"];
                  }
                  if ($row["course"] == "Compactes") {
                    if ($row["discord"] == $user["id"]) {
                      $Compact_miseFor = "P6";
                      $Compact_mise = $row["Montant"];
                    }

                    $Compact_P6_mise = $Compact_P6_mise + $row["Montant"];
                    $Compact_totalMise = $Compact_totalMise + $row["Montant"];
                  }
                }
              }

              $resultSeven = $mysqli->query("SELECT * FROM pari WHERE NumPilote=7");
              if ($resultSeven->num_rows > 0) {
                while($row = $resultSeven->fetch_assoc()) {
                  if ($row["course"] == "Sportives") {
                    if ($row["discord"] == $user["id"]) {
                      $Sport_miseFor = "P7";
                      $Sport_mise = $row["Montant"];
                    }

                    $Sport_P7_mise = $Sport_P7_mise + $row["Montant"];
                    $Sport_totalMise = $Sport_totalMise + $row["Montant"];
                  }
                  if ($row["course"] == "Compactes") {
                    if ($row["discord"] == $user["id"]) {
                      $Compact_miseFor = "P7";
                      $Compact_mise = $row["Montant"];
                    }

                    $Compact_P7_mise = $Compact_P7_mise + $row["Montant"];
                    $Compact_totalMise = $Compact_totalMise + $row["Montant"];
                  }
                }
              }

              $resultEight = $mysqli->query("SELECT * FROM pari WHERE NumPilote=8");
              if ($resultEight->num_rows > 0) {
                while($row = $resultEight->fetch_assoc()) {
                  if ($row["course"] == "Sportives") {
                    if ($row["discord"] == $user["id"]) {
                      $Sport_miseFor = "P8";
                      $Sport_mise = $row["Montant"];
                    }

                    $Sport_P8_mise = $Sport_P8_mise + $row["Montant"];
                    $Sport_totalMise = $Sport_totalMise + $row["Montant"];
                  }
                  if ($row["course"] == "Compactes") {
                    if ($row["discord"] == $user["id"]) {
                      $Compact_miseFor = "P8";
                      $Compact_mise = $row["Montant"];
                    }

                    $Compact_P87_mise = $Compact_P8_mise + $row["Montant"];
                    $Compact_totalMise = $Compact_totalMise + $row["Montant"];
                  }
                }
              }

              if ($Compact_P1_mise != 0) {
                $Compact_P1_cote = $Compact_totalMise / $Compact_P1_mise;
                if ($Compact_miseFor == "P1") $Compact_cote = $Compact_P1_cote;
              }

              if ($Compact_P2_mise != 0) {
                $Compact_P2_cote = $Compact_totalMise / $Compact_P2_mise;
                if ($Compact_miseFor == "P2") $Compact_cote = $Compact_P2_cote;
              }

              if ($Compact_P3_mise != 0) {
                $Compact_P3_cote = $Compact_totalMise / $Compact_P3_mise;
                if ($Compact_miseFor == "P3") $Compact_cote = $Compact_P3_cote;
              }

              if ($Compact_P4_mise != 0) {
                $Compact_P4_cote = $Compact_totalMise / $Compact_P4_mise;
                if ($Compact_miseFor == "P4") $Compact_cote = $Compact_P4_cote;
              }

              if ($Compact_P5_mise != 0) {
                $Compact_P5_cote = $Compact_totalMise / $Compact_P5_mise;
                if ($Compact_miseFor == "P5") $Compact_cote = $Compact_P5_cote;
              }

              if ($Compact_P6_mise != 0) {
                $Compact_P6_cote = $Compact_totalMise / $Compact_P6_mise;
                if ($Compact_miseFor == "P6") $Compact_cote = $Compact_P6_cote;
              }
              if ($Compact_P7_mise != 0) {
                $Compact_P7_cote = $Compact_totalMise / $Compact_P7_mise;
                if ($Compact_miseFor == "P7") $Compact_cote = $Compact_P7_cote;
              }

              if ($Compact_P8_mise != 0) {
                $Compact_P8_cote = $Compact_totalMise / $Compact_P8_mise;
                if ($Compact_miseFor == "P8") $Compact_cote = $Compact_P8_cote;
              }


              if ($Sport_P1_mise != 0) {
                $Sport_P1_cote = $Sport_totalMise / $Sport_P1_mise;
                if ($Sport_miseFor == "P1") $Sport_cote = $Sport_P1_cote;
              }

              if ($Sport_P2_mise != 0) {
                $Sport_P2_cote = $Sport_totalMise / $Sport_P2_mise;
                if ($Sport_miseFor == "P2") $Sport_cote = $Sport_P2_cote;
              }

              if ($Sport_P3_mise != 0) {
                $Sport_P3_cote = $Sport_totalMise / $Sport_P3_mise;
                if ($Sport_miseFor == "P3") $Sport_cote = $Sport_P3_cote;
              }

              if ($Sport_P4_mise != 0) {
                $Sport_P4_cote = $Sport_totalMise / $Sport_P4_mise;
                if ($Sport_miseFor == "P4") $Sport_cote = $Sport_P4_cote;
              }

              if ($Sport_P5_mise != 0) {
                $Sport_P5_cote = $Sport_totalMise / $Sport_P5_mise;
                if ($Sport_miseFor == "P5") $Sport_cote = $Sport_P5_cote;
              }

              if ($Sport_P6_mise != 0) {
                $Sport_P6_cote = $Sport_totalMise / $Sport_P6_mise;
                if ($Sport_miseFor == "P6") $Sport_cote = $Sport_P6_cote;
              }
              if ($Sport_P7_mise != 0) {
                $Sport_P7_cote = $Sport_totalMise / $Sport_P7_mise;
                if ($Sport_miseFor == "P7") $Sport_cote = $Sport_P7_cote;
              }

              if ($Sport_P8_mise != 0) {
                $Sport_P8_cote = $Sport_totalMise / $Sport_P8_mise;
                if ($Sport_miseFor == "P8") $Sport_cote = $Sport_P8_cote;
              }
            }

            
              if ($user != null && $user["ban"] == 1) {
                echo "<center><h1 style='font-size: 300%'><br><br><br>Vous êtes banni</h1></center>";
                return;
              }
              ?>
              @include('header')

                <div class="content-wrap">
                  <main id="content" class="content" role="main">
                    <?php
                    if ($user == null) {
                      echo "<div class='alert alert-danger alert-sm'>";
                      echo "<span class='fw-semi-bold'>Attention :</span> Vous devez vous enregistrer pour faire des pari, veuillez contacte Connor Parker au 051-8321 pour vous enregistrer.";
                      echo "</div>";
                    } else {
                      echo "<h1 class='page-title'><b>Bienvenue</b> $fullname</h1>";
                    }
                    ?>
                    
                    <div class="row">
                      <div class="col-lg-6">
                          <div class="pb-xlg h-100">
                              <section class="widget mb-0 h-100">
                                  <header class="d-flex justify-content-between flex-nowrap">
                                      <h4 class="d-flex align-items-center pb-1 big-stat-title">
                                          <span class="circle bg-success mr-sm" style="font-size: 6px;"></span>
                                          <span class="fw-normal ml-xs">Sportives</span>
                                      </h4>
                                  </header>
                                  <div class="widget-body p-0">
                                      <h4 class="fw-semi-bold ml-lg mb-lg"></h4>
                                      <div class="d-flex border-top">
                                          <div class="w-50 border-right p-3 px-4">
                                              <div class="d-flex align-items-center mb-2">
                                                <?php
                                                  if ($Sport_mise > 0) {
                                                    echo "<h6><b class='home-card green-dollar'>$</b> &nbsp" . $Sport_mise . "</h6>";
                                                  } else {
                                                    echo "<h6><b class='home-card red-dollar'>$</b> &nbsp0</h6>";
                                                  }
                                                ?>
                                              </div>
                                              <p class="text-muted mb-0 mr"><small>Mise</small></p>
                                          </div>
                                          <div class="w-50 p-3 px-4">
                                              <div class="d-flex align-items-center mb-2">
                                                  <?php
                                                    if ($Sport_mise > 0) {
                                                      echo "<h6> &nbsp" . $Sport_cote . "</h6>";
                                                    } else {
                                                      echo "<h6> &nbsp0</h6>";
                                                    }
                                                  ?>
                                              </div>
                                              <p class="text-muted mb-0 mr"><small>Côte</small></p>
                                          </div>
                                      </div>
                                  </div>
                              </section>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="pb-xlg h-100">
                              <section class="widget mb-0 h-100">
                                  <header class="d-flex justify-content-between flex-nowrap">
                                      <h4 class="d-flex align-items-center pb-1 big-stat-title">
                                          <span class="circle bg-success mr-sm" style="font-size: 6px;"></span>
                                          <span class="fw-normal ml-xs">Compactes</span>
                                      </h4>
                                  </header>
                                  <div class="widget-body p-0">
                                      <h4 class="fw-semi-bold ml-lg mb-lg"></h4>
                                      <div class="d-flex border-top">
                                          <div class="w-50 border-right p-3 px-4">
                                              <div class="d-flex align-items-center mb-2">
                                                <?php
                                                  if ($Compact_mise > 0) {
                                                    echo "<h6><b class='home-card green-dollar'>$</b> &nbsp" . $Compact_mise . "</h6>";
                                                  } else {
                                                    echo "<h6><b class='home-card red-dollar'>$</b> &nbsp0</h6>";
                                                  }
                                                ?>                                              </div>
                                              <p class="text-muted mb-0 mr"><small>Mise</small></p>
                                          </div>
                                          <div class="w-50 p-3 px-4">
                                              <div class="d-flex align-items-center mb-2">
                                                <?php
                                                  if ($Compact_mise > 0) {
                                                    echo "<h6> &nbsp" . $Compact_cote . "</h6>";
                                                  } else {
                                                    echo "<h6> &nbsp0</h6>";
                                                  }
                                                ?>                                              </div>
                                              <p class="text-muted mb-0 mr"><small>Côte</small></p>
                                          </div>
                                      </div>
                                  </div>
                              </section>
                          </div>
                      </div>
                      </div>
                          <div class="col-lg-16">
                              <section class="widget pb-0">
                                  <header>
                                      <h4>
                                          Prochaine course
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
                                                  <th scope="col"><span class=" pl-3">Course</span></th>
                                                  <th scope="col">Participant</th>
                                                  <th scope="col">Véhicule</th>
                                                  <th scope="col">Mise total</th>
                                                  <th scope="col">Côte</th>
                                              </tr>
                                          </thead>
                                          <tbody class="text-white-50">
                                              <tr>
                                                  <th class="pl-4 fw-normal"><?php echo $course["nom"] ?></th>
                                                  <td><?php echo $course["P1_name"] ?></td>
                                                  <td><?php echo $course["P1_car"] ?></td>
                                                  <?php
                                                  if ($course["pari"] == 0) {
                                                    echo "<td>Aucun pari sur cette course</td>";
                                                    echo "<td>/</td>";
                                                  } else {
                                                    if ($course["nom"] == "Sportives") {
                                                      if ($Sport_P1_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Sport_P1_mise . "</td>";

                                                      if ($Sport_P1_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Sport_P1_cote . "</td>";
                                                    } else {
                                                      if ($Compact_P1_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Compact_P1_mise . "</td>";

                                                      if ($Compact_P1_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Compact_P1_cote . "</td>";
                                                    }


                                                  }
                                                  ?>
                                              </tr>
                                              <tr>
                                                  <th class="pl-4 fw-normal"></th>
                                                  <td><?php echo $course["P2_name"] ?></td>
                                                  <td><?php echo $course["P2_car"] ?></td>
                                                  <?php
                                                  if ($course["pari"] == 0) {
                                                    echo "<td></td>";
                                                    echo "<td>/</td>";
                                                  } else {
                                                    if ($course["nom"] == "Sportives") {
                                                      if ($Sport_P2_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Sport_P2_mise . "</td>";

                                                      if ($Sport_P2_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Sport_P2_cote . "</td>";
                                                    } else {
                                                      if ($Compact_P2_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Compact_P2_mise . "</td>";

                                                      if ($Compact_P2_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Compact_P2_cote . "</td>";
                                                    }
                                                  }
                                                  ?>
                                              </tr>
                                              <tr>
                                                  <th class="pl-4 fw-normal"></th>
                                                  <td><?php echo $course["P3_name"] ?></td>
                                                  <td><?php echo $course["P3_car"] ?></td>
                                                  <?php
                                                  if ($course["pari"] == 0) {
                                                    echo "<td></td>";
                                                    echo "<td>/</td>";
                                                  } else {
                                                    if ($course["nom"] == "Sportives") {
                                                      if ($Sport_P3_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Sport_P3_mise . "</td>";

                                                      if ($Sport_P3_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Sport_P3_cote . "</td>";
                                                    } else {
                                                      if ($Compact_P3_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Compact_P3_mise . "</td>";

                                                      if ($Compact_P3_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Compact_P3_cote . "</td>";
                                                    }
                                                  }
                                                  ?>
                                              </tr>
                                              <tr>
                                                  <th class="pl-4 fw-normal"></th>
                                                  <td><?php echo $course["P4_name"] ?></td>
                                                  <td><?php echo $course["P4_car"] ?></td>
                                                  <?php
                                                  if ($course["pari"] == 0) {
                                                    echo "<td></td>";
                                                    echo "<td>/</td>";
                                                  } else {
                                                    if ($course["nom"] == "Sportives") {
                                                      if ($Sport_P4_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Sport_P4_mise . "</td>";

                                                      if ($Sport_P4_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Sport_P4_cote . "</td>";
                                                    } else {
                                                      if ($Compact_P4_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Compact_P4_mise . "</td>";

                                                      if ($Compact_P4_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Compact_P4_cote . "</td>";
                                                    }
                                                  }
                                                  ?>
                                              </tr>
                                              <tr>
                                                  <th class="pl-4 fw-normal"></th>
                                                  <td><?php echo $course["P5_name"] ?></td>
                                                  <td><?php echo $course["P5_car"] ?></td>
                                                  <?php
                                                  if ($course["pari"] == 0) {
                                                    echo "<td></td>";
                                                    echo "<td>/</td>";
                                                  } else {
                                                    if ($course["nom"] == "Sportives") {
                                                      if ($Sport_P5_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Sport_P5_mise . "</td>";

                                                      if ($Sport_P5_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Sport_P5_cote . "</td>";
                                                    } else {
                                                      if ($Compact_P5_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Compact_P5_mise . "</td>";

                                                      if ($Compact_P5_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Compact_P5_cote . "</td>";
                                                    }
                                                  }
                                                  ?>
                                              </tr>
                                              <tr>
                                                  <th class="pl-4 fw-normal"></th>
                                                  <td><?php echo $course["P6_name"] ?></td>
                                                  <td><?php echo $course["P6_car"] ?></td>
                                                  <?php
                                                  if ($course["pari"] == 0) {
                                                    echo "<td></td>";
                                                    echo "<td>/</td>";
                                                  } else {
                                                    if ($course["nom"] == "Sportives") {
                                                      if ($Sport_P6_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Sport_P6_mise . "</td>";

                                                      if ($Sport_P6_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Sport_P6_cote . "</td>";
                                                    } else {
                                                      if ($Compact_P6_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Compact_P6_mise . "</td>";

                                                      if ($Compact_P6_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Compact_P6_cote . "</td>";
                                                    }
                                                  }
                                                  ?>
                                              </tr>
                                              <tr>
                                                  <th class="pl-4 fw-normal"></th>
                                                  <td><?php echo $course["P7_name"] ?></td>
                                                  <td><?php echo $course["P7_car"] ?></td>
                                                  <?php
                                                  if ($course["pari"] == 0) {
                                                    echo "<td></td>";
                                                    echo "<td>/</td>";
                                                  } else {
                                                    if ($course["nom"] == "Sportives") {
                                                      if ($Sport_P7_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Sport_P7_mise . "</td>";

                                                      if ($Sport_P7_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Sport_P7_cote . "</td>";
                                                    } else {
                                                      if ($Compact_P7_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Compact_P7_mise . "</td>";

                                                      if ($Compact_P7_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Compact_P7_cote . "</td>";
                                                    }
                                                  }
                                                  ?>
                                              </tr>
                                              <tr>
                                                  <th class="pl-4 fw-normal"></th>
                                                  <td><?php echo $course["P8_name"] ?></td>
                                                  <td><?php echo $course["P8_car"] ?></td>
                                                  <?php
                                                  if ($course["pari"] == 0) {
                                                    echo "<td></td>";
                                                    echo "<td>/</td>";
                                                  } else {
                                                    if ($course["nom"] == "Sportives") {
                                                      if ($Sport_P8_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Sport_P8_mise . "</td>";

                                                      if ($Sport_P8_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Sport_P8_cote . "</td>";
                                                    } else {
                                                      if ($Compact_P8_mise == 0) echo "<td><b class='red-dollar'>$</b> &nbsp0</td>";
                                                      else echo "<td><b class='green-dollar'>$</b> &nbsp" . $Compact_P8_mise . "</td>";

                                                      if ($Compact_P8_cote == 0) echo "<td>/</td>";
                                                      else echo "<td>" . $Compact_P8_cote . "</td>";
                                                    }
                                                  }
                                                  ?>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </section>
                          </div>
                    </main>
                </div>
            </div>
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
