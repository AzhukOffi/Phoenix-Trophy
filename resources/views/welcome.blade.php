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
    if (!$mysqli) {
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
          echo "<div class='alert alert-warning alert-sm'>";
          echo "<span class='fw-semi-bold'>Attention :</span> Vous n'êtes pas enregistré, contactez Connor Parker au 051-8321 pour vous enregistrer.";
          echo "</div>";
        } else {
          echo "<h1 class='page-title'><b>Bienvenue</b> $fullname</h1>";
        }
        ?>
      
      <div class="row">
        <div class="container-fluid">
          <section class="widget pb-0">
            <header>
              <h4>Agenda</h4>
              <div class="widget-controls mt-2">
                <a href="#"><i class="la la-cog text-white"></i></a>
                <a href="#" data-widgster="close"><i class="la la-remove text-white"></i></a>
              </div>
            </header>
            <div class="widget-body p-0 support table-wrapper">
              <table class="table table-striped mb-0">
                <thead>
                  <tr class="text-white">
                    <th scope="col"><span class=" pl-3">Type</span></th>
                    <th scope="col">Nom</th>
                    <th scope="col">Heure</th>
                    <th scope="col">Places disponibles</th>
                    <th scope="col">Informations</th>
                  </tr>
                </thead>

                <tbody class="text-white-50">
                  <tr>
                    <td><span class=" pl-3">Qualifications</span></td>
                    <td>Compactes</td>
                    <td>20h50 - 21h30</td>
                    <td>8</td>
                    <td>Les qualifications permettent de définir l'ordre sur la grille de départ, elle se déroule en 4 courses.</td>
                  </tr>
                  <tr>
                    <td><span class=" pl-3">Course</span></td>
                    <td>Compactes</td>
                    <td>21h30 - 21h50</td>
                    <td>8</td>
                    <td>La course, la vrai. <b>8</b> pilotes, <b>un seul vainqueur</b></td>
                  </tr>
                </tbody>
                <tbody class="text-white-50">
                  <tr>
                    <td><span class=" pl-3">Course</span></td>
                    <td>Open-Series</td>
                    <td>21h50 - 22h05</td>
                    <td>6</td>
                    <td>Course ouverte, entrée gratuite, tout véhicule. une <b>8F Drafter</b> contre une <b>Kalahari</b> contre un <b>Faggio</b>, tout est possible !</td>
                  </tr>
                </tbody>
                <tbody class="text-white-50">
                  <tr>
                    <td><span class=" pl-3">Qualifications</span></td>
                    <td>Sportives</td>
                    <td>22h10 - 22h50</td>
                    <td>8</td>
                    <td>Les qualifications permettent de définir l'ordre sur la grille de départ, elle se déroule en 4 courses.</td>
                  </tr>
                  <tr>
                    <td><span class=" pl-3">Course</span></td>
                    <td>Sportives</td>
                    <td>22h50 - 23h10</td>
                    <td>8</td>
                    <td>La course, la vrai. <b>8</b> pilotes, <b>un seul vainqueur</b></td>
                  </tr>
                </tbody>
                <tbody class="text-white-50">
                  <tr>
                    <td><span class=" pl-3">Libre</span></td>
                    <td>Piste ouverte</td>
                    <td>À partir de 23h15</td>
                    <td>6 véhicules sur le circuit</td>
                    <td>Accès libre au circuit - Possibilité d'encadrer la course jusqu'à 1h.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <section class="widget pb-0">
            <header>
              <h4>Compactes</h4>
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
              <h4>Sportives</h4>
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
      @else
      <div class="container-fluid">
        <center>
          <a href="{{ route('login') }}" class=""><button class="button-64" role="button"><span class="text">Login With Discord</span></button></a>
        </center>
      </div>
      </main>
    </div>
    @endauth
  @endif
</body>
</html>
