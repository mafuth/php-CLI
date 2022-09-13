<?php
class db{
    private static $conn;
    private static $insertData;
    private static $setData;
    private static $query;

    public function __construct($conn) {
        self::$conn = $conn;
    }

    public static function selectFrom($table){
        self::$query = "SELECT * FROM $table";
    }

    public static function Update($table){
        self::$query = "UPDATE $table";
    }

    public static function set($data){
        self::$query = "UPDATE $table";
    }

    public static function where($items){
        $query = self::$query;
        $in = array();
        foreach($items as $key=>$val){
            if(is_array($items[$key])){
                if(str_contains("/ IN /i",$query)){
                    $imploded = "'" . implode("','", $items[$key]) . "'";
                    $query = $query." AND $key IN ($imploded)";
                }else{
                    $imploded = "'" . implode("','", $items[$key]) . "'";
                    $query = $query." WHERE $key IN ($imploded)";
                }
            }else{
                if(str_contains("/ IN /i",$query)){
                    $query = $query." AND $key IN ('$val')";
                }else{
                    $query = $query." WHERE $key IN ('$val')";
                }
            }
        }
        self::$query = $query;
    }

    public static function insert($data){
        self::$insertData = $data;
    }

    public static function to($table){
        $rows =  array();
        $exclude = array('id','created_at','updated_on');
        $query = "SELECT * FROM $table LIMIT 1";
        $result = self::$conn->query($query);
        while($row = $result->fetch_assoc()) 
        {
            foreach($row as $row_name => $row_val){
                if(!in_array($row_name,$exclude)){
                    array_push($rows,$row_name);
                }
            }
        }
        if(!empty($rows)){
            $imploded = "'" .implode("','", self::$insertData). "'";
            self::$query = "INSERT INTO $table (".implode(',',$imploded).")VALUES(".$imploded.")";
        }else{
            self::$query = "";
        }
    }
    public static function paginated($currentPage,$per_page){
        $query = trim(self::$conn->real_escape_string(self::$query));
        $sql = $query;
        $NumberOfRows = 0;
        $result = $conn->query($sql);
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
                $data['id'] = $conn->insert_id;
            }else{
                $data['status'] = false;
                $data['message'] = $conn->error;
            }
        }
        return $data;
    }
}
