<?php require_once 'config.php'; ?>
<?php require_once 'functions.php'; ?>
<?php session_start();
include('../assets/icon.php');
?>

<?php if (is_logged_in()) {
  header("Location: intro");
  exit;
}

$msg = $_GET["message"];
$def_username = $_GET["username"];

$root = getenv("ROOT_DIR");
?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | XYZ</title>
  <link rel="stylesheet" href="<?= $root ?>css/main.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <meta name="robots" content="noindex">
  <script src="main.js" defer></script>
  <script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }
  </script>
</head>

<body class="admin bg-white sm:bg-slate-100 dark:bg-gray-900 sm:dark:bg-gray-800 h-screen flex flex-col justify-between pb-8 sm:justify-center items-center sm:px-20">
  <?php include_once "components/dev.php"; ?>
  <div class="w-full lg:w-10/12 xl:w-8/12 max-w-[1200px] overflow-hidden sm:bg-white sm:rounded-3xl sm:shadow-sm dark:bg-gray-900 sm:px-5 py-8">
    <div class="px-6 flex flex-col md:flex-row justify-between">
      <div class="flex flex-col items-start gap-2">
        <a href="login"><img class="w-auto h-16 mb-2" src="logo.webp" alt="XYZ Logo"></a>
        <h3 class="text-5xl font-medium text-center md:text-left text-gray-800 dark:text-gray-200">Sign in</h3>
        <h3 class="text-center md:text-left text-gray-600 dark:text-gray-200/80 text-md mt-2">Please enter your Credentials</h3>
      </div>

      <form action="modules/authenticate.php" method="post" class="lg:w-[420px] <?= $msg ? 'pt-0' : 'pt-4' ?>">
        <?php
        if ($msg) {
        ?>
          <div class="font-medium mt-6 flex gap-2 justify-between items-center text-red-600 dark:text-gray-900 bg-red-100 dark:bg-red-400 text-sm px-6 py-3 rounded-lg mb-4" id="error-msg">
            <p class="flex gap-2"><?= iEx('1.2rem') ?> <?= $msg ?></p>
            <button type="button" onclick="document.getElementById('error-msg').classList.add('hidden');"
              class="p-1 rounded-full focus:outline-none hover:bg-red-200 focus:bg-red-200 focus:ring-2 ring-red-500/60 ring-offset-2 ring-offset-red-100 dark:ring-red-300 dark:ring-offset-gray-800 transition-all">
              <?= iClose() ?>
            </button>
          </div>
        <?php
        } ?>
        <div class="flex flex-col gap-2">
          <div class="mt-4 w-full ring-1 ring-gray-400 rounded dark:bg-gray-900 dark:ring-gray-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
            <label for="username" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
              Username
            </label>
            <input tabindex="1" class="block p-4 w-full text-gray-700 dark:text-gray-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Username" name="username" id="username" autofocus value="<?= $def_username ?>" required />
          </div>

          <div class="flex justify-between items-center gap-2 mt-4 w-full ring-1 ring-gray-400 rounded dark:bg-gray-900 dark:ring-gray-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
            <label for="password" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
              Password
            </label>
            <input tabindex="1" class="block p-4 w-full text-gray-700 dark:text-gray-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded"
              type="password" placeholder="" aria-label="Password" name="password" id="password" required />
            <button type="button" id="showpassword" class="p-2 me-2 rounded-full text-gray-600 hover:bg-blue-100 focus:bg-blue-600/5 focus:outline-none active:bg-blue-600/20 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:bg-gray-700/5 dark:active:bg-gray-700/20 focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 transition-all">
              <span class=""><?= iEyeOff("1.3rem") ?></span>
              <span class="hidden"><?= iEye("1.3rem") ?></span>
            </button>
          </div>
        </div>

        <button type="button" id="remebtn" tabindex="1" class="w-fit text-black dark:text-white text-sm mt-6 px-3 py-2.5 flex justify-start items-center gap-3 rounded-full focus:outline-none focus:bg-blue-100 dark:focus:bg-gray-700 transition group focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:ring-transparent active:ring-transparent dark:hover:ring-transparent dark:active:ring-transparent">
          <label for="remember" class="text-white group-focus:text-blue-100 dark:text-gray-900 dark:group-focus:text-gray-700 rounded-sm ring-2 ring-gray-600 [&:has(~input:checked)]:ring-blue-600 dark:[&:has(~input:checked)]:ring-blue-300 [&:has(~input:checked)]:bg-blue-600 dark:[&:has(~input:checked)]:bg-blue-300 cursor-pointer transition-all">
            <?= iTick() ?>
          </label>
          <label for="remember" class="select-none font-medium text-sm cursor-pointer text-gray-800 dark:text-gray-200">Remember me</label>
          <input type="checkbox" name="remember" id="remember" class="hidden">
        </button>

        <div class="flex items-center justify-between md:justify-end gap-2 mt-14">
          <a href="change-password" class="text-sm px-6 py-2.5 text-blue-600 dark:text-blue-300 font-medium hover:bg-blue-600/5 focus:bg-blue-600/5 active:bg-blue-600/20 rounded-full focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 transition-all">Forgot password?</a>
          <button tabindex="1" type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Sign in</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mt-5 flex justify-between items-center w-full lg:w-10/12 xl:w-8/12 max-w-[1200px] px-4">
    <p class="text-xs text-gray-400 dark:text-gray-600 font-medium ms-4">Designed & Developed by <a href="https://unknown009d.github.io" target="_blank" class="border-b border-dashed border-gray-400 dark:border-gray-600">Drubajyoti</a></p>
    <div class="text-gray-800 dark:text-gray-400 me-4 flex items-center gap-2">
      <button title="Change theme (light)" onclick="switchTheme('light')" class="hidden dark:block p-2 text-gray-300 font-medium hover:bg-blue-600/5 focus:bg-blue-600/5 active:bg-blue-600/20 rounded-full focus:outline-none focus:ring-2 ring-offset-2 ring-blue-300 ring-offset-gray-800 transition-all">
        <?= iLight('1.2rem') ?>
      </button>
      <button title="Change theme (dark)" onclick="switchTheme('dark')" class="block dark:hidden p-2 text-gray-600 dark:text-blue-300 font-medium hover:bg-blue-600/5 focus:bg-blue-600/5 active:bg-blue-600/20 rounded-full focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 transition-all">
        <?= iDark('1.2rem') ?>
      </button>
    </div>
  </div>
  <script>
    // window.addEventListener('load', () => {
    //   if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    //     const usernameField = document.getElementById('username');
    //     if (usernameField) {
    //       usernameField.focus();
    //     }
    //   }
    // });
  </script>
</body>

</html>