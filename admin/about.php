<?php
$title = 'About';
$active = 2;
$pageCategory = 'about';
require_once 'header.php';


$stmt = $pdo->prepare("SELECT id, content FROM static WHERE category = ?");
$stmt->execute(['about']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$ast_id = base64UrlEncode(intval($data[0]['id'])); // ast_id => about_sub_title
$pt_id = base64UrlEncode(intval($data[1]['id'])); // pt_id => page_title
$about_sub_title = $data[0]['content'] ?? "";
$about_title = $data[1]['content'] ?? "";

$stmt = $pdo->prepare("SELECT id, content FROM static WHERE category = ?");
$stmt->execute(['approach']);
$apr_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$apr_id = base64UrlEncode(intval($apr_data[0]['id']));
$approach_title = $apr_data[0]['content'] ?? "";

$ast_max_length = 150; // ast => about_sub_title

$stmt = $pdo->prepare("SELECT * FROM items WHERE category = ?");
$stmt->execute(["about"]);
$about_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM items WHERE category = ?");
$stmt->execute(["approach"]);
$approach_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

$uploads_dir = 'uploads/';

$bannerpage = "about";
require_once "components/banneredit.php";

?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-0 border-dashed dark:border-slate-800 md:border-0 md:pt-6" id="about_text">
        <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>about" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">about</a> page</h4>
        <form action="modules/about_update.php?astid=<?= $ast_id ?>&ptid=<?= $pt_id ?>" id="update_about" method="POST" enctype="multipart/form-data" class="flex flex-col md:grid md:grid-cols-6 gap-6">
            <div class="col-span-2">
                <div class="overflow-hidden rounded-xl w-full h-72 relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                    <input type="file" name="aboutimg" id="aboutimg" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'aboutimg', true)" oninput="checkImage(this, false, false, true)">
                    <img src="<?= $updir ?>uploads/about.webp?<?= time() ?>" alt="About Section Image" class="h-full w-full object-cover">
                    <span class="editbtn">
                        <?= iPen('1.2rem') ?>
                    </span>
                </div>
            </div>
            <div class="col-span-4 flex flex-col justify-between">
                <div>
                    <div class="flex flex-col justify-start items-start gap-8">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="about_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Page Title
                            </label>
                            <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Page Title" name="about_title" id="about_title" value="<?= $about_title ?>" required />
                        </div>
                        <!-- <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="about_sub_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Page Sub Title
                        </label>
                        <input tabindex="1" maxlength="<?= $ast_max_length ?>" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Page Sub Title" name="about_sub_title" id="about_sub_title" value="<?= $about_sub_title ?>" required />
                    </div> -->
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="about_sub_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Page Sub Title
                            </label>
                            <textarea maxlength="<?= $ast_max_length ?>" rows="3" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Page Sub Title" name="about_sub_title" id="about_sub_title" required><?= $about_sub_title ?></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end items-center opacity-60 text-xs mt-4" data-character-count data-textarea-id="about_sub_title" data-max-characters="<?= $ast_max_length ?>"></div>
                </div>
                <div class="flex justify-end items-center mt-6">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="about_list">
        <h4 class="mb-1 font-semibold">You can update the items of <a href="<?= $root ?>#about_item" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">about</a> section</h4>
        <p class="text-slate-500 text-sm mb-2">Update the fields as needed. Empty fields will be removed. Please remember to save your changes.</p>
        <form action="modules/about_list_items.php" id="aboutlistitems" method="POST" class="flex flex-col gap-8 py-4">
            <div id="textbox-container" class="textbox-container">
                <?php foreach ($about_list as $in => $item) { ?>
                    <div class="textbox-row">
                        <input type="text" name="item_names[]" autocomplete="off" value="<?= htmlspecialchars_decode($item['item']); ?>">
                        <input type="hidden" name="item_hahahah[]" value="<?= base64_encode($item['id'])  ?>">
                        <button type="button" onclick="removeTextbox(this)"><?= iTrash('1.2rem') ?></button>
                    </div>
                <?php } ?>
            </div>
            <div class="flex justify-end gap-4 items-center">
                <button type="button" onclick="addNewTextbox('textbox-container')" class="text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-full hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">
                    Add Item
                </button>
                <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                    Save&nbsp;Changes
                </button>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="flex flex-col md:flex-row gap-4 items-start justify-start mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="goals_items">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full md:w-[400px]">
            <h4 class="mb-6 font-semibold">Add goals from here</h4>
            <form action="modules/service_insert.php?cat=<?= base64UrlEncode("goals") ?>" method="POST" id="goals_list" enctype="multipart/form-data" class="flex flex-col">
                <div class="mb-2 relative text-center h-52 w-full lg:w-80 rounded-2xl border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload overflow-hidden">
                    <label for="goalsimg" class="font-medium select-none grid place-items-center text-blue-500 dark:text-blue-200">
                        <span class=""><?= iUpload('4rem') ?></span>
                        Drag & Drop Image Or Browse
                    </label>
                    <input type="file" name="sectionimg" id="goalsimg" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'goalsimg')" oninput="checkImage(this, false, true)" required>
                    <img src="" alt="Image Preview" style="display:none; z-index: 2;" class="object-contain p-4 h-full w-full">
                </div>
                <div class="flex flex-col gap-6">
                    <div class="mt-6 w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="goals_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Title
                        </label>
                        <input tabindex="1" autocomplete="off" title="goals title" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="goals Title" name="title" id="goals_title" value="" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="goals_description" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Description
                        </label>
                        <textarea autocomplete="off" maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="goals Description" name="description" id="goals_description" required></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="goals_description" data-max-characters="<?= $desc_max_length ?>"></div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" tabindex="1">
                        Publish goals
                    </button>
                </div>
            </form>
        </section>

        <?php
        $stmt = $pdo->prepare("SELECT * FROM services WHERE category=? ORDER BY id ASC");
        $stmt->execute(["goals"]);
        $dataset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <section class="bg-white dark:bg-slate-900 rounded-xl w-full md:p-6 mt-10 md:mt-0">
            <?php
            if (count($dataset) > 0) { ?>
                <div class="cards-container text-center">
                    <?php foreach ($dataset as $in => $item) { ?>
                        <div class="w-full bg-white dark:bg-slate-800 shadow rounded-2xl overflow-hidden relative text-left" title="<?= $item['title'] ?>">
                            <form action="modules/service_delete.php?id=<?= base64UrlEncode($item['id']) ?>&cat=<?= base64UrlEncode("goals") ?>" id="form_delete_item_<?= $in ?>" method="POST">
                                <button type="submit" class="delete-button absolute top-2 right-2 bg-red-500 hover:bg-red-400 focus:bg-red-500 active:bg-red-500 p-2 rounded-full text-white transition-all duration-300" title="Delete item">
                                    <?= iTrash('1.2rem') ?>
                                </button>
                            </form>
                            <div class="w-full h-44 checkboard">
                                <img src="<?= $root . $uploads_dir . $item['image'] ?>" class="h-full w-full object-contain p-4" alt="<?= $item['title'] ?>">
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
                    There are no goals published yet.
                </div>
            <?php } ?>
        </section>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6 md:mb-12" id="approach_text">
        <!-- Approach section -->
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6 col-span-2">
            <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>about#approach" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">approach</a> page</h4>
            <form action="modules/approach_update.php?aprid=<?= $apr_id ?>" id="update_approach" method="POST" enctype="multipart/form-data">
                <div class="overflow-hidden rounded-xl w-full h-72 relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload mb-8 group">
                    <input type="file" name="approachimg" id="approachimg" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'approachimg', true)" oninput="checkImage(this, false, false, true)">
                    <img src="<?= $updir ?>uploads/approach.webp?<?= time() ?>" alt="Approach Section Image" class="h-full w-full object-cover">
                    <span class="editbtn">
                        <?= iPen('1.2rem') ?>
                    </span>
                </div>
                <div class="flex flex-col justify-start items-start gap-8">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="approach_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Title
                        </label>
                        <input tabindex="1" maxlength="120" autocomplete="off" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Page Title" name="approach_title" id="approach_title" value="<?= $approach_title ?>" required />
                    </div>
                </div>
                <div class="flex justify-end items-center mt-6">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </form>
        </section>

        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6 col-span-4" id="approach_list">
            <p class="text-slate-500 text-sm mb-2">Update the fields as needed. Empty fields will be removed. Please remember to save your changes.</p>
            <form action="modules/approach_list_items.php" id="approachlistitems" method="POST" class="flex flex-col gap-8 py-4">
                <div id="approach-textbox-container" class="textbox-container">
                    <?php foreach ($approach_list as $in => $item) { ?>
                        <div class="textbox-row">
                            <input type="text" name="item_names[]" autocomplete="off" value="<?= htmlspecialchars_decode($item['item']); ?>">
                            <input type="hidden" name="item_hahahah[]" value="<?= base64_encode($item['id'])  ?>">
                            <button type="button" onclick="removeTextbox(this)"><?= iTrash('1.2rem') ?></button>
                        </div>
                    <?php } ?>
                </div>
                <div class="flex justify-end gap-4 items-center">
                    <button type="button" onclick="addNewTextbox('approach-textbox-container')" class="text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-full hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">
                        Add Item
                    </button>
                    <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                        Save&nbsp;Changes
                    </button>
                </div>
            </form>
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