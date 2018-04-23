<?php
session_start();
if(!isset($_POST['password'])) {
    header('Location: ../login.php');
    die();
}
if(!isset($_POST['email'])) {
    header('Location: ../registracija.php');
    die();
}

        $email=$_POST['email'];
        $password = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $confirmnewpassword = $_POST['confirmnewpassword'];

        if($newpassword != $confirmnewpassword){

            header('Location: ../login.php');
            die();
        }
        require_once __DIR__ . '/../tabele/Korisnik.php';
        $korisnik = Korisnik::promeniLozinku($password);

        if ($newpassword == $confirmnewpassword){

            if ($password == $password){

               if ($password == $confirmnewpassword)
                {
                    $password = hash('sha512', $password);

                    // Unos novog passworda

                    echo "Uspešno ste promenili password.";
                }
                else
                    echo "Nije pronađen uneseni password.";
            }
    else
        echo "Passwordi se ne poklapaju. Molim unesite password opet.";
}

      ?>