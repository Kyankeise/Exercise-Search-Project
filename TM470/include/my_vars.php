<?php

// Database Settings - amend the following: DB_USER, DB_PASS, DB_DATABASE
// ----------------------------------------------------------------------

		define("DB_SERVER", "localhost");
		define("DB_USER", "root");
		define("DB_PASS", "root");
		define("DB_DATABASE", "TM470");


// Site Customization - amend the following: SITE_NAME, SITE_URL
// -------------------------------------------------------------

		define("APP_NAME", "Exercise");
		define("SITE_NAME", "SITE NAME");
//		define("SITE_URL", "https://www.sitename.com"); (use on the remote server)
		define("SITE_URL", "http://localhost/");
		define("SITE_EMAIL", "support@sitename.com");


// Security - amend the following: COOKIE_NAME, SECRET_WORD
// --------------------------------------------------------

		define("COOKIE_NAME", TM470);
		define("SECRET_WORD", "cookies are yummy");
		define("COOKIE_EXPIRE", "86400");


// Templates
// ---------
		define("TMPL_ERROR", realpath(dirname(__DIR__))  ."/include/errors.html");


// Stuff - I'll leave this here and move it to a table later
// ---------------------------------------------------------
		define("KEY1", "VDiaAOCwmbeeE2iM0WGoZVfew/bwPDMOc3IN/FTE6eI=");
		define("KEY2", "bznsz59I6uowp+hNiuIgNYFqMrx7a6VeEnsSbQteSjYTFPqx+7g2Qf+M76gXvOdUot59GyIaTl6tL5Sg6NtElA==");

?>
