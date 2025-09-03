<?php
require 'flight/Flight.php';

// Connexion à la base de données PostgreSQL
$db_host = 'localhost';
$db_user = 'postgres';
$db_password = 'postgres';
$db_name = 'LostInZoom';

$conn = pg_connect("host=$db_host dbname=$db_name port='5432' user=$db_user password=$db_password");
if (!$conn) {
    die("<script>console.log('Erreur de connexion');</script>" . pg_last_error());
} else {
    echo "<script>console.log('Connexion réussie');</script>";
}

// Route principale
Flight::route('GET /', function () {
    Flight::render('accueil');
});

// Route pour enregistrer un participant
Flight::route('/index_LBC.php', function () use ($conn) {
    $query = "INSERT INTO participants (created_at) VALUES (CURRENT_TIMESTAMP) RETURNING id";
    $result = pg_query($conn, $query);
    
    if ($result) {
        $row = pg_fetch_assoc($result);
        $id = $row['id'];
        session_start();
        $_SESSION['participant_id'] = $id;
    }
    Flight::render('index_LBC');
});

// Route de fin pour stocker les résultats
Flight::route('/fin', function () use ($conn) {
    session_start();

    if (isset($_SESSION['participant_id'])) {
        $participant_id = $_SESSION['participant_id'];
        $table_name = "table_$participant_id";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Création de la table spécifique au participant
            $create_table_query = "
                CREATE TABLE IF NOT EXISTS $table_name (
                    Type VARCHAR(255),
                    Zoom_9 VARCHAR(255),
                    Zoom_10 VARCHAR(255),
                    Zoom_11 VARCHAR(255),
                    Zoom_12 VARCHAR(255),
                    Zoom_13 VARCHAR(255),
                    Zoom_14 VARCHAR(255),
                    Zoom_15 VARCHAR(255),
                    Zoom_16 VARCHAR(255)
                )
            ";
            $result = pg_query($conn, $create_table_query);
            
            if ($result) {
                $types = ['batiment', 'urban', 'toponym', 'linear', 'surface', 'railway'];
                foreach ($types as $type) {
                    $insert_row_query = "INSERT INTO $table_name (Type) VALUES ('$type')";
                    pg_query($conn, $insert_row_query);
                }
            }
            
            // Mise à jour des valeurs des zooms
            foreach ($_POST as $zoom_key => $types) {
                if (preg_match('/zoom_(\d+)/', $zoom_key, $matches)) {
                    $zoom_level = $matches[1];
                    foreach ($types as $type => $value) {
                        if (!empty($value)) {
                            $safe_zoom = pg_escape_string($conn, "Zoom_$zoom_level");
                            $safe_type = pg_escape_string($conn, $type);
                            $safe_value = pg_escape_string($conn, $value);

                            $update_query = "
                                UPDATE $table_name
                                SET $safe_zoom = '$safe_value'
                                WHERE Type = '$safe_type'
                            ";
                            pg_query($conn, $update_query);
                        }
                    }
                }
            }
        }
    }
    Flight::render('fin');
});

Flight::start();
?>
