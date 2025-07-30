<?PHP
    $user = $_SESSION['employeeID'];
    $old_events = file("spool/".basename($user)."/old_events.csv");# or die("Unable to open file!");
    $old_events = $old_events ? array_reverse($old_events) : [];
    $new_events = file("spool/".basename($user)."/new_events.csv");# or die("Unable to open file!");
    $new_events = $new_events ? array_reverse($new_events): [];

?>
