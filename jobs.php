<?php
include("api/config.php");
include("assets/icon.php");

require_once 'admin/includes/functions.php'; // Functions form the admin


$limit = 10; // Number of jobs per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number from query parameter
$offset = ($page - 1) * $limit; // Calculate the offset

// Get filter criteria from the form
$search = isset($_GET['search']) ? $_GET['search'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';

// Build the SQL query with filters and search
$query = "SELECT * FROM jobs WHERE 1=1 ORDER BY id DESC"; // 1=1 is a placeholder for easier appending of conditions

if (!empty($search)) {
    $query .= " AND title LIKE :search";
}

if (!empty($type)) {
    $query .= " AND type = :type";
}

if (!empty($location)) {
    $query .= " AND location = :location";
}

$query .= " LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($query);

if (!empty($search)) {
    $searchTerm = '%' . $search . '%'; // Add wildcards for partial match
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
}

if (!empty($type)) {
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
}

if (!empty($location)) {
    $stmt->bindParam(':location', $location, PDO::PARAM_STR);
}

$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count total jobs with the same filters and search term for pagination
$countQuery = "SELECT COUNT(*) FROM jobs WHERE 1=1";

if (!empty($search)) {
    $countQuery .= " AND title LIKE :search";
}

if (!empty($type)) {
    $countQuery .= " AND type = :type";
}

if (!empty($location)) {
    $countQuery .= " AND location = :location";
}

$countStmt = $pdo->prepare($countQuery);

if (!empty($search)) {
    $countStmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
}

if (!empty($type)) {
    $countStmt->bindParam(':type', $type, PDO::PARAM_STR);
}

if (!empty($location)) {
    $countStmt->bindParam(':location', $location, PDO::PARAM_STR);
}

$countStmt->execute();
$totalJobs = $countStmt->fetchColumn();
$totalPages = ceil($totalJobs / $limit);

// Fetch distinct job types
$typeQuery = "SELECT DISTINCT type FROM jobs";
$typeStmt = $pdo->prepare($typeQuery);
$typeStmt->execute();
$jobTypes = $typeStmt->fetchAll(PDO::FETCH_COLUMN);

// Fetch distinct locations
$locationQuery = "SELECT DISTINCT location FROM jobs";
$locationStmt = $pdo->prepare($locationQuery);
$locationStmt->execute();
$jobLocations = $locationStmt->fetchAll(PDO::FETCH_COLUMN);
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
    <!-- Job Listings Header -->
    <section class="p-5 mt-10">
        <div class="w-full lg:w-[500px] mx-auto mb-12">
            <p class="text-3xl bnf font-bold text-pmblue" style="<?= count($jobs) < 1 ? 'display: none' : '' ?>">Our&nbsp;Latest&nbsp;Job&nbsp;Offering</p>
        </div>

        <!-- Filter and Search Form -->
        <div class="w-full lg:w-[600px] mx-auto mb-6">
            <form method="GET" action="">
                <div class="flex flex-col lg:flex-row gap-4">
                    <input type="text" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" placeholder="Search job titles..." class="border border-gray-300 p-2 rounded">
                    <select name="type" class="border border-gray-300 p-2 rounded">
                        <option value="">All Types</option>
                        <?php foreach ($jobTypes as $jobType): ?>
                            <option value="<?= htmlspecialchars($jobType) ?>" <?= isset($_GET['type']) && $_GET['type'] === $jobType ? 'selected' : '' ?>><?= htmlspecialchars($jobType) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="location" class="border border-gray-300 p-2 rounded">
                        <option value="">All Locations</option>
                        <?php foreach ($jobLocations as $jobLocation): ?>
                            <option value="<?= htmlspecialchars($jobLocation) ?>" <?= isset($_GET['location']) && $_GET['location'] === $jobLocation ? 'selected' : '' ?>><?= htmlspecialchars($jobLocation) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-sm hover:bg-teal-500 transition-color">Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Job Listings -->
    <section class="container mx-auto mb-10 lg:w-8/12">
        <div class="border border-b-0 border-neutral-400">
            <?php if (count($jobs) > 0) { ?>
                <?php foreach ($jobs as $job) { ?>
                    <div class="p-10 border-b border-neutral-400 hover:bg-teal-600 group transition-colors">
                        <div class="flex flex-col gap-10 md:gap-2 md:flex-row justify-between items-start md:items-center">
                            <div class="flex flex-col justify-start gap-4">
                                <h4 class="text-2xl font-bold text-pmblue group-hover:text-white"><?= htmlspecialchars_decode($job['title']) ?></h4>
                                <p class="text-neutral-600 group-hover:text-white"><?= htmlspecialchars_decode($job['mode']) ?> - <?= htmlspecialchars_decode($job['location']) ?> - <?= htmlspecialchars_decode($job['type']) ?></p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div class="flex flex-row items-center justify-end gap-2 text-neutral-800 group-hover:text-white">
                                    <div>
                                        <?= iCurrency("1.5rem") ?>
                                    </div>
                                    <h4 class="font-semibold text-sm"><?= htmlspecialchars_decode($job['salary']) ?></h4>
                                </div>
                                <a href="apply.php?jb=<?= base64UrlEncode($job['id']) ?>" class="flex items-center justify-center gap-2 text-lg bg-teal-600 hover:bg-teal-500 hover:-translate-y-0.5 hover:shadow-lg transition-transform focus:bg-teal-500 group-hover:bg-white text-white group-hover:text-teal-600 px-6 py-1.5 rounded-sm">
                                    Apply <?= iRight("1.4rem"); ?>
                                </a>
                            </div>
                        </div>
                        <?php if (!empty($job['description'])) { ?>
                            <div class="text-neutral-600 group-hover:text-white mt-10">
                                <h3 class="font-semibold text-lg">Job Description for <?= htmlspecialchars_decode($job['title']) ?>:</h3>
                                <ul class="mt-1 ulli">
                                    <?= renderJobDescription(html_entity_decode($job['description'])) ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="text-center opacity-50 flex flex-col lg:flex-row justify-center items-center gap-2 py-16 border-b border-neutral-400 px-4">
                    <?= iSad("1.5rem") ?>
                    Currently, there are no job openings listed. Please check back later.
                </div>
            <?php } ?>
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-end">
            <nav aria-label="Page navigation">
                <ul class="inline-flex -space-x-px">
                    <?php if ($page > 1): ?>
                        <li>
                            <a href="?page=<?= $page - 1 ?>" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li>
                            <a href="?page=<?= $i ?>" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li>
                            <a href="?page=<?= $page + 1 ?>" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </section>
</body>
</html>