<?php
$title = 'Service';
$active = 3;
$pageCategory = "service";
require_once 'header.php';

$uploads_dir = 'uploads/';

$stmt = $pdo->prepare("SELECT * FROM static WHERE category = ?");
$stmt->execute(["services"]);
$service_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = $service_data[1]['content'];
$ptid = base64UrlEncode($service_data[1]['id']);

$service_title = $service_data[0]['content'];
$tid = base64UrlEncode($service_data[0]['id']);

$desc_title = $service_data[2]['content'] ?? "";
$did = base64UrlEncode($service_data[2]['id']);
$desc_max_length = 512;


$bannerpage = "service";
require_once "components/banneredit.php";

?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-0 border-dashed dark:border-slate-800 md:border-0 md:pt-6" id="service_text">
        <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>services" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">services</a> page</h4>
        <form action="modules/service_update.php?tid=<?= $tid ?>&ptid=<?= $ptid ?>&did=<?= $did ?>" id="update_service" method="POST" class="">
            <div class="flex flex-col justify-between w-full">
                <div class="flex flex-col justify-start items-start gap-8">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="page_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Header Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Header Title" name="page_title" id="page_title" value="<?= $page_title ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="service_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Service Title" name="service_title" id="service_title" value="<?= $service_title ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="service_title_desc" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Description
                        </label>
                        <textarea maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Service Description" name="service_title_desc" id="service_title_desc"><?= $desc_title ?></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="service_title_desc" data-max-characters="<?= $desc_max_length ?>"></div>

                <div class="flex justify-end items-center mt-6">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="flex flex-col md:flex-row gap-4 items-start justify-start border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="service_items">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full md:w-[400px]">
            <h4 class="mb-6 font-semibold">Add Service from here</h4>
            <form action="modules/service_insert.php?cat=<?= base64UrlEncode("service") ?>" method="POST" id="service_list" enctype="multipart/form-data" class="flex flex-col">
                <div class="mb-2 relative text-center h-52 w-full lg:w-80 rounded-2xl border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload overflow-hidden">
                    <label for="pimg" class="font-medium select-none grid place-items-center text-blue-500 dark:text-blue-200">
                        <span class=""><?= iUpload('4rem') ?></span>
                        Drag & Drop Image Or Browse
                    </label>
                    <input type="file" name="sectionimg" id="pimg" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'pimg')" oninput="checkImage(this, false, true)" required>
                    <img src="" alt="Image Preview" style="display:none; z-index: 2;" class="object-cover h-full w-full">
                </div>
                <div class="flex flex-col gap-6">
                    <div class="mt-6 w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="service_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Title
                        </label>
                        <input tabindex="1" autocomplete="off" title="Service title" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Service Title" name="title" id="service_title" value="" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="service_description" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Description
                        </label>
                        <textarea autocomplete="off" maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Service Description" name="description" id="service_description" required></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="service_description" data-max-characters="<?= $desc_max_length ?>"></div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" tabindex="1">
                        Publish service
                    </button>
                </div>
            </form>
        </section>

        <?php
        $search_text = htmlspecialchars($_GET['q'] ?? '');
        $stmt = $pdo->prepare("SELECT * FROM services WHERE title LIKE ? AND category = ? ORDER BY id ASC");
        $stmt->execute(["%$search_text%", "services"]);
        $dataset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <section class="bg-white dark:bg-slate-900 rounded-xl w-full md:p-6 mt-10 md:mt-0">
            <form action="" method="GET" class="flex gap-4 items-center justify-start w-full mb-5">
                <label for="searchtext" action="" method="GET" class="w-full cursor-text border-2 py-3.5 px-3 md:px-6 flex items-center justify-start gap-4 border-slate-200 dark:border-slate-600 rounded-lg focus-within:border-slate-400 dark:focus-within:border-slate-400 transition-colors">
                    <label for="searchtext" class="opacity-50"><?= iSearch('1.2rem') ?></label>
                    <input type="search" name="q" id="searchtext" tabindex="1" class="h-full focus:outline-none bg-transparent w-full"
                        autocomplete="off" value="<?= $search_text ?>" oninput="if(this.value.length < 1) this.form.submit()"
                        placeholder="Search service here..." required>
                </label>
                <button type="submit" tabindex="1" class="text-sm px-2 md:px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-lg hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">Search</button>
            </form>
            <?php
            if (count($dataset) > 0) { ?>
                <div class="cards-container text-center mt-8">
                    <?php foreach ($dataset as $in => $item) { ?>
                        <div class="w-full bg-white dark:bg-slate-800 shadow rounded-2xl overflow-hidden relative text-left" title="<?= $item['title'] ?>">
                            <form action="modules/service_delete.php?id='<?= base64UrlEncode($item['id']) ?>'&cat='<?= base64UrlEncode("services") ?>'" id="form_delete_item_<?= $in ?>" method="POST">
                                <button type="submit" class="delete-button absolute top-2 right-2 bg-red-500 hover:bg-red-400 focus:bg-red-500 active:bg-red-500 p-2 rounded-full text-white transition-all duration-300" title="Delete item">
                                    <?= iTrash('1.2rem') ?>
                                </button>
                            </form>
                            <div class="w-full h-44">
                                <img src="<?= $root . $uploads_dir . $item['image'] ?>" class="h-full w-full object-cover" alt="<?= $item['title'] ?>">
                            </div>
                            <div class="py-4 px-3">
                                <h4 class="text-base pb-2 font-bold leading-5">
                                    <?= $item['title'] ?>
                                </h4>
                                <p class="text-xs">
                                    <?= $item['description'] ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="w-full text-center opacity-50 flex flex-col lg:flex-row justify-center items-center gap-2 py-16 px-4">
                    <?= iSad("1.5rem") ?>
                    There are no services published yet.
                </div>
            <?php } ?>
        </section>
    </article>
<?php endif; ?>

<br><br>

<?php /* For Notification */ $msg = $_SESSION["msg_text"] ?? null; ?>

<div class="<?= !$msg ? 'hidden' : '' ?> fixed bottom-8 right-8 flex gap-3 items-center py-3 px-6 pe-3 bg-white dark:bg-neutral-950 text-slate-600 dark:text-slate-300 rounded-md msganim shadow" style="z-index: 10;">
    <p class="font-medium"><?= htmlspecialchars($msg) ?? '' ?></p>
    <button title='close-notification' type='button' onclick='this.parentNode.parentNode.removeChild(this.parentNode)' class='opacity-80 ms-4 hover:bg-slate-900/5 dark:hover:bg-slate-100/5 active:bg-slate-900/10 dark:active:bg-slate-100/10 rounded-full p-2'><?= iClose('1.2rem') ?></button>
</div>

<?php unset($_SESSION["msg_text"]); ?>

<?php
require_once 'footer.php';
?>