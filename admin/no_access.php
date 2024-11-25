<?php
$title = 'No Access';
$active = -1;
$pageCategory = null;
require_once 'header.php';
?>
<!-- TODO: Check whether the user is the administrator -->

<h2 class="mb-2 font-semibold text-xl text-slate-800 dark:text-slate-100">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<p class="mb-8 text-slate-600 dark:text-slate-300">Currently you're not given any authorization to work. <br>Please wait or contact your administrator for access control and try logging in again.</p>

<?php
require_once 'footer.php';
?>