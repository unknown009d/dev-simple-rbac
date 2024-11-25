<?php 

$logo_loc_upload = '/uploads/header_logo.webp';
$logo = $logo_loc_upload;
$root = getenv("ROOT_DIR");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dummy Website</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= $root ?>/css/main.css">
</head>
<body class="p-4 flex flex-col gap-4 text-center" style="place-items: center;">
    <div class="flex flex-col justify-center items-center">
        <img src="<?= $root ?><?= $logo ?>" alt="Web Page Logo" style="height: 120px; width: 120px">
        <i class="text-xs">*This image will change from the admin panel</i>
    </div>
    <div>
        <p style="font-weight: medium">
            Due to specific reasons I cannot display the current website.
        </p>
        <a href="admin/" class="text-blue-500 underline">Here is the admin panel you are looking for.</a>
        <br>
        <a href="jobs.php" class="text-blue-500 underline">Here is the portal for applying in jobs</a>
    </div>
</body>
</html>