<?php
	ob_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/kernel.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/export.php");
	ob_end_clean();

	if (!(login_valid() and login_restricted(3)))
	{
		http_response_code(403);
		header("Content-Type: application/json");
		echo json_encode(array("status" => "error", "error_message" => "forbidden"));
		exit;
	}

	$anonymise = isset($_GET["anonymise"]) && $_GET["anonymise"] == "1";

	$db_connection = db_connect();

	$tables = array();
	foreach (array("ensembles", "members", "members-ensembles", "logins", "terms", "term_dates", "attendance") as $table)
	{
		$query = $db_connection->query("SELECT * FROM `".$table."` ORDER BY `ID` ASC");

		if (!$query)
		{
			http_response_code(500);
			header("Content-Type: application/json");
			echo json_encode(array("status" => "error", "error_message" => "failed to read ".$table."; ".$db_connection->error));
			exit;
		}

		$tables[$table] = $query->fetch_all(MYSQLI_ASSOC);
	}

	db_disconnect($db_connection);

	if ($anonymise)
	{
		$tables = anonymise_export_tables($tables);
	}

	$settings = array();
	foreach (array("group_name", "software_name", "logo_url", "assume_attending", "repeat_headings", "hide_past_dates", "hide_instrument", "taxonomy_rehearsal", "taxonomy_rehearsals", "taxonomy_concert", "taxonomy_ensemble", "taxonomy_ensembles") as $key)
	{
		if (array_key_exists($key, $config))
		{
			$settings[$key] = $config[$key];
		}
	}

	$export = array(
		"format"      => "pollererer-export",
		"version"     => 1,
		"exported_at" => date("c"),
		"anonymised"  => $anonymise,
		"timezone"    => date_default_timezone_get(),
		"settings"    => (object) $settings,
		"tables"      => $tables,
	);

	$filename = "pollererer-export-".($anonymise ? "anonymised-" : "").date("Ymd").".json";

	header("Content-Type: application/json");
	header("Content-Disposition: attachment; filename=\"".$filename."\"");
	header("Cache-Control: no-store");

	echo json_encode($export, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
?>
