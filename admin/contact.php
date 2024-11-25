<?php
$title = 'Contact';
$active = 8;
$pageCategory = "contact";
require_once 'header.php';

$stmt = $pdo->prepare("SELECT * FROM static WHERE category = ?");
$stmt->execute(["contact"]);
$contact_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$heading = $contact_data[0]['content'];
$hid = base64UrlEncode($contact_data[0]['id']);
$title = $contact_data[1]['content'];
$tid = base64UrlEncode($contact_data[1]['id']);
$desc = $contact_data[2]['content'];
$did = base64UrlEncode($contact_data[2]['id']);

$stmt->execute(["auto_mail"]);
$am_data = $stmt->fetch();
$auto_mail = $am_data['content'];
$auto_mail_id = $am_data['id'];

$desc_max_length = 512;

$stmt = $pdo->prepare("SELECT * FROM items WHERE category = ?");
$stmt->execute(["phone"]);
$phone_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt->execute(["mails"]);
$mail_list = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<?php if ($UAC <= 1): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-0 border-dashed dark:border-slate-800 md:border-0 md:pt-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 md:gap-0">
            <h4 class="mb-0 font-semibold">Update the e-mail id to recieve all contact page submission</h4>
            <form method="POST" action="modules/update_automail.php?id=<?= base64UrlEncode($auto_mail_id) ?>" class="flex flex-col md:flex-row items-end md:items-center md:justify-start gap-4" id="automail_update">
                <div class="w-full md:w-80 ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="contact_email" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Email
                    </label>
                    <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="email" placeholder="" aria-label="Email" name="contact_email" id="contact_email" value="<?= $auto_mail ?>" required />
                </div>
                <button class="text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-full hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800" tabindex="1" type="submit">
                    Update
                </button>
            </form>
        </div>
    </article>
<?php endif; ?>

<?php if ($UAC <= 2): ?>
    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="contact_text">
        <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>#contact" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">contacts</a> page</h4>
        <form action="modules/contacts_update.php?hid=<?= $hid ?>&tid=<?= $tid ?>&did=<?= $did ?>" id="update_contact" method="POST" class="">
            <div class="flex flex-col justify-between w-full">
                <div class="flex flex-col justify-start items-start gap-8">
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="page_heading" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Header Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Header Title" name="heading" id="page_heading" value="<?= $heading ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="contact_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Title
                        </label>
                        <input tabindex="1" autocomplete="off" maxlength="120" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="contact Title" name="title" id="contact_title" value="<?= $title ?>" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="contact_title_desc" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Content Description
                        </label>
                        <textarea maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="contact Description" name="desc" id="contact_title_desc"><?= $desc ?></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="contact_title_desc" data-max-characters="<?= $desc_max_length ?>"></div>

                <div class="flex justify-end items-center mt-6">
                    <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
                </div>
            </div>
        </form>
    </article>
<?php endif; ?>

