<?php
// /admin/includes/functions.php
// ac_pg = Access Page
function ac_pg($pdo, $username)
{
    // Checking the user access page
    $stmt = $pdo->prepare("SELECT page FROM user_page_access WHERE username = ?");
    $stmt->execute([$username]);
    $access = array_map(function ($item) {
        return $item['page'];
    }, $stmt->fetchAll(PDO::FETCH_ASSOC));
    return $access;
}

function check_login($pdo)
{
    if (isset($_COOKIE['rememberme'])) {
        $cookie_data = unserialize(base64_decode($_COOKIE['rememberme']));

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$cookie_data['username']]);
        $user = $stmt->fetch();

        if ($user && $cookie_data['password'] === $user['password']) {
            // Log the user in
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $cookie_data['username'];
            $_SESSION['last_activity'] = time(); // Set the time of the last activity
            $_SESSION['access_pages'] = ac_pg($pdo, $cookie_data['username']);
            $_SESSION['UAC'] = $cookie_data['UAC'];
        }
    }
}

function check_user($pdo, $username)
{
    $stmt = $pdo->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    return $stmt->rowCount() > 0 ? true : false;
}

function is_logged_in()
{
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

function handle_session_timeout($timeout_duration, $rootdir)
{
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: " . $rootdir . "login?message=Session timed out. Please log in again.");
        exit;
    }
    $_SESSION['last_activity'] = time(); // Update last activity time
}

function convertToIco($sourceImagePath, $destinationIcoPath, $size = 64)
{
    // Check if the source file exists
    if (!file_exists($sourceImagePath)) {
        return false;
    }

    // Get the image information
    $imageInfo = getimagesize($sourceImagePath);

    if (!$imageInfo) {
        return false;
    }

    $width = $imageInfo[0];
    $height = $imageInfo[1];
    $imageType = $imageInfo[2];

    // Create an image resource from the source image based on its type
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourceImagePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourceImagePath);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourceImagePath);
            break;
        default:
            return false;
    }

    if (!$sourceImage) {
        return false;
    }

    // Create a new true color image with the specified size (default 64x64)
    $destinationImage = imagecreatetruecolor($size, $size);

    // Preserve transparency for PNG and GIF images
    if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
        imagecolortransparent($destinationImage, imagecolorallocate($destinationImage, 0, 0, 0));
        imagealphablending($destinationImage, false);
        imagesavealpha($destinationImage, true);
    }

    // Resize the source image to the new size
    imagecopyresampled($destinationImage, $sourceImage, 0, 0, 0, 0, $size, $size, $width, $height);

    // Save the resized image as an ICO file
    $icoFile = fopen($destinationIcoPath, 'w');
    if (!$icoFile) {
        return false;
    }

    // Write ICO header
    fwrite($icoFile, pack('vvv', 0, 1, 1));
    fwrite($icoFile, pack('CCCCvvVV', $size, $size, 0, 0, 1, 32, 40, $size * $size * 4));

    // Write BMP header
    fwrite($icoFile, pack('VVVvvVVVVVV', 40, $size, $size * 2, 1, 32, 0, $size * $size * 4, 0, 0, 0, 0));

    // Write pixel data
    for ($y = $size - 1; $y >= 0; $y--) {
        for ($x = 0; $x < $size; $x++) {
            $color = imagecolorat($destinationImage, $x, $y);
            $rgba = imagecolorsforindex($destinationImage, $color);
            fwrite($icoFile, pack('CCCC', $rgba['blue'], $rgba['green'], $rgba['red'], $rgba['alpha'] ^ 0xFF));
        }
    }

    // Write the AND mask (none in this case, full transparency)
    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < ceil($size / 8); $x++) {
            fwrite($icoFile, pack('C', 0));
        }
    }

    fclose($icoFile);

    // Destroy the images
    imagedestroy($sourceImage);
    imagedestroy($destinationImage);

    return true;
}

function isValidSVG($input)
{
    // Check if the input contains the <svg> tag
    if (strpos($input, '<svg') === false || strpos($input, '</svg>') === false) {
        return false;
    }

    // Load the string into a DOMDocument for further validation
    $dom = new DOMDocument();

    // Disable libxml errors and allow user to fetch error information as needed
    libxml_use_internal_errors(true);

    $dom->loadXML($input, LIBXML_NOERROR | LIBXML_NOWARNING);

    // Check for errors
    $errors = libxml_get_errors();
    libxml_clear_errors();

    // If there are errors, it's not a valid SVG
    if (!empty($errors)) {
        return false;
    }

    // Validate if the root element is indeed an SVG element
    $rootElement = $dom->documentElement;
    if ($rootElement && $rootElement->tagName === 'svg') {
        return true;
    }

    return false;
}

