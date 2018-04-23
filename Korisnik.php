<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';
class Korisnik {
	public $id;
	public $email;
	public $password;
	public $ime_prezime;

	public static function register($email, $password, $ime_prezime) {
		$db = Database::getInstance();

		$query = 'INSERT INTO korisnici (email, ime_prezime, password) '.
				 'VALUES (:email, :ime_prezime, :password)';
		$params = [
			':email' => $email,
			':ime_prezime' => $ime_prezime,
			':password' => hash('sha512', $password)
		];

		$db->insert('Korisnik', $query, $params);

		return $db->lastInsertId();
	}

	public static function autentifikacija($email, $password) {
		$db = Database::getInstance();
		$query = 'SELECT * FROM korisnici '.
				'WHERE email = :email AND password = :password';
		$params = [
			':email' => $email,
			':password' => hash('sha512', $password)
		];
		$korisnici = $db->select('Korisnik', $query, $params);
		foreach($korisnici as $korisnik)
			return $korisnik;
		return null;
	}

	public static function promeniLozinku($email, $password) {
		$db = Database::getInstance();
		$query = 'SELECT * FROM korisnici '.
				'WHERE email = :email AND password = :password';
		$params = [
			':email' => $email,
			':password' => hash('sha512', $password)
		];
		$korisnici = $db->select('Korisnik', $query, $params);
		$query2 = 'UPDATE korisnici SET password '.
				'WHERE email = :email';
		$params2 = [
			':email' => $email,
		];
		$num = $query->rowCount();
		if($num ==0){

		return print ("<span style='color:#e533d37'>Greska... Stara lozinka nije pronadjena</span>");
		}else {

			$query2 = $pdo->prepare("UPDATE korisnici SET password=? WHERE korisnik_id=?");
			$query2 = execute(array($new_pass,$uid));
			return print ("<span style='color:green'>Lozinka je promenjena!</span>");
			return false;
		}

	}
	
}