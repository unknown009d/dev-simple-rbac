<?php
$title = "Home";
$active = 1;
$pageCategory = "dashboard";
require_once "header.php";

$stmt = $pdo->prepare("SELECT id,content FROM static WHERE category = ?");
$stmt->execute(["home"]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title_text = $data[0]['content'];
$tid = base64UrlEncode($data[0]['id']);

$subtitle_text = $data[1]['content'];
$stid = base64UrlEncode($data[1]['id']);


$stmt = $pdo->prepare("SELECT * FROM dual_data WHERE cat = ?");
$stmt->execute(["stats"]);
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$desc_max_length = 512;

?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 mb-6 md:mb-12 rounded-xl w-full">
        <div class="flex flex-row mb-4 md:mb-2 md:flex-row justify-between items-center md:items-start">
            <h4 class="text-sm md:text-base font-semibold">Change Company logo</h4>
            <form method="post" action="modules/reset_logo.php" class="" id="reset_logo">
                <button type="submit" title="Reset your current logo to the previous saved logo"
                    class="text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-full hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">
                    Reset logo
                </button>
            </form>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
            <form action="modules/upload_logo.php" method="post" enctype="multipart/form-data" class="w-full lg:w-auto">
                <div class="relative text-center p-4 h-52 w-full lg:w-80 rounded-2xl border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload overflow-hidden">
                    <label for="logoimg" class="font-medium select-none grid place-items-center text-blue-500 dark:text-blue-200">
                        <span class=""><?= iUpload('4rem') ?></span>
                        Drag & Drop Image Or Browse
                    </label>
                    <input type="file" name="logo" id="logoimg" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'logoimg')" oninput="checkImage(this, true, true)" required>
                    <img src="" alt="Logo Preview" style="display:none; z-index: 2;" class="object-contain h-full w-full">
                </div>
                <button type="submit" class="cursor-pointer mt-5 text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" style="display: none;">
                    Upload
                </button>
            </form>
            <div class="checkboard h-52 w-full md:w-80 rounded-2xl relative">
                <p class="font-medium text-xs md:text-sm absolute top-0 left-0 m-2 py-1 px-3 rounded-full bg-blue-500 dark:bg-blue-300 text-white dark:text-slate-900">Current Logo</p>
                <img src="<?= $root ?>uploads/header_logo.webp?<?= time(); ?>" alt="XYZ Logo" class="w-full h-full object-contain">
            </div>
        </div>
        <p class="text-slate-500 text-xs mt-4">* Changes are not updated in the main site due to cache. Please hard-reload the website for immediate preview.</p>
    </article>
<?php endif; ?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="hero_content">
        <h4 class="text-sm md:text-base font-semibold">Update the contents of <a href="<?= $root ?>" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">home</a> page</h4>
        <div class="grid md:grid-cols-2 gap-8 items-start mt-8">
            <form action="modules/hero_content_update.php?tid=<?= $tid ?>&stid=<?= $stid ?>" id="update_solution" method="POST" class="flex flex-col gap-6 order-2 md:order-none mt-2">
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col justify-start items-start gap-8 w-full">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="hero_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Content Title
                            </label>
                            <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Hero Title" name="hero_title" id="hero_title" value="<?= $title_text ?>" required />
                        </div>
                    </div>
                    <div class="flex flex-col justify-start items-start gap-8 w-full">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="hero_sub_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Content Description
                            </label>
                            <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Hero Sub Title" name="hero_sub_title" id="hero_sub_title" value="<?= $subtitle_text ?>" required />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center mt-4">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </form>
            <form method="POST" action="modules/hero_image_update.php" enctype="multipart/form-data" id="changeHeroImage" class="flex flex-col gap-4 items-end">
                <div class="overflow-hidden rounded-xl w-full h-80 relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                    <input type="file" name="heroimg" id="heroimg" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'heroimg', true)" oninput="checkImage(this, true, false, true)" required>
                    <img src="<?= $updir ?>uploads/hsimg.webp?<?= time() ?>" alt="Hero Section Image" class="h-full w-full object-cover">
                    <span class="editbtn">
                        <?= iPen('1.4rem') ?>
                    </span>
                </div>
                <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" style="display: none;">Upload</button>
            </form>
        </div>
    </article>
<?php endif; ?>

