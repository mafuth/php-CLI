<?php
class db{
    private static $conn;
    private static $insertData;
    private static $insertRows;
    private static $setData;
    private static $query;

    public function __construct($conn) {
        self::$conn = $conn;
    }

    public static function sanitize($input) {
        if(is_array($input)){
            $output = array();
            foreach($input as $val){
                array_push($output,trim(self::$conn->real_escape_string(htmlspecialchars($input))));
            }
        }else{
            $output = trim(self::$conn->real_escape_string(htmlspecialchars($input))); 
        }
        return $output;
    }

    public static function selectFrom($table){
        self::$query = "SELECT * FROM $table";
        return self::$query;
    }

    public static function deleteFrom($table){
        self::$query ="DELETE FROM $table";
        return self::$query;
    }

    public static function updateFrom($table){
        self::$query = "UPDATE $table";
        return self::$query;
    }

    public static function set($items){
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
    
    public function between($item,$value1,$value2){
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
        self::$insertData = array();
        foreach($Data as $data){
            array_push(self::$insertData,self::$conn->real_escape_string($data));
        }
        return self::$insertData;
    }

    public static function insertTo($table,$Data){
        self::$insertData = array();
        foreach($Data as $key=>$value){
            array_push(self::$insertRows,self::$conn->real_escape_string($key));
            array_push(self::$insertData,self::$conn->real_escape_string($value));
        }
        if(!empty(self::$insertRows)){
            $imploded = "'" .implode("','", self::$insertData). "'";
            self::$query = "INSERT INTO $table (".implode(',',self::$insertRows).")VALUES(".$imploded.")";
        }else{
            self::$query = "";
        }
        return self::$query;
    }

    public static function to($table){
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
            self::$query = "INSERT INTO $table (".implode(',',$rows).")VALUES(".$imploded.")";
        }else{
            self::$query = "";
        }
        return self::$query;
    }

    public static function paginated($currentPage,$per_page){
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

    public function customQuery($query){
        self::$query = $query;
        return $query;
    }

    public function getQuery(){
        return trim(self::$query);
    }
    
    public static function execute(){
        $data = array();
        $i = 0;
        $sql = trim(self::$query);
        if(preg_match("/SELECT/i",$sql)){
            $result = self::$conn->query($sql);
            while($row = $result->fetch_assoc()) 
            {
                if(!isset($data[$i])){
                    $data[$i] = array();
                }
                foreach($row as $row_name => $row_val){
                    $data[$i][$row_name] = $row_val;
                }
                $i++;
            }

        }else{
            if (self::$conn->query($sql) === TRUE){
                $data['status'] = true;
                $data['id'] = self::$conn->insert_id;
            }else{
                throw new Exception(self::$conn->error);
            }
        }
        return $data;
    }
}