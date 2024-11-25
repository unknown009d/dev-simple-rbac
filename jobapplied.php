<?php
include('assets/icon.php');

$success = $_GET['success'] ?? false;
$job_name = $_GET['jbn'];
$job_error = $_GET['error'];

if ($success) {
    $iconS =  iCircleTick('5rem', '1');
    $title = "Application Submitted Successfully!";
    $desc = "Thank you for applying for $job_name position. Your application has been successfully received. Our team will review your details, and if your qualifications match our requirements, we will be in touch soon. We appreciate your interest in joining us.";
    $error = false;
} else {
    $iconS = iCircleX('5rem', '1');
    $title = "Oops! Something Went Wrong.";
    $desc = "We apologize, but there was an error submitting your application. Please try again later. If the problem persists, <a href=\"\" class=\"underline text-pmblue\">contact</a> us.";
    $error = iEx('1.2rem') . $job_error;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dummy Website</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <section class="max-w-[620px] mx-auto mt-24 bg-white px-8 py-12 rounded-xl flex flex-col items-center justify-center text-center">
        <div class="">
            <?= $iconS ?>
        </div>
        <h2 class="mt-5 font-bold text-2xl"><?= $title ?></h2>
        <p class="mt-4 font-medium"><?= $desc ?></p>
        <p class="<?php if (!$error) echo 'hidden'; ?> font-medium mt-8 flex gap-2 bg-yellow-100 rounded-xl py-3 px-6"><?= $error ?></p>
    </section>
</body>
</html>