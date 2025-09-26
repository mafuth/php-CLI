<?php
// use EnvLoader;

class db{
    private static $conn;
    private static $insertData;
    private static $insertRows;
    private static $setData;
    private static $query;
    private static $type;
    private static $connectionCount = 0;

    public function __construct() {
        $this->ensureConnection();
    }

    public function __destruct() {
        $this->closeConnection();
    }

    private function ensureConnection() {
        if (self::$conn === null || !$this->isConnectionHealthy()) {
            $this->createConnection();
        }
    }

    private function isConnectionHealthy() {
        if (self::$conn === null) {
            return false;
        }
        try {
            return self::$conn->ping();
        } catch (Exception $e) {
            return false;
        }
    }

    private function createConnection() {
        try {
            $env = new EnvLoader(dirname(__DIR__, 1).'/.env');
            $servername = $env->get('servername');
            $username = $env->get('username');
            $password = $env->get('password');
            $dbname = $env->get('dbname');

            if (empty($servername) || empty($username) || empty($dbname)) {
                throw new Exception("Database configuration is incomplete. Please check your .env file.");
            }

            self::$conn = new mysqli($servername, $username, $password, $dbname);
            
            if (self::$conn->connect_error) {
                throw new Exception("Database connection failed: " . self::$conn->connect_error);
            }
            
            self::$conn->set_charset("utf8mb4");
            self::$connectionCount++;
            
        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new Exception("Failed to establish database connection: " . $e->getMessage());
        }
    }

    public function closeConnection() {
        if (self::$conn !== null && self::$connectionCount > 0) {
            try {
                self::$conn->close();
            } catch (Exception $e) {
                error_log("Error closing database connection: " . $e->getMessage());
            } finally {
                self::$conn = null;
                self::$connectionCount = 0;
            }
        }
    }

    public static function close() {
        if (self::$conn !== null) {
            try {
                self::$conn->close();
            } catch (Exception $e) {
                error_log("Error closing database connection: " . $e->getMessage());
            } finally {
                self::$conn = null;
                self::$connectionCount = 0;
            }
        }
    }

    public static function sanitize($input) {
        self::ensureStaticConnection();
        if(is_array($input)){
            $output = array();
            foreach($input as $val){
                array_push($output,trim(self::$conn->real_escape_string(htmlspecialchars($val))));
            }
        }else{
            $output = trim(self::$conn->real_escape_string(htmlspecialchars($input)));
        }
        return $output;
    }

    public static function isConnected() {
        return self::$conn !== null && self::isStaticConnectionHealthy();
    }

    public static function getConnectionStatus() {
        if (self::$conn === null) {
            return 'Not connected';
        }
        try {
            if (self::$conn->ping()) {
                return 'Connected';
            } else {
                return 'Connection lost';
            }
        } catch (Exception $e) {
            return 'Connection error: ' . $e->getMessage();
        }
    }

    private static function ensureStaticConnection() {
        if (self::$conn === null || !self::isStaticConnectionHealthy()) {
            self::createStaticConnection();
        }
    }

    private static function isStaticConnectionHealthy() {
        if (self::$conn === null) {
            return false;
        }
        try {
            return self::$conn->ping();
        } catch (Exception $e) {
            return false;
        }
    }

    private static function createStaticConnection() {
        try {
            $env = new EnvLoader(dirname(__DIR__, 1).'/.env');
            $servername = $env->get('servername');
            $username = $env->get('username');
            $password = $env->get('password');
            $dbname = $env->get('dbname');

            if (empty($servername) || empty($username) || empty($dbname)) {
                throw new Exception("Database configuration is incomplete. Please check your .env file.");
            }

            self::$conn = new mysqli($servername, $username, $password, $dbname);
            
            if (self::$conn->connect_error) {
                throw new Exception("Database connection failed: " . self::$conn->connect_error);
            }
            
            self::$conn->set_charset("utf8mb4");
            self::$connectionCount++;
            
        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new Exception("Failed to establish database connection: " . $e->getMessage());
        }
    }