<?php if ($UAC <= 2): ?>
    <article class="grid md:grid-cols-2 gap-6">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="phone_list">
            <h4 class="mb-1 font-semibold">You can update the phone numbers of <a href="<?= $root ?>#contact" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">contact</a> section</h4>
            <p class="text-slate-500 text-sm mb-2">Empty fields will be removed. Please remember to save your changes.</p>
            <form action="modules/contact_list_items.php?cat=<?= base64UrlEncode("phone") ?>" id="phonelistitems" method="POST" class="flex flex-col gap-8 py-4">
                <div id="phone-container" class="textbox-container">
                    <?php foreach ($phone_list as $in => $item) { ?>
                        <div class="textbox-row">
                            <input type="text" name="item_names[]" autocomplete="off" value="<?= htmlspecialchars_decode($item['item']); ?>">
                            <input type="hidden" name="item_hahahah[]" value="<?= base64_encode($item['id'])  ?>">
                            <button type="button" onclick="removeTextbox(this)"><?= iTrash('1.2rem') ?></button>
                        </div>
                    <?php } ?>
                </div>
                <div class="flex justify-end gap-4 items-center">
                    <button type="button" onclick="addNewTextbox('phone-container')" class="text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-full hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">
                        Add Item
                    </button>
                    <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">
                        Save&nbsp;Changes
                    </button>
                </div>
            </form>
        </section>

        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="mail_list">
            <h4 class="mb-1 font-semibold">You can update the emails of <a href="<?= $root ?>#contact" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">contact</a> section</h4>
            <p class="text-slate-500 text-sm mb-2">Empty fields will be removed. Please remember to save your changes.</p>
            <form action="modules/contact_list_items.php?cat=<?= base64UrlEncode("mails") ?>" id="maillistitems" method="POST" class="flex flex-col gap-8 py-4">
                <div id="mails-container" class="textbox-container">
                    <?php foreach ($mail_list as $in => $item) { ?>
                        <div class="textbox-row">
                            <input type="text" name="item_names[]" autocomplete="off" value="<?= htmlspecialchars_decode($item['item']); ?>">
                            <input type="hidden" name="item_hahahah[]" value="<?= base64_encode($item['id'])  ?>">
                            <button type="button" onclick="removeTextbox(this)"><?= iTrash('1.2rem') ?></button>
                        </div>
                    <?php } ?>
                </div>
                <div class="flex justify-end gap-4 items-center">
                    <button type="button" onclick="addNewTextbox('mails-container','email')" class="text-sm px-6 py-2.5 font-medium tracking-wide text-blue-600 dark:text-blue-300 capitalize transition-all duration-300 transform rounded-full hover:bg-blue-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800">
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

