<?php 

//  note: the order is exercise, muscle, category, level, equitment, measurement
//  ----------------------------------------------------------------------


//  get exercise details as an array
//  --------------------------------
	function getExerciseDet( $exercise_id ) {
	
					global $db;	
					
					$query = sprintf("SELECT * FROM exercise WHERE exercise_id=%s LIMIT 1", $exercise_id );
					$result = $db->query($query); 
					$arr = (array('exercise_id'   => clean_output($result[0]->exercise_id),
								  'exercise_name' => clean_output($result[0]->exercise_name)  ));
					return $arr;

				}


//  get muscle details as an array
//  ----------------------------------
	function getMuscleDet( $muscle_id ) {
					
					global $db; 
					
					$query = sprintf("SELECT * FROM muscle WHERE muscle_id=%s LIMIT 1", $muscle_id );
					$result = $db->query($query); 
					$arr = (array('muscle_id'   => clean_output($result[0]->muscle_id),
								  'muscle_name' => clean_output($result[0]->muscle_name)  ));
					return $arr;

				}


//  get category details as an array
//  --------------------------------
	function getCategoryDet( $category_id ) {

					global $db; 
					
					$query = sprintf("SELECT * FROM category WHERE category_id=%s LIMIT 1", $category_id );
					$result = $db->query($query); 
					$arr = (array('category_id'   => clean_output($result[0]->category_id),
								  'category_name' => clean_output($result[0]->category_name)  ));
					return $arr;


				}	
				
				
//  get level details as an array
//  ----------------------------------
	function getLevelDet( $level_id ) {
					
					global $db; 
					
					$query = sprintf("SELECT * FROM level WHERE level_id=%s LIMIT 1", $level_id );
					$result = $db->query($query); 
					$arr = (array('level_id'   => clean_output($result[0]->level_id),
								  'level_name' => clean_output($result[0]->level_name)  ));
					return $arr;

				}
				
				
//  get equitment details as an array
//  ----------------------------------
	function getEquipmentDet( $equipment_id ) {
					
					global $db; 
					
					$query = sprintf("SELECT * FROM equipment WHERE equipment_id=%s LIMIT 1", $equipment_id );
					$result = $db->query($query); 
					$arr = (array('equipment_id'   => clean_output($result[0]->equipment_id),
								  'equipment_name' => clean_output($result[0]->equipment_name)  ));
					return $arr;
		
				}

				
//  get measurement details as an array
//  ----------------------------------
	function getMeasurementDet( $measurement_id ) {

					global $db; 
					
					$query = sprintf("SELECT * FROM measurement WHERE measurement_id=%s LIMIT 1", $measurement_id );
					$result = $db->query($query); 
					$arr = (array('measurement_id'   => clean_output($result[0]->measurement_id),
								  'measurement_name' => clean_output($result[0]->measurement_name)  ));
					return $arr;
		
				}
				



// get all exercises for this exercise
// ------------------------------------

	function getExercise( $exercise ) {
			
					global $db ; $arr = array();

			// select all muscle for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise WHERE exercise_id=%s ", clean_input( $exercise ) );				
					$result = $db->query($query);
					if ( count($result) > 0 ) {

						foreach( $result as $i ) {

							if($i->exercise_id) {
								array_push($arr, getExerciseDet( $i->exercise_id ));
							}
						}
					}
					
					return( $arr );

	}


//  get all muscles for this exercise
//  ------------------------------------
	function getMuscle( $exercise ) {
			
					global $db ; $arr = array();
					
			// select all muscle for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_muscle WHERE exercise_muscle_exercise_id=%s ", clean_input( $exercise ) );				
					$result = $db->query($query);
					if ( count($result) > 0 ) {

						foreach( $result as $i ) {

							if($i->exercise_muscle_muscle_id) {
								
								array_push($arr, getMuscleDet( $i->exercise_muscle_muscle_id ));						
							}
						}

					}
				
					return( $arr );

	}

//  get all categories types for this exercise
//  ----------------------------------------
	function getCategory( $exercise ) {
			
				global $db ; $arr = array();

			// select all muscle for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_category WHERE exercise_category_exercise_id=%s ", clean_input( $exercise ) );				

					$result = $db->query($query);
					if ( count($result) > 0 ) {

						foreach( $result as $i ) {

							if($i->exercise_category_category_id) {
						
								array_push($arr, getCategoryDet( $i->exercise_category_category_id ));		
							}
						}
					}
					
					return( $arr );

	}