    public static function selectFrom($table){
        self::$query = "SELECT * FROM $table";
        self::$type = "SEL";
        return self::$query;
    }

    public static function deleteFrom($table){
        self::$query ="DELETE FROM $table";
        self::$type = "EXEC";
        return self::$query;
    }

    public static function updateFrom($table){
        self::$query = "UPDATE $table";
        self::$type = "EXEC";
        return self::$query;
    }

    public static function set($items){
        self::ensureStaticConnection();
        $set = array();
        foreach($items as $key=>$val){
            $val = self::$conn->real_escape_string($val);
            if(!in_array("$key='".$val."'",$set)){
                array_push($set,"$key='".$val."'");
            }
        }
        self::$query = self::$query." SET ".implode(', ',$set);
        return self::$query;
    }
    
    public static function between($item,$value1,$value2){
        $query = self::$query;
        if(str_contains($query," WHERE ")){
            $query = $query." AND $item BETWEEN '$value1' AND '$value2'";
        }else{
            $query = $query." WHERE $item BETWEEN '$value1' AND '$value2'";
        }
        self::$query = $query;
        return self::$query;
    }

    public static function where($items){
        $query = self::$query;
        $in = array();
        foreach($items as $key=>$val){
            if(is_array($items[$key])){
                if(str_contains($query," IN ")){
                    $imploded = "'" . implode("','", $items[$key]) . "'";
                    $query = $query." AND $key IN ($imploded)";
                }else{
                    $imploded = "'" . implode("','", $items[$key]) . "'";
                    if(str_contains($query," WHERE ")){
                        $query = $query." AND $key IN ($imploded)";
                    }else{
                        $query = $query." WHERE $key IN ($imploded)";
                    }
                }
            }else{
                if(str_contains($query," IN ")){
                    $query = $query." AND $key IN ('$val')";
                }else{
                    if(str_contains($query," WHERE ")){
                        $query = $query." AND $key IN ('$val')";
                    }else{
                        $query = $query." WHERE $key IN ('$val')";
                    }
                }
            }
        }
        self::$query = $query;
        return self::$query;
    }

    public static function whereOR($items){
        $query = self::$query;
        $in = array();
        foreach($items as $key=>$val){
            if(is_array($items[$key])){
                if(str_contains($query," IN ")){
                    $imploded = "'" . implode("','", $items[$key]) . "'";
                    $query = $query." OR $key IN ($imploded)";
                }else{
                    $imploded = "'" . implode("','", $items[$key]) . "'";
                    if(str_contains($query," WHERE ")){
                        $query = $query." OR $key IN ($imploded)";
                    }else{
                        $query = $query." WHERE $key IN ($imploded)";
                    }
                }
            }else{
                if(str_contains($query," IN ")){
                    $query = $query." OR $key IN ('$val')";
                }else{
                    if(str_contains($query," WHERE ")){
                        $query = $query." OR $key IN ('$val')";
                    }else{
                        $query = $query." WHERE $key IN ('$val')";
                    }
                }
            }
        }
        self::$query = $query;
        return self::$query;
    }

    public static function notIn($items){
        $query = self::$query;
        $in = array();
        foreach($items as $key=>$val){
            if(is_array($items[$key])){
                if(str_contains($query," NOT IN ")){
                    $imploded = "'" . implode("','", $items[$key]) . "'";
                    $query = $query." AND $key NOT IN ($imploded)";
                }else{
                    $imploded = "'" . implode("','", $items[$key]) . "'";
                    if(str_contains($query," WHERE ")){
                        $query = $query." AND $key NOT IN ($imploded)";
                    }else{
                        $query = $query." WHERE $key NOT IN ($imploded)";
                    }
                }
            }else{
                if(str_contains($query," NOT IN ")){
                    $query = $query." AND $key NOT IN ('$val')";
                }else{
                    if(str_contains($query," WHERE ")){
                        $query = $query." AND $key NOT IN ('$val')";
                    }else{
                        $query = $query." WHERE $key NOT IN ('$val')";
                    }
                }
            }
        }
        self::$query = $query;
        return self::$query;
    }