<?php if ($UAC <= 2): ?>
    <article class="flex flex-col md:flex-row gap-4 items-stretch justify-start mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="address_items">
        <section class="md:bg-white dark:md:bg-slate-900 md:p-6 rounded-xl w-full md:w-[520px]">
            <h4 class="mb-6 font-semibold">Add address from here</h4>
            <form action="modules/address_insert.php" method="POST" id="address_list" class="flex flex-col">
                <div class="flex flex-col gap-6">
                    <div class="mt-6 w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="address_title" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Title
                        </label>
                        <input tabindex="1" autocomplete="off" title="Address title" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Address Title" name="title" id="address_title" value="" required />
                    </div>
                    <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(textarea:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                        <label for="address_description" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~textarea:not(:placeholder-shown))]:glabel [&:has(~textarea:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                            Description
                        </label>
                        <textarea autocomplete="off" maxlength="<?= $desc_max_length ?>" rows="5" tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Address Description" name="description" id="address_description" required></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center opacity-60 text-xs mt-2" data-character-count data-textarea-id="address_description" data-max-characters="<?= $desc_max_length ?>"></div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" tabindex="1">
                        Add address
                    </button>
                </div>
            </form>
        </section>

        <?php
        $stmt = $pdo->prepare("SELECT * FROM dual_data WHERE cat = ? ORDER BY id ASC");
        $stmt->execute(["address"]);
        $dataset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <section class="bg-white dark:bg-slate-900 rounded-xl w-full md:p-6 mt-10 md:mt-0">
            <?php
            if (count($dataset) > 0) { ?>
                <div class="cards-container text-center mt-8">
                    <?php foreach ($dataset as $in => $item) { ?>
                        <div class="w-full bg-white dark:bg-slate-800 shadow rounded-2xl overflow-hidden relative text-left" title="<?= $item['title'] ?>">
                            <form action="modules/address_delete.php?id=<?= base64UrlEncode($item['id']) ?>" id="form_delete_item_<?= $in ?>" method="POST">
                                <button type="submit" class="delete-button absolute top-2 right-2 bg-red-500 hover:bg-red-400 focus:bg-red-500 active:bg-red-500 p-2 rounded-full text-white transition-all duration-300" title="Delete item">
                                    <?= iTrash('1.2rem') ?>
                                </button>
                            </form>
                            <div class="py-4 px-3 pe-10">
                                <h4 class="text-lg pb-2 font-bold leading-5">
                                    <?= $item['title'] ?>
                                </h4>
                                <p class="text-sm">
                                    <?= $item['content'] ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="w-full text-center opacity-50 flex flex-col lg:flex-row justify-center items-center gap-2 py-16 px-4">
                    <?= iSad("1.5rem") ?>
                    There are no address added yet.
                </div>
            <?php } ?>
        </section>
    </article>
<?php endif; ?>

<?php
if ($UAC <= 2):

    $idss = [];

    $stmt = $pdo->prepare("SELECT * FROM static WHERE category = ?");
    $stmt->execute(["footer"]);
    $footer_details = $stmt->fetch();
    $footer_text = $footer_details['content'];
    $ftid = base64UrlEncode($footer_details['id']);

    $stmt = $pdo->prepare("SELECT * FROM static WHERE category = ?");
    $stmt->execute(["socials"]);
    $socials_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $socials = array_map(function ($item) {
        return $item['content'];
    }, $socials_data);
    $wplink = $socials[0] != null ? $socials[0] : "";
    $iglink = $socials[1] != null ? $socials[1] : "";
    $fblink = $socials[2] != null ? $socials[2] : "";
    $lilink = $socials[3] != null ? $socials[3] : "";

    foreach ($socials_data as $value) {
        array_push($idss, base64_encode($value['id']));
    }

?>

    <article class="md:bg-white dark:md:bg-slate-900 md:p-6 md:rounded-xl w-full mb-6 md:mb-12 border-t-2 border-dashed dark:border-slate-800 md:border-0 pt-6" id="footer_text">
        <h4 class="mb-8 font-semibold">You can update the contents of <a href="<?= $root ?>#final_footer" target="_blank" class="text-blue-600 dark:text-blue-300 border-b-2 border-dashed border-blue-600 dark:border-blue-300">footer</a> page</h4>
        <form action="modules/footer_update.php?ftid=<?= $ftid ?>" class="flex flex-col gap-4" method="POST" id="footercontent">
            <div class="flex flex-col gap-8">
                <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="copyright_text" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Copyright Text
                    </label>
                    <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Copyright Text" name="copyright_text" id="copyright_text" value="<?= $footer_text ?>" required />
                </div>
                <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="link_whatsapp" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Link for Whatsapp
                    </label>
                    <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Link for Whatsapp" name="links[]" id="link_whatsapp" value="<?= $wplink ?>" />
                </div>
                <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="link_instagram" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Link for Instagram Profile
                    </label>
                    <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Link for Instagram" name="links[]" id="link_instagram" value="<?= $iglink ?>" />
                </div>
                <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="link_facebook" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Link for Facebook Profile
                    </label>
                    <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Link for Facebook" name="links[]" id="link_facebook" value="<?= $fblink ?>" />
                </div>
                <div class="w-full ring-1 ring-slate-400 rounded dark:bg-slate-900 dark:ring-slate-600 focus-within:ring-2 focus-within:ring-blue-600 dark:focus-within:ring-blue-300 [&:has(input:focus:not(:placeholder-shown):invalid)]:ring-red-500 group relative transition-all">
                    <label for="link_linkedin" class="absolute top-0 left-4 mt-4 pointer-events-none select-none bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 group-focus-within:glabel [&:has(~input:not(:placeholder-shown))]:glabel [&:has(~input:focus:not(:placeholder-shown):invalid)]:text-red-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-300 px-1 transition-all">
                        Link for LinkedIn Profile
                    </label>
                    <input tabindex="1" class="block p-4 w-full text-slate-700 dark:text-slate-300 placeholder-transparent bg-transparent focus:outline-none group-[&:user-invalid]:ring-red-500 rounded" type="text" placeholder="" aria-label="Link for LinkedIn Profile" name="links[]" id="link_linkedin" value="<?= $lilink ?>" />
                </div>
                <?php foreach ($idss as $value): ?>
                    <input type="hidden" name="hah[]" value="<?= $value ?>">
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end items-center mt-6">
                <button type="submit" tabindex="1" class="text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md">Update</button>
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

<?php
require_once 'footer.php';
?>