function renderJobDescription($description)
{
    // Split the job description by '#'
    $jdesc_headings = explode('#', $description);

    foreach ($jdesc_headings as $jdesc_heading) {
        $jdesc_heading = trim($jdesc_heading); // Remove any leading or trailing spaces

        if (strlen($jdesc_heading) > 0) { // Check if there's any content
            if (strpos($jdesc_heading, '-') !== false) { // Check if there's a '-' in the heading
                $jdesc = explode('- ', $jdesc_heading);
                // The first element in $jdesc is the heading
                $heading = trim(array_shift($jdesc));
                if (strlen($heading) > 0) {
                    echo "<h2 class='heading-list'>$heading</h2>"; // Display the heading
                }
                // The rest are list items
                foreach ($jdesc as $desc) {
                    $desc = trim($desc);
                    if (strlen($desc) > 0) {
                        echo "<li class=\"list-disc\">$desc</li>"; // Display list item
                    }
                }
            } else {
                // If there's no '-' at all, treat the whole segment as a heading
                echo "<p>$jdesc_heading</p>";
            }
        }
    }
}

function truncateText($text, $maxChars = 50)
{
    // Check if the text length is greater than the maximum allowed characters
    if (strlen($text) > $maxChars) {
        // Truncate the text to the maximum number of characters and add '...'
        return substr($text, 0, $maxChars) . '...';
    }

    // Return the original text if the character count is within the limit
    return $text;
}



/**
 * Function to handle image uploads and conversion to WebP format.
 *
 * @param array $file The uploaded file from the $_FILES array.
 * @param string $uploadDir The directory where the file should be uploaded.
 * @param string $file_name_prefix The file name that should be saved in.
 * @return array An associative array containing 'success' (bool) and 'filename' or 'error'.
 */
function uploadImage($file, $uploadDir, $file_name_prefix = 'unlabel', $quality = 80)
{
    // Check if the file is uploaded and there is no error
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $tempName = $file['tmp_name'];
        $image = imagecreatefromstring(file_get_contents($tempName));

        $filename = "$file_name_prefix.webp";
        $imagePath = $uploadDir . $filename;

        if ($image !== false) {
            if (imagewebp($image, $imagePath, $quality)) {
                imagedestroy($image);
                return [
                    'success' => true,
                    'filename' => $filename
                ]; // Return success with filename
            } else {
                return [
                    'success' => false,
                    'error' => "Failed to save the WebP image."
                ]; // Return failure with error message
            }
        } else {
            return [
                'success' => false,
                'error' => "Failed to create an image from the uploaded file."
            ]; // Return failure with error message
        }
    } else {
        return [
            'success' => false,
            'error' => "Error: " . ($file['error'] ?? 'No file uploaded')
        ]; // Return failure with error message
    }
}


/**
 * Function to delete an image file from the server.
 *
 * @param string $filePath The full path to the image file to be deleted.
 * @return array An associative array containing 'success' (bool) and 'message'.
 */
function deleteImage($filePath)
{
    // Check if the file exists
    if (file_exists($filePath)) {
        // Attempt to delete the file
        if (unlink($filePath)) {
            return [
                'success' => true,
                'message' => "File deleted successfully."
            ]; // Return success message
        } else {
            return [
                'success' => false,
                'message' => "Failed to delete the file."
            ]; // Return failure message
        }
    } else {
        return [
            'success' => false,
            'message' => "File does not exist."
        ]; // Return file not found message
    }
}


// Encoding and decoding
function base64UrlEncode($data)
{
    return urlencode(base64_encode($data));
}
function base64UrlDecode($data)
{
    return urldecode(base64_decode($data));
}

// Checking if there exist any domain in this given name
function checkEmail($email)
{
    $dns = explode("@", $email);
    return checkdnsrr($dns[1]);
}

// Finding the level/priority
function findLevel($num)
{
    switch ($num) {
        case 1:
            return ("Admin");
            break;
        case 2:
            return ("Content Editor");
            break;
        case 3:
            return ("Manager");
            break;
        case 4:
            return ("Viewer");
            break;
        default:
            return ("Unassigned");
            break;
    }
}

// Function to log user details when they log in
function logUserLoginDetails()
{
    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        return;
    }

    $username = $_SESSION['username'];
    $log_file = 'logs/users.log';
    date_default_timezone_set("Asia/Kolkata");
    $login_time = date("Y-m-d H:i:s");

    // Get user's IP address
    $ip = !empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

    // Get geolocation data
    $location_data = json_decode(file_get_contents("https://ipinfo.io/{$ip}/json"), true);
    $location = isset($location_data['city']) ? "{$location_data['city']}, {$location_data['region']}, {$location_data['country']}" : 'Unknown';

    // Get browser and OS details from the user agent
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Format the log message
    $log_message = "[{$login_time}] - User: {$username}, IP: {$ip}, Location: {$location}, User-Agent: {$user_agent}\n";

    // Write the log message to the file
    if (file_put_contents($log_file, $log_message, FILE_APPEND) === false) {
        return "Error: Unable to write to log file.";
    }
}
