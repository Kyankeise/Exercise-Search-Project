<?php

/*===================================================================*/
/* script to install exercise database                               */
/*===================================================================*/


	// include file containing global variables & settings
	// ---------------------------------------------------
				include( "../include/my_vars.php") ;


	// declare local variables
	// ------------------------
				$conn = '';						/* connection to server */
				$sql = '';						/* sql statement */
				$result = '';					/* result from server */

				
	// declare variables to hold SQL statement  
	// ---------------------------------------			
			// atoms
				$create_exercise = $create_muscle = $create_category = '';
				$create_level = $create_equipment = $create_measurement = '';
				$create_url = $create_description = '';		
			
			// molecules	
				$create_exercise_muscle =	$create_exercise_category = $create_exercise_level = '';
				$create_exercise_equipment = $create_exercise_measurement = '';
				$create_exercise_url = $create_exercise_description = '';


	// define SQL statements for each variable. This will be used to create tables
	// ---------------------------------------------------------------------------
				$create_exercise = " CREATE TABLE IF NOT EXISTS exercise (
								exercise_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								exercise_name VARCHAR(128) NULL,
								PRIMARY KEY(exercise_id)
							)" ;
							

				$create_muscle = " CREATE TABLE IF NOT EXISTS muscle (
								muscle_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								muscle_name VARCHAR(128) NULL,
								PRIMARY KEY(muscle_id)
							)" ;

							
				$create_category = "CREATE TABLE IF NOT EXISTS category (
								category_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								category_name VARCHAR(128) NULL,
								PRIMARY KEY(category_id)
							)" ;

						  
				$create_level = "CREATE TABLE IF NOT EXISTS level (
								level_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								level_name VARCHAR(128) NULL,
								PRIMARY KEY(level_id)
							)" ;

							
				$create_equipment = "CREATE TABLE IF NOT EXISTS equipment (
								equipment_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								equipment_name VARCHAR(128) NULL,
								PRIMARY KEY(equipment_id)
							)" ;


				$create_measurement = "CREATE TABLE IF NOT EXISTS measurement (
								measurement_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								measurement_name VARCHAR(128) NULL,
								PRIMARY KEY(measurement_id)
							)" ;


				$create_url = "CREATE TABLE IF NOT EXISTS url (
								url_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								url_loc TEXT NULL,
								PRIMARY KEY(url_id)
							)" ;


				$create_description = "CREATE TABLE IF NOT EXISTS description (
								description_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								description_text MEDIUMTEXT NULL,
								PRIMARY KEY(description_id)
							)" ;

// ---------------------------------------------------------------------------
							
				$create_exercise_muscle =	" CREATE TABLE IF NOT EXISTS exercise_muscle (
								exercise_muscle_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								exercise_muscle_exercise_id INTEGER(11),
								exercise_muscle_muscle_id INTEGER(11) ,
								PRIMARY KEY(exercise_muscle_id)
							)" ;
							
				$create_exercise_category = " CREATE TABLE IF NOT EXISTS exercise_category (
								exercise_category_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								exercise_category_exercise_id INTEGER(11),
								exercise_category_category_id INTEGER(11) ,
								PRIMARY KEY(exercise_category_id)
							)" ;
							
				$create_exercise_level = " CREATE TABLE IF NOT EXISTS exercise_level (
								exercise_level_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								exercise_level_exercise_id INTEGER(11),
								exercise_level_level_id INTEGER(11) ,
								PRIMARY KEY(exercise_level_id)
							)" ;
							
				$create_exercise_equipment = " CREATE TABLE IF NOT EXISTS exercise_equipment (
								exercise_equipment_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								exercise_equipment_exercise_id INTEGER(11),
								exercise_equipment_equipment_id INTEGER(11) ,
								PRIMARY KEY(exercise_equipment_id)
							)" ;
							
				$create_exercise_measurement = " CREATE TABLE IF NOT EXISTS exercise_measurement (
								exercise_measurement_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								exercise_measurement_exercise_id INTEGER(11),
								exercise_measurement_measurement_id INTEGER(11) ,
								PRIMARY KEY(exercise_measurement_id)
							)" ;

				$create_exercise_url = " CREATE TABLE IF NOT EXISTS exercise_url (
								exercise_url_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								exercise_url_exercise_id INTEGER(11),
								exercise_url_url_id INTEGER(11) ,
								PRIMARY KEY(exercise_url_id)
							)" ;

				$create_exercise_description = " CREATE TABLE IF NOT EXISTS exercise_description (
								exercise_description_id INTEGER(11) NOT NULL AUTO_INCREMENT,
								exercise_description_exercise_id INTEGER(11),
								exercise_description_description_id INTEGER(11) ,
								PRIMARY KEY(exercise_description_id)
							)" ;
				
/*===================================================================*/
/* PROCESS                                                           */
/*===================================================================*/


	// connect to mySQL server using contact values, display error if failed
	// ---------------------------------------------------------------------
				$conn = mysqli_connect( DB_SERVER, DB_USER, DB_PASS );
				if (mysqli_connect_error()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					exit;
				}


	// delete database, if it exists
	// -----------------------------
				$sql = "DROP DATABASE IF EXISTS " . DB_DATABASE ;
				$result = mysqli_query($conn, $sql) or die( mysqli_error($conn) );


	// create database
	// ---------------
				$sql = "CREATE DATABASE IF NOT EXISTS " . DB_DATABASE ;
				$result = mysqli_query($conn, $sql) or die( mysqli_error($conn) );


	// select database
	// ---------------
				mysqli_select_db( $conn, DB_DATABASE );


	// create tables using the defination above
	// ----------------------------------------
				$result = mysqli_query($conn, $create_exercise ) or die( mysqli_error($conn) );
				$result = mysqli_query($conn, $create_muscle) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_category) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_level ) or die( mysqli_error($conn) );
				$result = mysqli_query($conn, $create_equipment) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_measurement) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_url) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_description) or die(mysqli_error($conn) );

				$result = mysqli_query($conn, $create_exercise_muscle) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_exercise_category) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_exercise_level ) or die( mysqli_error($conn) );
				$result = mysqli_query($conn, $create_exercise_equipment) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_exercise_measurement) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_exercise_url) or die(mysqli_error($conn) );
				$result = mysqli_query($conn, $create_exercise_description) or die(mysqli_error($conn) );


	// close connection
	// ----------------
				mysqli_close($conn);


	// inform user & terminate
	// -----------------------
				echo ("Installation of database [ " . DB_DATABASE ." ] is now completed.");

		
?>
