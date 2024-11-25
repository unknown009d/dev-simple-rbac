<?php
require_once "config.php";
require_once "icon.php";
require_once 'functions.php';

// Get base URL from environment
$baseURL = getenv("URL_BASE");

date_default_timezone_set('Asia/Kolkata');

// Initialize done
$done = isset($_GET['done']) ? $_GET['done'] : false;

// Handle form submission and password reset request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_link']) && !$done) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() > 0) {
        // Email exists, generate a unique token
        $token = bin2hex(random_bytes(32)); // 64-character token
        $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour

        // Insert token into password_resets table (or update if entry exists)
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) 
                               VALUES (:email, :token, :expires_at)
                               ON DUPLICATE KEY UPDATE token = :token, expires_at = :expires_at");
        $stmt->execute([
            'email' => $email,
            'token' => $token,
            'expires_at' => $expiryTime
        ]);

        // Construct reset link
        $resetLink = $baseURL . "reset-password?token=" . $token;

        // Send the reset link via email
        $subject = "Password Reset Request";
        $message = "Link to reset your password: $resetLink";
        mail($email, $subject, $message);

        header("Location: " . $_SERVER['PHP_SELF'] . "?done=true");
    } else {
        // Optionally: Log or handle the case where the email doesn't exist.
        header("Location: " . $_SERVER['PHP_SELF'] . "?done=false");
    }
}
$reqfordarktheme = isset($_GET['done']);

$root = getenv("ROOT_DIR");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_POST['send_link']) && !$done): ?>
                <div class="flex flex-col justify-start items-start gap-2">
                    <a href="login"><img class="w-auto h-16 mb-2" src="logo.webp" alt="XYZ Logo"></a>
                    <h3 class="text-4xl font-medium text-center md:text-left text-gray-800 dark:text-gray-200">Account recovery</h3>
                    <h3 class="text-left md:text-left text-gray-600 dark:text-gray-200/80 text-md mt-2 md:w-96">Please enter your registered email to make sure you get the reset link</h3>
                </div>

                <form action="" method="post" class="lg:w-[420px] <?= $msg ? 'pt-0' : 'pt-4' ?>">
                    <div class="flex flex-col gap-2 mt-4 md:mt-20">
                        <div class="mt-4 w-full ring-1 ring-gray-400 rounded dark:bg-gray-900 dark:ring-gray-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="email" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Email
                            </label>
                            <input tabindex="1" class="block p-4 w-full text-gray-700 dark:text-gray-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="email" placeholder="" aria-label="Email" name="email" id="email" value="" autofocus required />
                        </div>
                    </div>

                    <div class="flex items-center justify-between md:justify-end gap-2 mt-8 md:mt-28">
                        <a href="login" class="text-sm px-6 py-2.5 text-blue-600 dark:text-blue-300 font-medium hover:bg-blue-600/5 focus:bg-blue-600/5 active:bg-blue-600/20 rounded-full focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 transition-all flex gap-2">Go Back</a>
                        <button tabindex="1" type="submit" name="send_link" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Continue</button>
                    </div>
                </form>
            <?php else: ?>
                <?php
                if ($done): ?>
                    <div class="flex flex-col items-start gap-2 mb-36">
                        <a href="login"><img class="w-auto h-16 mb-2" src="logo.webp" alt="XYZ Logo"></a>
                        <h3 class="text-4xl font-medium text-center md:text-left text-gray-800 dark:text-gray-200">Account recovery</h3>
                        <h3 class="text-left md:text-left text-gray-600 dark:text-gray-200/80 text-md mt-2 md:w-96">Password reset link has been sent to your email. You will be re-directed in <u id="seconds">5</u> seconds.</h3>
                    </div>
                    <script>
                        seconds = 5
                        setInterval(() => {
                            document.getElementById("seconds").textContent = seconds
                            if (seconds > 0) seconds--
                            else clearInterval()
                        }, 1000)
                        setTimeout(() => {
                            window.location.replace('login')
                        }, seconds * 1000)
                    </script>
                <?php
                endif; ?>
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