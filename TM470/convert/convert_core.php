<?php  

//  convert core files from csv files
//  ---------------------------------



// include global variables
// ------------------------
        include( "../include/my_vars.php") ;
        include( "../include/my_db.php") ;
        include( "../include/my_functions.php") ;


// convert text file to database ( file is in csv format)
// ----------------------------------------------------------------------------

		// read file in directory
		// ----------------------
			$file 			= file_get_contents("sheet2.csv");
            $file_contents 	= explode("\n",$file);

		
		// declare variables
		// ----------------
			$exercise = $primary_muscle = $secondary_muscle = $type = $level = $equipment = $unit_of_measurement = '';
			
		// loop, process all lines in file
		// -------------------------------
			foreach ($file_contents as $file_content) {

                // split line  
                // ----------
					list($exercise, $primary_muscle, $secondary_muscle, $type, $level, $equipment, $unit_of_measurement) = explode(",", $file_content);

				// clean each input item
                // --------------------
                    $exercise 			= filter_var($exercise, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $primary_muscle 	= filter_var($primary_muscle, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $secondary_muscle 	= filter_var($secondary_muscle, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $type 				= filter_var($type, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $level 				= filter_var($level, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $equipment 			= filter_var($equipment, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $unit_of_measurement= filter_var($unit_of_measurement, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );

				// initialise lastid
				// -----------------
					$exercise_lastid = '';
					$primary_muscle_lastid = '';
					$secondary_muscle_lastid = '';
					$category_lastid = '';
					$level_lastid = '';
					$equipment_lastid = '';
					$measurement_lastid	= '';
																		
				// exercise
				// -------- 

					if($exercise) {
						$query = sprintf("SELECT * FROM exercise WHERE exercise_name=%s LIMIT 1", clean_input( $exercise) );
						$result = $db->query($query); 
						if(count($result) == 0) {
							$query = sprintf("INSERT INTO exercise (exercise_name) values(%s)", clean_input( $exercise ) );
							$result = $db->query($query);
							$exercise_lastid = $db->lastid();
						}
					}

				// process all others if exercise lastid is valid
                // ----------------------------------------------
					if( $exercise_lastid ) {
						
						// muscle, primary (1:1)
						// ------------------
							if( $primary_muscle ) {
								$query = sprintf("SELECT * FROM muscle WHERE muscle_name=%s LIMIT 1", clean_input( $primary_muscle ) );
								$result = $db->query($query); 
								if(count($result) == 0) {
									$query = sprintf("INSERT INTO muscle (muscle_name) values(%s)", clean_input( $primary_muscle ) );
									$result = $db->query($query);
								}
							}
						
						// muscle, secondary (1:1)
						// -------------------
							if( $secondary_muscle ) {
								$query = sprintf("SELECT * FROM muscle WHERE muscle_name=%s LIMIT 1", clean_input( $secondary_muscle ) );
								$result = $db->query($query); 
								if(count($result) == 0) {
									$query = sprintf("INSERT INTO muscle (muscle_name) values(%s)", clean_input( $secondary_muscle ) );
									$result = $db->query($query);
								}
							}
						// exercise type (1:1)
						// -------------
							if($type) {
								$query = sprintf("SELECT * FROM category WHERE category_name=%s LIMIT 1", clean_input( $type ) );
								$result = $db->query($query); 
								if(count($result) == 0) {
									$query = sprintf("INSERT INTO category (category_name) values(%s)", clean_input( $type ) );
									$result = $db->query($query);
								}
							}
						// level (1:1)
						// ----------
							if( $level ) {
								$query = sprintf("SELECT * FROM level  WHERE level_name=%s LIMIT 1", clean_input( $level ) );
								$result = $db->query($query); 
								if(count($result) == 0) {
									$query = sprintf("INSERT INTO level  (level_name) values(%s)", clean_input( $level ) );
									$result = $db->query($query);
								}
							}

						// equipment (1:1)
						// ---------
							if(  $equipment ) {
								$query = sprintf("SELECT * FROM equipment WHERE equipment_name=%s LIMIT 1", clean_input( $equipment ) );
								$result = $db->query($query); 
								if(count($result) == 0) {
									$query = sprintf("INSERT INTO equipment (equipment_name) values(%s)", clean_input( $equipment ) );
									$result = $db->query($query);
								}
							}
							
						// measurement (1:1)
						// ----------------
							if( $unit_of_measurement ) {
								$query = sprintf("SELECT * FROM measurement WHERE measurement_name=%s LIMIT 1", clean_input( $unit_of_measurement ) );
								$result = $db->query($query); 
								if(count($result) == 0) {
									$query = sprintf("INSERT INTO measurement (measurement_name) values(%s)", clean_input( $unit_of_measurement ) );
									$result = $db->query($query);
								}

							}
						
						
					}

				 
		    }

// inform user & terminate
// -----------------------
		echo ("Conversion of core files is now completed. ");

?>
