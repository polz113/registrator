<?PHP

    function errorReport($error){
        if (strcmp($error, 'loginfail')==0){
            $_SESSION['errorreport']='Prijava neuspešna, preverite če ste vnesli pravilne podatke!';
        }
        else if (strcmp($error, 'accessdenied')==0){
            $_SESSION['errorreport']='Nimate dostopa do te storitve, če mislite, da bi ga morali imeti se obrnite na skrbnika.';
        }
        else if (strcmp($error, 'domaindenied')==0){
            $_SESSION['errorreport']='Trenutno je ta storitev na voljo samo uporabnikom fakultete FRI.';
        }
        else if (strcmp($error, 'missingdata')==0){
            $_SESSION['errorreport']='V vašem AD računu manjkajo podatki za uporabo te storitve.';
        }
        else if (strcmp($error, 'eventlogfail')==0){
            $_SESSION['errorreport']='Napaka pri beleženju dogodka. Preverite, da so podatki pravilni.';
        }
        else if (strcmp($error, 'writelockerror')==0){
            $_SESSION['errorreport']='Napaka pri beleženju dogodka. Prosimo poskusite čez nekaj sekund.';
        }

    }

?>