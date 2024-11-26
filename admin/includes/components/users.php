<?php
if ($UAC <= 1) {

    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
    <article class="md:bg-white dark:md:bg-slate-900 md:rounded-xl w-[69vw] lg:w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 relative overflow-x-auto" id="usermanagement">
        <table class="w-full text-sm text-left rtl:text-right text-slate-500 dark:text-slate-400">
            <caption class="p-6 text-lg font-semibold text-left rtl:text-right text-slate-900 bg-white dark:text-white dark:bg-slate-900">
                <div class="flex justify-between items-center w-full">
                    <div class="">
                        User Management
                        <p class="mt-1 text-sm font-normal text-slate-500 dark:text-slate-400">
                            Browse the list of users or modify them.
                        </p>
                    </div>
                    <a href="register_user" type="submit" class="flex gap-2 items-center text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 transition-all duration-300 transform rounded-full hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">
                        Add a new user
                        <?= iPlus('1rem', 2.5) ?>
                    </a>
                </div>
            </caption>
            <thead class="text-xs text-slate-700 uppercase bg-slate-50/80 dark:bg-slate-700 dark:text-slate-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Sl no.</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">UAC</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-900">
                <?php if (!empty($user_data)): ?>
                    <?php foreach ($user_data as $count => $row):
                        $thisuser = $_SESSION['username'] == $row['username'];
                    ?>
                        <tr class="bg-white <?= $count < count($user_data) - 1 ? 'border-b' : '' ?> dark:bg-slate-900 dark:border-slate-700" title="<?= $thisuser ? "You are logged in through this user. Thus you cannot edit or delete" : "" ?>">
                            <td class="px-6 py-4"><?= $count + 1 ?>.</td>
                            <td class="px-6 py-4"><strong><?= $thisuser ? '*' : '' ?><?= htmlspecialchars($row['username']) ?></strong></td>
                            <td class="px-6 py-4">
                                <a href="mailto:<?= htmlspecialchars($row['email']) ?>" target="_blank" class="border-b-2 border-slate-300 dark:border-slate-700 border-dashed">
                                    <?= htmlspecialchars($row['email']) ?>
                                </a>
                            </td>
                            <td class="px-6 py-4"><?= findLevel(intval($row['priority'])) ?></td>
                            <td class="px-6 py-4 flex items-center justify-center gap-2">
                                <?php if (!$thisuser): ?>
                                    <a href="register_user?type=<?= "edit" ?>&user=<?= base64UrlEncode($row['id']) ?>" class="h-8 w-8 flex justify-center items-center bg-yellow-500 hover:bg-yellow-400 focus:bg-yellow-500 active:bg-yellow-500 p-2 rounded-full text-white transition-all duration-300" title="Edit item">
                                        <?= iPen('1.2rem') ?>
                                    </a>
                                    <form action="modules/userdel.php?id=<?= base64UrlEncode($row['id']) ?>" id="form_delete_item_<?= $count ?>" method="POST">
                                        <button type="submit" class="delete-button h-8 w-8 flex justify-center items-center bg-red-500 hover:bg-red-400 focus:bg-red-500 active:bg-red-500 p-2 rounded-full text-white transition-all duration-300" title="Delete item">
                                            <?= iTrash('1.2rem') ?>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <p class="opacity-80 select-none">N/A</p>
                                <?php endif; ?>
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
    </article>

<?php } ?>