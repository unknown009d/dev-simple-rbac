<?php
require_once "config.php";
require_once "functions.php";
require_once "icon.php";

// Get the token from the URL
$token = $_GET['token'] ?? '';

// Check if the token is valid and not expired
$stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = :token AND expires_at > NOW()");
$stmt->execute(['token' => $token]);

if ($stmt->rowCount() > 0) {
    // Token is valid, display the reset password form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle password reset
        $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $stmt->fetch()['email'];

        // Update the user's password in the database
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
        $stmt->execute(['password' => $newPassword, 'email' => $email]);

        // Delete the token from the database to prevent reuse
        $stmt = $pdo->prepare("DELETE FROM password_resets WHERE email = :email");
        $stmt->execute(['email' => $email]);

        header("Location: reset-mail-success.php?message=" . urlencode("Your password has been changed, you can close this tab."));
        exit();
    }
} elseif (!empty($_GET['token'])) {
    header("Location: reset-mail-success.php?message=" . urlencode("Invalid or expired token."));
    exit();
} else {
    header("HTTP/1.0 404 not found");
    exit();
}

$root = getenv("ROOT_DIR");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            <div class="flex flex-col justify-start items-start gap-2">
                <a href="login"><img class="w-auto h-16 mb-2" src="logo.webp" alt="XYZ Logo"></a>
                <h3 class="text-4xl font-medium text-center md:text-left text-gray-800 dark:text-gray-200">Change password</h3>
                <h3 class="text-left md:text-left text-gray-600 dark:text-gray-200/80 text-md mt-2 md:w-96">Please enter your new password</h3>
            </div>
            <?php if ($stmt->rowCount() > 0): ?>
                <form action="" method="POST" class="lg:w-[420px] mt-4 md:mt-20">
                    <div class="flex justify-between items-center gap-2 mt-4 w-full ring-1 ring-gray-400 rounded dark:bg-gray-900 dark:ring-gray-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="password" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            New Password
                        </label>
                        <input tabindex="1" class="block p-4 w-full text-gray-700 dark:text-gray-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded"
                            type="password" placeholder="" aria-label="Password" name="password" id="password" autocomplete="new-password" required />
                        <button type="button" id="showpassword" class="p-2 me-2 rounded-full text-gray-600 hover:bg-blue-100 focus:bg-blue-600/5 focus:outline-none active:bg-blue-600/20 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:bg-gray-700/5 dark:active:bg-gray-700/20 focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 transition-all">
                            <span class=""><?= iEyeOff("1.3rem") ?></span>
                            <span class="hidden"><?= iEye("1.3rem") ?></span>
                        </button>
                    </div>

                    <div class="flex items-center justify-end gap-2 mt-8 md:mt-28">
                        <button tabindex="1" type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Change password</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-5 flex justify-between items-center w-full lg:w-10/12 xl:w-8/12 max-w-[1200px] px-4">
        <p class="text-xs text-gray-400 dark:text-gray-600 font-medium ms-4">Designed & Developed by <a href="https://unknown009d.github.io" target="_blank" class="border-b border-dashed border-gray-400 dark:border-gray-600">Drubajyoti</a></p>
        <div class="text-gray-800 dark:text-gray-400 me-4 flex items-center gap-2">
            <button title="Change theme (light)" onclick="switchTheme('light')" class="hidden dark:block p-2 text-gray-300 font-medium hover:bg-blue-600/5 focus:bg-blue-600/5 active:bg-blue-600/20 rounded-full focus:outline-none focus:ring-2 ring-offset-2 ring-blue-300 ring-offset-gray-800 transition-all" <?= $reqfordarktheme ? "disabled" : "" ?>>
                <?= iLight('1.2rem') ?>
            </button>
            <button title="Change theme (dark)" onclick="switchTheme('dark')" class="block dark:hidden p-2 text-gray-600 dark:text-blue-300 font-medium hover:bg-blue-600/5 focus:bg-blue-600/5 active:bg-blue-600/20 rounded-full focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 transition-all" <?= $reqfordarktheme ? "disabled" : "" ?>>
                <?= iDark('1.2rem') ?>
            </button>
        </div>
    </div>
</body>

</html>