<?php
	function db_connect()
	{
		if (php_sapi_name() === 'cli')
		{
			require(getenv('PWD')."/config.php");
		}
		else
		{
			require($_SERVER['DOCUMENT_ROOT']."/config.php");
		}

		// Single gate: every page, API call and cron job (DB + email) goes through here.
		if (!empty($config["maintenance_mode"]))
		{
			if (php_sapi_name() !== 'cli' && !headers_sent())
			{
				http_response_code(503);
				header("Retry-After: 3600");
			}
			die("Down for maintenance. Please check back soon.");
		}

		$new_database_connection = new mysqli($config["db_host"], $config["db_username"], $config["db_password"], $config["db_name"]);

		if ($new_database_connection->connect_error)
		{
			die("Connection failed: " . $new_database_connection->connect_error);
		}
		else
		{
			return $new_database_connection;
		}
	}

	function db_disconnect($db_connection)
	{
		return $db_connection->close();
	}
?>