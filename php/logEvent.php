<?PHP

    function writeEventOld($event, $usertime=NULL){
        $file = fopen("logs/registratorLog.csv", "a") or die("Unable to open file!");
        $t = time();
        if (isset($usertime)){
            [ $h, $m ] = explode($usertime, ":");
            $t = strtotime('today') + 60*(60*$h + $m);
        }
        $logtxt=$_SESSION['employeeID'].",".date("m/d/Y", $t).",".date("H:i:s", $t).",".$event."\n";
        $logtxt = iconv("UTF-8", "UTF-16LE", $logtxt);
        if (flock($file, LOCK_EX)) {  // acquire an exclusive lock
            fwrite($file, $logtxt);
            fflush($file);            // flush output before releasing the lock
            flock($file, LOCK_UN);    // release the lock
        } else {
            errorReport('writelockerror');
        }
        fclose($file);
    }

    function writeEventNew($event, $usertime=NULL){ 
        $user = $_SESSION['employeeID'];
        $user = preg_replace("/[^0-9]+/", "", $user);
        $file = fopen("spool/".$user."/fixes.csv", "a") or die("Unable to open file!");
        $t = time();
        if (isset($usertime)){
            [ $h, $m ] = explode($usertime, ":");
            $t = strtotime('today') + 60*(60*$h + $m);
        }
        $logtxt = date("Y-m-d\TH:i:s", $t) . "," . $event . "\n";
        if (flock($file, LOCK_EX)) {  // acquire an exclusive lock
            fwrite($file, $logtxt);
            fflush($file);            // flush output before releasing the lock
            flock($file, LOCK_UN);    // release the lock
        } else {
            errorReport('writelockerror');
        }
        fclose($file);
    }



    function writeEvent($event, $usertime=NULL){
        writeEventOld($event, $usertime);
        writeEventNew($event, $usertime);
    }

    //Allowed events, selectable from the user interface
    $allowedUserEvents=array(
        #'Celodnevna registracija' => 42, 
        #'Prihod' => 43, 
        'Prihod' => '2',
        # 'Odhod' => 44,
        # 'Malica' => 45,
        'Malica' => "malica",
        # 'Službeni prihod' => 46, 
        # 'Službeni odhod' => 47,
        'Službeni odhod' => "sluzbeni",
        # 'Zasebni odhod' => 48, 
        'Zasebni odhod' => "zasebni",
        # 'Zasebni prihod' => 49, 
        # 'Zasebni prihod' => 49, 
        # '24. člen prihod' => 50, 
        # '24. člen odhod' => 51, 
        # 'Promocija zdravja - prihod' => 52, 
        'Bolniški izhod' => "zdravnik",
        # 'Bolniški izhod' => 70,
        # 'Zdravnik' => 'zdravnik'
    );
    $timeRegEx='/^([01][0-9]|2[0-3]):([0-5][0-9])$/';

    //Write the event to file
    if (!empty($_POST['UserM'])){
        if (strcmp($_POST["UserM"], 'Malica!')==0){
            writeEvent("malica");
            $_SESSION['eventlogged']=1;
        }
        elseif (strcmp($_POST['UserM'], 'Izhod!')==0){
            writeEvent('sluzbeni');
            $_SESSION['eventlogged']=1;
        }
        elseif (strcmp($_POST['UserM'], 'Popravek!')==0 && !empty($_POST['UserTRP']) && array_key_exists($_POST['UserTRP'], $allowedUserEvents)){
            if (!empty($_POST['UserRP'])){
                if (preg_match($timeRegEx, $_POST['UserRP'])==1){
                    writeEvent($allowedUserEvents[$_POST['UserTRP']], $_POST['UserRP']);
                    $_SESSION['eventlogged']=1;
                }
                else{
                    //Time format does not match
                    errorReport('eventlogfail');
                }
            }
            else{
                writeEvent($allowedUserEvents[$_POST['UserTRP']]);
                $_SESSION['eventlogged']=1;
            }
        }
        else{
            //Not a supported action
            errorReport('eventlogfail');
        }
    }

?>
