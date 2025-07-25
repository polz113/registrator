<?PHP
    //Include the login functions
    require_once('./php/login.php');

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Registrator FRI</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	</head>
	<body>
        <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img class="mx-auto h-12 w-auto" src="./assets/working-time-workplace-job.png" alt="Workflow">
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Prijava v Registrator FRI
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        Vnesite svoje FRI1 uporabniško ime in geslo za vpis
                    </p>
                </div>
                <form class="mt-8 space-y-6" action="./index.php" method="POST" id="formL">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="UserL" class="sr-only">Uporabniško ime:</label>
                            <input id="UserL" name="UserL" type="text" required class="float-left appearance-none rounded-none relative block w-2/3 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-tl-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="up. ime">
                            <label for="UserDL" class="sr-only">Domena:</label>
                            <select id="UserDL" name="UserDL" class="float-left appearance-none rounded-none relative block w-1/3 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-tr-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                <?PHP
                                    //Generate the possible login domains
                                    foreach($allowedDomains as $domain){
                                        echo '<option>'.$domain.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="UserPL" class="sr-only">Geslo:</label>
                            <input id="UserPL" name="UserPL" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="********">
                        </div>
                    </div>

                    <div>
                        <button type="submit" id="loginL" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <!-- Heroicon name: solid/lock-closed -->
                                <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Prijava
                        </button>
                    </div>
                </form>
                <div>
                    <?PHP if (!empty($_SESSION['errorreport'])) :?>
                        <div class="flex justify-center bg-transparent text-blue-700 font-semibold py-2 px-4 border border-blue-500 rounded"><?PHP echo $_SESSION['errorreport']; ?></div>
                    <?PHP endif; ?>
                </div>
            </div>
        </div>
	</body>
</html>
