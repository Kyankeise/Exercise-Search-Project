<?php

    // parse includes
    // --------------

 			include("include/my_vars.php");
			include("include/my_db.php");
			include("include/my_functions.php");

			$page = '';

	// check if disclaimer has been shown
	// ----------------------------------
			if ( !empty( $_COOKIE[ COOKIE_NAME ]) ) {
				$hash_key = $_COOKIE[ COOKIE_NAME  ];
			} else {
				header( "Location: disclaimer.php" );
				exit;
			}	

	// process if submit or cancel button is pressed
	// --------------------------------------------
		if ( isset($_POST['submit']) || isset($_POST['cancel'])   ) {

				// return if cancelled
				// --------------------
					if (  isset($_POST['cancel'])  ) {

							header( "Location: index.php" );
							exit;
					}


					$muscle   	= filter_var($_POST['muscle'], FILTER_SANITIZE_STRING);
					$category  	= filter_var($_POST['category'], FILTER_SANITIZE_STRING);
					$level  	= filter_var($_POST['level'], FILTER_SANITIZE_STRING);
					$equipment 	= filter_var($_POST['equipment'], FILTER_SANITIZE_STRING);


				// validate - minimum of 1 entry
				// ------------------------------
					if ( empty($muscle) && empty($category) && empty($level) && empty($equipment) ) {
						
						$errmsg = 'At least 1 selection required to proceed' ;
						
					}

				
				// process
				// -------
				
					$where = 'WHERE ';
					$select = 'SELECT * ';
					$from = 'FROM exercise ';
					$join = '';
					$first = FALSE;
				
					if($muscle) {
						$where .= 'exercise_muscle.exercise_muscle_muscle_id=' .$muscle .' ';
						$join  .= 'INNER JOIN exercise_muscle ON exercise.exercise_id=exercise_muscle.exercise_muscle_exercise_id ';
						$first = TRUE;
					}
					if($category) {
						if($first) $where .= 'AND ';
						$where .= 'exercise_category.exercise_category_category_id=' .$category .' ';
						$join  .= 'INNER JOIN exercise_category ON exercise.exercise_id=exercise_category.exercise_category_exercise_id ';
						$first = TRUE;
					}
					if($level) {
						if($first) $where .= 'AND ';
						$where .= 'exercise_level.exercise_level_level_id=' .$level .' ';
						$join  .= 'INNER JOIN exercise_level ON exercise.exercise_id=exercise_level.exercise_level_exercise_id ';	
						$first = TRUE;
					}
					
					if($equipment) {
						if($first) $where .= 'AND ';
						$where .= 'exercise_equipment.exercise_equipment_equipment_id=' .$equipment .' ';
						$join  .= 'INNER JOIN exercise_equipment ON exercise.exercise_id=exercise_equipment.exercise_equipment_exercise_id ';
						$first = TRUE;
					}
	
					$query = $select .$from .$join .$where;
					$result = $db->query($query);
					$page = '';

					if ( count($result) > 0 ) {


							foreach( $result as $i ) {

								$page .= "<tr>";
								$page .= "<td>" . $i->exercise_id   ."</td>";
								$page .= "<td>" . clean_output($i->exercise_name) ."</td>";					
								$page .= "<td><a href=search-detail.php?ID=" . $i->exercise_id . ">Detail</a></td>";
								$page .= "</tr>";
							}


					} else { 
								$page .= "<tr>";
								$page .= "<td></td>";
								$page .= "<td>No exercises were availble for this request</td>";					
								$page .= "<td></td>";
								$page .= "</tr>";
					}


		} else {


			// load muscle, category, level, equipment 
			// ----------------------------------------
					$query  = "SELECT * FROM muscle ORDER BY muscle_name";
					$result = $db->query($query);
					$muscle_page = '';

					if ( count($result) > 0 ) {
							
							$muscle_page = "<option selected></option>";

							foreach( $result as $i ) {
								$muscle_page .= '<option value="' .$i->muscle_id .'">' .clean_output($i->muscle_name) .'</option>';
							}

					}
					

					$query  = "SELECT * FROM category ORDER BY category_name";
					$result = $db->query($query); 
					$category_page = '';

					if ( count($result) > 0 ) {
							
							$category_page = "<option selected></option>";

							foreach( $result as $i ) {
								$category_page .= '<option value="' .$i->category_id .'">' .clean_output($i->category_name) .'</option>';
							}

					}

					$query  = "SELECT * FROM level ORDER BY level_name";
					$result = $db->query($query); 
					$level_page = '';

					if ( count($result) > 0 ) {
							
							$level_page = "<option selected></option>";

							foreach( $result as $i ) {
								$level_page .= '<option value="' .$i->level_id .'">' .clean_output($i->level_name) .'</option>';
							}

					}


					$query  = "SELECT * FROM equipment ORDER BY equipment_id";
					$result = $db->query($query); 
					$equipment_page = '';

					if ( count($result) > 0 ) {
							
							$equipment_page = "<option selected></option>";

							foreach( $result as $i ) {
								$equipment_page .= '<option value="' .$i->equipment_id .'">' .clean_output($i->equipment_name) .'</option>';
							}

					}
	}
?>

<?php if(!$page) { ?> 
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
      <a class="navbar-brand js-scroll-trigger" href="index.php">TM470</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center"></div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">

		<h2>Search for exercises </h2> <br />
		<form action="<?php echo ($_SERVER["PHP_SELF"])?>" method="POST" id="needs-validation" novalidate> 
 
		<div class="row">

			<div class="col-lg-3 mx-auto">
				  <label class="mr-sm-2" for="muscle">Muscle</label>
				  <select class="custom-select mr-sm-2" id="muscle" name="muscle">
					<?php echo $muscle_page ?>
				  </select>
			</div>
	
			<div class="col-lg-3 mx-auto">
				  <label class="mr-sm-2" for="category">Category</label>
				  <select class="custom-select mr-sm-2" id="category" name="category">
					<?php echo $category_page ?>
				  </select>
			</div> 

			<div class="col-lg-3 mx-auto">
				  <label class="mr-sm-2" for="level">Level</label>
				  <select class="custom-select mr-sm-2" id="level" name="level">
					<?php echo $level_page ?>
				  </select>
			</div> 
			
			<div class="col-lg-3 mx-auto">
				  <label class="mr-sm-2" for="equipment">Equipment</label>
				  <select class="custom-select mr-sm-2" id="equipment" name="equipment">
					<?php echo $equipment_page ?>
				  </select>
			</div>

			
		</div>

<br/><br/>
		<div class="row">  
			<div class="col-lg-12 mx-auto">  
				<div class="float-right">  
					 <button class="btn btn-primary rounded-0" type="submit" name='cancel' id="cancel">Cancel</button> <button class="btn btn-primary rounded-0" type="submit" name='submit' id="submit">Submit</button>  
				</div>                            
			</div>  
		</div>  

		</form>

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

<?php } else { ?>



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
      <a class="navbar-brand js-scroll-trigger" href="index.php">TM470</a>
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
        <div class="col-lg-8 mx-auto">

		<h2>Search results:-</h2>
		<table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Exercises</th>
                <th>Action</th>
                <th></th>              
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
				
				<?php echo $page ?>
 
        </tbody>
		</table>
		

        </div>
      </div>
    </div>
  </section>


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


<?php } ?>
