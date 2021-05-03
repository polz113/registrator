<?PHP

    function writeNoCommit($nocommit){ 
        $user = $_SESSION['employeeID'];
        $user = preg_replace("/[^0-9]+/", "", $user);
        $file = fopen("spool/".$user."/nocommit.csv", "a") or die("Unable to open file!");
        $t = time();
        $logtxt = date("Y-m-d\TH:i:s", $t) . "," . $nocommit . "\n";
        if (flock($file, LOCK_EX)) {  // acquire an exclusive lock
            fwrite($file, $logtxt);
            fflush($file);            // flush output before releasing the lock
            flock($file, LOCK_UN);    // release the lock
        } else {
            errorReport('writelockerror');
        }
        fclose($file);
    }

    function readNoCommit(){ 
        $user = $_SESSION['employeeID'];
        $user = preg_replace("/[^0-9]+/", "", $user);
	$file = fopen("spool/".$user."/nocommit.csv", "r");
	$ret = False;
        if (!$file) return False;
        try {
            assert(flock($file, LOCK_EX));  // acquire an exclusive lock
                /* beri zadnjo vrstico - komplicirano */
                /* 
                fseek($file, -2 * strlen("9999-13-32\t25:66:77 , True"), SEEK_END);
                while(!feof($file)) {
                    $row = fgets($file);
                }
                // dobi vrednost na koncu
                [$t, $val] = explode(",", $row);
                */
            /* beri zadnjo vrednost - preprosto */
            fseek($file, -2, SEEK_END);
            $val = trim(fgets($file));
            if (strcmp($val, "1") == 0) {
                $ret = True;
            }
        } catch (Exception $e) {
            $ret = False;
        } finally {
            flock($file, LOCK_UN);    // release the lock
        }
        fclose($file);
        return $ret;
    }


    //Write the setting
    if (!empty($_POST['NoCommitUsed'])){
        if ($_POST['nocommit'] == "on") {
            $nocommit = "1";
        } else {
            $nocommit = "0";
        }
        writeNoCommit($nocommit);
    }
    $nocommit = readNoCommit();
?>
