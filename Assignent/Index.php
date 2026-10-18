<?php
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fields = [
        "name" => "Name",
        "pob" => "Place of Birth",
        "dob" => "Date of Birth",
        "address" => "Address",
        "gender" => "Gender",
        "telephone" => "Telephone",
        "email" => "Email",
        "parent_name" => "Parent Name",
        "parent_telephone" => "Parent Telephone",
        "relationship" => "Relationship",
        "student_id" => "Student ID",
        "faculty" => "Faculty",
        "department" => "Department",
        "class" => "Class",
        "registration_date" => "Registration Date"
    ];

    $data = [];

    foreach ($fields as $key => $label) {
        $data[$key] = trim($_POST[$key] ?? "");

        if ($data[$key] == "") {
            $errors[$key] = "$label is required.";
        }
    }

    // Validate name
    if (
        $data["name"] != "" &&
        !preg_match("/^[\p{L} ]+$/u", $data["name"])
    ) {
        $errors["name"] = "Name must contain letters and spaces only.";
    }

    // Validate email
    if (
        $data["email"] != "" &&
        !filter_var($data["email"], FILTER_VALIDATE_EMAIL)
    ) {
        $errors["email"] = "Please enter a valid email address.";
    }

    // Validate image
    if (
        !isset($_FILES["image"]) ||
        $_FILES["image"]["error"] == UPLOAD_ERR_NO_FILE
    ) {
        $errors["image"] = "Please upload a student image.";
    } elseif ($_FILES["image"]["error"] != UPLOAD_ERR_OK) {
        $errors["image"] = "Image upload failed.";
    } else {
        $imageInfo = @getimagesize($_FILES["image"]["tmp_name"]);
        $mime = $imageInfo["mime"] ?? "";

        $allowedTypes = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/gif" => "gif",
            "image/webp" => "webp"
        ];

        if (!isset($allowedTypes[$mime])) {
            $errors["image"] = "Only JPG, JPEG, PNG, GIF, and WEBP images are allowed.";
        }

        if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
            $errors["image"] = "Image must be 5 MB or less.";
        }
    }

    // If there are no errors, save image and redirect
    if (empty($errors)) {

        $uploadDir = "uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $extension = $allowedTypes[$mime];
        $imageName = bin2hex(random_bytes(8)) . "." . $extension;

        if (move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            $uploadDir . $imageName
        )) {
            $data["image"] = $imageName;

            $_SESSION["student"] = $data;

            header("Location: result.php");
            exit;
        } else {
            $errors["image"] = "Unable to save the image.";
        }
    }
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container my-5">

    <div class="card shadow p-4 mx-auto form-card">

        <h2 class="text-center mb-2">
            Student Registration Form
        </h2>

        <p class="text-center text-muted">
            Jamhuriya University of Science & Technology
        </p>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <strong>Please correct the following errors:</strong>

                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST"
              action="index.php"
              enctype="multipart/form-data">

            <!-- PERSONAL INFORMATION -->

            <h4 class="section-title">Personal Information</h4>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name"
                       class="form-control"
                       value="<?= e($_POST['name'] ?? '') ?>"
                       required>

                <?php if (isset($errors['name'])): ?>
                    <small class="text-danger">
                        <?= e($errors['name']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Place of Birth (POB)</label>
                <input type="text" name="pob"
                       class="form-control"
                       value="<?= e($_POST['pob'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth (DOB)</label>
                <input type="date" name="dob"
                       class="form-control"
                       value="<?= e($_POST['dob'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address"
                       class="form-control"
                       value="<?= e($_POST['address'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Telephone</label>
                <input type="tel" name="telephone"
                       class="form-control"
                       value="<?= e($_POST['telephone'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email"
                       class="form-control"
                       value="<?= e($_POST['email'] ?? '') ?>"
                       required>

                <?php if (isset($errors['email'])): ?>
                    <small class="text-danger">
                        <?= e($errors['email']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Student Image</label>
                <input type="file" name="image"
                       class="form-control"
                       accept=".jpg,.jpeg,.png,.gif,.webp"
                       required>

                <?php if (isset($errors['image'])): ?>
                    <small class="text-danger">
                        <?= e($errors['image']) ?>
                    </small>
                <?php endif; ?>
            </div>


            <!-- PARENT INFORMATION -->

            <h4 class="section-title mt-4">Parent Information</h4>

            <div class="mb-3">
                <label class="form-label">Parent Name</label>
                <input type="text" name="parent_name"
                       class="form-control"
                       value="<?= e($_POST['parent_name'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Parent Telephone</label>
                <input type="tel" name="parent_telephone"
                       class="form-control"
                       value="<?= e($_POST['parent_telephone'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Relationship</label>
                <select name="relationship" class="form-select" required>
                    <option value="">Select Relationship</option>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Guardian">Guardian</option>
                    <option value="Other">Other</option>
                </select>
            </div>


            <!-- ACADEMIC INFORMATION -->

            <h4 class="section-title mt-4">Academic Information</h4>

            <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="text" name="student_id"
                       class="form-control"
                       value="<?= e($_POST['student_id'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Faculty</label>
                <input type="text" name="faculty"
                       class="form-control"
                       value="<?= e($_POST['faculty'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Department</label>
                <input type="text" name="department"
                       class="form-control"
                       value="<?= e($_POST['department'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Class</label>
                <input type="text" name="class"
                       class="form-control"
                       value="<?= e($_POST['class'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Registration Date</label>
                <input type="date" name="registration_date"
                       class="form-control"
                       value="<?= e($_POST['registration_date'] ?? '') ?>"
                       required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">
                Register Student
            </button>

        </form>
    </div>
</div>

</body>
</html>