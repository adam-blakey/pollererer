<?php
function anonymise_export_tables($tables)
{
  foreach ($tables["members"] as &$member)
  {
    if ($member["ID"] > 0)
    {
      $member["first_name"] = "First".$member["ID"];
      $member["last_name"]  = "Last".$member["ID"];
    }
    $member["image"] = "";
  }
  unset($member);

  $password_hash = password_hash("password", PASSWORD_BCRYPT);

  foreach ($tables["logins"] as &$login)
  {
    if (strpos($login["email"], "@") !== false)
    {
      $login["email"] = "member".$login["ID"]."@example.invalid";
    }
    $login["password"] = $password_hash;
  }
  unset($login);

  foreach ($tables["attendance"] as &$attendance)
  {
    $attendance["IP"] = "";
  }
  unset($attendance);

  foreach ($tables["ensembles"] as &$ensemble)
  {
    $addresses = array_filter(array_map("trim", explode(",", (string) $ensemble["admin_email"])), "strlen");
    $replacements = array();
    foreach (array_values($addresses) as $n => $address)
    {
      $replacements[] = "admin".$ensemble["ID"]."-".($n + 1)."@example.invalid";
    }
    $ensemble["admin_email"] = implode(",", $replacements);
  }
  unset($ensemble);

  return $tables;
}
?>
