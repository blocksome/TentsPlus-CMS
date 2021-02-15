<!doctype html>
<?php ob_start(); ?>
<html lang="en">

<?php
include("inc/crud/db-login.php");

?>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body id="login-body">

    <form name="login-form" id="login-form" class="flex">
        <h2>TentsPlus CMS Login</h2>

        <div>
            <label for="username">Username:</label>
            <input type="text" id="login-username" name="username">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="login-password" name="password">
        </div>

        <input type="button" id="login-btn" name="login-btn" value="Log In">
        <h3 id="error-msg"></h3>

    </form>

    <!--jQquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous">
    </script>

    <!--Local Script-->
    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>