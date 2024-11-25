<?php
include("api/config.php");
include("assets/icon.php");
require_once 'admin/includes/functions.php'; // Functions form the admin

$job_id = base64UrlDecode($_GET['jb']) ?? '';
$stmt = $pdo->prepare("SELECT title FROM jobs WHERE id = ?");
$stmt->execute([$job_id]);
$data = $stmt->fetch();

// Read and decode the JSON file for country code
$jsonFile = 'api/country_code.json';
$jsonData = file_get_contents($jsonFile);
$countries = json_decode($jsonData, true);

if ($data) {
    $job_name = $data['title'];
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
    <section class="container mx-auto mt-16 grid place-items-center">
        <div class="bg-white p-5 rounded-xl max-w-[600px]">
            <h2 class="font-bold text-2xl mb-10">Applying job for <span class="text-pmblue"><?= $job_name ?></span></h2>
            <form action="api/job_apply.php?jid=<?= base64UrlEncode($job_id) ?>&jbn=<?= urlencode($job_name) ?>" method="post" enctype="multipart/form-data" class="flex flex-col gap-8">
                <input type="hidden" style="display: none;" name="job_name" value="<?= $job_name ?>">
                <div class="w-full flex flex-col gap-2">
                    <label class="font-medium" for="name">Name:</label>
                    <input type="text" id="name" name="name" class="txt_secondary" placeholder="eg. John Doe" autofocus required>
                </div>

                <div class="w-full flex flex-col gap-2">
                    <label class="font-medium" for="phone">Phone number:</label>
                    <div class="flex gap-2">
                        <select name="country_code" id="country_code" class="txt_secondary w-32">
                            <?php
                            foreach ($countries as $country) {
                                $countryName = htmlspecialchars($country['code'], ENT_QUOTES, 'UTF-8');
                                $countryCode = htmlspecialchars($country['dial_code'], ENT_QUOTES, 'UTF-8');
                                $selectedy = $countryName == "IN" ? 'selected' : '';
                                echo "<option value=\"$countryCode\" $selectedy>$countryName ($countryCode)</option>";
                            }
                            ?>
                        </select>
                        <input type="tel" id="phone" name="phone" pattern="^[0-9\s]*$" title="Please enter only numbers" class="txt_secondary w-full" maxlength="10" placeholder="eg. 7085472598" required>
                    </div>
                </div>

                <div class="w-full flex flex-col gap-2">
                    <label class="font-medium" for="email">Email:</label>
                    <input type="email" id="email" name="email" class="txt_secondary" placeholder="eg. someone@example.com" required>
                </div>

                <div class="w-full flex flex-col gap-2">
                    <label class="font-medium" for="resume">Upload Resume:</label>
                    <label for="resume" class="txt_secondary relative">
                        <div class="w-full flex items-center gap-4">
                            <p class="opacity-80 my-2 select-none pointer-events-none"><?= iUpload('2.5rem') ?></p>
                            <input type="file" id="resume" name="resume" accept=".pdf, .doc, .docx" class="inpb w-full text-center" required>
                        </div>
                    </label>
                </div>
                <div class="w-full flex justify-center">
                    <input type="submit" value="Submit application" class="w-full cursor-pointer bg-sky-700 hover:bg-sky-500 transition-colors focus:outline-none focus:ring-4 focus:ring-btnSend/30 rounded-lg px-4 py-2 sm:px-5 sm:py-3 text-left flex gap-2 justify-center items-center text-white mt-8 font-medium">
                </div>
            </form>
        </div>
    </section>

<?php } else {
?>
    <section class="container mx-auto mt-24 grid place-items-center px-4">
        <p>The job is no more available to apply. Please re-direct to <a href="<?= $root ?>/careers" class="text-pmblue underline">careers</a> to see the current open positions.</p>
    </section>
<?php
} ?>

</body>
</html>