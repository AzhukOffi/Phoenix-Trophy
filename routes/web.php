<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$infoSQL = null;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/dashboard', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/pari', function () {
    return view('pari');
});

Route::get('/vote', function () {
    return view('vote');
});

Route::get('/admin', function () {
    return view('admin',  ['info' => "none"]);
});

Route::get('/admin/success', function () {
    return view('admin',  ['info' => 'success']);
});

Route::get('/admin/successInfo', function () {
    return view('admin',  ['info' => 'pariError', 'pilote' => $infoSQL["NumPilote"], 'mise' => $infoSQL["Montant"]]);
});

Route::get('/admin/error', function () {
    return view('admin',  ['info' => 'error']);
});

Route::get('/admin/duplicateError', function () {
    return view('admin',  ['info' => 'duplicateError']);
});

Route::get('/admin/pariError', function () {
    return view('admin',  ['info' => 'pariError']);
});

Route::get('/admin/noPariError', function () {
    return view('admin',  ['info' => 'pariError']);
});

Route::post('/add_user', function () {
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


  $sql = 'INSERT INTO `rp_users` (`id`, `fullname`) VALUES (' . $_POST["id"] . ', "' . $_POST["name"] . '")';
  try {
    $result = $mysqli->query($sql);
  } catch(Exception $exp) {
    return redirect('/admin/duplicateError');
  }

  return redirect('/admin/success');
});

Route::post('/add_pari', function () {
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


  $test = $mysqli->query("SELECT * FROM `pari` WHERE discord=" . $_POST["id"] . " AND course='" . $_POST["course"] . "'");

  if (mysqli_fetch_array($test)) {
    return redirect('/admin/pariError');
  }

  $sql = 'INSERT INTO `pari` (`course`, `discord`, `NumPilote`, `Montant`) VALUES ("' . $_POST["course"] . '", ' . $_POST["id"] . ', ' . $_POST["pilote"] . ', ' . $_POST["mise"] . ')';
  try {
    $result = $mysqli->query($sql);
  } catch(Exception $exp) {
    echo $sql;
  }

  return redirect('/admin/success');
});

Route::post('/edit_pari', function () {
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


  $test = $mysqli->query("SELECT * FROM `pari` WHERE discord=" . $_POST["id"] . " AND course='" . $_POST["course"] . "'");

  if (mysqli_fetch_array($test)) {
    $sql = 'UPDATE `pari` SET NumPilote=' . $_POST["pilote"] . ', Montant=' . $_POST["mise"] . ' ' .  "WHERE discord=" . $_POST["id"] . " AND course='" . $_POST["course"] . "'";
    echo $sql;
    try {
      $result = $mysqli->query($sql);
    } catch(Exception $exp) {
      echo $sql;
    }

    return redirect('/admin/success');

  }
  return redirect('/admin/noPariError');
});

Route::post('/updateNext', function () {
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

  try {
    $result = $mysqli->query("UPDATE `courses` SET next=0");
  } catch (\Exception $e) {
    return redirect('/admin/error');
  }

  try {
    $result = $mysqli->query("UPDATE `courses` SET next=1 WHERE id=" . $_POST["course"]);
    return redirect('/admin/success');
  } catch (\Exception $e) {
    return redirect('/admin/noPariError');
  }
});


Route::post('/updatePilote', function () {
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

  try {
    $result = $mysqli->query("UPDATE `courses` SET ". $_POST["pilote"] . "_car='" . $_POST["car"] . "', ". $_POST["pilote"] . "_name='" . $_POST["fullname"] . "' WHERE nom='" . $_POST["course"] . "'");
    return redirect('/admin/success');
  } catch (\Exception $e) {
    return redirect('/admin/error');
  }

});
