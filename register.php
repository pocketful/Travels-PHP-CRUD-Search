<?
/**
 * Displays the registration form if the user needs to sign-up,
 * or lets the user know, if he's already logged in, that he
 * can't register another name.
 */
include("include/session.php");
?>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
    <title>Registracija</title>
    <link href="include/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table class="center">
    <tr>
        <td>
            <img src="pictures/top.png"/>
        </td>
    </tr>
    <tr>
        <td>
            <table style="background-color:#F8F8F8;">
                <tr>
                    <td>
                        Atgal į <a href="index.php">pradžią</a>
                    </td>
                </tr>
            </table>
            <?
            /**
             * The user is already logged in
             */
            if ($session->logged_in) {
                header("Location: index.php");
            }
            /**
             * The user has submitted the registration form and the
             * results have been processed.
             */
            else if (isset($_SESSION['regsuccess'])) {
                /* Registracija sėkminga */
                if ($_SESSION['regsuccess']) {
                    echo "<p style=\"margin-left:20px\">Ačiū, <b>" . $_SESSION['reguname'] . "</b>, Jūsų duomenys buvo sėkmingai įvesti į duomenų bazę, galite "
                        . "<a href=\"index.php\">prisijungti</a>.</p><br>";
                }
                /* Registracija nesėkminga */ else {
                    echo "<p>Atsiprašome, bet vartotojo <b>" . $_SESSION['reguname'] . "</b>, "
                        . " registracija nebuvo sėkmingai baigta.<br>Bandykite vėliau.</p>";
                }
                unset($_SESSION['regsuccess']);
                unset($_SESSION['reguname']);
            }
            /**
             * The user has not filled out the registration form yet.
             * Below is the page with the sign-up form, the names
             * of the input fields are important and should not
             * be changed.
             */
            else {
                ?>
                <div align="center" style="margin-bottom:20px;">
                    <?
                    if ($form->num_errors > 0) {
                        echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                    }
                    ?>
                    <table>
                        <tr>
                            <td>
                                <form action="process.php" method="POST" class="login">
                                    <center style="font-size:18pt;"><b>Registracija</b></label></center>
                                    <p style="text-align:left;">Vartotojo vardas:
                                        <input class ="s1" name="user" type="text" size="15"
                                               value="<? echo $form->value("user"); ?>"/><br><? echo $form->error("user"); ?>
                                    </p>
                                    <p style="text-align:left;">Slaptažodis:
                                        <input class ="s1" name="pass" type="password" size="15"
                                               value="<? echo $form->value("pass"); ?>"/><br><? echo $form->error("pass"); ?>
                                    </p>
                                    <p style="text-align:left;">El. paštas:
                                        <input class ="s1" name="email" type="text" size="15"
                                               value="<? echo $form->value("email"); ?>"/><br><? echo $form->error("email"); ?>
                                    </p>
                                    <p style="text-align:left;">
                                        <input type="hidden" name="subjoin" value="1">
                                        <input type="submit" value="Registruotis">
                                    </p>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
                <?
            }
            echo "<tr><td>";
            include("include/footer.php");
            echo "</td></tr>";
            ?>
        </td>
    </tr>
</table>
</body>
</html>