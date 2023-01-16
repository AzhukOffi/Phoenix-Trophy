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
             @include('header')
                <?php
                

                if ($user != null && $user["ban"] == 1) {
                  echo "<center><h1 style='font-size: 300%'><br><br><br>Vous êtes banni</h1></center>";
                  return;
                }
                ?>

                <div class="content-wrap">
                  <main id="content" class="content" role="main">
                    <?php
                    if ($user == null) {
                      echo "<div class='alert alert-danger alert-sm'>";
                      echo "<span class='fw-semi-bold'>Attention :</span> Vous n'êtes pas enregistré, contactez Connor Parker au 051-8321 pour vous enregistrer.";
                      echo "</div>";
                    } else {
                      echo "<h1 class='page-title'><b>Bienvenue</b> $fullname</h1>";
                    }
                    ?>
                    <div class="row">
                      <div class="col-lg-12">
                        <section class="widget voteWidget">
                          <header>
                            <h5>Classez la tenue des pilotes !  
                          </header>
                          <div class="widget-body" style="font-size: 200%">
                            <form action="/admin" method="get" class="form-horizontal" role="form">
                              @csrf
                              <div class="row">
                                <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">1</span>
                                    </span>
                                    <select onChange="updatePilote(this, 1)" class="select2 form-control" id="firstPilote" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">2</span>
                                    </span>
                                    <select onChange="updatePilote(this, 2)" class="select2 form-control" id="secondPilote" data-placeholder="Réponse 2" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">3</span>
                                    </span>
                                    <select onChange="updatePilote(this, 3)" class="select2 form-control" id="threePilote" data-placeholder="Réponse 3" tabindex="-1" name="car">
                                        <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">4</span>
                                    </span>
                                    <select onChange="updatePilote(this, 4)" class="select2 form-control" id="fourPilote" data-placeholder="Réponse 4" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">5</span>
                                    </span>
                                    <select onChange="updatePilote(this, 5)" class="select2 form-control" id="fivePilote" data-placeholder="Réponse 5" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">6</span>
                                    </span>
                                    <select onChange="updatePilote(this, 6)" class="select2 form-control" id="sixPilote" data-placeholder="Réponse 6" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">7</span>
                                    </span>
                                    <select onChange="updatePilote(this, 7)" class="select2 form-control" id="sevenPilote" data-placeholder="Réponse 7" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">8</span>
                                    </span>
                                    <select onChange="updatePilote(this, 8)" class="select2 form-control" id="eightPilote" data-placeholder="Réponse 8" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">9</span>
                                    </span>
                                    <select onChange="updatePilote(this, 9)" class="select2 form-control" id="ninePilote" data-placeholder="Réponse 9" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">10</span>
                                    </span>
                                    <select onChange="updatePilote(this, 10)" class="firstDropdown select2 form-control" id="tenPilote" data-placeholder="Réponse 10" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">11</span>
                                    </span>
                                    <select onChange="updatePilote(this, 11)" class="firstDropdown select2 form-control" id="elevenPilote" data-placeholder="Réponse 11" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">12</span>
                                    </span>
                                    <select onChange="updatePilote(this, 12)" class="firstDropdown select2 form-control" id="twelvePilote" data-placeholder="Réponse 12" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">13</span>
                                    </span>
                                    <select onChange="updatePilote(this, 13)" class="firstDropdown select2 form-control" id="thirteenPilote" data-placeholder="Réponse 13" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">14</span>
                                    </span>
                                    <select onChange="updatePilote(this, 14)" class="firstDropdown select2 form-control" id="fourteenPilote" data-placeholder="Réponse 14" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">15</span>
                                    </span>
                                    <select onChange="updatePilote(this, 15)" class="firstDropdown select2 form-control" id="fifteenPilote" data-placeholder="Réponse 15" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">16</span>
                                    </span>
                                    <select onChange="updatePilote(this, 16)" class="firstDropdown select2 form-control" id="sixteenPilote" data-placeholder="Réponse 16" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_name"] ?></option>
                                         <option value="2"><?php echo $compact["P2_name"] ?></option>
                                         <option value="3"><?php echo $compact["P3_name"] ?></option>
                                         <option value="4"><?php echo $compact["P4_name"] ?></option>
                                         <option value="5"><?php echo $compact["P5_name"] ?></option>
                                         <option value="6"><?php echo $compact["P6_name"] ?></option>
                                         <option value="7"><?php echo $compact["P7_name"] ?></option>
                                         <option value="8"><?php echo $compact["P8_name"] ?></option>
                                         <option value="9"><?php echo $sport["P1_name"] ?></option>
                                         <option value="10"><?php echo $sport["P2_name"] ?></option>
                                         <option value="11"><?php echo $sport["P3_name"] ?></option>
                                         <option value="12"><?php echo $sport["P4_name"] ?></option>
                                         <option value="13"><?php echo $sport["P5_name"] ?></option>
                                         <option value="14"><?php echo $sport["P6_name"] ?></option>
                                         <option value="15"><?php echo $sport["P7_name"] ?></option>
                                         <option value="16"><?php echo $sport["P8_name"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            </div>
                            
                            

                              
                              </fieldset>
                              <div class="form-actions">
                                  <div class="row">
                                      <div class="offset-md-2 col-md-9 col-12">
                                          <center>
                                            <button type="submit" class="btn btn-inverse mr-3">Voter</button>
                                            <button type="reset" onclick="resetPilote()" class="btn btn-danger mr-3">Réinitialiser</button>
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
                      <div class="col-lg-12">
                        <section class="widget voteWidget">
                          <header>
                            <h5>Classez les sportives de la plus belle à la moins moche !
                          </header>
                          <div class="widget-body" style="font-size: 200%">
                            <form class="form-horizontal" role="form">
                              @csrf
                              <div class="row">
                                <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">1</span>
                                    </span>
                                    <select onChange="updateSport(this, 1)" class="firstDropdown select2 form-control" id="firstSport" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $sport["P1_car"] ?></option>
                                         <option value="2"><?php echo $sport["P2_car"] ?></option>
                                         <option value="3"><?php echo $sport["P3_car"] ?></option>
                                         <option value="4"><?php echo $sport["P4_car"] ?></option>
                                         <option value="5"><?php echo $sport["P5_car"] ?></option>
                                         <option value="6"><?php echo $sport["P6_car"] ?></option>
                                         <option value="7"><?php echo $sport["P7_car"] ?></option>
                                         <option value="8"><?php echo $sport["P8_car"] ?></option>
                                     </select>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">2</span>
                                    </span>
                                    <select onChange="updateSport(this, 2)" class="secondSport select2 form-control" id="secondSport" data-placeholder="Réponse 2" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $sport["P1_car"] ?></option>
                                         <option value="2"><?php echo $sport["P2_car"] ?></option>
                                         <option value="3"><?php echo $sport["P3_car"] ?></option>
                                         <option value="4"><?php echo $sport["P4_car"] ?></option>
                                         <option value="5"><?php echo $sport["P5_car"] ?></option>
                                         <option value="6"><?php echo $sport["P6_car"] ?></option>
                                         <option value="7"><?php echo $sport["P7_car"] ?></option>
                                         <option value="8"><?php echo $sport["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">3</span>
                                    </span>
                                    <select onChange="updateSport(this, 3)" class="threeSport select2 form-control" id="threeSport" data-placeholder="Réponse 3" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $sport["P1_car"] ?></option>
                                         <option value="2"><?php echo $sport["P2_car"] ?></option>
                                         <option value="3"><?php echo $sport["P3_car"] ?></option>
                                         <option value="4"><?php echo $sport["P4_car"] ?></option>
                                         <option value="5"><?php echo $sport["P5_car"] ?></option>
                                         <option value="6"><?php echo $sport["P6_car"] ?></option>
                                         <option value="7"><?php echo $sport["P7_car"] ?></option>
                                         <option value="8"><?php echo $sport["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">4</span>
                                    </span>
                                    <select onChange="updateSport(this, 4)" class="fourSport select2 form-control" id="fourSport" data-placeholder="Réponse 4" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $sport["P1_car"] ?></option>
                                         <option value="2"><?php echo $sport["P2_car"] ?></option>
                                         <option value="3"><?php echo $sport["P3_car"] ?></option>
                                         <option value="4"><?php echo $sport["P4_car"] ?></option>
                                         <option value="5"><?php echo $sport["P5_car"] ?></option>
                                         <option value="6"><?php echo $sport["P6_car"] ?></option>
                                         <option value="7"><?php echo $sport["P7_car"] ?></option>
                                         <option value="8"><?php echo $sport["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">5</span>
                                    </span>
                                    <select onChange="updateSport(this, 5)" class="firstSport select2 form-control" id="fiveSport" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $sport["P1_car"] ?></option>
                                         <option value="2"><?php echo $sport["P2_car"] ?></option>
                                         <option value="3"><?php echo $sport["P3_car"] ?></option>
                                         <option value="4"><?php echo $sport["P4_car"] ?></option>
                                         <option value="5"><?php echo $sport["P5_car"] ?></option>
                                         <option value="6"><?php echo $sport["P6_car"] ?></option>
                                         <option value="7"><?php echo $sport["P7_car"] ?></option>
                                         <option value="8"><?php echo $sport["P8_car"] ?></option>
                                     </select>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">6</span>
                                    </span>
                                    <select onChange="updateSport(this, 6)" class="firstSport select2 form-control" id="sixSport" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $sport["P1_car"] ?></option>
                                         <option value="2"><?php echo $sport["P2_car"] ?></option>
                                         <option value="3"><?php echo $sport["P3_car"] ?></option>
                                         <option value="4"><?php echo $sport["P4_car"] ?></option>
                                         <option value="5"><?php echo $sport["P5_car"] ?></option>
                                         <option value="6"><?php echo $sport["P6_car"] ?></option>
                                         <option value="7"><?php echo $sport["P7_car"] ?></option>
                                         <option value="8"><?php echo $sport["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">7</span>
                                    </span>
                                    <select onChange="updateSport(this, 7)" class="firstSport select2 form-control" id="sevenSport" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $sport["P1_car"] ?></option>
                                         <option value="2"><?php echo $sport["P2_car"] ?></option>
                                         <option value="3"><?php echo $sport["P3_car"] ?></option>
                                         <option value="4"><?php echo $sport["P4_car"] ?></option>
                                         <option value="5"><?php echo $sport["P5_car"] ?></option>
                                         <option value="6"><?php echo $sport["P6_car"] ?></option>
                                         <option value="7"><?php echo $sport["P7_car"] ?></option>
                                         <option value="8"><?php echo $sport["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">8</span>
                                    </span>
                                    <select onChange="updateSport(this, 8)" class="firstSport select2 form-control" id="eightSport" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $sport["P1_car"] ?></option>
                                         <option value="2"><?php echo $sport["P2_car"] ?></option>
                                         <option value="3"><?php echo $sport["P3_car"] ?></option>
                                         <option value="4"><?php echo $sport["P4_car"] ?></option>
                                         <option value="5"><?php echo $sport["P5_car"] ?></option>
                                         <option value="6"><?php echo $sport["P6_car"] ?></option>
                                         <option value="7"><?php echo $sport["P7_car"] ?></option>
                                         <option value="8"><?php echo $sport["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            </div>
                              </fieldset>
                              <div class="form-actions">
                                  <div class="row">
                                      <div class="offset-md-2 col-md-9 col-12">
                                          <center>
                                            <button type="submit" class="btn btn-inverse mr-3">Voter</button>
                                            <button type="reset" onclick="resetSport()" class="btn btn-danger mr-3">Réinitialiser</button>
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
                      <div class="col-lg-12">
                        <section class="widget voteWidget">
                          <header>
                            <h5>Classez les compactes de la plus belle à la moins moche !
                          </header>
                          <div class="widget-body" style="font-size: 200%">
                            <form class="form-horizontal" role="form">
                              @csrf
                              <div class="row">
                                <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">1</span>
                                    </span>
                                    <select onChange="updateCompact(this, 1)" class="firstDropdown select2 form-control" id="firstCompact" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_car"] ?></option>
                                         <option value="2"><?php echo $compact["P2_car"] ?></option>
                                         <option value="3"><?php echo $compact["P3_car"] ?></option>
                                         <option value="4"><?php echo $compact["P4_car"] ?></option>
                                         <option value="5"><?php echo $compact["P5_car"] ?></option>
                                         <option value="6"><?php echo $compact["P6_car"] ?></option>
                                         <option value="7"><?php echo $compact["P7_car"] ?></option>
                                         <option value="8"><?php echo $compact["P8_car"] ?></option>
                                     </select>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">2</span>
                                    </span>
                                    <select onChange="updateCompact(this, 2)" class="secondSport select2 form-control" id="secondCompact" data-placeholder="Réponse 2" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_car"] ?></option>
                                         <option value="2"><?php echo $compact["P2_car"] ?></option>
                                         <option value="3"><?php echo $compact["P3_car"] ?></option>
                                         <option value="4"><?php echo $compact["P4_car"] ?></option>
                                         <option value="5"><?php echo $compact["P5_car"] ?></option>
                                         <option value="6"><?php echo $compact["P6_car"] ?></option>
                                         <option value="7"><?php echo $compact["P7_car"] ?></option>
                                         <option value="8"><?php echo $compact["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">3</span>
                                    </span>
                                    <select onChange="updateCompact(this, 3)" class="threeSport select2 form-control" id="threeCompact" data-placeholder="Réponse 3" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_car"] ?></option>
                                         <option value="2"><?php echo $compact["P2_car"] ?></option>
                                         <option value="3"><?php echo $compact["P3_car"] ?></option>
                                         <option value="4"><?php echo $compact["P4_car"] ?></option>
                                         <option value="5"><?php echo $compact["P5_car"] ?></option>
                                         <option value="6"><?php echo $compact["P6_car"] ?></option>
                                         <option value="7"><?php echo $compact["P7_car"] ?></option>
                                         <option value="8"><?php echo $compact["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">4</span>
                                    </span>
                                    <select onChange="updateCompact(this, 4)" class="fourSport select2 form-control" id="fourCompact" data-placeholder="Réponse 4" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_car"] ?></option>
                                         <option value="2"><?php echo $compact["P2_car"] ?></option>
                                         <option value="3"><?php echo $compact["P3_car"] ?></option>
                                         <option value="4"><?php echo $compact["P4_car"] ?></option>
                                         <option value="5"><?php echo $compact["P5_car"] ?></option>
                                         <option value="6"><?php echo $compact["P6_car"] ?></option>
                                         <option value="7"><?php echo $compact["P7_car"] ?></option>
                                         <option value="8"><?php echo $compact["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">5</span>
                                    </span>
                                    <select onChange="updateCompact(this, 5)" class="firstSport select2 form-control" id="fiveCompact" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_car"] ?></option>
                                         <option value="2"><?php echo $compact["P2_car"] ?></option>
                                         <option value="3"><?php echo $compact["P3_car"] ?></option>
                                         <option value="4"><?php echo $compact["P4_car"] ?></option>
                                         <option value="5"><?php echo $compact["P5_car"] ?></option>
                                         <option value="6"><?php echo $compact["P6_car"] ?></option>
                                         <option value="7"><?php echo $compact["P7_car"] ?></option>
                                         <option value="8"><?php echo $compact["P8_car"] ?></option>
                                     </select>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">6</span>
                                    </span>
                                    <select onChange="updateCompact(this, 6)" class="firstSport select2 form-control" id="sixCompact" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_car"] ?></option>
                                         <option value="2"><?php echo $compact["P2_car"] ?></option>
                                         <option value="3"><?php echo $compact["P3_car"] ?></option>
                                         <option value="4"><?php echo $compact["P4_car"] ?></option>
                                         <option value="5"><?php echo $compact["P5_car"] ?></option>
                                         <option value="6"><?php echo $compact["P6_car"] ?></option>
                                         <option value="7"><?php echo $compact["P7_car"] ?></option>
                                         <option value="8"><?php echo $compact["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">7</span>
                                    </span>
                                    <select onChange="updateCompact(this, 7)" class="firstSport select2 form-control" id="sevenCompact" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_car"] ?></option>
                                         <option value="2"><?php echo $compact["P2_car"] ?></option>
                                         <option value="3"><?php echo $compact["P3_car"] ?></option>
                                         <option value="4"><?php echo $compact["P4_car"] ?></option>
                                         <option value="5"><?php echo $compact["P5_car"] ?></option>
                                         <option value="6"><?php echo $compact["P6_car"] ?></option>
                                         <option value="7"><?php echo $compact["P7_car"] ?></option>
                                         <option value="8"><?php echo $compact["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text bg-transparent">
                                        <span class="step">8</span>
                                    </span>
                                    <select onChange="updateCompact(this, 8)" class="firstSport select2 form-control" id="eightCompact" data-placeholder="Réponse 1" tabindex="-1" name="car">
                                         <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>                                         
                                         <option value="1"><?php echo $compact["P1_car"] ?></option>
                                         <option value="2"><?php echo $compact["P2_car"] ?></option>
                                         <option value="3"><?php echo $compact["P3_car"] ?></option>
                                         <option value="4"><?php echo $compact["P4_car"] ?></option>
                                         <option value="5"><?php echo $compact["P5_car"] ?></option>
                                         <option value="6"><?php echo $compact["P6_car"] ?></option>
                                         <option value="7"><?php echo $compact["P7_car"] ?></option>
                                         <option value="8"><?php echo $compact["P8_car"] ?></option>
                                     </select>
                                </span>
                                </div>
                              </div>
                            </div>
                              </fieldset>
                              <div class="form-actions">
                                  <div class="row">
                                      <div class="offset-md-2 col-md-9 col-12">
                                          <center>
                                            <button type="submit" class="btn btn-inverse mr-3">Voter</button>
                                            <button type="reset" onclick="resetCompact()" class="btn btn-danger mr-3">Réinitialiser</button>
                                          </center>
                                      </div>
                                  </div>
                              </div>
                            </form>
                          </div>
                        </section>
                      </div>
                      
                    </div>
                    
              </main>
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
    <script type="text/javascript">

        var pilote = []
        window.onload = function() {
            resetPilote();
        };

        function resetPilote() {
            const html = '<option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>'
                + '<option value="1"><?php echo $compact["P1_car"] ?></option>'
                + '<option value="2"><?php echo $compact["P2_car"] ?></option>'
                + '<option value="3"><?php echo $compact["P3_car"] ?></option>'
                + '<option value="4"><?php echo $compact["P4_car"] ?></option>'
                + '<option value="5"><?php echo $compact["P5_car"] ?></option>'
                + '<option value="6"><?php echo $compact["P6_car"] ?></option>'
                + '<option value="7"><?php echo $compact["P7_car"] ?></option>'
                + '<option value="8"><?php echo $compact["P8_car"] ?></option>'
                + '<option value="9"><?php echo $sport["P1_car"] ?></option>'
                + '<option value="10"><?php echo $sport["P2_car"] ?></option>'
                + '<option value="11"><?php echo $sport["P3_car"] ?></option>'
                + '<option value="12"><?php echo $sport["P4_car"] ?></option>'
                + '<option value="13"><?php echo $sport["P5_car"] ?></option>'
                + '<option value="14"><?php echo $sport["P6_car"] ?></option>'
                + '<option value="15"><?php echo $sport["P7_car"] ?></option>'
                + '<option value="16"><?php echo $sport["P8_car"] ?></option>'
            document.getElementById("firstPilote").innerHTML  = html;
            document.getElementById("secondPilote").innerHTML  = html;
            document.getElementById("threePilote").innerHTML  = html;
            document.getElementById("fourPilote").innerHTML  = html;
            document.getElementById("fivePilote").innerHTML  = html;
            document.getElementById("sixPilote").innerHTML  = html;
            document.getElementById("sevenPilote").innerHTML  = html;
            document.getElementById("eightPilote").innerHTML  = html;
            document.getElementById("ninePilote").innerHTML  = html;
            document.getElementById("tenPilote").innerHTML  = html;
            document.getElementById("elevenPilote").innerHTML  = html;
            document.getElementById("twelvePilote").innerHTML  = html;
            document.getElementById("thirteenPilote").innerHTML  = html;
            document.getElementById("fourteenPilote").innerHTML  = html;
            document.getElementById("fifteenPilote").innerHTML  = html;
            document.getElementById("sixteenPilote").innerHTML  = html;
        }

        function resetSport() {
            const html = '<option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>'
                + '<option value="1"><?php echo $sport["P1_car"] ?></option>'
                + '<option value="2"><?php echo $sport["P2_car"] ?></option>'
                + '<option value="3"><?php echo $sport["P3_car"] ?></option>'
                + '<option value="4"><?php echo $sport["P4_car"] ?></option>'
                + '<option value="5"><?php echo $sport["P5_car"] ?></option>'
                + '<option value="6"><?php echo $sport["P6_car"] ?></option>'
                + '<option value="7"><?php echo $sport["P7_car"] ?></option>'
                + '<option value="8"><?php echo $sport["P8_car"] ?></option>'

            document.getElementById("firstSport").innerHTML  = html;
            document.getElementById("secondSport").innerHTML  = html;
            document.getElementById("threeSport").innerHTML  = html;
            document.getElementById("fourSport").innerHTML  = html;
            document.getElementById("fiveSport").innerHTML  = html;
            document.getElementById("sixSport").innerHTML  = html;
            document.getElementById("sevenSport").innerHTML  = html;
            document.getElementById("eightSport").innerHTML  = html;
        }

        function resetCompact() {
            const html = '<option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>'
                + '<option value="1"><?php echo $compact["P1_car"] ?></option>'
                + '<option value="2"><?php echo $compact["P2_car"] ?></option>'
                + '<option value="3"><?php echo $compact["P3_car"] ?></option>'
                + '<option value="4"><?php echo $compact["P4_car"] ?></option>'
                + '<option value="5"><?php echo $compact["P5_car"] ?></option>'
                + '<option value="6"><?php echo $compact["P6_car"] ?></option>'
                + '<option value="7"><?php echo $compact["P7_car"] ?></option>'
                + '<option value="8"><?php echo $compact["P8_car"] ?></option>'

            document.getElementById("firstCompact").innerHTML  = html;
            document.getElementById("secondCompact").innerHTML  = html;
            document.getElementById("threeCompact").innerHTML  = html;
            document.getElementById("fourCompact").innerHTML  = html;
            document.getElementById("fiveCompact").innerHTML  = html;
            document.getElementById("sixCompact").innerHTML  = html;
            document.getElementById("sevenCompact").innerHTML  = html;
            document.getElementById("eightCompact").innerHTML  = html;
        }


        function getOptionByValue (select, value) {
            var options = select.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === value) {
                    return i
                }
            }
            return null
        }

        function updatePilote(sel, id) {
            if (sel.options[sel.selectedIndex].value == "") return;

            if (id != 1) document.getElementById("firstPilote").remove(getOptionByValue(document.getElementById("firstPilote"), sel.options[sel.selectedIndex].value))
            if (id != 2) document.getElementById("secondPilote").remove(getOptionByValue(document.getElementById("secondPilote"), sel.options[sel.selectedIndex].value))
            if (id != 3) document.getElementById("threePilote").remove(getOptionByValue(document.getElementById("threePilote"), sel.options[sel.selectedIndex].value))
            if (id != 4) document.getElementById("fourPilote").remove(getOptionByValue(document.getElementById("fourPilote"), sel.options[sel.selectedIndex].value))
            if (id != 5) document.getElementById("fivePilote").remove(getOptionByValue(document.getElementById("fivePilote"), sel.options[sel.selectedIndex].value))
            if (id != 6) document.getElementById("sixPilote").remove(getOptionByValue(document.getElementById("sixPilote"), sel.options[sel.selectedIndex].value))
            if (id != 7) document.getElementById("sevenPilote").remove(getOptionByValue(document.getElementById("sevenPilote"), sel.options[sel.selectedIndex].value))
            if (id != 8) document.getElementById("eightPilote").remove(getOptionByValue(document.getElementById("eightPilote"), sel.options[sel.selectedIndex].value))
            if (id != 9) document.getElementById("ninePilote").remove(getOptionByValue(document.getElementById("ninePilote"), sel.options[sel.selectedIndex].value))
            if (id != 10) document.getElementById("tenPilote").remove(getOptionByValue(document.getElementById("tenPilote"), sel.options[sel.selectedIndex].value))
            if (id != 11) document.getElementById("elevenPilote").remove(getOptionByValue(document.getElementById("elevenPilote"), sel.options[sel.selectedIndex].value))
            if (id != 12) document.getElementById("twelvePilote").remove(getOptionByValue(document.getElementById("twelvePilote"), sel.options[sel.selectedIndex].value))
            if (id != 13) document.getElementById("thirteenPilote").remove(getOptionByValue(document.getElementById("thirteenPilote"), sel.options[sel.selectedIndex].value))
            if (id != 14) document.getElementById("fourteenPilote").remove(getOptionByValue(document.getElementById("fourteenPilote"), sel.options[sel.selectedIndex].value))
            if (id != 15) document.getElementById("fifteenPilote").remove(getOptionByValue(document.getElementById("fifteenPilote"), sel.options[sel.selectedIndex].value))
            if (id != 16) document.getElementById("sixteenPilote").remove(getOptionByValue(document.getElementById("sixteenPilote"), sel.options[sel.selectedIndex].value))
        }

        function updateSport(sel, id) {
                if (sel.options[sel.selectedIndex].value == "") return;

                if (id != 1) document.getElementById("firstSport").remove(getOptionByValue(document.getElementById("firstSport"), sel.options[sel.selectedIndex].value))
                if (id != 2) document.getElementById("secondSport").remove(getOptionByValue(document.getElementById("secondSport"), sel.options[sel.selectedIndex].value))
                if (id != 3) document.getElementById("threeSport").remove(getOptionByValue(document.getElementById("threeSport"), sel.options[sel.selectedIndex].value))
                if (id != 4) document.getElementById("fourSport").remove(getOptionByValue(document.getElementById("fourSport"), sel.options[sel.selectedIndex].value))
                if (id != 5) document.getElementById("fiveSport").remove(getOptionByValue(document.getElementById("fiveSport"), sel.options[sel.selectedIndex].value))
                if (id != 6) document.getElementById("sixSport").remove(getOptionByValue(document.getElementById("sixSport"), sel.options[sel.selectedIndex].value))
                if (id != 7) document.getElementById("sevenSport").remove(getOptionByValue(document.getElementById("sevenSport"), sel.options[sel.selectedIndex].value))
                if (id != 8) document.getElementById("eightSport").remove(getOptionByValue(document.getElementById("eightSport"), sel.options[sel.selectedIndex].value))
        }
        function updateCompact(sel, id) {
                if (sel.options[sel.selectedIndex].value == "") return;

                if (id != 1) document.getElementById("firstCompact").remove(getOptionByValue(document.getElementById("firstCompact"), sel.options[sel.selectedIndex].value))
                if (id != 2) document.getElementById("secondCompact").remove(getOptionByValue(document.getElementById("secondCompact"), sel.options[sel.selectedIndex].value))
                if (id != 3) document.getElementById("threeCompact").remove(getOptionByValue(document.getElementById("threeCompact"), sel.options[sel.selectedIndex].value))
                if (id != 4) document.getElementById("fourCompact").remove(getOptionByValue(document.getElementById("fourCompact"), sel.options[sel.selectedIndex].value))
                if (id != 5) document.getElementById("fiveCompact").remove(getOptionByValue(document.getElementById("fiveCompact"), sel.options[sel.selectedIndex].value))
                if (id != 6) document.getElementById("sixCompact").remove(getOptionByValue(document.getElementById("sixCompact"), sel.options[sel.selectedIndex].value))
                if (id != 7) document.getElementById("sevenCompact").remove(getOptionByValue(document.getElementById("sevenCompact"), sel.options[sel.selectedIndex].value))
                if (id != 8) document.getElementById("eightCompact").remove(getOptionByValue(document.getElementById("eightCompact"), sel.options[sel.selectedIndex].value))
        }


    </script>
</body>
</html>