//  get all level for this exercise
//  --------------------------------------
	function getlevel( $exercise ) {
			
				global $db ; $arr = array();
 
 			// select all level for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_level WHERE exercise_level_exercise_id=%s ", clean_input( $exercise ) );				

					$result = $db->query($query);
					if ( count($result) > 0 ) {

						foreach( $result as $i ) {

							if($i->exercise_level_level_id) {
						
								array_push($arr, getLevelDet( $i->exercise_level_level_id ));
										
							}
						}
					}
					
					return( $arr );

	}


// get all equitments for this exercise
// ------------------------------------
	function getEquipment( $exercise ) {
			
				global $db ; $arr = array();

			// select all equipment for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_equipment WHERE exercise_equipment_exercise_id=%s ", clean_input( $exercise ) );				

					$result = $db->query($query);
					if ( count($result) > 0 ) {

						foreach( $result as $i ) {

							if($i->exercise_equipment_equipment_id) {
						
								array_push($arr, getEquipmentDet( $i->exercise_equipment_equipment_id ));	
									
							}
						}
					}
					
					return( $arr );

	}



// get all measurement types for this exercise
// -------------------------------------------

	function getMeasurement( $exercise ) {
			
				global $db ;  $arr = array();
		 

			// select all measurement for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_measurement WHERE exercise_measurement_exercise_id=%s ", clean_input( $exercise ) );				

					$result = $db->query($query);
					if ( count($result) > 0 ) {

						foreach( $result as $i ) {

							if($i->exercise_measurement_measurement_id) {
								
								array_push($arr, getMeasurementDet( $i->exercise_measurement_measurement_id ));		
													
							}
						}
					}
					
					return( $arr );

	}

// get all exercises for this muscle
// ----------------------------------
	function getMuscleExercise( $muscle_id ) {
			
					global $db ; $arr = array();
					
			// select all muscle for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_muscle WHERE exercise_muscle_muscle_id=%s ", clean_input( $muscle_id ) );				
					$result = $db->query($query);
					
					if ( count($result) > 0 ) {
						
						foreach( $result as $i ) {

							if($i->exercise_muscle_exercise_id) {
								
								array_push($arr, getExerciseDet( $i->exercise_muscle_exercise_id ));						
							}
						}

					}
				
					return( $arr );

	}

// get all exercises for this muscle
// ----------------------------------
	function getCategoryExercise( $category_id ) {
			
					global $db ; $arr = array();
					
			// select all muscle for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_category WHERE exercise_category_category_id=%s ", clean_input( $category_id ) );				
					$result = $db->query($query);
					
					if ( count($result) > 0 ) {
						
						foreach( $result as $i ) {

							if($i->exercise_category_exercise_id) {
								
								array_push($arr, getExerciseDet( $i->exercise_category_exercise_id ));						
							}
						}

					}
				
					return( $arr );

	}

// get all exercises for this level
// ----------------------------------
	function getLevelExercise( $level_id ) {
			
					global $db ; $arr = array();
					
			// select all muscle for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_level WHERE exercise_level_level_id=%s ", clean_input( $level_id ) );				
					$result = $db->query($query);
					
					if ( count($result) > 0 ) {
						
						foreach( $result as $i ) {

							if($i->exercise_level_exercise_id) {
								
								array_push($arr, getExerciseDet( $i->exercise_level_exercise_id ));						
							}
						}

					}
				
					return( $arr );

	}


// get all exercises for this equipment
// ----------------------------------
	function getEquipmentExercise( $equipment_id ) {
			
					global $db ; $arr = array();
					
			// select all muscle for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_equipment WHERE exercise_equipment_equipment_id=%s ", clean_input( $equipment_id ) );				
					$result = $db->query($query);
					
					if ( count($result) > 0 ) {
						
						foreach( $result as $i ) {

							if($i->exercise_equipment_exercise_id) {
								
								array_push($arr, getExerciseDet( $i->exercise_equipment_exercise_id ));						
							}
						}

					}
				
					return( $arr );

	}


// get all exercises for this measurement
// --------------------------------------
	function getMeasurementExercise( $measurement_id ) {
			
					global $db ; $arr = array();
					
			// select all measurement for this exercise
			// -------------------------------------		
					$query = sprintf("SELECT * FROM exercise_measurement WHERE exercise_measurement_measurement_id=%s ", clean_input( $measurement_id ) );				
					$result = $db->query($query);
					
					if ( count($result) > 0 ) {
						
						foreach( $result as $i ) {

							if($i->exercise_measurement_exercise_id) {
								
								array_push($arr, getExerciseDet( $i->exercise_measurement_exercise_id ));						
							}
						}

					}
				
					return( $arr );

	}


?>
