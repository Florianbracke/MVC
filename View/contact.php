<?php include("includes/headerIndex.php"); ?>

<?php include("includes/navIndex.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="contact.css">
    <title>Contact Us</title>
</head>

<body>
    <section class="contact">
        <div class="content">
            <h2>Contact Us</h2>
            <p>For any queries, suggestions or feedback, please contact us. Happy to organize. Happy to help. Subscribe for newsletter for further updates on Digital closet.</p>
        </div>

        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>Kon. Astridlaan 185, <br>9000 Gent</p>
                    </div>
                </div>

                <div class="box">
                    <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>Florian's Email: </p>
                        <p>Fran's Email: </p>
                        <p>Maureen's Email: </p>
                        <p>Vidya's Email: </p>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <form action="" method="post" id="contact-form">
                    <h2>Hello,</h2>
                    <input type="text" name="name" class="form-control" placeholder="Your name" required><br>

                    <input type="text" name="email" class="form-control" placeholder="Your email" required><br>

                    <textarea name="message" placeholder="Message" rows="5" class="form-control" required></textarea><br>

                    <input type="submit" class="submit" value="Send Message">
                </form>
            </div>
        </div>
    </section>
</body>

</html>