    public static function insert($Data){
        self::ensureStaticConnection();
        self::$type = "EXEC";
        self::$insertData = array();
        foreach($Data as $data){
            array_push(self::$insertData,self::$conn->real_escape_string($data));
        }
        return self::$insertData;
    }

    public static function insertTo($table,$Data){
        self::ensureStaticConnection();
        self::$type = "EXEC";
        self::$insertData = array();
        self::$insertRows = array();
        foreach($Data as $key=>$value){
            array_push(self::$insertRows,self::$conn->real_escape_string($key));
            array_push(self::$insertData,self::$conn->real_escape_string($value));
        }
        if(!empty(self::$insertRows)){
            $imploded = "'" .implode("','", self::$insertData). "'";
            self::$query = "INSERT IGNORE INTO $table (".implode(',',self::$insertRows).")VALUES(".$imploded.")";
        }else{
            self::$query = "";
        }
        return self::$query;
    }

    public static function to($table){
        self::ensureStaticConnection();
        self::$type = "EXEC";
        $rows = array();
        $exclude = array('id','created_at','updated_on');
        $query = "SHOW COLUMNS FROM $table";
        $result = self::$conn->query($query);
        while($row = $result->fetch_assoc())
        {
            if(!in_array($row['Field'],$exclude)){
                array_push($rows,$row['Field']);
            }
        }
        if(!empty($rows)){
            $imploded = "'" .implode("','", self::$insertData). "'";
            self::$query = "INSERT IGNORE INTO $table (".implode(',',$rows).")VALUES(".$imploded.")";
        }else{
            self::$query = "";
        }
        return self::$query;
    }

    public static function paginated($currentPage,$per_page){
        self::ensureStaticConnection();
        self::$type = "SEL";
        $query = trim(self::$conn->real_escape_string(self::$query));
        $sql = $query;
        $NumberOfRows = 0;
        $result = self::$conn->query($sql);
        while($row = $result->fetch_assoc())
        {
            $NumberOfRows += 1;
        }

        $lastPage = ceil($NumberOfRows / $per_page);

        if($currentPage==""){
            $page=1;
        }else{
            $page=$currentPage;
        }
        if ($page < 1) {
            $page = 1;
        }elseif ($page > $lastPage) {
            $page = $lastPage;
        }
        if($lastPage != 0){
            $NEXTPAGE = $page+1;
            $start = ($page - 1) * $per_page;
            self::$query = "$query LIMIT $start,$per_page";
        }
        return $lastPage;
    }

    public static function limit($amount){
        self::$query = self::$query." LIMIT $amount";
        return self::$query;
    }

    public static function orderBy($item,$type){
        self::$query = self::$query." ORDER BY $item $type";
        return self::$query;
    }

    public static function customQuery($query){
        self::$query = $query;
        return $query;
    }

    public static function getQuery(){
        return trim(self::$query);
    }

    public static function getRows(){
        self::ensureStaticConnection();
        $rows = [];
        $sql = trim(self::$query);
        $result = self::$conn->query($sql);
        while($row = $result->fetch_assoc())
        {
            $rows[] = $row;
        }
        return $rows;

    }
    
    public static function execute(){
        self::ensureStaticConnection();
        $data = [];
        $i = 0;
        $sql = trim(self::$query);
        
        if (self::$conn->query($sql) === TRUE){
            $data['status'] = true;
            $data['id'] = self::$conn->insert_id;
        }else{
            throw new Exception(self::$conn->error);
        }
        
        return $data;
    }
}