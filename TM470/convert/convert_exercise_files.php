<?php  

// convert exercise_muscle from csv
// ----------------------------------


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


		// declare variable
		// ----------------
			$exercise = $primary_muscle = $secondary_muscle = $type = $level = $equipment = $measurement = '';
			$exercise_id = '';
			
		// loop, process all lines in file
		// -------------------------------
			foreach ($file_contents as $file_content) {

                // split line  
                // ----------
					list($exercise, $primary_muscle, $secondary_muscle, $type, $level, $equipment, $measurement) = explode(",", $file_content);


				// clean each input item
                // --------------------
                    $exercise 			= filter_var($exercise, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $primary_muscle 	= filter_var($primary_muscle, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $secondary_muscle 	= filter_var($secondary_muscle, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $type 				= filter_var($type, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $level 				= filter_var($level, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $equipment 			= filter_var($equipment, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );
                    $measurement		= filter_var($measurement, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP );

					$exercise_id = '';
																		
				// find this exercise
				// ------------------
					$query = sprintf("SELECT * FROM exercise WHERE exercise_name=%s LIMIT 1", clean_input( $exercise) );
					$result = $db->query($query); 
					$exercise_id = $result[0]->exercise_id;
					
				
				// write primary muscle
				// ---------------------
					if($primary_muscle) {
						
						$query = sprintf("SELECT * FROM muscle WHERE muscle_name=%s LIMIT 1", clean_input( $primary_muscle ) );
						$result = $db->query($query); 
						$primary_muscle_id = $result[0]->muscle_id;
						
						$query = sprintf("INSERT INTO exercise_muscle ( exercise_muscle_exercise_id, exercise_muscle_muscle_id) values(%s, %s )",
									clean_input( $exercise_id ),
									clean_input( $primary_muscle_id )
							);
						$result = $db->query($query);
			
					}

				// write primary muscle
				// ---------------------
					if($secondary_muscle) {
						
						$query = sprintf("SELECT * FROM muscle WHERE muscle_name=%s LIMIT 1", clean_input( $secondary_muscle ) );
						$result = $db->query($query); 
						$secondary_muscle_id = $result[0]->muscle_id;
						
						$query = sprintf("INSERT INTO exercise_muscle ( exercise_muscle_exercise_id, exercise_muscle_muscle_id) values(%s, %s )",
									clean_input( $exercise_id ),
									clean_input( $secondary_muscle_id )
							);
						$result = $db->query($query);
			
					}


				// exercise_category
				// ----------------------
					if( $type ) {
						
						$query = sprintf("SELECT * FROM category WHERE category_name=%s LIMIT 1", clean_input( $type ) );
						$result = $db->query($query); 
						$type_id = $result[0]->category_id;
						
						$query = sprintf("INSERT INTO exercise_category ( exercise_category_exercise_id, exercise_category_category_id) values(%s, %s )",
									clean_input( $exercise_id ),
									clean_input( $type_id )
							);
						$result = $db->query($query);
			
					}



				// exercise_level
				// --------------------
					if( $level ) {
						
						$query = sprintf("SELECT * FROM level WHERE level_name=%s LIMIT 1", clean_input( $level ) );
						$result = $db->query($query); 
						$level_id = $result[0]->level_id;
						
						$query = sprintf("INSERT INTO exercise_level ( exercise_level_exercise_id, exercise_level_level_id) values(%s, %s )",
									clean_input( $exercise_id ),
									clean_input( $level_id )
							);
						$result = $db->query($query);
			
					}

				// exercise_equipment
				// --------------------
					if( $equipment ) {
						
						$query = sprintf("SELECT * FROM equipment WHERE equipment_name=%s LIMIT 1", clean_input( $equipment ) );
						$result = $db->query($query); 
						$equipment_id = $result[0]->equipment_id;
						
						$query = sprintf("INSERT INTO exercise_equipment ( exercise_equipment_exercise_id, exercise_equipment_equipment_id) values(%s, %s )",
									clean_input( $exercise_id ),
									clean_input( $equipment_id  )
							);
						$result = $db->query($query);
			
					}

				// exercise_measurement
				// --------------------
					if( $measurement ) {
						
						$query = sprintf("SELECT * FROM measurement WHERE measurement_name=%s LIMIT 1", clean_input( $measurement ) );
						$result = $db->query($query); 
						$measurement_id = $result[0]->measurement_id;
					
						$query = sprintf("INSERT INTO exercise_measurement ( exercise_measurement_exercise_id, exercise_measurement_measurement_id) values(%s, %s )",
									clean_input( $exercise_id ),
									clean_input( $measurement_id  )
							);
						$result = $db->query($query);
			
					}

						
						
			}
		    

// inform user & terminate
// -----------------------
		echo ("Conversion of exercise files is now completed.");

?>
