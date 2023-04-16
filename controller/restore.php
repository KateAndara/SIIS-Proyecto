<?php
class Restore {
 
    private $DB_HOST = 'localhost';
    private $DB_USER = 'SIIS2';
    private $DB_PASSWORD = '12345';
    private $DB_NAME = 'proyecto-siis';
    private $ruta = '../Backups/';

    public function Restaurar($backup_file) {
        // Conectar a la base de datos
        $mysqli = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);

        // Verificar si se pudo conectar a la base de datos
        if ($mysqli->connect_error) {
            throw new Exception('Error al conectar a la base de datos: ' . $mysqli->connect_error);
        }

        // Nombre completo del archivo de backup
        $backup_file_path = $this->ruta . $backup_file;

        // Verificar si el archivo de backup existe
        if (!file_exists($backup_file_path)) {
            throw new Exception('El archivo de backup no existe: ' . $backup_file_path);
        }

        // Abrir el archivo de backup
        $fp = fopen($backup_file_path, 'r');

        // Leer el contenido del archivo
        $sql = fread($fp, filesize($backup_file_path));

        // Ejecutar el contenido del archivo
        if ($mysqli->multi_query($sql)) {
            // Cerrar el archivo
            fclose($fp);

            // Cerrar la conexión a la base de datos
            $mysqli->close();

            // Redirigir a la página de inicio
            header('Location: ../Formularios/inicio.php');
            exit();
        } else {
            throw new Exception('Error al restaurar la base de datos: ' . $mysqli->error);
        }
    }
}

if (isset($_POST['restore'])) {
    $backup_file = $_FILES['sql']['name'];
    $backup_file_tmp = $_FILES['sql']['tmp_name'];

    // Mover el archivo de la ubicación temporal al directorio de backups
    move_uploaded_file($backup_file_tmp, '../Backups/' . $backup_file);

    $restore = new Restore();
    $restore->Restaurar($backup_file);
}
?>
