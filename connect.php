
<?php
	$pdo = null;
	function prepareConnection(){
		$host ="127.0.0.1";
		$db ="db_dog";
		$username ="root";
		$password ="";

		try{
			$pdo = new PDO('mysql:host='.$host.';dbname='.$db , $username , $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(Exception $e){
			echo "Ooops! Something is wrong with the Connection\nPlease Contact the System Adminstrator";
			echo $e->getMessage();
		}
		return $pdo;
	}
	if($pdo == null){
		$pdo = prepareConnection();
	}
?>
