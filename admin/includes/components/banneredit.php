<?php
if ($UAC <= 2):
    if (!empty($bannerpage)) {
        $filename = $bannerpage .  "_banner";
        $filepath = $updir . "uploads/" . $filename . ".webp";
        $filepathwodir = "uploads/" . $filename . ".webp";
?>

        <form class="mb-8 border-b-2 border-dashed dark:border-slate-800 md:border-0 pb-6 flex flex-col items-end" enctype="multipart/form-data" method="POST" action="modules/update_banner.php?name=<?= $bannerpage ?>" id="confirmbanner" data-imagepath="<?= $filepathwodir ?>">
            <input type="hidden" value="<?= $filename ?>" name="filename">
            <div class="overflow-hidden rounded-xl w-full h-40 md:h-fit max-h-60 relative border-2 border-dashed border-blue-400 dark:border-blue-300 fileupload group">
                <input type="file" name="bannerimg" id="bannerimg" accept="image/*" class="absolute left-0 h-full w-full opacity-0 cursor-pointer"
                    onchange="setupImagePreview(this, 'bannerimg', true)" oninput="checkImage(this, true, false, true)">
                <img src="<?= $filepath ?>?<?= time() ?>" alt="Page Banner Image" class="h-full w-full object-cover">
                <span class="editbtn">
                    <?= iPen('1.2rem') ?>
                </span>
            </div>
            <button type="submit" class="mt-2 text-sm px-6 py-2.5 font-medium tracking-wide text-white capitalize transition-all duration-300 transform bg-blue-600 dark:bg-blue-500  rounded-full hover:bg-blue-400 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 ring-blue-600/60 ring-offset-2 dark:ring-blue-300 dark:ring-offset-gray-800 hover:shadow-lg focus:shadow-lg active:shadow-md" style="display: none;">Upload</button>
        </form>
    <?php } else { ?>
        <p class="text-sm my-4">Please provide the <span class="underline">bannerpage</span> variable.</p>
<?php }
endif;
?>