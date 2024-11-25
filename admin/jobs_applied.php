<?php
$title = 'Applied Jobs';
$active = 6;
$pageCategory = "careers";
require_once 'header.php';

$jobid = base64UrlDecode($_GET['id']) ?? NULL;

$stmt = $pdo->prepare("SELECT title FROM jobs WHERE id = ?");
$stmt->execute([$jobid]);
$jobdata = $stmt->fetch();

if ($jobid !== NULL && !empty($jobid)) {
    // Prepare the statement with a parameter for job_id
    $stmt = $pdo->prepare("SELECT * FROM jobs_applied WHERE job_id = ?");
    $stmt->execute([$jobid]);
} else {
    // Prepare the statement to select rows where job_id is NULL
    $stmt = $pdo->prepare("SELECT * FROM jobs_applied WHERE job_id IS NULL");
    $stmt->execute();
}

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[69vw] lg:w-full">
    <table class="w-full text-sm text-left rtl:text-right text-slate-500 dark:text-slate-400">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-slate-900 bg-white dark:text-white dark:bg-slate-900">
            <div class="flex justify-between items-center w-full">
                <div class="">
                    Applied Jobs for <?= $jobdata[0] ?? 'Unknown' ?> Role
                    <p class="mt-1 text-sm font-normal text-slate-500 dark:text-slate-400">
                        Browse a list of jobs that applicants have applied.
                    </p>
                </div>
                <?php if (!empty($data) && $UAC <= 3): ?>
                    <form action="modules/applicants_remove.php<?= $jobid != NULL ? "?id=$jobid" : '' ?>" method="POST" id="removeApplicants">
                        <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-red-600 dark:text-red-300 capitalize transition-all duration-300 transform rounded-full hover:bg-red-100 dark:hover:bg-red-400/10 focus:outline-none focus:ring-2 ring-red-600/60 ring-offset-2 dark:ring-red-300 dark:ring-offset-gray-800">Remove all applicants</button>
                    </form>
                <?php endif; ?>
            </div>
        </caption>
        <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
            <tr>
                <th scope="col" class="px-6 py-3">Sl no.</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Phone</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Resume</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-slate-900">
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $count => $row): ?>
                    <tr class="bg-white <?= $count < count($data) - 1 ? 'border-b' : '' ?> dark:bg-slate-900 dark:border-slate-700">
                        <td class="px-6 py-4"><?= $count + 1 ?>.</td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['name']) ?></td>
                        <td class="px-6 py-4">
                            <a href="tel:<?= htmlspecialchars($row['phone']) ?>" target="_blank" class="border-b-2 border-slate-300 dark:border-slate-700 border-dashed">
                                <?= htmlspecialchars($row['phone']) ?>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <a href="mailto:<?= htmlspecialchars($row['email']) ?>" target="_blank" class="border-b-2 border-slate-300 dark:border-slate-700 border-dashed">
                                <?= htmlspecialchars($row['email']) ?>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <a href="resumes/<?= htmlspecialchars($row['resume']) ?>" class="text-ellipsis underline text-blue-500 dark:text-blue-300" target="_blank">
                                <?= truncateText(htmlspecialchars($row['resume']), 40) ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center">No data found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php /* For Notification */ $msg = $_SESSION["msg_text"] ?? null; ?>

<div class="<?= !$msg ? 'hidden' : '' ?> fixed bottom-8 right-8 flex gap-3 items-center py-3 px-6 pe-3 bg-white dark:bg-neutral-950 text-slate-600 dark:text-slate-300 rounded-md msganim shadow" style="z-index: 10;">
    <p class="font-medium"><?= htmlspecialchars($msg) ?? '' ?></p>
    <button title='close-notification' type='button' onclick='this.parentNode.parentNode.removeChild(this.parentNode)' class='opacity-80 ms-4 hover:bg-slate-900/5 dark:hover:bg-slate-100/5 active:bg-slate-900/10 dark:active:bg-slate-100/10 rounded-full p-2'><?= iClose('1.2rem') ?></button>
</div>

<?php unset($_SESSION["msg_text"]); ?>

<?php require_once 'footer.php'; ?>