<?PHP
    //Include the login configuration
    require_once('./conf/loginconf.php');
    //Include the errorReport function
    require_once('./php/errorReport.php');

    function login($domain, $userData){
        //Clear the errors
        unset($_SESSION['errorreport']);
        //Set the user information
        $_SESSION['loggedin']=$_POST["UserL"];
        $_SESSION['domain']=$domain;
        $_SESSION['employeeID']=$userData[0];
        $_SESSION['displayName']=$userData[1];
        //Redirect
        header('Location: reg.php');
        exit();
    }

    function logout(){
        $_SESSION=array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location: /');
        exit();
    }

    function checkDomain($postDomain, $allowedDomains){
        //Check if the used domain is allowed
        if (in_array($postDomain, $allowedDomains)){
            return $postDomain;
        }
        return "";
    }
    
    function setDN($domain, $baseDn){
        $select=substr($domain, 1);
        $select=explode(".", $select)[0];
        return "DC=".$select.$baseDn;
    }

    function getUserData($ldap_conn, $dnU, $userDatacall, $domain){
        $filter="(&(objectcategory=person)(userprincipalname=".$_POST["UserL"].$domain."))";
        $sr=ldap_search($ldap_conn, $dnU, $filter, $userDatacall);
        $info = ldap_get_entries($ldap_conn, $sr);
        return array((isset($info[0]['employeeid'][0]) ? $info[0]['employeeid'][0] : ""), (isset($info[0]['displayname'][0]) ? $info[0]['displayname'][0] : ""));
    }


    if (!empty($_POST["UserL"])&&!empty($_POST["UserPL"]&&!empty($_POST["UserDL"]))){
        //Set the status variables
        unset($_SESSION['errorreport']);
        //Set the user selected domain
        $domain=checkDomain($_POST["UserDL"], $allowedDomains);
        if (strcmp($domain, "")!=0){
            $dnU=setDn($domain, $baseDn);
            //Create the ldap connection
            $ldap_conn=ldap_connect($adServerGC) or die ("Could not connect");
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);
            //Try to bind the user
            if (ldap_bind($ldap_conn, $_POST["UserL"].$domain, $_POST["UserPL"])){
                //If bind sucessful log the user in
                //Get the required user data. If the data isn't available show an error message
                $userData=getUserData($ldap_conn, $dnU, $userDatacall, $domain);
                if (strcmp($userData[0], "")!=0 && strcmp($userData[1], "")!=0){
                    login($domain, $userData);
                }
                else{
                    errorReport('missingdata');
                }
            }
            else{
                errorReport('loginfail');
            }
            ldap_close($ldap_conn);
        }
        else{
            errorReport('domaindenied');
        }
    }
    if (!empty($_POST["UserEL"])){
        //Logout triggered
        logout();
    }

?>