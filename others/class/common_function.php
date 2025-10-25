<?php

session_start();
//==============================================================================
define("DB_HOST", "localhost"); // set database host
define("DB_USER", "root"); // set database user
define("DB_PASS", "1234"); // set database password
define("DB_NAME", "ims"); // set database name
//==============================================================================

class setting {

    function connectDB() {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_set_charset($con, "utf8");
        date_default_timezone_set('Asia/Colombo');
        return $con;
    }

    function close_DB() {
        mysqli_close($this->connectDB());
    }

    function get_next_autoincrement_ID($table) {
        $result = mysqli_query($this->connectDB(), "SHOW TABLE STATUS LIKE '" . $table . "'")or die(mysqli_error($this->connectDB()));
        mysqli_close($this->connectDB());
        $row = mysqli_fetch_array($result);
        return $nextId = $row['Auto_increment'];
    }

    function json_encoded_select_query($query) {
        $data = array();
        $result = mysqli_query($this->connectDB(), $query)or die(mysqli_error($this->connectDB()));
        mysqli_close($this->connectDB());
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    function basic_Select_Query($query) {
        $data = array();
        $result = mysqli_query($this->connectDB(), $query)or die(mysqli_error($this->connectDB()));
        mysqli_close($this->connectDB());
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function command_query_with_lastInset_ID($query) {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $save = mysqli_query($con, $query);
        if ($save) {
            return mysqli_insert_id($con);
        } else {
            return -1;
        }
        mysqli_close($con);
    }

    function basic_command_query($query) {
        $save = mysqli_query($this->connectDB(), $query);
        mysqli_close($this->connectDB());
        if (isset($save) && $save) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function row_count_query($query) {
        $data = mysqli_query($this->connectDB(), $query)or die(mysqli_error($this->connectDB()));
        mysqli_close($this->connectDB());
        $count = mysqli_num_rows($data);
        return $count;
    }

    function password_encrypt($q) {
        $cryptKey_1 = 'g1215rftfghdr#xfg47$sdd25=';
        $cryptKey_2 = '65rtyu2fdfgc5ht#wwe@ef154Qcf$=';
        $qEncoded = sha1($cryptKey_2 . $q . $cryptKey_1);
        return($qEncoded);
    }

}
?>

