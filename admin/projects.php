<?php
$title = 'Projects';
$active = 6;
$pageCategory = "projects";
require_once 'header.php';

$uploads_dir = 'uploads/';

$stmt = $pdo->prepare("SELECT id, content FROM static WHERE category = ?");
$stmt->execute(["projects"]);
$project_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = $project_data[1]['content'];
$ptid = base64UrlEncode($project_data[1]['id']);

$project_title = $project_data[0]['content'];
$tid = base64UrlEncode($project_data[0]['id']);

$desc_title = $project_data[2]['content'] ?? "";
$did = base64UrlEncode($project_data[2]['id']);
$desc_max_length = 512;

$bannerpage = "projects";
require_once "components/banneredit.php";
?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-0 border-dashed dark:border-slate-800 md:border-0 md:pt-6" id="project_text">
        <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>projects" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">projects</a> page</h4>
        <form action="modules/projects_update.php?tid=<?= $tid ?>&ptid=<?= $ptid ?>&did=<?= $did ?>" id="update_project" method="POST" class="">
            <div class="flex flex-col justify-between w-full">
                <div class="flex flex-col justify-start items-start gap-8">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="page_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Header Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Header Title" name="page_title" id="page_title" value="<?= $page_title ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="project_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Project Title" name="project_title" id="project_title" value="<?= $project_title ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="project_title_desc" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Description
                        </label>
                        <textarea maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="project Description" name="project_title_desc" id="project_title_desc"><?= $desc_title ?></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="project_title_desc" data-max-characters="<?= $desc_max_length ?>"></div>

                <div class="flex justify-end items-center mt-6">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="flex flex-col md:flex-row gap-4 items-start justify-start border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="projectsadd">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full md:w-[400px]">
            <h4 class="mb-6 font-semibold">Add Projects from here</h4>
            <form action="modules/project_add.php" method="post" enctype="multipart/form-data" class="">
                <div class="relative text-center h-52 w-full lg:w-80 rounded-2xl border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload overflow-hidden">
                    <label for="projectimg" class="font-medium select-none grid place-items-center text-blue-500 dark:text-blue-200">
                        <span class=""><?= iUpload('4rem') ?></span>
                        Drag & Drop Image Or Browse
                    </label>
                    <input type="file" name="project_img" id="projectimg" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                        onchange="setupImagePreview(this, 'projectimg')" oninput="checkImage(this, true, true)" required>
                    <img src="" alt="Image Preview" style="display:none; z-index: 2;" class="object-cover h-full w-full">
                </div>
                <div class="mt-6 w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="project_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Project Title
                    </label>
                    <input tabindex="1" title="Project title" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Title" name="project_title" id="project_title" value="" required />
                </div>
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" tabindex="1">
                        Publish Project
                    </button>
                </div>
            </form>
        </section>

        <?php
        $search_text = htmlspecialchars($_GET['q'] ?? '');
        $limit = 5;
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE title LIKE ? ORDER BY id ASC");
        $stmt->execute(["%$search_text%"]);
        $dataset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $projects = $dataset;
        ?>

        <section class="bg-white dark:bg-slate-900 rounded-xl w-full md:p-6 mt-10 md:mt-0">
            <form action="" method="GET" class="flex gap-4 items-center justify-start w-full mb-5">
                <label for="searchtext" action="" method="GET" class="w-full cursor-text border-2 py-3.5 px-3 md:px-6 flex items-center justify-start gap-4 border-slate-200 dark:border-slate-600 rounded-lg focus-within:border-slate-400 dark:focus-within:border-slate-400 transition-colors">
                    <label for="searchtext" class="opacity-50"><?= iSearch('1.2rem') ?></label>
                    <input type="search" name="q" id="searchtext" tabindex="1" class="h-full focus:outline-none bg-transparent w-full"
                        autocomplete="off" value="<?= $search_text ?>" oninput="if(this.value.length < 1) this.form.submit()"
                        placeholder="Search projects here..." required>
                </label>
                <button type="submit" tabindex="1" class="text-sm px-2 md:px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-lg hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">Search</button>
            </form>
            <div class="flex flex-wrap gap-6 place-content-start text-center mt-8">
                <?php
                if (count($projects) > 0) {
                    foreach ($projects as $in => $project) { ?>
                        <div class="w-full md:w-[180px] bg-white dark:bg-slate-800 shadow rounded-2xl overflow-hidden relative" title="<?= $project['title'] ?>">
                            <form action="modules/delete_project.php?id=<?= $project['id'] ?>" id="form_delete_project_<?= $in ?>" method="POST">
                                <button type="submit" class="delete-button absolute top-2 right-2 bg-red-500 hover:bg-red-400 focus:bg-red-500 active:bg-red-500 p-2 rounded-full text-white transition-all duration-300" title="Delete item">
                                    <?= iTrash('1.2rem') ?>
                                </button>
                            </form>
                            <div class="w-full h-32">
                                <img src="<?= $root . $uploads_dir . $project['image'] ?>" class="h-full w-full object-cover" alt="<?= $project['title'] ?>">
                            </div>
                            <div class="py-4 px-3">
                                <h4 class="text-xs pb-2 font-bold">
                                    <?= $project['title'] ?>
                                </h4>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="w-full text-center opacity-50 flex flex-col lg:flex-row justify-center items-center gap-2 py-16 px-4">
                        <?= iSad("1.5rem") ?>
                        There are no projects published yet.
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