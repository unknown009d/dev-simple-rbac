<?php
$title = 'Careers';
$active = 6;
$pageCategory = "careers";
require_once 'header.php';

$search_text = htmlspecialchars($_GET['q'] ?? '');

// Count total number of matching jobs
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM jobs WHERE title LIKE ?");
$countStmt->execute(["%$search_text%"]);
$totalJobs = $countStmt->fetchColumn();

$jobsPerPage = 10; // Number of jobs per page
$totalPages = ceil($totalJobs / $jobsPerPage);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($totalPages, $page)); // Ensure page is within range

$offset = ($page - 1) * $jobsPerPage;

// Retrieve jobs for the current page
$sql = "SELECT * FROM jobs WHERE title LIKE :search ORDER BY id DESC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);

// Bind the parameters
$stmt->bindValue(':search', "%$search_text%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $jobsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$dataset = $stmt->fetchAll(PDO::FETCH_ASSOC);

$jobs = $dataset;
?>

<?php if ($UAC <= 4): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full">
        <!-- Search Form -->
        <!-- (No changes in the search form code) -->
        <form action="" method="GET" class="flex gap-4 items-center justify-start w-full mb-5">
            <label for="searchtext" action="" method="GET" class="w-full cursor-text border-2 py-3.5 px-6 flex items-center justify-start gap-4 border-slate-200 dark:border-slate-600 rounded-lg focus-within:border-slate-400 dark:focus-within:border-slate-400 transition-colors">
                <label for="searchtext" class="opacity-50"><?= iSearch('1.2rem') ?></label>
                <input type="search" name="q" id="searchtext" tabindex="1" class="h-full focus:outline-none bg-transparent w-full"
                    autocomplete="off" value="<?= $search_text ?>" oninput="if(this.value.length < 1) this.form.submit()"
                    placeholder="Search jobs here..." required>
            </label>
            <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-lg hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">Search</button>
        </form>

        <!-- Job Listings -->
        <div class="">
            <?php if (count($jobs) > 0) { ?>
                <?php foreach ($jobs as $in => $job) { ?>
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
                                    <?php if ($UAC <= 3): ?>
                                        <form action="modules/job_remove.php" method="POST" id="delete-job-form_<?= $in ?>">
                                            <input type="hidden" name="id" value="<?= $job['id'] ?>" class="hidden">
                                            <button type="submit" class="delete-button text-sm px-2.5 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-red-600 dark:bg-red-500  rounded-full hover:bg-red-400 dark:hover:bg-red-400 focus:outline-none focus:ring-2 ring-red-600/60 ring-offset-2 dark:ring-red-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                                                <?= iTrash('1.2rem') ?>
                                            </button>
                                        </form>
                                    <?php endif; ?>
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
                <?php } ?>
            <?php } else { ?>
                <div class="text-center opacity-50 flex flex-col lg:flex-row justify-center items-center gap-2 py-16 px-4">
                    <?= iSad("1.5rem") ?>
                    Currently, there are no job openings listed
                </div>
            <?php } ?>
        </div>

        <!-- Pagination Links -->
        <?php if ($totalPages > 1) { ?>
            <div class="pagination mt-10">
                <div class="flex justify-end items-center gap-0 text-sm">
                    <?php if ($page > 1) { ?>
                        <a href="?q=<?= urlencode($search_text) ?>&page=<?= $page - 1 ?>" class="pagination-link">
                            <?= iChevronLeft('1.2rem') ?>
                        </a>
                    <?php } ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <a href="?q=<?= urlencode($search_text) ?>&page=<?= $i ?>" class="pg <?= $i == $page ? 'pgactive' : '' ?>">
                            <?= $i ?>
                        </a>

                    <?php } ?>

                    <?php if ($page < $totalPages) { ?>
                        <a href="?q=<?= urlencode($search_text) ?>&page=<?= $page + 1 ?>" class="pagination-link">
                            <?= iChevronRight('1.2rem') ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
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