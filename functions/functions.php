<?php
//All the below functions are helper functions.

//clearing from the form when unwanted data is given
function clean($string)
{
    return htmlentities($string);
}

//to redirect to a particular page
function redirect($location)
{
    return header("Location: {$location}");
}

//Sending messages when there's an error
function set_message($message)
{
    if (!empty($message)) {
        $_SESSION['message'] = $message;
    } else {
        $message = "";
    }
}

//displaying the above messages
function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

//for security
function token_generator()
{
    //creates a unique ID with a random number as a prefix 
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
}

//All the below functions are validation functions for registration
function validation_errors($error_message)
{
    $error_message = <<<DELIMITER

                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <strong>Warning! </strong> $error_message
              </div>
              DELIMITER;

    return $error_message;
}

function email_exists($email)
{
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = query($sql);

    if (row_count($result) ==  1) {
        return true;
    } else {
        return false;
    }
}

function username_exists($username)
{
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $result = query($sql);

    if (row_count($result) ==  1) {
        return true;
    } else {
        return false;
    }
}

//Sending email for activation
function send_email($email, $subject, $msg, $header)
{
    return mail($email, $subject, $msg, $header);
}

//For validating user registration
function validate_user_registration()
{
    $min = 3;
    $max = 20;
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //echo "working";
        //Getting the values from the form and cleaning the values
        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $username = clean($_POST['username']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);

        if (strlen($first_name) < $min) {
            //echo "3 working";
            $errors[] = "First name cannot be less than {$min} characters!";
        }

        if (strlen($first_name) > $max) {
            //echo "3 working";
            $errors[] = "First name cannot be more than {$max} characters!";
        }

        if (strlen($last_name) < $min) {
            //echo "3 working";
            $errors[] = "Last name cannot be less than {$min} characters!";
        }

        if (strlen($last_name) > $max) {
            //echo "3 working";
            $errors[] = "Last name cannot be more than {$max} characters!";
        }

        if (username_exists($username)) {
            $errors[] = "Sorry, this username has already been taken!";
        }

        if (strlen($username) < $min) {
            //echo "3 working";
            $errors[] = "Username cannot be less than {$min} characters!";
        }

        if (strlen($username) > $max) {
            //echo "3 working";
            $errors[] = "Username cannot be more than {$max} characters!";
        }

        if (email_exists($email)) {
            $errors[] = "Sorry, this email has already been registered!";
        }

        if (strlen($email) < $min) {
            //echo "3 working";
            $errors[] = "Email cannot be more than {$max} characters!";
        }

        if ($password !== $confirm_password) {
            $errors[] = "Passwords are not matching!";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                //calling function for error[refactored]
                echo validation_errors($error);
            }
        } else {
            if (register_user($first_name, $last_name, $username, $email, $password)) {

                set_message("<p class='bg-success text-center'>Please check your email/spam folder for an activation link for your account.");

                redirect("index.php");

                //echo "New User Registered";
            } else {
                set_message("<p class='bg-danger text-center'>Sorry your account could not be registered!!.");

                redirect("index.php");
            }
        }
    }
}

//registering a new user
function register_user($first_name, $last_name, $username, $email, $password)
{

    $first_name = escape($first_name);
    $last_name = escape($last_name);
    $username = escape($username);
    $email = escape($email);
    $password = escape($password);

    if (email_exists($email)) {
        return false;
    } elseif (username_exists($username)) {
        return false;
    } else {
        $password = md5($password); //very secure
        $validation_code = md5($username);

        $sql = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active) VALUES('$first_name','$last_name','$username','$email', '$password','$validation_code',0)";

        $result = query($sql);
        confirm($result);

        $subject = "Activation of Digital closet.";
        $msg = "Please click the link below to activate your account : 
                http://localhost/login/activate.php?email=$email&code=$validation_code";

        $header = "From: noreply@DigitalCloset.com";

        send_email($email, $subject, $msg, $header);

        return true;
    }
} //func register_user

//All the functions below are to help in activating user
function activate_user()
{
    //echo "hi";
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['email'])) {
            $email = clean($_GET['email']);
            $validation_code = clean($_GET['code']);
            //echo $email;
            //echo $validation_code;
            //echo "hi";

            $sql = "SELECT id FROM users WHERE email = '" . escape($_GET['email']) . "' AND validation_code = '" . escape($_GET['code']) . "' ";

            $result = query($sql);
            confirm($result);

            if (row_count($result) == 1) {
                $sql2 = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '" . escape($email) . "' AND validation_code = '" . escape($validation_code) . "'";

                $result2 = query($sql2);
                confirm($result2);

                set_message("<p class='bg-success'>Your account has been activated. Please login!</p>");

                redirect("login.php");
            } else {

                set_message("<p class='bg-danger'>Your account is not activated. Please check your spam!</p>"); //not displayed for some reason

                redirect("login.php");
            }
        }
    }
}

//Below functions are for login system

//validating the user login
function validate_user_login()
{
    $min = 3;
    $max = 20;
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //echo "working";
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);

        if (empty($email)) {
            $errors[] = "Email field can't be empty";
        }

        if (empty($password)) {
            $errors[] = "Password field can't be empty";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                //calling function for error[refactored]
                echo validation_errors($error);
            }
        } else {
            if (login_user($email, $password)) {
                redirect("admin.php"); //can change to different pages if login successful
            } else {
                echo validation_errors("Check your username or password!");
            }
        }
    }
} //validate user login function

//Login functions
function login_user($email, $password)
{
    $sql = "SELECT password, id FROM users WHERE email = '" . escape($email) . "' AND active = 1";
    $result = query($sql);

    if (row_count($result) ==  1) {
        $row = fetch_array($result);
        $db_password = $row['password'];

        if (md5($password) === $db_password) {
            $_SESSION['email'] = $email;
            return true;
        } else {
            return false;
        }
        return true;
    } else {
        return false;
    }
} //user login function

//logged in
function logged_in()
{
    if (isset($_SESSION['email'])) {
        return true;
    } else {
        return false;
    }
}
