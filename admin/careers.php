<?php
$title = 'Careers';
$active = 6;
$pageCategory = "careers";
require_once 'header.php';

$stmt = $pdo->prepare("SELECT id, content FROM static WHERE category = ?");
$stmt->execute(["careers"]);
$project_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = $project_data[1]['content'];
$ptid = base64UrlEncode($project_data[1]['id']);

$career_title = $project_data[0]['content'];
$tid = base64UrlEncode($project_data[0]['id']);

$desc_title = $project_data[2]['content'] ?? "";
$did = base64UrlEncode($project_data[2]['id']);
$desc_max_length = 512;

$bannerpage = "careers";
require_once "components/banneredit.php";
?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-0 border-dashed dark:border-slate-800 md:border-0 md:pt-6" id="career_text">
        <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>careers" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">careers</a> page</h4>
        <form action="modules/careers_update.php?tid=<?= $tid ?>&ptid=<?= $ptid ?>&did=<?= $did ?>" enctype="multipart/form-data" id="update_career" method="POST" class="flex flex-col md:grid md:grid-cols-6 gap-6">
            <div class="col-span-2 flex flex-col gap-4">
                <div class="flex flex-col gap-4 h-[450px]">
                    <div class="overflow-hidden rounded-xl w-full h-full relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                        <input type="file" name="career_bottoml_img" id="career_bottoml_img" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                            onchange="setupImagePreview(this, 'career_bottoml_img', true)" oninput="checkImage(this, false, false, true)">
                        <img src="<?= $updir ?>uploads/career_side1.webp?<?= time() ?>" alt="Career Bottom Left Image" class="h-full w-full object-cover">
                        <span class="editbtn">
                            <?= iPen('1rem') ?>
                        </span>
                    </div>
                    <div class="overflow-hidden rounded-xl w-full h-full relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                        <input type="file" name="career_bottomr_img" id="career_bottomr_img" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                            onchange="setupImagePreview(this, 'career_bottomr_img', true)" oninput="checkImage(this, false, false, true)">
                        <img src="<?= $updir ?>uploads/career_side2.webp?<?= time() ?>" alt="Career Bottom Right Image" class="h-full w-full object-cover">
                        <span class="editbtn">
                            <?= iPen('1rem') ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-between w-full col-span-4">
                <div>
                    <div class="flex flex-col justify-start items-start gap-8">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="page_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Header Title
                            </label>
                            <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Header Title" name="page_title" id="page_title" value="<?= $page_title ?>" required />
                        </div>
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="career_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Content Title
                            </label>
                            <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="career Title" name="career_title" id="career_title" value="<?= $career_title ?>" required />
                        </div>
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="career_title_desc" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Content Description
                            </label>
                            <textarea maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="career Description" name="career_title_desc" id="career_title_desc"><?= $desc_title ?></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="career_title_desc" data-max-characters="<?= $desc_max_length ?>"></div>
                </div>
                <div class="flex justify-end items-center mt-6">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 3): ?>
    <article class="flex flex-col md:flex-row gap-4 items-start border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="jobs">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full md:w-[400px]">
            <h4 class="mb-8 font-semibold">Add new job openings</h4>
            <form action="modules/job_insert.php" method="POST" class="flex flex-col gap-6">
                <div class="relative group/sug">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Title
                        </label>
                        <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Job Title" name="title" id="title" value="" required />
                    </div>
                    <div class="hidden group-focus-within/sug:block mt-2 bg-yellow-100 dark:bg-slate-600 text-yellow-900 dark:text-slate-50/80 p-2 rounded">
                        <p class="text-xs">eg. Software Development Engineer, UI/UX Designer</p>
                    </div>
                </div>

                <div class="relative group/sug">
                    <div class="flex gap-4">
                        <div class="w-full md:w-96 ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="salary_amount" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Salary
                            </label>
                            <span class="hidden group-focus-within:block [&:has(~input:not(:placeholder-shown))]:block absolute top-0 left-4 mt-[1.1rem] text-slate-800 dark:text-slate-200 opacity-80" title="in Rupees"><?= iCurrency("1.3rem") ?></span>
                            <input tabindex="1" title="Please enter a valid amount (e.g., 50,000 or 120,000.00)." autocomplete="off" class="block p-4 ps-12 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" pattern="^\d{1,3}(,\d{3})*(\.\d{1,2})?$" aria-label="Salary" name="salary_amount" id="salary_amount" value="" required />
                        </div>
                        <div class="w-full md:w-60 ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <select tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Salary Time (/- month, /- year, etc.)" name="salary_time" id="salary_time" required>
                                <option class="dark:bg-slate-950 dark:text-white/80" value="/- Month" selected>/- Month</option>
                                <option class="dark:bg-slate-950 dark:text-white/80" value="/- Hour">/- Hour</option>
                                <option class="dark:bg-slate-950 dark:text-white/80" value="/- Week">/- Week</option>
                                <option class="dark:bg-slate-950 dark:text-white/80" value="/- Year">/- Year</option>
                                <option class="dark:bg-slate-950 dark:text-white/80" value="LPA">LPA</option>
                            </select>
                        </div>
                    </div>
                    <div class="hidden group-focus-within/sug:block mt-2 bg-yellow-100 dark:bg-slate-600 text-yellow-900 dark:text-slate-50/80 p-2 rounded">
                        <p class="text-xs">eg. 20,000 /- Month, 120,000 /- Week, 20 LPA, etc.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="relative group/sug">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="type" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Type
                            </label>
                            <input tabindex="1" list="job_types" autocomplete="off" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Job Type" name="type" id="type" value="" required />
                            <datalist id="job_types">
                                <option value="Full-time"></option>
                                <option value="Part-time"></option>
                                <option value="Contract"></option>
                                <option value="Internship"></option>
                                <option value="Freelance"></option>
                                <option value="Volunteer"></option>
                            </datalist>
                        </div>
                        <div class="hidden group-focus-within/sug:block mt-2 bg-yellow-100 dark:bg-slate-600 text-yellow-900 dark:text-slate-50/80 p-2 rounded">
                            <p class="text-xs">eg. Full-time, Part-time </p>
                        </div>
                    </div>
                    <div class="relative group/sug">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="mode" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Mode
                            </label>
                            <input tabindex="1" list="job_mode" autocomplete="off" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Job Mode" name="mode" id="mode" value="" required />
                            <datalist id="job_mode">
                                <option value="On-site"></option>
                                <option value="Remote"></option>
                                <option value="Hybrid"></option>
                                <option value="Flexible"></option>
                                <option value="Field-based"></option>
                            </datalist>
                        </div>
                        <div class="hidden group-focus-within/sug:block mt-2 bg-yellow-100 dark:bg-slate-600 text-yellow-900 dark:text-slate-50/80 p-2 rounded">
                            <p class="text-xs">eg. On-site, Remote </p>
                        </div>
                    </div>
                </div>


                <div class="relative group/sug">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="location" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Location
                        </label>
                        <input tabindex="1" autocomplete="off" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Job Location" name="location" id="location" value="" required />
                    </div>
                    <div class="hidden group-focus-within/sug:block mt-2 bg-yellow-100 dark:bg-slate-600 text-yellow-900 dark:text-slate-50/80 p-2 rounded">
                        <p class="text-xs">eg. Bangalore, Delhi, Patna, etc. </p>
                    </div>
                </div>

                <div class="relative group/sug">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="description" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Description
                        </label>
                        <textarea tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Description" name="description" id="description"></textarea>
                    </div>
                    <div class="hidden group-focus-within/sug:block mt-2 bg-yellow-100 dark:bg-slate-600 text-yellow-900 dark:text-slate-50/80 p-2 rounded">
                        <h5 class="text-xs font-semibold">Rules for writing description </h5>
                        <ul class="ms-5 text-xs mt-2">
                            <li class="list-disc">Use # before a heading</li>
                            <li class="list-disc">Use - for bullet points</li>
                            <li class="list-disc">Combine # and - for structured content</li>
                            <li class="list-disc">Or you can just put a plain text</li>
                        </ul>
                        <p class="text-xs font-semibold mt-3">For example:</p>
                        <pre class="text-xs mt-2">
 # Job Responsibilities
 - Develop software solutions
 - Collaborate with the team
 
 # Requirements
 - Experience with PHP
 - Knowledge of MySQL
                </pre>
                    </div>
                </div>

                <div class="flex justify-end items-center gap-4 mt-4">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Insert Job</button>
                </div>
            </form>

        </section>

        <?php
        $search_text = htmlspecialchars($_GET['q'] ?? '');
        $limit = 5;
        $stmt = $pdo->prepare("SELECT * FROM jobs WHERE title LIKE ? ORDER BY id DESC LIMIT $limit");
        $stmt->execute(["%$search_text%"]);
        $dataset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jobs = $dataset;
        ?>
        <article class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full mt-10 md:mt-0">
            <form action="" method="GET" class="flex gap-4 items-center justify-start w-full mb-5">
                <label for="searchtext" action="" method="GET" class="w-full cursor-text border-2 py-3.5 px-3 md:px-6 flex items-center justify-start gap-2 md:gap-4 border-slate-200 dark:border-slate-600 rounded-lg focus-within:border-slate-400 dark:focus-within:border-slate-400 transition-colors">
                    <label for="searchtext" class="opacity-50"><?= iSearch('1.2rem') ?></label>
                    <input type="search" name="q" id="searchtext" tabindex="1" class="h-full focus:outline-none bg-transparent w-full"
                        autocomplete="off" value="<?= $search_text ?>" oninput="if(this.value.length < 1) this.form.submit()"
                        placeholder="Search jobs here..." required>
                </label>
                <button type="submit" tabindex="1" class="text-sm px-2 md:px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-lg hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">Search</button>
            </form>
            <div class="">
                <?php if (count($jobs) > 0) { ?>
                    <?php
                    foreach ($jobs as $in => $job) {
                    ?>
                        <div class="p-10 <?= $in < count($jobs) - 1 ? 'border-b' : '' ?> border-neutral-400 dark:border-slate-700 group transition-colors">
                            <div class="flex flex-col gap-10 md:gap-2 md:flex-row justify-between items-start md:items-center">
                                <div class="flex flex-col justify-start gap-4">
                                    <h4 class="text-2xl font-bold text-blue-600 dark:text-blue-300 "><?= $job['title'] ?></h4>
                                    <p class="text-neutral-600 dark:text-slate-400"><?= $job['mode'] ?> - <?= $job['location'] ?> - <?= $job['type'] ?></p>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-row items-center justify-end gap-2 text-neutral-800 dark:text-slate-400">
                                        <div>
                                            <?= iCurrency("1.5rem") ?>
                                        </div>
                                        <h4 class="font-semibold text-sm"><?= $job['salary'] ?></h4>
                                    </div>
                                    <div class="flex flex-row gap-2 items-center justify-end">
                                        <a href="jobs_applied?id=<?= base64UrlEncode($job['id']) ?>" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                                            Show Candidates
                                        </a>
                                        <form action="modules/job_remove.php" method="POST" id="delete-job-form_<?= $in ?>">
                                            <input type="hidden" name="id" value="<?= $job['id'] ?>" class="hidden">
                                            <button type="submit" class="delete-button text-sm px-2.5 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-red-600 dark:bg-red-500  rounded-full hover:bg-red-400 dark:hover:bg-red-400 focus:outline-none focus:ring-2 ring-red-600/60 ring-offset-2 dark:ring-red-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                                                <?= iTrash('1.2rem') ?>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php if ($job['description'] ?? NULL) { ?>
                                <div class="text-neutral-600 dark:text-slate-400 mt-10">
                                    <h3 class="font-semibold text-lg">Job Description for <?= $job['title'] ?>:</h3>
                                    <ul class="mt-1 ulli">
                                        <?= renderJobDescription(html_entity_decode($job['description'])) ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    <?php }
                } else { ?>
                    <div class="text-center opacity-50 flex flex-col lg:flex-row justify-center items-center gap-2 py-16 px-4">
                        <?= iSad("1.5rem") ?>
                        Currently, there are no job openings listed
                    </div>
                <?php } ?>
            </div>
            <div class="mt-6 flex justify-end px-4 md:px-0" style="<?= count($jobs) > $limit - 1 ? '' : 'display: none;' ?>">
                <a href="careers_all" class="text-pmblue underline">View more</a>
            </div>
        </article>

    </article>
<?php endif; ?>

<div class="flex justify-end mt-5">
    <a href="jobs_applied" class="underline text-blue-500 dark:text-blue-300 text-sm">Archived Candidates</a>
</div>

<?php /* For Notification */ $msg = $_SESSION["msg_text"] ?? null; ?>

<div class="<?= !$msg ? 'hidden' : '' ?> fixed bottom-8 right-8 flex gap-3 items-center py-3 px-6 pe-3 bg-white dark:bg-neutral-950 text-slate-600 dark:text-slate-300 rounded-md msganim shadow" style="z-index: 10;">
    <p class="font-medium"><?= htmlspecialchars($msg) ?? '' ?></p>
    <button title='close-notification' type='button' onclick='this.parentNode.parentNode.removeChild(this.parentNode)' class='opacity-80 ms-4 hover:bg-slate-900/5 dark:hover:bg-slate-100/5 active:bg-slate-900/10 dark:active:bg-slate-100/10 rounded-full p-2'><?= iClose('1.2rem') ?></button>
</div>

<?php unset($_SESSION["msg_text"]); ?>

<?php
require_once 'footer.php';
?>