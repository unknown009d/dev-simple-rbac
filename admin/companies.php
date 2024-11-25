<?php
$title = 'Companies';
$active = 7;
$pageCategory = "clients";
require_once 'header.php';

$uploads_dir = 'uploads/';


$stmt = $pdo->prepare("SELECT * FROM static WHERE category = ?");
$stmt->execute(['clients']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$desc_id = base64UrlEncode(intval($data[1]['id']));
$desc = $data[1]['content'] ?? "";
$desc_max_length = 512;

$title_id = base64UrlEncode(intval($data[0]['id']));
$content_title = $data[0]['content'] ?? "";

?>
<?php if ($UAC <= 2): ?>
    <article class="flex flex-col md:flex-row gap-4 items-stretch justify-start mb-8">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full">
            <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>#clients" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">clients</a> section</h4>
            <form action="modules/companies_details_update.php?ctid=<?= $title_id ?>&cdid=<?= $desc_id ?>" id="update_solution" method="POST" class="flex flex-col justify-between items-stretch">
                <div class="flex flex-col justify-start items-start gap-8">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="content_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="50" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Content Title" name="content_title" id="content_title" value="<?= $content_title ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="content_description" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Description
                        </label>
                        <textarea maxlength="<?= $desc_max_length ?>" rows="2" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Content Description" name="content_description" id="content_description"><?= $desc ?></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="content_description" data-max-characters="<?= $desc_max_length ?>"></div>
                <div class="flex justify-end items-center mt-6">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </form>
        </section>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="flex flex-col md:flex-row gap-4 items-start justify-start" id="clients">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full md:w-[400px]">
            <h4 class="mb-6 font-semibold">Add Companies from here</h4>
            <form action="modules/companies_insert.php" method="post" enctype="multipart/form-data" class="">
                <div class="relative text-center h-52 w-full lg:w-80 rounded-2xl border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload overflow-hidden">
                    <label for="companylogo" class="font-medium select-none grid place-items-center text-blue-500 dark:text-blue-200">
                        <span class=""><?= iUpload('4rem') ?></span>
                        Drag & Drop Image Or Browse
                    </label>
                    <input type="file" name="company_img" id="companylogo" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'companylogo')" oninput="checkImage(this, true, true)" required>
                    <img src="" alt="Image Preview" style="display:none; z-index: 2;" class="object-contain h-full w-full">
                </div>
                <div class="mt-6 w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="company_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Company Name
                    </label>
                    <input tabindex="1" autocomplete="off" title="Company Name" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Title" name="company_title" id="company_title" value="" required />
                </div>
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" tabindex="1">
                        Publish
                    </button>
                </div>
            </form>
        </section>
        <?php
        $search_text = htmlspecialchars($_GET['q'] ?? '');
        $limit = 5;
        $stmt = $pdo->prepare("SELECT * FROM dual_data WHERE title LIKE ? AND cat = ? ORDER BY id ASC");
        $stmt->execute(["%$search_text%", "company"]);
        $dataset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $companies = $dataset;
        ?>

        <section class="bg-white dark:bg-slate-900 rounded-xl w-full md:p-6 mt-10 md:mt-0">
            <form action="" method="GET" class="flex gap-4 items-center justify-start w-full mb-5">
                <label for="searchtext" action="" method="GET" class="w-full cursor-text border-2 py-3.5 px-3 md:px-6 flex items-center justify-start gap-4 border-slate-200 dark:border-slate-600 rounded-lg focus-within:border-slate-400 dark:focus-within:border-slate-400 transition-colors">
                    <label for="searchtext" class="opacity-50"><?= iSearch('1.2rem') ?></label>
                    <input type="search" name="q" id="searchtext" tabindex="1" class="h-full focus:outline-none bg-transparent w-full"
                        autocomplete="off" value="<?= $search_text ?>" oninput="if(this.value.length < 1) this.form.submit()"
                        placeholder="Search companies here..." required>
                </label>
                <button type="submit" tabindex="1" class="text-sm px-2 md:px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-lg hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">Search</button>
            </form>
            <div class="grid xs:grid-cols-2 md:flex md:flex-wrap gap-6 place-content-start text-center mt-8">
                <?php
                if (count($companies) > 0) {
                    foreach ($companies as $in => $company) { ?>
                        <div class="w-full md:w-[180px] bg-white dark:bg-slate-800 shadow rounded-2xl overflow-hidden relative" title="<?= $company['title'] ?>">
                            <form action="modules/companies_delete.php?id=<?= $company['id'] ?>" id="form_delete_company_<?= $in ?>" method="POST">
                                <button type="submit" class="delete-button absolute top-2 right-2 bg-red-500 hover:bg-red-400 focus:bg-red-500 active:bg-red-500 p-2 rounded-full text-white transition-all duration-300" title="Delete item">
                                    <?= iTrash('1.2rem') ?>
                                </button>
                            </form>
                            <div class="w-full h-32">
                                <img src="<?= $root . $uploads_dir . $company['content'] ?>" class="h-full w-full object-contain p-4" alt="<?= $company['title'] ?>">
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="w-full text-center opacity-50 flex flex-col lg:flex-row justify-center items-center gap-2 py-16 px-4">
                        <?= iSad("1.5rem") ?>
                        There are no company published yet.
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