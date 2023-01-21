<?php

    // parse includes
    // --------------

 			include("include/my_vars.php");
			include("include/my_db.php");
			include("include/my_functions.php");

			$page = '';

	// process if submit or cancel button is pressed
	// --------------------------------------------
		if ( isset($_POST['No']) || isset($_POST['Yes'])   ) {

				// not happy with rules
				// --------------------
					if (  isset($_POST['No'])  ) {
							header( "Location: https://www.google.co.uk/" );
							exit;
					} else {
						$hash_key = time();	
						setcookie( COOKIE_NAME, $hash_key, time() + COOKIE_EXPIRE );
							header( "Location: index.php" );
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

		<h2>Disclaimer </h2> <br />
		<form action="<?php echo ($_SERVER["PHP_SELF"])?>" method="POST" id="needs-validation" novalidate> 
        <p>Please read this disclaimer ("disclaimer") carefully before using [website] website (“website”,
        "service") operated by [name] ("us", 'we", "our").
        The content displayed on the website is the intellectual property of the [name]. You may not
        reuse, republish, or reprint such content without our written consent.
        All information posted is merely for educational and informational purposes. It is not intended
        as a substitute for professional advice. Should you decide to act upon any information on this
        website, you do so at your own risk.
        While the information on this website has been verified to the best of our abilities, we cannot
        guarantee that there are no mistakes or errors.
        We reserve the right to change this policy at any given time, of which you will be promptly
        updated. If you want to make sure that you are up to date with the latest changes, we advise
        you to frequently visit this page.</P>
    <br/><br/>
		<div class="row">  
			<div class="col-lg-12 mx-auto">  
				<div class="float-right">  
					 <button class="btn btn-primary rounded-0" type="submit" name='No' id="No">No</button> <button class="btn btn-primary rounded-0" type="submit" name='Yes' id="Yes">Yes</button>  
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
