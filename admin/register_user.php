<?php
$title = 'User Management';
$active = -1;
$pageCategory = "*";
require_once 'header.php';


$editor = $_GET['type'] ?? false;
$title = $editor == "edit" ? "Update an existing account" : "Create a new account";

$stmt = $pdo->prepare("SELECT * FROM pages");
$stmt->execute();
$pages_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$user_types = [
    1 => "Admin",
    2 => "Content Editor",
    3 => "Manager",
    4 => "Viewer",
];

$username_current = "";
$email = "";
$priority = "";
$access_pages = array();
if ($editor) {
    $userid = base64UrlDecode($_GET['user']);
    if ($userid == 1) {
        echo "You cannot update the super-user";
        exit();
    }
    $stmt = $pdo->prepare("SELECT id,username,email,priority FROM users WHERE id=?");
    $stmt->execute([$userid]);
    $user_data = $stmt->fetch();
    if ($stmt->rowCount() != 1) {
        echo "There was a problem fetching the user details. Please contact the administrator.";
        exit();
    }
    $username_current = $user_data['username'];
    $email = $user_data['email'];
    $priority = $user_data['priority'];

    // Fetching all the page access information
    $stmt = $pdo->prepare("SELECT page FROM user_page_access WHERE username = ?");
    $stmt->execute([$username_current]);
    $access_pages = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>

<?php if ($UAC <= 1): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-0 border-dashed dark:border-slate-800 md:border-0 md:pt-6">
        <h4 class="mb-8 font-semibold"><?= $title ?></h4>
        <form action="modules/<?= !$editor ? "accounts_create.php" : "accounts_update.php" ?>" method="POST" <?= $editor ? "id='update-user'" : null ?>>
            <div class="fields-container items-start gap-6 w-full mb-8">
                <div class="flex flex-col gap-3 w-full">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="username" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Username
                        </label>
                        <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Username" onkeyup="this.value = this.value.replace(/\s+/g, '')" onblur="checkusername(this,'text-message-username','<?= $username_current ?>')" name="username" id="username" value="<?= $username_current ?>" autocomplete="off" required />
                    </div>
                    <div id="text-message-username">
                        <p class="text-red-500 dark:text-red-300 flex gap-2 items-center text-sm px-2 mb-2 hidden"><?= iInfo("1rem") ?> The username already exist.</p>
                        <p class="text-blue-500 dark:text-blue-300 flex gap-2 items-center text-sm px-2 mb-2 hidden"><?= iTick("1rem") ?> This username is available.</p>
                    </div>
                </div>
                <?php if (!$editor): ?>
                    <div class="w-full">
                        <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                            <label for="password" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                                Password
                            </label>
                            <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="password" placeholder="" aria-label="Password" name="password" id="password" value="" autocomplete="new-password" required />
                        </div>
                    </div>
                <?php else: ?>
                    <input type="hidden" name="user" value="<?= base64_encode($userid) ?>">
                <?php endif; ?>
                <div class="w-full">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="email" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Email
                        </label>
                        <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="email" placeholder="" aria-label="Email" name="email" id="email" value="<?= $email ?>" required />
                    </div>
                </div>
                <div class="w-full">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <select tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="User Access" name="user_type" id="user_type" required>
                            <?php if (!$editor): ?>
                                <option class="dark:bg-slate-950 dark:text-white/80" value="" selected disabled hidden>-- Select User Type --</option>
                            <?php endif; ?>
                            <?php foreach (array_reverse($user_types, true) as $key => $value): ?>
                                <option class="dark:bg-slate-950 dark:text-white/80" value="<?= $key ?>" <?= $key == $priority ? "selected" : "" ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <fieldset class="uac">
                <legend class="font-bold">User Page Access</legend>
                <p class="text-sm opacity-80">You can select the pages that the user can have access</p>
                <div class="dark:opacity-10">
                    <hr class="mt-4">
                </div>
                <div class="flex flex-col justify-start w-full gap-4 my-8 md:px-4">
                    <?php
                    foreach ($pages_data as $in => $data): ?>
                        <div class="flex justify-between items-center w-full gap-4">
                            <label for="page_item_<?= $in ?>" class="w-full flex flex-col gap-0">
                                <span class="font-bold"><?= ucfirst($data['name']) ?></span>
                                <span class="text-sm opacity-80 italic"><?= truncateText($data['description'], 120) ?></span>
                            </label>
                            <label for="page_item_<?= $in ?>" class="switch" style="min-width: 50px;">
                                <input type="checkbox" tabindex="1" name="pages[]" role="switch" id="page_item_<?= $in ?>" value="<?= base64_encode($data['id']) ?>"
                                    <?= count($access_pages) > 0 ? ($data['name'] == $access_pages[0] ? "checked" : "") : null ?>>
                                <span class="slider"></span>
                            </label>
                        </div>
                    <?php if (count($access_pages) > 0 && $data['name'] == $access_pages[0]) array_shift($access_pages);
                    endforeach; ?>
                </div>
            </fieldset>

            <div class="flex justify-end items-center mt-4">
                <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                    <?= !$editor ? "Create" : "Update" ?>
                </button>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php /* For Notification */ $msg = $_SESSION["msg_text"] ?? null; ?>

<div class="<?= !$msg ? 'hidden' : '' ?> fixed bottom-8 right-8 flex gap-3 items-center py-3 px-6 pe-3 bg-white dark:bg-neutral-950 text-slate-600 dark:text-slate-300 rounded-md msganim shadow" style="z-index: 10;">
    <p class="font-medium"><?= $msg ?? '' ?></p>
    <button title='close-notification' type='button' onclick='this.parentNode.parentNode.removeChild(this.parentNode)' class='opacity-80 ms-4 hover:bg-slate-900/5 dark:hover:bg-slate-100/5 active:bg-slate-900/10 dark:active:bg-slate-100/10 rounded-full p-2'><?= iClose('1.2rem') ?></button>
</div>

<?php unset($_SESSION["msg_text"]); ?>

<script>

</script>

<?php
require_once 'footer.php';
?>