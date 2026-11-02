<?php
require_once(__DIR__."/../includes/export.php");

$tables = array(
	"ensembles" => array(
		array("ID" => "1", "name" => "Band", "admin_email" => "a@x.com, b@y.com"),
		array("ID" => "2", "name" => "Choir", "admin_email" => ""),
	),
	"members" => array(
		array("ID" => "-1", "first_name" => "Band", "last_name" => "Login", "image" => "e.png", "instrument" => "Ensemble"),
		array("ID" => "0", "first_name" => "Guest", "last_name" => "User", "image" => "g.png", "instrument" => ""),
		array("ID" => "5", "first_name" => "Jane", "last_name" => "Doe", "image" => "j.png", "instrument" => "Flute"),
	),
	"members-ensembles" => array(array("ID" => "1", "member_ID" => "5", "ensemble_ID" => "1")),
	"logins" => array(
		array("ID" => "-1", "email" => "band", "password" => "old"),
		array("ID" => "5", "email" => "jane@x.com", "password" => "old"),
	),
	"terms" => array(array("ID" => "1", "name" => "Autumn")),
	"term_dates" => array(array("ID" => "1", "term_ID" => "1")),
	"attendance" => array(array("ID" => "1", "member_ID" => "5", "status" => "1", "IP" => "1.2.3.4")),
);

$result = anonymise_export_tables($tables);

$checks = array(
	"member names replaced"         => $result["members"][2]["first_name"] === "First5" && $result["members"][2]["last_name"] === "Last5",
	"guest name kept"               => $result["members"][1]["first_name"] === "Guest" && $result["members"][1]["last_name"] === "User",
	"ensemble login name kept"      => $result["members"][0]["first_name"] === "Band" && $result["members"][0]["last_name"] === "Login",
	"images cleared"                => array_column($result["members"], "image") === array("", "", ""),
	"other member columns kept"     => $result["members"][2]["instrument"] === "Flute",
	"email replaced"                => $result["logins"][1]["email"] === "member5@example.invalid",
	"username kept"                 => $result["logins"][0]["email"] === "band",
	"passwords are 'password'"      => password_verify("password", $result["logins"][0]["password"]) && password_verify("password", $result["logins"][1]["password"]),
	"IP cleared"                    => $result["attendance"][0]["IP"] === "" && $result["attendance"][0]["status"] === "1",
	"admin emails replaced"         => $result["ensembles"][0]["admin_email"] === "admin1-1@example.invalid,admin1-2@example.invalid",
	"empty admin email kept"        => $result["ensembles"][1]["admin_email"] === "",
	"ensemble name kept"            => $result["ensembles"][0]["name"] === "Band",
	"untouched tables identical"    => $result["terms"] === $tables["terms"] && $result["term_dates"] === $tables["term_dates"] && $result["members-ensembles"] === $tables["members-ensembles"],
	"input not modified"            => $tables["members"][2]["first_name"] === "Jane",
);

$failed = array_keys(array_filter($checks, function ($passed) { return !$passed; }));

foreach ($failed as $name)
{
	echo "FAIL: ".$name."\n";
}

if ($failed)
{
	exit(1);
}

echo "OK: ".count($checks)." checks passed\n";
?>
