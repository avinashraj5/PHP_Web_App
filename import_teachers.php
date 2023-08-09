<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "login";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["excel_file"]) && $_FILES["excel_file"]["error"] == UPLOAD_ERR_OK) {
        $filename = $_FILES["excel_file"]["name"];
        $tmpfile = $_FILES["excel_file"]["tmp_name"];

        // Check if the uploaded file is a CSV file
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (strtolower($extension) === 'csv') {
            // Read the CSV file
            $handle = fopen($tmpfile, "r");
            if ($handle !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    // Get the teacher data from each row
                    $username = $data[0];
                    $email = $data[1];
                    $phone = $data[2];
                    $gender = $data[3];
                    $address = $data[4];
                    $token =bin2hex(random_bytes(15));
                    // Insert the teacher into the database
                    $sql = "INSERT INTO signup(name, email, mobile, gender, address,token) 
                            VALUES ('$username', '$email', '$phone', '$gender', '$address', '$token')";
                    $conn->query($sql);
                }
                fclose($handle);
                ?>
                <script>
                        location.replace("home.php");
                  alert("Teachers imported successfully.")
                </script>
                <?php
            } else {
                echo "Error reading the CSV file.";
            }
        } else {
            echo "Invalid file format. Please upload a CSV file.";
        }
    } else {
        echo "Error uploading the file.";
    }
}

$conn->close();
?>
