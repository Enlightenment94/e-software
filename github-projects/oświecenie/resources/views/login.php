<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['username']) && isset($_GET['password']) ){
    // Obsługa formularza logowania
    $username = $_GET['username'];
    $password = $_GET['password'];
  
    if($username == 'sudo' && $password == 'enlBlog94'){ 
        $_SESSION['user_id'] = 1; 
    } else {
        $error_msg = "Błędny login lub hasło, spróbuj ponownie.";
    }
}

if(isset($_SESSION['user_id'])){
  // Jeśli jesteś już zalogowany, przekieruj na stronę główną
}else{
?>

<h2>Formularz logowania</h2>
<form action="./panel" method="get">
  <label>Użytkownik:</label>
  <input type="text" name="username">
  <br>
  <label>Hasło:</label>
  <input type="password" name="password">
  <br>
  <input type="submit" value="Zaloguj">
</form>

<?php
die();
}
?>