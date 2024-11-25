<?php
// Include the database connection
require 'config.php';
require_once '../admin/includes/functions.php'; // Functions form the admin

// Function to handle job application form submission
function handleJobApplication($pdo, $job_id, $name, $phone, $email, $resume)
{
    // Define the directory to store uploaded resumes
    $uploadDir = '../admin/resumes/';

    // Validate the resume file
    if ($resume['size'] > 0 && $resume['size'] <= 2 * 1024 * 1024) { // Check if file size is below 2MB
        $fileExtension = pathinfo($resume['name'], PATHINFO_EXTENSION);
        $allowedExtensions = ['pdf', 'doc', 'docx'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $uniqueFileName = uniqid() . '_' . $resume['name']; // To avoid file name conflicts
            $resumePath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($resume['tmp_name'], $resumePath)) {
                // File uploaded successfully, now save details in the database
                try {
                    $stmt = $pdo->prepare("INSERT INTO jobs_applied (job_id, name, phone, email, resume) VALUES (:job_id, :name, :phone, :email, :resume)");
                    $stmt->execute([
                        ':job_id' => $job_id,
                        ':name' => htmlspecialchars($name),
                        ':phone' => htmlspecialchars($phone),
                        ':email' => htmlspecialchars($email),
                        ':resume' => "$uniqueFileName"
                    ]);

                    return ["Application submitted successfully!", true];
                } catch (PDOException $e) {
                    return ["Error: " . $e->getMessage(), false];
                }
            } else {
                return ["Failed to upload resume.", false];
            }
        } else {
            return ["Invalid file type. Only PDF, DOC, and DOCX files are allowed.", false];
        }
    } else {
        return ["Resume file size should be below 2MB.", false];
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the job_id from the URL parameter
    $jid = base64UrlDecode($_GET['jid']);
    $job_id = isset($jid) ? intval($jid) : 0;
    $job_name = urldecode($_GET["jbn"]) ?? 'this Job';

    $phno = $_POST['country_code'] . ' ' . $_POST['phone'];

    // Checking if the user already applied for this job role
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM jobs_applied WHERE (phone = ? OR email = ?) AND job_id = ?");
    $stmt->execute([$phno, $_POST['email'], $job_id]);
    $data = $stmt->fetch();

    if ($data[0] > 0) {
        $msg_text = "You have already applied for $job_name role.";
        $success = false;
    } else {
        if ($job_id > 0) {
            // Call the function to handle form submission
            $returntext = handleJobApplication($pdo, $job_id, $_POST['name'], $phno, $_POST['email'], $_FILES['resume']);
            $msg_text = $returntext[0];
            $success = $returntext[1];
        } else {
            $msg_text = "Invalid job ID.";
            $success = false;
        }
    }
} else {
    $msg_text = "Method was invalid";
    $success = false;
}

$success = urlencode($success);
$msg_text = urlencode($msg_text);


header("Location: ../jobapplied.php?success=$success&error=$msg_text&jbn=$job_name");
exit();