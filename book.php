<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="form.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kayak trip</title>
</head>

<body>
    <div class="container mt-5">
       
        <?php
        

        $formComplete = false;

        if (isset($_POST["submit"]) && $_POST["submit"] === "Book") {
            $name = htmlspecialchars($_POST["name"] ?? "", ENT_QUOTES);
            $email = htmlspecialchars($_POST["email"] ?? "", ENT_QUOTES);
            $phone = htmlspecialchars($_POST["phone"] ?? "", ENT_QUOTES);
            $date = htmlspecialchars($_POST["date"] ?? "", ENT_QUOTES);
            $shuttle = htmlspecialchars($_POST["shuttle"] ?? "", ENT_QUOTES);
            $under = htmlspecialchars($_POST["under"] ?? "", ENT_QUOTES);
            $comments = nl2br(htmlspecialchars($_POST["comments"] ?? "", ENT_QUOTES));

            $formComplete = true;
            $errorMessages = [];

            if (trim($name) === "") {
                $formComplete = false;
                array_push($errorMessages, "Please enter your name");
            }
            if (trim($email) === "") {
                $formComplete = false;
                array_push($errorMessages, "Email address missing or incorrect");
            }
            if (trim($phone) === "") {
                $formComplete = false;
                array_push($errorMessages, "Phone missing");
            } elseif (strlen(trim($phone)) < 10) {
                $formComplete = false;
                array_push($errorMessages, "Phone format is wrong");
            } 
            if ($date === "") {
                $formComplete = false;
                array_push($errorMessages, "You do not choose the date");
            }
            if (!in_array($shuttle, ["yes", "no"])) {
                $formComplete = false;
                array_push($errorMessages, "Please tell us if you need shuttle service");
            }
            if ($under !== "ok") {
                $under = "no";
            }
            
            if ($formComplete) {
                $title = "Your booking Successfully!!!";
                echo '<span style="font-size: 50px;"> ' . $title. '</span>';
                echo "<div class=\"mb-3\">
                <b>Name</b>: $name<br>
                <b>Email</b>: $email<br>
                <b>Phone</b>: $phone<br>
                <b>Date</b>: $date<br>
                <b>Shuttle</b>: $shuttle<br>
                <b>Under 18</b>: $under<br>
                <b>Comments</b>: $comments</div>";
            } else {
                echo "<div class=\"mt-4 mb-3 text-danger\"><p class=\"fw-bold\">Validation errors:</p><ul>";
                foreach ($errorMessages as $errorMessage) {
                    echo "<li>$errorMessage</li>";
                }
                echo "</ul></div>";
            }
        }

        if (!$formComplete) {
            $title = "Book your April trip!!!";
            echo '<span style="font-size: 50px;"> ' . $title. '</span>';
        ?>
        <form method="post" action="" class="mt-4">
            <div class="mb-3">
                <label for="name"  class="form-label">Name</label>
                <input type="name" name="name" id="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number (eg. 9021345673)</label>
                <input type="phone" name="phone" id="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <select name="date" id="date" class="form-select">
                    <option value="">-- Please choose --</option>
                    <option value="April 2nd (Sunday)">April 2nd (Sunday)</option>
                    <option value="April 9th (Sunday)">April 9th (Sunday)</option>
                    <option value="April 16th (Sunday)">April 16th (Sunday)</option>
                    <option value="April 23rd (Sunday)">April 23rd (Sunday)</option>
                    <option value="April 30th (Sunday)">April 30th (Sunday)</option>
                </select>
            </div>
            <div class="input-group mb-1">
                <label class="form-label me-5">Shuttle Service</label>
                <div class="mb-3 me-4 form-check">
                    <input type="radio" name="shuttle" id="shuttle" value='yes' class="form-check-input">
                    <label class="form-check-label" for="shuttle">Yes</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="radio" name="shuttle" id="shuttle" value='no' class="form-check-input">
                    <label class="form-check-label" for="shuttle">No</label>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="under" id="under" class="form-check-input">
                <label class="form-check-label" for="under">Under 18? (People under 18 should pay extra insurance)</label>
            </div>
            <div class="mb-3">
                <label class="form-label" for="comments">Comments</label>
                <textarea name="comments" id="comments" class="form-control">
                </textarea>
            </div>
            <input type="submit" name="submit" value="Book" class="btn btn-primary">
        </form>
        <?php
        }
        ?>
    </div>
</body>

