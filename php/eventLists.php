<?PHP
        $user = $_SESSION['employeeID'];
        // $user = preg_replace("/[^0-9]+/", "", $user);
        $old_events = file("spool/".basename($user)."/new_events.csv", "r") or die("Unable to open file!");
        $old_events = reverse_array($old_events);
        $new_events = file("spool/".basename($user)."/old_events.csv", "r") or die("Unable to open file!");
        $new_events = reverse_array($new_events);
    }

?>
