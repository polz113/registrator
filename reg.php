<?PHP
    session_start();
    //Include the errorReport function
    require_once('./php/errorReport.php');
    //Include the logEvent function
    require_once('./php/logEvent.php');
    require_once('./php/noCommit.php');
    //Redirect to index / login if no user is set
    if (empty($_SESSION['username'])||empty($_SESSION['employeeID'])){
        header('Location: /');
        exit();
    }
    require_once('./php/eventLists.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Registrator FRI</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link href="./assets/style.css" rel="stylesheet">
    </head>
    <body>
        <div>
            <nav class="bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <a href="./reg.php"><img class="h-8 w-8" src="./assets/working-time-workplace-job-light.png" alt="Workflow"></a>
                            </div>
                            <div>
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                    <a href="./navodila.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Navodila</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ml-4 flex items-center md:ml-6">
                                <div class="ml-3 relative">
                                    <div>
                                        <form action="/index.php" method="post">
                                            <input type="hidden" name="UserEL" id="UserEL" value="Konec seje">
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-sm font-medium py-2 px-3 rounded-md" id="logoutL">
                                                Odjava
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
                    
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-1xl font-bold text-gray-900">
			Registrator FRI - Pozdravljeni <?PHP echo $_SESSION['displayName']?>!
                    </h1>
                </div>
            </header>
            <main>
                <?PHP if (!empty($_SESSION['eventlogged']) || !empty($_SESSION['errorreport'])) :?>
                <div class="max-w-7xl mx-auto pt-4 sm:px-6 lg:px-8">
                    <div class="w-full">
                        <?PHP if (!empty($_SESSION['eventlogged'])) :?>
                            <div class="flex justify-center bg-transparent text-orange-700 font-semibold py-2 px-4 border border-green-500 rounded">Dogodek je bil zabeležen.</div>
                        <?PHP unset($_SESSION['eventlogged']); ?>
                        <?PHP endif; ?>
                        <?PHP if (!empty($_SESSION['errorreport'])) :?>
                            <div class="flex justify-center bg-transparent text-blue-700 font-semibold py-2 px-4 border border-blue-500 rounded"><?PHP echo $_SESSION['errorreport']; ?></div>
                            <?PHP unset($_SESSION['errorreport']); ?>
                        <?PHP endif; ?>
                    </div>
                </div>
                <?PHP endif; ?>
                <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
                    <div class="border-b border-t border-gray-200 sm:border sm:rounded-lg overflow-hidden">
                        <div class="relative">
                            <div class="px-4 border-b border-gray-200 flex flex-col justify-left items-left bg-white sm:px-6 sm:items-baseline">
                                <div class="flex-shrink min-w-0 flex items-center">
                                    <p class="mt-2 w-full text-md font-bold text-gray-900">
                                        Hitra izbira pogostih tipov dogodkov
                                    </p>
                                </div>
                                <div class="flex flex-shrink-0 items-center">
                                    <div class="flex justify-center">
                                        <form action="/reg.php" method="post">
                                            <input type="hidden" name="UserM" id="UserM" value="Malica!">
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-600 rounded m-4 ml-0" id="submitM">
                                                Malica
                                            </button>
                                        </form>
                                    </div>
                                    <div class="flex justify-center">
                                        <form action="/reg.php" method="post">
                                            <input type="hidden" name="UserM" id="UserI" value="Izhod!">
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-600 rounded m-4 ml-0" id="submitI">
                                                Službeni izhod
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
                    <div class="border-b border-t border-gray-200 sm:border sm:rounded-lg overflow-hidden">
                        <div class="relative">
                            <div class="px-4 border-b border-gray-200 flex flex-col justify-left items-left bg-white sm:px-6 sm:items-baseline">
                                <div class="flex-shrink min-w-0 flex items-center">
                                    <p class="mt-2 w-full text-md font-bold text-gray-900">
                                        Ostali tipi dogodkov
                                    </p>
                                </div>
                                <div class="flex-shrink min-w-0 flex items-center">
                                    <p class="w-full text-sm text-gray-900">
                                        V kolikor tipa dogodka ni med hitro izbiro zgoraj, ga poiščite v spustnem seznamu spodaj
                                    </p>
                                </div>
                                <div class="flex flex-shrink-0 items-center justify-center w-full">
                                    <form class="w-full" action="/reg.php" method="post">
                                        <div>
                                            <label for="UserRP" class="sr-only">Ura:</label>
                                            <input type="text" id="UserRP" name="UserRP" pattern="([01]?[0-9]{1}|2[0-3]{1}):[0-5]{1}[0-9]{1}" class="clock float-left appearance-none rounded-none relative block w-4/12 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-l-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm mt-4" placeholder="HH:mm"> 
                                            <label for="UserTRP" class="sr-only">Tip Dogodka:</label>
                                            <select name="UserTRP" class="float-left appearance-none rounded-none relative block w-5/12 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-r-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm mt-4">
                                                <?PHP
                                                    //Generate the user event options
                                                    foreach(array_keys($allowedUserEvents) as $key){
                                                        echo '<option>'.$key.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="UserM" id="UserRP" value="Popravek!">
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-600 rounded m-4 ml-0 sm:ml-4" id="submitRP">
                                            Oddaj popravek
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
                    <div class="border-b border-t border-gray-200 sm:border sm:rounded-lg overflow-hidden">
                            <div class="px-4 border-b border-gray-200 flex flex-col justify-left items-left bg-white sm:px-6 sm:items-baseline">
                                <div class="flex flex-shrink-0 items-center justify-center w-full">
                                    <form class="w-full" action="/reg.php" method="post">
                                        <input type="hidden" name="NoCommitUsed" id="NoCommitUsed" value="True">
                                        <label><input type="checkbox" name="nocommit" <?PHP if ($nocommit) echo "checked"; ?>>Prepreči prenos v SAP</label>

                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-600 rounded m-4 ml-0 sm:ml-4" id="submit">
                                            Oddaj nastavitev
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
                    <div class="border-b border-t border-gray-200 sm:border sm:rounded-lg overflow-hidden">
                        <div class="relative">
                            <div class="px-4 border-b border-gray-200 flex flex-col justify-left items-left bg-white sm:px-6 sm:items-baseline">
                                <div class="flex-shrink min-w-0 flex items-center">
                                    <p class="mt-2 w-full text-md font-bold text-gray-900">
                                        Zaznani dogodki (danes)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                        <ul>
<?PHP
echo '<li>' . implode( '</li><li>', $new_events) . '</li>';
?>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
                    <div class="border-b border-t border-gray-200 sm:border sm:rounded-lg overflow-hidden">
                        <div class="relative">
                            <div class="px-4 border-b border-gray-200 flex flex-col justify-left items-left bg-white sm:px-6 sm:items-baseline">
                                <div class="flex-shrink min-w-0 flex items-center">
                                    <p class="mt-2 w-full text-md font-bold text-gray-900">
                                        Obdelani dogodki
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                        <ul>
<?PHP
echo '<li>' . implode( '</li><li>', $old_events) . '</li>';
?>
                        </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
