<?php

    // parse includes
    // --------------
 			include("include/my_vars.php");
			include("include/my_db.php");
			include("include/my_functions.php");
			include("include/ex_files.php") ;


// get the input and clean
// --------------------       
        if ($_GET['ID'] != "") {
            $_GET['ID'] = filter_var($_GET['ID'], FILTER_SANITIZE_STRING);
        }


// retrieve input
// -------------- 	
		$exercise = $_GET['ID'];
		
		
// local variables
// ---------------       
        $query = '' ;
        $result = '';
        $arr = array();
        $cnt = 0;

		
		
// if error input, inform user via json
// ------------------------------------
		if( $exercise )  {
			
 
		// select the all records from exercise table
		// ------------------------------------------
				$query = sprintf("SELECT * FROM exercise WHERE exercise_id=%s LIMIT 1", clean_input( $exercise ) );				
				$result = $db->query($query);


				if ( count($result) > 0 ) {

					// define the array structure
					// --------------------------
					$arr["Muscle"]=array();
					$arr["Category"]=array();
					$arr["Level"]=array();
					$arr["Equipment"]=array();
					$arr["Measurement"]=array();


					foreach( $result as $i ) {
							$exercise_name = $i->exercise_name;
							$exercise_id = $i->exercise_id;
							$arr["Muscle"]   = getMuscle( $i->exercise_id );
							$arr["Category"] = getCategory( $i->exercise_id );
							$arr["Level"] = getLevel( $i->exercise_id );
							$arr["Equipment"] = getEquipment( $i->exercise_id );
							$arr["Measurement"] = getMeasurement( $i->exercise_id );

					}
					
					// place each into a card
					// ----------------------
					
						// muscle group
						// ------------
						foreach ($arr["Muscle"]  as ['muscle_id' => $muscle_id, 'muscle_name' => $muscle_name]) {
								$card_muscle .= '<tr><td>' .$muscle_name .'</td><td></td></tr>';
						}    

						// category group
						// --------------
						foreach ($arr["Category"]  as ['category_id' => $category_id, 'category_name' => $category_name]) {
								$card_category .= '<tr><td>' .$category_name .'</td><td></td></tr>';
						}    

						// level group
						// -----------
						foreach ($arr["Level"]  as ['level_id' => $level_id, 'level_name' => $level_name]) {
								$card_level .= '<tr><td>' .$level_name .'</td><td></td></tr>';
						}    

						// equitment group
						// ---------------
						foreach ($arr["Equipment"]  as ['equipment_id' => $equipment_id, 'equipment_name' => $equipment_name]) {
								$card_equipment .= '<tr><td>' .$equipment_name .'</td><td></td></tr>';
						}    


				}

		}






?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TM470</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php">TM470: Admin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	  <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
         <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php">New Search</a></li>
		 </ul>
      </div>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center"></div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">

		<h2>Exercise : ( <?php echo $exercise_id  ?> ) , <?php echo $exercise_name  ?> </h2> <br />

		<div class="row">
			
			
		  <div class="col-lg-3 mx-auto">
			<table class="table">
			  <thead>
				<tr>
				  <th scope="col">Muscle</th>
				  <th scope="col"></th>
				</tr>
			  </thead>
			  <tbody>
				<?php echo $card_muscle ?>
			  </tbody>
			</table> 
		</div>



		  <div class="col-lg-3 mx-auto">
			<table class="table">
			  <thead>
				<tr>
				  <th scope="col">Category</th>
				  <th scope="col"></th>
				</tr>
			  </thead>
			  <tbody>
				<?php echo $card_category ?>
			  </tbody>
			</table> 
		</div>

		  <div class="col-lg-3 mx-auto">
			<table class="table">
			  <thead>
				<tr>
				  <th scope="col">level</th>
				  <th scope="col"></th>
				</tr>
			  </thead>
			  <tbody>
				<?php echo $card_level ?>
			  </tbody>
			</table> 
		</div>

		  <div class="col-lg-3 mx-auto">
			<table class="table">
			  <thead>
				<tr>
				  <th scope="col">Equipment</th>
				  <th scope="col"></th>
				</tr>
			  </thead>
			  <tbody>
				<?php echo $card_equipment ?>
			  </tbody>
			</table> 
		</div>

  
  
</div>


		

        </div>
      </div>
    </div>
  </section>
  <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Kyan Keise 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

</body>

</html>
