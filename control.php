<?php
/**
 * Class control
 */
class control{
    /**
     * @var null|PDO
     */
    public $PDO = null;

    public function __construct($config_file = "../config.php"){
        include_once($config_file);
        $host   = db_host;
        $db     = db_name;
        $pass   = db_pass;
        $user   = db_user;
        try{
            $this->PDO = new PDO("mysql:host=$host;dbname=$db",$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }catch (PDOException $e){
            exit();
        }
    }

    /**
     * @param $value
     * @param $hash
     */
    public function insert($value,$hash){
        $PDO = $this->PDO;
        $db  = "hash_".$hash[0];
        $sql = "INSERT INTO `".$db."`(`value`, `hash`) VALUES (:value0,:hash0)";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':value0' => $value, ':hash0' => $hash));
    }

    /**
     * @param $value
     * @return string
     */
    public function newHash($value){
        $values = array();
        $values["0"]  = $value;
        $values["1"]  = md5($values[0]);
        $values["2"]  = md5($values[1]);
        $values["3"]  = md5($values[2]);
        $values["4"]  = md5($values[3]);
        $values["5"]  = md5($values[4]);
        $values["6"]  = md5($values[5]);
        $values["7"]  = md5($values[6]);
        $values["8"]  = md5($values[7]);
        $values["9"]  = md5($values[8]);
        $values["10"] = md5($values[9]);
        if($this->search($values["1"]) === false){
            $this->insert($values["0"],$values["1"]);
            $this->insert($values["1"] . ":<!#:#!>:" . $value,$values["2"]);
            $this->insert($values["2"] . ":<!#:#!>:" . $value,$values["3"]);
            $this->insert($values["3"] . ":<!#:#!>:" . $value,$values["4"]);
            $this->insert($values["4"] . ":<!#:#!>:" . $value,$values["5"]);
            $this->insert($values["5"] . ":<!#:#!>:" . $value,$values["6"]);
            $this->insert($values["6"] . ":<!#:#!>:" . $value,$values["7"]);
            $this->insert($values["7"] . ":<!#:#!>:" . $value,$values["8"]);
            $this->insert($values["8"] . ":<!#:#!>:" . $value,$values["9"]);
            $this->insert($values["9"] . ":<!#:#!>:" . $value,$values["10"]);
        }
        return $values["1"];
    }

    /**
     * @param $hash
     * @return bool
     */
    public function search($hash){
        $PDO = $this->PDO;
        $db  = "hash_".$hash[0];
        $sql = "SELECT * FROM `".$db."` WHERE `hash` = :hash";
        $sth = $PDO->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':hash' => $hash));
        $row = $sth;
        foreach ($row as $a) {
            return $a['value'];
        }
        return false;
    }

    /**
     * @param $hash
     * @return string
     */
    public function fromOther($hash){
        if(strlen($hash) !== 32){
            return "This isn't a MD5 hash.";
        }

        @$a = json_decode(file_get_contents("http://md5cracker.org/api/api.cracker.php?r=1417&database=md5cracker.org&hash=".$hash));
        @$l = $a->status;
        if($a->status == "true"){
            @$p = $a->result;
            $this->newHash($p);
            return $p;
        }
        @$a = json_decode(file_get_contents("http://md5cracker.org/api/api.cracker.php?r=1417&database=md5.net&hash=".$hash));
        @$l = $a->status;
        if($a->status == "true"){
            @$p = $a->result;
            $this->newHash($p);
            return $p;
        }
        @$a = json_decode(file_get_contents("http://md5cracker.org/api/api.cracker.php?r=1417&database=md5online.net&hash=".$hash));
        @$l = $a->status;
        if($a->status == "true"){
            @$p = $a->result;
            $this->newHash($p);
            return $p;
        }
        @$a = json_decode(file_get_contents("http://md5cracker.org/api/api.cracker.php?r=1417&database=md5decryption.com&hash=".$hash));
        @$l = $a->status;
        if($a->status == "true"){
            @$p = $a->result;
            $this->newHash($p);
            return $p;
        }
        return "Not found";
    }

    public function install(){
        $fp     = fopen("cracker.sql","r");
        $file   = fread($fp,filesize("cracker.sql"));
        fclose($fp);
        $this->PDO->query($file);
    }
}