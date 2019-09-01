<!-- Funktion zum Login -->
<?php
include ("db_connect.php");
    #Falls der User schon eingeloggt ist, wird er auf die Startseite weitergeleitet
    if ($_SESSION["login"] == 1)
    {
    	include("index.php");
    }
    if (!empty($_POST["submit"]))
    {
        #Überprüfung, ob der User sich als Mitarbeiter anmelden will
        if ($_POST["mitarbeiter"] == "mitarbeiter")
	       {
    	        $username = $_POST["username"];
    	        $passwort =$_POST["passwort"];
    	        $anfrage = "SELECT *   
    					FROM Mitarbeiter
    					WHERE Name='$username' AND
    					Passwort='$passwort'";

    	        $result = mysqli_query($db, $anfrage);
    	        $anzahl = mysqli_num_rows($result);
    	        #Falls es für den User einen Eintrag in der Mitarbeiter Tabelle gibt, wird eine Mitarbeiter Session gestartet
                $_SESSION["admin"]=1;
            	}
    	#Falls ein Kunde sich einloggt
        else
    		{
    	        $username = $_POST["username"];
    	        $passwort =$_POST["passwort"];
    	        $anfrage = "SELECT *
    					FROM Kunde
    					WHERE Email='$username' AND
    					Passwort='$passwort'";

    	        $result = mysqli_query($db, $anfrage);
    	        $anzahl = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
    	        #Session Variable zur Identifikation eines Mitarbeiters wird auf Null gesetzt
                #Damit ist der Kunde nicht als Mitarbeiter eingeloggt
                $_SESSION["admin"]=0;
                #Speichern des eingeloggten Kunden anhand seiner KundenNr
                $_SESSION["user_id"]=$row["KundenNr"];
    		}
	   #Falls es eine Übereinstimmung zwischen eingegebenen Username und Passwort in der Datenbank gibt -> login erfolgreich
       if ($anzahl > 0)
            {
            echo "Der Login war erfolgreich.<br>";
            #User ist Eingeloggt
            $_SESSION["login"] = 1;
            #Speichern des aktuellen Users
            $_SESSION["user"] = $username;
            #Weiterleitung auf Startseite
            include ("index.php");
            }
        else
            {
            echo "<p align=center><font color='red'>Die Logindaten sind nicht korrekt.</font></p><br>";
            }
	}
#Falls User noch nicht eingeloggt -> weiterleitung auf das Login Formular
if ($_SESSION["login"] == 0)
        {
        include("login.html");
        mysql_close($db);
        exit;
        }

mysql_close($db);
?>