<?php
$title = 'Welcome';
$active = -1;
$pageCategory = null;
$fullpage = true;
require_once 'header.php';
?>
<style>
    .admin .introbg {
        background: url(assets/bg.webp) center/cover no-repeat;
    }

    .dark .admin .introbg {
        background: none;
    }
</style>
<section class="relative grid place-items-center h-full p-8 introbg">
    <div class="grid gap-4 md:gap-6 text-center">
        <h2 class="font-bold text-4xl md:text-6xl text-slate-800 dark:text-slate-100">Hello, <?= htmlspecialchars($_SESSION['username']); ?></h2>
        <p class="text-slate-600 dark:text-slate-300">Welcome on-board, let's navigate your tasks together.</p>
    </div>
    <div class="absolute bottom-10">
        <button onclick="alert('Not Available in Dev Branch')" class="px-6 py-3 backdrop-blur-xl bg-white/40 dark:bg-black/30 rounded-full font-medium text-sm group flex justify-center items-center gap-1.5 hover:-translate-y-0.5 transition-transform">
            Starter Video Guide <span class="-translate-y-0.5"><?= icExtlink("1.2rem") ?></span>
        </button>
    </div>
</section>

<?php
require_once 'footer.php';
?>