<?php
if ($UAC <= 2):
    $stmt = $pdo->prepare("SELECT * FROM dual_data WHERE cat = ?");
    $stmt->execute(["focus"]);
    $f_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
    <article class="md:bg-white dark:md:bg-slate-900 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 md:px-6" id="company_focus">
        <h4 class="text-sm md:text-base font-semibold py-6">Update the contents of <a href="<?= $root ?>#focus" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">focus</a> page</h4>
        <form action="modules/focus_update.php" method="POST" id="focus_update" class="">
            <div class="flex flex-col md:flex-row gap-4 w-full">
                <?php foreach ($f_data as $in => $item) { ?>
                    <div class="w-full <?= count($f_data) > $in + 1 ? 'border-b pb-4 md:border-e md:border-b-0 md:pe-4 md:pb-0' : '' ?> border-slate-300 dark:border-slate-700 border-dashed py-6 flex flex-col gap-6">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="f_title_<?= intval($in) ?>" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Title
                            </label>
                            <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Title" name="f_title[]" id="f_title_<?= intval($in) ?>" value="<?= $item['title'] ?>" required />
                        </div>
                        <div>
                            <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                                <label for="f_desc_<?= intval($in) ?>" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                    Description
                                </label>
                                <textarea maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Description" name="description[]" id="f_desc_<?= intval($in) ?>" required><?= $item['content'] ?></textarea>
                            </div>
                            <div class="flex justify-end items-center opacity-60 text-xs mt-4" data-character-count data-textarea-id="f_desc_<?= intval($in) ?>" data-max-characters="<?= $desc_max_length ?>"></div>
                        </div>
                        <input type="hidden" name="cid[]" value="<?= base64_encode($item['id']) ?>">
                    </div>
                <?php } ?>
            </div>
            <div class="pb-6 pt-4 flex justify-end items-center">
                <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                    Update
                </button>
            </div>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="aboutimage">
        <h4 class="mb-8 font-semibold">You can update the images of <a href="<?= $root ?>#about" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">about</a> section</h4>
        <form action="modules/update_image_about.php" enctype="multipart/form-data" id="update_about_image" method="POST">
            <div class="flex flex-col md:flex-row items-center justify-start gap-4">
                <div class="w-full text-center">
                    <div class="overflow-hidden rounded-xl w-full h-72 relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                        <input type="file" name="about_home_top_img" id="about_home_top_img" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                            onchange="setupImagePreview(this, 'about_home_top_img', true)" oninput="checkImage(this, false, false, true)">
                        <img src="<?= $updir ?>uploads/about_home_top.webp?<?= time() ?>" alt="About Top Image" class="h-full w-full object-cover">
                        <span class="editbtn">
                            <?= iPen('1.4rem') ?>
                        </span>
                    </div>
                    <small class="opacity-60">1920 x 1280 px (for accurate results)</small>
                </div>
                <div class="w-full text-center">
                    <div class="overflow-hidden rounded-xl w-full h-72 relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                        <input type="file" name="about_home_left_img" id="about_home_left_img" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                            onchange="setupImagePreview(this, 'about_home_left_img', true)" oninput="checkImage(this, false, false, true)">
                        <img src="<?= $updir ?>uploads/about_home_left.webp?<?= time() ?>" alt="About Left Side Image" class="h-full w-full object-cover">
                        <span class="editbtn">
                            <?= iPen('1.4rem') ?>
                        </span>
                    </div>
                    <small class="opacity-60">1024 x 683 px (for accurate results)</small>
                </div>
                <div class="w-full text-center">
                    <div class="overflow-hidden rounded-xl w-full h-72 relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                        <input type="file" name="about_home_right_img" id="about_home_right_img" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                            onchange="setupImagePreview(this, 'about_home_right_img', true)" oninput="checkImage(this, false, false, true)">
                        <img src="<?= $updir ?>uploads/about_home_right.webp?<?= time() ?>" alt="About Right Side Image" class="h-full w-full object-cover">
                        <span class="editbtn">
                            <?= iPen('1.4rem') ?>
                        </span>
                    </div>
                    <small class="opacity-60">994 x 661 px (for accurate results)</small>
                </div>
            </div>
            <div class="flex items-center justify-end mt-8">
                <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                    Update
                </button>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="stats">
        <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>#stats" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">stats</a> section</h4>
        <div class="flex flex-col lg:grid lg:grid-cols-6 gap-8 items-stretch lg:items-start mt-8">
            <form action="modules/stats_insert.php?" id="insert_stats" method="POST" class="flex flex-col gap-6 mt-2 col-span-2 w-full">
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col justify-start items-start gap-8 w-full">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="metric_value" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Mertic Value
                            </label>
                            <input tabindex="1" autocomplete="off" maxlength="20" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Metric Value" name="metric_value" id="metric_value" value="" required />
                        </div>
                    </div>
                    <div class="flex flex-col justify-start items-start gap-8 w-full">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="metric_label" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Metric Label
                            </label>
                            <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Metric Label" name="metric_label" id="metric_label" value="" required />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center mt-4">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Publish</button>
                </div>
            </form>
            <div class="col-span-4 bg-blue-50 dark:bg-slate-800 h-full rounded-xl p-10">
                <div class="container mx-auto flex flex-row justify-start items-center w-full flex-wrap gap-2 md:gap-8">
                    <?php foreach ($stats as $in => $stat) { ?>
                        <div class="flex flex-col justify-center items-center text-center bg-white/80 dark:bg-black/20 p-4 rounded-2xl relative">
                            <h2 class="text-2xl md:text-5xl font-black"><?= $stat['content'] ?></h2>
                            <p class="text-xs md:text-base text-sky-500 dark:text-sky-300 font-semibold"><?= $stat['title'] ?></p>
                            <form action="modules/stats_delete.php?id=<?= $stat['id'] ?>" id="form_delete_stats_<?= $in ?>" method="POST">
                                <button type="submit" class="delete-button absolute top-2 right-2 bg-red-500 hover:bg-red-400 focus:bg-red-500 active:bg-red-500 p-2 rounded-full text-white transition-all duration-300" title="Delete item">
                                    <?= iTrash('1.2rem') ?>
                                </button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </article>
<?php endif; ?>

<?php /* For Notification */ $msg = $_SESSION["msg_text"] ?? null; ?>

<div class="<?= !$msg ? 'hidden' : '' ?> fixed bottom-8 right-8 flex gap-3 items-center py-3 px-6 pe-3 bg-white dark:bg-neutral-950 text-slate-600 dark:text-slate-300 rounded-md msganim shadow" style="z-index: 10;">
    <p class="font-medium"><?= htmlspecialchars($msg) ?? '' ?></p>
    <button title='close-notification' type='button' onclick='this.parentNode.parentNode.removeChild(this.parentNode)' class='opacity-80 ms-4 hover:bg-slate-900/5 dark:hover:bg-slate-100/5 active:bg-slate-900/10 dark:active:bg-slate-100/10 rounded-full p-2'><?= iClose('1.2rem') ?></button>
</div>

<?php unset($_SESSION["msg_text"]); ?>

<?php

require_once "footer.php";
?>