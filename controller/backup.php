<?php   
ob_start(); // Iniciar el búfer de salida

class Backup {

    private $DB_HOST = 'localhost';
    private $DB_USER = 'SIIS2';
    private $DB_PASSWORD = '12345';
    private $DB_NAME = 'proyecto-siis';
    private $ruta = '../Backups/';

    public function Respaldo() {
        // Conectar a la base de datos
        $mysqli = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);
    
        // Verificar si se pudo conectar a la base de datos
        if ($mysqli->connect_error) {
            throw new Exception('Error al conectar a la base de datos: ' . $mysqli->connect_error);
        }
    
        // Nombre del archivo de backup
        $backup_file = 'backup_generado_el_' . date('Y-m-d_H-i-s') . '.sql';
    
        // Ejecutar el comando mysqldump
        $command = "\"C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe\" --user={$this->DB_USER} --password={$this->DB_PASSWORD} --host={$this->DB_HOST} --routines {$this->DB_NAME} > {$this->ruta}{$backup_file}";
    
        system($command);
    
        // Cerrar la conexión a la base de datos
        $mysqli->close();
    
        // Redirigir a la página de inicio
        header('Location: ../Formularios/inicio.php');
        exit();
    } 

}

include_once('../Formularios/Backup.php');
  
if (isset($_POST['crear_backup'])) {
    $backup = new Backup();
    $backup->Respaldo();
}

ob_end_flush(); // Enviar la salida al navegador
?>
