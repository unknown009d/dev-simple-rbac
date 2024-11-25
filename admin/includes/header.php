<?php
$root = getenv("ROOT_DIR");
require_once 'session.php';
require_once 'icon.php';

$title = $title ?? "CMS";

$menuiconsize = "1rem";

$UAC = intval($_SESSION["UAC"]);

$updir = getenv("ROOT_DIR");

$menuitems = [
    // [ Title, Links, Icons, Category(for UAC) ]
    ["Home", "dashboard", iHome($menuiconsize), "dashboard"],
    ["About", "about", iAbout($menuiconsize), "about"],
    ["Service", "service", iServices($menuiconsize), "service"],
    ["Expertise", "expertise", iBrain($menuiconsize), "expertise"],
    ["Solutions", "solution", iSolution($menuiconsize), "solution"],
    // ["Projects", "projects", iProjects($menuiconsize), "projects"],
    ["Careers", $UAC <= 3 ? "careers" : "careers_all", iCareers($menuiconsize), "careers"],
    ["Clients", "companies", iHandShake($menuiconsize), "clients"],
    ["Contact", "contact", iHeadset($menuiconsize), "contact"],
];



/* // Too much processing
// To check page control (in menu items - side nav bar)
$stmt = $pdo->prepare("SELECT page FROM user_page_access WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$access = $stmt->fetchAll(PDO::FETCH_COLUMN);

$filteredMenuItems = array_map(function ($item) use ($access) {
    // Check if the item's title (lowercase) exists in the access array
    $itemExists = in_array(strtolower($item[1]), $access);
    // Update the last value to true if the item exists, otherwise keep it as it is
    $item[3] = $itemExists;
    return $item;
}, $menuitems);

$currentPage = pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME);

$menunames = array_map(function ($item) {
    return $item[3] ? $item[1] : null;
}, $filteredMenuItems);
*/

$access_pages = $_SESSION['access_pages'];

$exist = in_array($pageCategory, $access_pages) || $pageCategory == "*";

$currentPage = pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME);

$allowedPages = ["no_access", "intro", "guide"];

if (!$exist && !in_array($currentPage, $allowedPages)) {
    header("HTTP/1.0 404 not found");
    exit();
}

$UAC_LABEL = findLevel($UAC);

// Adding menu items that will be static to all the users
array_push($menuitems, ["Settings", "settings", iSettings($menuiconsize)])
?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title><?= $title ?> | Content Panel</title>

    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <meta name="robots" content="noindex">

    <link rel="stylesheet" href="<?= $root ?>css/main.css">
    <script src="main.js" defer></script>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="admin bg-white text-slate-800 dark:text-slate-200 dark:bg-slate-900 min-h-screen dashboard">
    <?php include_once "components/dev.php"; ?>
    <header class="px-4 sm:px-8 py-2 overflow-hidden flex justify-between items-center gap-8 border-b border-slate-300 dark:border-slate-700">
        <a href="./" class="flex items-center justify-start gap-2">
            <img src="logo.webp" alt="CMS Logo" width="256px" height="256px" class="w-10">
            <h2 class="text-sm sm:text-lg md:text-xl font-semibold text-slate-600 dark:text-slate-200 leading-tight">Content Panel <span class="text-xs opacity-80 font-normal scale-75 hidden">v0.3</span></h2>
        </a>
        <div class="flex gap-2 items-center h-full">
            <p title="User Type" class="select-none bg-blue-100/80 dark:bg-slate-800/80 text-xs font-semibold px-4 py-2 rounded-xl me-2">
                <?= $UAC_LABEL ?>
            </p>
            <!-- Dark mode toggle switch -->
            <div class="text-gray-800 dark:text-gray-400 flex items-center gap-3">
                <button title="Change theme (light)" onclick="switchTheme('light')" class="hidden dark:block p-2 text-gray-300 font-medium hover:bg-blue-600/5 focus:bg-blue-600/5 active:bg-blue-600/20 rounded-full focus:outline-none focus:ring-2 ring-offset-2 ring-blue-300 dark:ring-offset-gray-800 transition-all">
                    <?= iLight('1.2rem') ?>
                </button>
                <button title="Change theme (dark)" onclick="switchTheme('dark')" class="block dark:hidden p-2 text-gray-600 font-medium hover:bg-blue-600/5 focus:bg-blue-600/5 active:bg-blue-600/20 rounded-full focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 ring-blue-300 transition-all">
                    <?= iDark('1.2rem') ?>
                </button>
                <a title="Logout" href="modules/logout.php" onclick="" class="rotate-45 p-2 text-gray-600 dark:text-gray-300 font-medium hover:bg-red-400/10 focus:bg-red-400/10 active:bg-red-400/20 rounded-full focus:outline-none focus:ring-2 ring-red-600/60 ring-offset-2 dark:ring-red-300 dark:ring-offset-gray-800 transition-all">
                    <?= iLogout2('1.2rem') ?>
                </a>
            </div>
        </div>
    </header>
    <aside class="pt-4 flex flex-col gap-0 px-2.5 sm:px-4 border-e border-slate-300 dark:border-slate-700">
        <div class="sticky top-5">
            <?php
            foreach ($menuitems as $ic => $item) {
                if (!empty($item[3])) {
                    if (!in_array($item[3], $access_pages)) continue;
                }
            ?>

                <a class="<?= $ic == $active - 1 ? 'active' : '' ?> text-slate-600 dark:text-slate-400 flex items-center justify-start gap-2 py-3.5 px-3 rounded-lg font-medium text-sm hover:bg-slate-200/60 dark:hover:bg-slate-800/60 focus:outline-none focus:bg-slate-200/60 dark:focus:bg-slate-800/60 relative"
                    href="<?= $item[1] ?>">
                    <span class="scale-110 sm:scale-100">
                        <?= $item[2] ?? '' ?>
                    </span>
                    <span class="hidden sm:inline">
                        <?= $item[0] ?>
                    </span>
                </a>
            <?php
            }
            ?>
        </div>

    </aside>
    <main class="bg-white md:bg-blue-50/80 dark:bg-slate-900 dark:md:bg-slate-800 w-full relative load-animation transition-opacity duration-200 <?= !isset($fullpage) ? 'p-8' : '' ?>">
        <section class="mx-auto <?= isset($fullpage) ? 'h-full w-full' : 'md:w-11/12 md:max-w-[1400px]' ?>">