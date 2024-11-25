<?php
$title = 'Expertise';
$active = 4;
$pageCategory = "expertise";
require_once 'header.php';

$stmt = $pdo->prepare("SELECT id, content FROM static WHERE category = ?");
$stmt->execute(['expertise']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$ptid = base64UrlEncode(intval($data[2]['id']));
$page_title = $data[2]['content'] ?? "";

$title_id = base64UrlEncode(intval($data[0]['id']));
$content_title = $data[0]['content'] ?? "";

$desc_id = base64UrlEncode(intval($data[1]['id']));
$desc = $data[1]['content'] ?? "";
$desc_max_length = 512;

$uploads_dir = 'uploads/';

$bannerpage = "expertise";
require_once "components/banneredit.php";

?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full border-0 border-dashed dark:border-slate-800 md:border-0 md:pt-6">
        <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>expertise" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">expertise</a> page</h4>
        <form action="modules/expertise_update.php?ctid=<?= $title_id ?>&cid=<?= $desc_id ?>&ptid=<?= $ptid ?>" id="update_expertise" method="POST" enctype="multipart/form-data" class="flex flex-col md:grid md:grid-cols-6 gap-6">
            <div class="col-span-2">
                <div class="overflow-hidden rounded-xl w-full h-72 relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                    <input type="file" name="expertise_img" id="expertise_img" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'expertise_img', true)" oninput="checkImage(this, false, false, true)">
                    <img src="<?= $updir ?>uploads/expertise_side.webp?<?= time() ?>" alt="Expertise Side Image" class="h-full w-full object-cover">
                    <span class="editbtn">
                        <?= iPen('1.2rem') ?>
                    </span>
                </div>
            </div>
            <div class="col-span-4">
                <div class="flex flex-col justify-start items-start gap-8">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="page_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Header Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Header Title" name="page_title" id="page_title" value="<?= $page_title ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="content_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="50" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Content Title" name="content_title" id="content_title" value="<?= $content_title ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="sol_body_desc" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Description
                        </label>
                        <textarea maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Description" name="description" id="sol_body_desc" required><?= $desc ?></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="sol_body_desc" data-max-characters="<?= $desc_max_length ?>"></div>
                <div class="flex justify-end items-center mt-6">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="flex flex-col md:flex-row gap-4 items-start justify-start mt-6 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6 md:pt-0" id="expImages">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full md:w-[400px]">
            <h4 class="mb-6 font-semibold">Add Images from here</h4>
            <form action="modules/expertise_add.php" method="post" enctype="multipart/form-data" class="">
                <div class="relative text-center h-52 w-full lg:w-80 rounded-2xl border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload overflow-hidden">
                    <label for="exp_img" class="font-medium select-none grid place-items-center text-blue-500 dark:text-blue-200">
                        <span class=""><?= iUpload('4rem') ?></span>
                        Drag & Drop Image Or Browse
                    </label>
                    <input type="file" name="exp_img" id="exp_img" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'exp_img')" oninput="checkImage(this, true, true)" required>
                    <img src="" alt="Image Preview" style="display:none; z-index: 2;" class="object-contain h-full w-full">
                </div>
                <div class="mt-6 w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="exp_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Title
                    </label>
                    <input tabindex="1" autocomplete="off" title="Title" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Title" name="exp_title" id="exp_title" value="" required />
                </div>
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" tabindex="1">
                        Publish
                    </button>
                </div>
            </form>
        </section>

        <?php
        $stmt = $pdo->prepare("SELECT * FROM dual_data WHERE cat = ? ORDER BY id ASC");
        $stmt->execute(["expertise"]);
        $dataset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $exp_images = $dataset;
        ?>

        <section class="bg-white dark:bg-slate-900 rounded-xl w-full md:p-6 md:mt-0">
            <div class="grid grid-cols-2 lg:flex lg:flex-wrap xl:grid xl:grid-cols-5 gap-6 place-content-start text-center">
                <?php
                if (count($exp_images) > 0) {
                    foreach ($exp_images as $in => $data) { ?>
                        <div class="w-full lg:w-[80px] xl:w-full bg-white dark:bg-slate-800 shadow rounded-2xl overflow-hidden relative" title="<?= $data['title'] ?>">
                            <form action="modules/expertise_delete.php?id=<?= $data['id'] ?>" id="form_delete_data_<?= $in ?>" method="POST">
                                <button type="submit" class="delete-button absolute top-2 right-2 bg-red-500 hover:bg-red-400 focus:bg-red-500 active:bg-red-500 p-2 rounded-full text-white transition-all duration-300" title="Delete item">
                                    <?= iTrash('1.2rem') ?>
                                </button>
                            </form>
                            <div class="w-full h-32">
                                <img src="<?= $root . $uploads_dir . $data['content'] ?>" class="h-full w-full object-cover" alt="<?= $data['title'] ?>">
                                <!-- <p class="font-bold text-xs absolute bottom-3 left-0 z-10 p-2 px-2 text-white bg-black/50 backdrop-blur-lg"><?= $data['title'] ?></p> -->
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="w-full text-center opacity-50 flex flex-col lg:flex-row justify-center items-center gap-2 py-16 px-4">
                        <?= iSad("1.5rem") ?>
                        There are no images published yet.
                    </div>
                <?php } ?>
            </div>
        </section>
    </article>
<?php endif; ?>

<?php /* For Notification */ $msg = $_SESSION["msg_text"] ?? null; ?>

<div class="<?= !$msg ? 'hidden' : '' ?> fixed bottom-8 right-8 flex gap-3 items-center py-3 px-6 pe-3 bg-white dark:bg-neutral-950 text-slate-600 dark:text-slate-300 rounded-md msganim shadow" style="z-index: 10;">
    <p class="font-medium"><?= htmlspecialchars($msg) ?? '' ?></p>
    <button title='close-notification' type='button' onclick='this.parentNode.parentNode.removeChild(this.parentNode)' class='opacity-80 ms-4 hover:bg-slate-900/5 dark:hover:bg-slate-100/5 active:bg-slate-900/10 dark:active:bg-slate-100/10 rounded-full p-2'><?= iClose('1.2rem') ?></button>
</div>

<?php unset($_SESSION["msg_text"]); ?>

<?php
require_once 'footer.php';
?>