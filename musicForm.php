<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../../css/bootstrap.min.css" rel="stylesheet"/>
	<title>musicForm.php</title>
	<style>
		.error {
			color:#ff0000;
		}
	</style>
  </head>
  <body>
	<div class="container">
        <div class="col-xs-12">
        <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $unknownpleasures = $_GET['unknownpleasures'];
        if (isset($unknownpleasures)) {
        	$crazyrhythms = $_GET['crazyrhythms'];
        	$deceit = $_GET['deceit'];
        	$pinkflag = $_GET['pinkflag'];
        	$devo = $_GET['devo'];
        	$chameleons = $_GET['chameleons'];
        	$substance = $_GET['substance'];
        	$suicide = $_GET['suicide'];
        	$albums = array(
        		0 => "joy division - unknown pleasures",
        		1 => "the feelies - crazy rhythms",
        		2 => "this heat - deceit",
        		3 => "wire - pink flag",
        		4 => "devo - q: are we not men? a: we are devo!",
        		5 => "the chameleons - script of the bridge",
        		6 => "new order - substance 1987",
        		7 => "suicide - suicide"
        	);
        	$dist = array();
        	$dist[0] = 0;
        	$dist[1] = $dist[0] + $unknownpleasures + 1;
        	$dist[2] = $dist[1] + $crazyrhythms + 1;
        	$dist[3] = $dist[2] + $deceit + 1;
        	$dist[4] = $dist[3] + $pinkflag + 1;
        	$dist[5] = $dist[4] + $devo + 1;
        	$dist[6] = $dist[5] + $chameleons + 1;
        	$dist[7] = $dist[6] + $substance + 1;
        	$dist[8] = $dist[7] + $suicide + 1;
            try {
                $iniData = parse_ini_file("data.ini.php", true);
                $database = new PDO('mysql:host=127.0.0.1;dbname=playground16', $iniData['insecure']['user'], $iniData['insecure']['pass']);
            } catch (PDOEXCEPTION $e) {
                print($e->getMessage());
                die();
            }
            echo "<p>here are ten albums you should listen to:</p>";
            for ($i = 0; $i < 10; $i++) {
            	$r = rand(0, $dist[8] - 1);
            	$j = 8;
            	while ($r < $dist[$j]) {
            		$j--;
            	}
            	$sql = "SELECT Album2 FROM `flowchart` WHERE Album1 = $albums[$j] ORDER BY RAND() LIMIT 1";
            	foreach ($database->query($sql) as $row) {
					echo "<p>".$row['Album2']."</p>";
				}
            }
        }
        else {
        ?>
        </div>
		<div class="col-lg-12 text-center">
			<h2 id="title">get randomized music recs here. rate the following albums on a scale of 0 to anything (make sure your ratings are proportional to one another). rate 0 if you haven't heard (you really should though):</h2>
		</div>
		<div class="col-xs-12" style="height:30px;"></div>
		<form id="register-form" class="container-fluid" method="get" action="musicForm.php">
			<div class="form-group col-md-6">
				<label for="unknownpleasures">joy division - unknown pleasures</label>
				<input class="form-control required rating" type="text" id="unknownpleasures" name="unknownpleasures"/>
			</div>
			<div class="form-group col-md-6">
				<label for="crazyrhythms">the feelies - crazy rhythms</label>
				<input class="form-control required rating" type="text" id="crazyrhythms" name="crazyrhythms"/>
			</div>
			<div class="form-group col-md-6">
				<label for="deceit">this heat - deceit</label>
				<input class="form-control required rating" type="text" id="deceit" name="deceit"/>
			</div>
			<div class="form-group col-md-6">
				<label for="pinkflag">wire - pink flag</label>
				<input class="form-control required rating" type="text" id="pinkflag" name="pinkflag"/>
			</div>
			<div class="form-group col-md-6">
				<label for="devo">devo - q: are we not men? a: we are devo!</label>
				<input class="form-control required rating" type="text" id="devo" name="devo"/>
			</div>
			<div class="form-group col-md-6">
				<label for="chameleons">the chameleons - script of the bridge</label>
				<input class="form-control required rating" type="text" id="chameleons" name="chameleons"/>
			</div>
			<div class="form-group col-md-6">
				<label for="substance">new order - substance 1987</label>
				<input class="form-control required rating" type="text" id="substance" name="substance"/>
			</div>
			<div class="form-group col-md-6">
				<label for="suicide">suicide - suicide</label>
				<input class="form-control required rating" type="text" id="suicide" name="suicide"/>
			</div>
            <div class="col-xs-12" style="height:10px;"></div>
			<div class="form-group container-fluid">
				<input class="form-control" type="submit" value="submit!"></input>
			</div>
		</form>
		<?php
		}
		?>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.validate.min.js"></script>
    <script src="../../js/addinput.js"></script>
	<script>
	$(document).ready(function(){
		$.validator.addMethod("rating", function(value, element) {
			return this.optional(element) || /^[0-9]+$/i.test(value);
		}, "rating must contain only letters, periods, underscores, and numbers.");
		$("#register-form").validate({
			rules: {
				passConfirm: {
					equalTo: "#password"
			}
		}
		});
	 });
	</script>
  </body>
</html>
