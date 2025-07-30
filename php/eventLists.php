<?PHP
    $user = $_SESSION['employeeID'];
    $userdir = basename($user);
    $old_events = file("spool/".$userdir."/old_events.csv");# or die("Unable to open $userdir/old_events.csv!");
    $old_events = $old_events ? array_reverse($old_events) : [];
    $new_events = file("spool/".$userdir."/new_events.csv");# or die("Unable to open $userdir/new_events.csv!");
    $new_events = $new_events ? array_reverse($new_events): [];

?>
