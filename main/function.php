<?php

$leagalpoint = '<div style="font-size:9px;font-weight: bold;">
    <br><br><br>
Disclaimer
<br>
This message contains legally privileged and/or confidential information. If you are not the intended recipient(s), or employee or agent responsible for delivery of this message to the intended recipient(s), you are hereby notified that any dissemination, distribution or copying of this e-mail message is strictly prohibited. If you have received this message in error, please immediately notify the sender and delete this e-mail message from your computer.
<br>WARNING: Computer viruses can be transmitted via email. The recipient should check this email and any attachments for the presence of viruses. The company accepts no liability for any damage caused by any virus transmitted by this email.
</div>';

class db
{
    /* main db class for @var $this */

    public $con, $employeeid;

    /* Create class Counstructor in which we create Data Base Connection And default db operation */

    public function __construct($hostname, $username, $password, $dbname, $port)
    {
        $this->employeeid = 0;
        if (isset($_SESSION['userid'])) {
            $this->employeeid = $_SESSION['userid'];
        }
        $this->con = mysqli_connect($hostname, $username, $password, $dbname, $port) or die("not connected" . mysqli_error());
        $this->execute("SET NAMES utf8");
        $this->execute("SET collation_connection = 'utf8_general_ci'");
    }

    /* Default db operation start */

    function execute($sql, $print = 0)
    {
        $employeeid = $this->employeeid;

        $sql11 = $sql;
        //         $sql . "<br><br><br>";
        //         $da = date("Ymd");
        //         mysqli_query($this->con, "CREATE TABLE IF NOT EXISTS `zquerylogs$da`  (
        //   `id` int(255) NOT NULL AUTO_INCREMENT,
        //   `query` text  NULL,
        //   `url` text  NULL,
        //   `added_by` int(255)  NULL,
        //   `added_on` datetime  NULL,
        //   `updated_by` int(255)  NULL,
        //   `updated_on` datetime  NULL,
        //   `status` int(11)  NULL,
        //   PRIMARY KEY (`id`)
        // ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        // ");
        // $sql1 = $this->escape($sql);
        // $url = $_SERVER['REQUEST_URI'];
        // $datetimenow = date("Y-m-d H:i:s");
        // $sql2 = "insert into `zquerylogs$da`(query,url,added_by,added_on,updated_by,updated_on,status) values('$sql1','$url','$employeeid','$datetimenow','$employeeid','$datetimenow',1)";

        // mysqli_query($this->con, $sql2) or die($sql2 . mysqli_error($this->con));

        if ($print) {
            echo $sql;
        }
        $result = mysqli_query($this->con, $sql) or die($sql . mysqli_error($this->con));
        return $result;
    }

    function escape($data)
    {
        return mysqli_real_escape_string($this->con, $data);
    }

    function fetch_assoc($result)
    {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function fetchattachment($aid)
    {
        $ptname = "uploadfile";
        if ($aid != "" && $aid > 0) {
            $pwhere = "id='" . $aid . "'";
            $presult = $this->selectextrawhere($ptname, $pwhere);
            $num = $this->total_rows($presult);
            $prow = $this->fetch_assoc($presult);
            if ($num) {
                return $prow['path'];
            } else {
                return;
            }
        } else {
            return;
        }
    }

    function select($tb_name, $sid, $print = 0)
    {
        $sql = "select * from $tb_name where id like '$sid'";
        if ($print) {
            echo $sql;
        }
        $result = $this->execute($sql);
        return $result;
    }

    function selecttable($tb_name, $print = 0)
    {
        $sql = "select * from `$tb_name` where `status`='1' order by id desc";
        $result = $this->execute($sql, $print);
        return $result;
    }

    function selecttableasc($tb_name, $print = 0)
    {
        $sql = "select * from `$tb_name` where `status`='1' order by id asc";
        $result = $this->execute($sql, $print);
        return $result;
    }

    function selectptable($tb_name, $print = 0)
    {
        $sql = "select * from `$tb_name` where `status`='0' order by id desc";
        $result = $this->execute($sql, $print);
        return $result;
    }

    function selectdtable($tb_name, $print = 0)
    {
        $sql = "select * from `$tb_name` where `status`='99' order by id desc";
        $result = $this->execute($sql, $print);
        return $result;
    }

    function selectfield($tb_name, $field, $col_name, $sid, $print = 0)
    {
        $sql = "select $field as `value` from $tb_name where $col_name = '$sid'";
        $result = $this->execute($sql, $print);
        $numrow = $this->total_rows($result);
        if ($numrow > 0) {
            $row = $this->fetch_assoc($result);
            $return = $row['value'];
        } else {
            $return = "Not Applicable";
        }
        return $return;
    }

    function selectfieldwhere($tb_name, $field, $where, $print = 0)
    {
        $sql = "select $field as `value` from $tb_name where $where";
        $result = $this->execute($sql, $print);
        $numrow = $this->total_rows($result);
        if ($numrow > 0) {
            $row = $this->fetch_assoc($result);
            $return = $row['value'];
        } else {
            $return = "";
        }
        return $return;
    }

    function selectin($tb_name, $col_name, $values, $print = 0)
    {
        if (!empty($values)) {
            $sql = "select * from $tb_name where `$col_name` in ($values)";
            $result = $this->execute($sql, $print);
            return $result;
        } else {
            return "NA";
        }
    }

    function selectorder($tb_name, $sid, $order, $print = 0)
    {
        $result = $this->selectextrawhere($tb_name, "id like '$sid' $order", $print);
        return $result;
    }

    function fixedselect($tb_name, $tb_col_name, $sid, $print = 0)
    {
        $sql = "select * from $tb_name where `$tb_col_name` like '$sid'";
        $result = $this->execute($sql, $print);
        return $result;
    }

    function fixedselectorder($tb_name, $tb_col_name, $sid, $order, $print = 0)
    {
        $sql = "select * from $tb_name where `$tb_col_name` like '$sid' $order";
        $result = $this->execute($sql, $print);
        return $result;
    }

    function selectextrawhereorder($tb_name, $where, $order)
    {
        $result = $this->selectextrawhere($tb_name, $where . " " . $order);
        return $result;
    }

    /* function for @selectextrawhere */
    /* return array */

    function selectextrawhere($tb_name, $where, $print = 0)
    {
        /**
         * (PHP 4, PHP 5, PHP 7)<br/>
         * Alias of <b>selectextrawhere</b>
         * @link http://abaxsoft.com/manual/en/function.php
         * @param $tb_name
         * @param $where
         */
        $sql = " select * from $tb_name where $where";
        $result = $this->execute($sql, $print);
        return $result;
    }

    function selectextrawhereupdate($tb_name, $field, $where, $print = 0)
    {
        $sql = " select $field from $tb_name where $where ";
        $result = $this->execute($sql, $print);
        return $result;
    }

    /* select function End */

    function update($tb_name, $tb_col_name, $sid, $print = 0)
    {
        $update = array();
        foreach ($tb_col_name as $col_name => $form_field) {
            $form_field = trim($form_field);
            $update[] = '`' . $col_name . '` = \'' . $this->escape($form_field) . '\'';
        }
        $sql = "update $tb_name set " . implode(',', $update) . " where id='$sid'";
        //echo $sql;
        $result = $this->execute($sql, $print);
        //echo $result;
        if ($result) {
            return 1;
        } else {
            //echo "error";
        }
    }

    function fixedupdate($tb_name, $tb_col_name, $column, $sid)
    {
        $update = array();
        foreach ($tb_col_name as $col_name => $form_field) {
            $update[] = '`' . $col_name . '` = \'' . $this->escape($form_field) . '\'';
        }
        $sql = "update $tb_name set" . implode(',', $update) . "where `$column`='$sid'";
        $result = $this->execute($sql);
        if ($result) {
            return 1;
        } else {
            //echo "error";
        }
    }

    function updatewhere($tb_name, $tb_col_name, $sid, $print = 0)
    {
        $update = array();
        foreach ($tb_col_name as $col_name => $form_field) {
            $update[] = '`' . $col_name . '` = \'' . $this->escape($form_field) . '\'';
        }
        $sql = "update $tb_name set " . implode(',', $update) . " where $sid";

        $result = $this->execute($sql, $print);
        if ($result) {
            return 1;
        } else {
            //            echo "error";
        }
    }

    function updatein($tb_name, $tb_col_name, $sid)
    {
        $update = array();
        foreach ($tb_col_name as $col_name => $form_field) {
            $update[] = '`' . $col_name . '` = \'' . $this->escape($form_field) . '\'';
        }
        $sql = "update $tb_name set" . implode(',', $update) . "where id in ($sid)";
        $result = $this->execute($sql);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    function delete($tb_name, $id)
    {
        //          $sql = "delete from `$tb_name` where `id`='$id' ";
        $sql = "update`$tb_name` set status=99, updated_on = Now(), updated_by = " . $this->employeeid . " where `id`='$id' ";
        if ($this->execute($sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    function deleteFinal($tb_name, $id)
    {
        //          $sql = "delete from `$tb_name` where `id`='$id' ";
        $sql = "delete from `$tb_name` where `id`='$id' ";
        if ($this->execute($sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    function deleteFinalWhere($tb_name, $where)
    {
        //          $sql = "delete from `$tb_name` where `id`='$id' ";
        $sql = "delete from `$tb_name` where $where ";
        if ($this->execute($sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    function insertid()
    {
        return mysqli_insert_id($this->con);
    }

    function total_rows($result)
    {
        $num = mysqli_num_rows($result);
        return $num;
    }

    function saveactivity($activity, $reason, $activityid, $supportid, $department, $category, $how = "By Software")
    {
        /* activity Log */
        $log['activity'] = $activity;
        $log['remark'] = $reason;
        $log['how'] = $how;
        $log['activityid'] = $activityid;
        $log['supportid'] = $supportid;
        $log['department'] = $department;
        $log['category'] = $category;
        $log['ip'] = $_SERVER['REMOTE_ADDR'];
        $log['city'] = "";
        $log['added_by'] = $this->employeeid;
        $log['added_on'] = date("Y-m-d H:i:s");
        $log['updated_by'] = $this->employeeid;
        $log['updated_on'] = date("Y-m-d H:i:s");
        $log['status'] = "1";
        $this->insertnew("activitylog", $log);
    }

    function insert($tb_name, $tb_col_name, $form_field, $print = 0)
    {
        $tb_col_name1 = "`" . implode("`, `", $tb_col_name) . "`";
        $form_field1 = implode("', '", $form_field);
        $sql = "insert into $tb_name ($tb_col_name1) values ('$form_field1')";
        if ($this->execute($sql, $print)) {
            $insertid = $this->insertid($this->con);
            if ($insertid) {
                return $insertid;
            } else {
                return FALSE;
            }
        } else {
            return false;
        }
    }

    function insertnew($tb_name, $postdata, $print = 0)
    {
        foreach ($postdata as $key => $value) {
            $tbl[$key] = $key;
            $postdata[$key] = $this->escape($value);
        }
        $tbl_coloumn_name = array(implode('`, `', $tbl));
        $tbl_data = array(implode("', '", $postdata));
        $tb_col_name1 = "`" . implode("`, `", $tbl_coloumn_name) . "`";
        $form_field1 = implode("', '", $tbl_data);
        $sql = "insert into $tb_name ($tb_col_name1) values ('$form_field1')";
        if ($this->execute($sql, $print)) {
            $insertid = $this->insertid($this->con);
            if ($insertid) {
                return $insertid;
            } else {
                return FALSE;
            }
        } else {
            return false;
        }
    }

    /* Default db operation start */

    function login($tb_name, $email_p, $password_p, $email_name, $password_name)
    {
        session_start();
        $sql = "select * from $tb_name where $email_name='$email_p'";
        $result = $this->execute($sql);
        $row = $this->fetch_assoc($result);
        $data = $this->total_rows($result);
        if ($data > 0) {
            if ($row[$password_name] = md5($password_p)) {
                echo $logid = $row["id"];
                $_SESSION["userid"] = $logid;
                $_SESSION['username'] = $row['username'];
                header("location:login.php?msg=error_noerror");
            } else {
                header("location:login.php?msg=error_wrong");
            }
        } else {
            header("location:login.php?msg=error_nouser");
        }
    }


    /**
     * @return int
     */
    function getinsertData($tb_name, $postdata)
    {
        foreach ($postdata as $key => $value) {
            $tbl[$key] = $key;
            $postdata[$key] = $this->escape($value);
        }
        $tbl_coloumn_name = array(implode('`, `', $tbl));
        $tbl_data = array(implode("', '", $postdata));
        $tb_col_name1 = "`" . implode("`, `", $tbl_coloumn_name) . "`";
        $form_field1 = implode("', '", $tbl_data);
        $sql = "('$form_field1')";

        return $sql;
    }

    function approve($tb_name, $id)
    {
        $sql = "update `$tb_name` set status=1 where `id`='$id' ";
        if ($this->execute($sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    function deletewhere($tb_name, $where, $print = 0)
    {
        $sql = "update`$tb_name` set status=99, updated_on = Now(), updated_by = " . $this->employeeid . " where $where";
        //        $sql = "delete from `$tb_name` where $where ";
        if ($this->execute($sql, $print)) {
            return 1;
        } else {
            return 0;
        }
    }

    function deletein($tb_name, $id)
    {
        $sql = "update`$tb_name` set status=99 where `id` in '$id' ";
        //        $sql = "delete from `$tb_name` where `id` in '$id' ";
        if ($this->execute($sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    function deletefile($path)
    {
        if (file_exists($path)) {
            if (unlink($path)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }

    function search($tb_name, $tb_col_name)
    {
        $sql = "select * from $tb_name where $tb_col_name like '%" . $_POST["search"] . "%'";
        $result = $this->execute($sql);
        return $result;
    }

    function check_login()
    {
        if (isset($_COOKIE['userData'])) {
            $userData = json_decode($_COOKIE['userData'], true);
            // print_r($userData);
            // die;
            $_SESSION['username'] = $userData['username'];
            $_SESSION['userid'] = $userData['userid'];
            $_SESSION['useremail'] = $userData['useremail'];
            $_SESSION['role'] = $userData['role'];
            $_SESSION['type'] = $userData['type'];
            $_SESSION['name'] = $userData['name'];
        }
        if (isset($_SESSION['username']) && $_SESSION['type'] === 'client') {
            $user = $_SESSION['username'];
            $head = "";

            if (($_SERVER['HTTP_HOST'] == 'localhost')) {
                $head = "/starfashion";
            }
            if (str_contains($_SERVER['REQUEST_URI'], "$head/admin")) {
                if ($_SERVER['REQUEST_URI'] === "$head/admin") {
                    header('location:admin/adminlogin');
                } else {
                    header('location:adminlogin');
                }
            }
        } elseif (isset($_SESSION['username']) && $_SESSION['type'] === 'super') {
            $head = "";
            // if ($_SERVER['REQUEST_URI'] !== '/indiastock/admin/users') {
            //     echo $_SERVER['REQUEST_URI'];
            //     die;
            // }
            if (($_SERVER['HTTP_HOST'] == 'localhost')) {
                $head = "/starfashion";
            }
            if (!str_contains($_SERVER['REQUEST_URI'], "$head/admin") && !str_contains($_SERVER['REQUEST_URI'], "$head/main/admin")) {
                header('location:login');
            }
        } else {
            $head = "";
            if (($_SERVER['HTTP_HOST'] == 'localhost')) {
                $head = "/starfashion";
            }
            if (str_contains($_SERVER['REQUEST_URI'], "$head/admin")) {
                if ($_SERVER['REQUEST_URI'] === "$head/admin") {
                    header('location:admin/adminlogin');
                } else {
                    header('location:adminlogin');
                }
            } else {
                header('location:login');
            }
        }
    }

    function check_activate()
    {
        $activate = $this->selectfieldwhere("users", "activate", "id=" . $this->employeeid . "");
        if (!empty($activate) && $activate === 'No') {
            header("location:logout");
            $this->logout();
        }
    }

    function logout()
    {

        setcookie('userData', '', time() - 3600, '/');
        session_destroy();
    }

    function createCache($tablename)
    {
        $data = array();
        $result = $this->selecttable("$tablename");
        while ($row = $this->fetch_assoc($result)) {
            $data[$row['id']] = $row['description'];
        }

        $fp = fopen("cache/$tablename.json", 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
    }

    function uploadimage($path, $image, $name)
    {
        $imagename = "";
        // print_r($image);
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $image[$name]["name"]);
        $exte = end($temp);
        $extension = strtolower($exte);
        if (in_array($extension, $allowedExts)) {
            if (($image[$name]["size"] < 600000000)) {

                if ((($image[$name]["type"] == "image/gif") || ($image[$name]["type"] == "image/jpeg") || ($image[$name]["type"] == "image/jpg") || ($image[$name]["type"] == "image/pjpeg") || ($image[$name]["type"] == "image/x-png") || ($image[$name]["type"] == "image/png"))) {
                    if ($image[$name]["error"] > 0) {

                        return "Return Code: " . $image[$name]["error"] . "<br>";
                    } else {
                        $imgname = time() . chr(rand(65, 90)) . chr(rand(97, 122)) . chr(rand(65, 90)) . "." . $extension;
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        if (file_exists($path . "/" . $image[$name]["name"])) {

                            $imagename = $path . "/" . $imgname;
                            if (move_uploaded_file($image["$name"]["tmp_name"], $imagename)) {
                                $x['filename'] = $imgname;
                                $x['orgname'] = $image[$name]["name"];
                                $x['uploadedby'] = $_SESSION['calitechemployee'];
                                $x['uploadedon'] = date("Y-m-d H:i:s");
                                $x['path'] = $imagename;
                                $x['status'] = 1;
                                $this->insertnew("uploadfile", $x);
                                return $imagename;
                            }
                        } else {
                            $imagename = $path . "/" . $imgname;
                            if (move_uploaded_file($image[$name]["tmp_name"], $imagename)) {
                                $x['filename'] = $imgname;
                                $x['orgname'] = $image[$name]["name"];
                                $x['uploadedby'] = $_SESSION['calitechemployee'];
                                $x['uploadedon'] = date("Y-m-d H:i:s");
                                $x['path'] = $imagename;
                                $x['status'] = 1;
                                print_r($x);
                                $this->insertnew("uploadfile", $x);
                                return $imagename;
                            }
                        }
                    }
                } else {
                    return " Invalid file Please Resave file";
                }
            } else {
                echo ' Invalid File gif,jpeg,png,jpg files allowed';
            }
        } else {
            echo ' Invalid File file size not more then 500MB';
        }
    }

    function uploadfilenew($path, $image, $name, $allowedext, $savename = "")
    {
        $imagename = "";
        // print_r($image);
        $allowedExts = $allowedext;
        $temp = explode(".", $image[$name]["name"]);
        $exte = end($temp);
        $extension = strtolower($exte);
        if (($image[$name]["size"] < 600000000)) {
            if (in_array($extension, $allowedExts)) {
                if ($image[$name]["error"] > 0) {
                    return "Return Code: " . $image[$name]["error"] . "<br>";
                } else {
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $imgname = $savename . "." . $extension;
                    if (empty($savename)) {
                        $imgname = time() . chr(rand(65, 90)) . chr(rand(97, 122)) . chr(rand(65, 90)) . "." . $extension;
                    }
                    if (file_exists($path . "/" . $image[$name]["name"])) {
                        $imagename = $path . "/" . $imgname;
                        echo move_uploaded_file($image["$name"]["tmp_name"], $imagename);
                        if (move_uploaded_file($image["$name"]["tmp_name"], $imagename)) {
                            $x['filename'] = $imgname;
                            $x['orgname'] = $image[$name]["name"];
                            $x['updated_by'] = $this->employeeid;
                            $x['updated_on'] = date("Y-m-d H:i:s");
                            $x['path'] = $imagename;
                            $x['status'] = 1;
                            //print_r($x);
                            $id = $this->insertnew("uploadfile", $x);
                            return $id;
                        }
                    } else {
                        $imagename = $path . "/" . $imgname;
                        if (move_uploaded_file($image[$name]["tmp_name"], $imagename)) {
                            $x['filename'] = $imgname;
                            $x['orgname'] = $image[$name]["name"];
                            $x['updated_by'] = $this->employeeid;
                            $x['updated_on'] = date("Y-m-d H:i:s");
                            $x['path'] = $imagename;
                            $x['status'] = 1;
                            $id = $this->insertnew("uploadfile", $x);
                            return $id;
                        }
                    }
                }
            } else {

                echo ' Invalid File gif,jpeg,png,jpg files allowed';
                return "Invalid File";
            }
        } else {
            echo ' Invalid File file size not more then 500MB';
            return "Invalid File";
        }
    }

    function uploadmultiple($path, $image, $name, $allowedext)
    {
        $imagename = "";
        // print_r($image);
        $allowedExts = $allowedext;
        $imagesarray = array();
        foreach ($image[$name]["tmp_name"] as $key => $tmp_name) {
            $temp = explode(".", $image[$name]["name"][$key]);
            $exte = end($temp);
            $extension = strtolower($exte);
            if (($image[$name]["size"][$key] < 600000000)) {
                if (in_array($extension, $allowedExts)) {
                    if ($image[$name]["error"][$key] > 0) {
                        return "Return Code: " . $image[$name]["error"][$key] . "<br>";
                    } else {
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        $imgname = time() . chr(rand(65, 90)) . chr(rand(97, 122)) . chr(rand(65, 90)) . "." . $extension;
                        if (file_exists($path . "/" . $image[$name]["name"][$key])) {
                            $imagename = $path . "/" . $imgname;
                            if (move_uploaded_file($image["$name"]["tmp_name"][$key], $imagename)) {
                                $x['filename'] = $imgname;
                                $x['orgname'] = $image[$name]["name"][$key];
                                $x['uploadedby'] = $_SESSION['calitechemployee'];
                                $x['uploadedon'] = date("Y-m-d H:i:s");
                                $x['path'] = $imagename;
                                $x['status'] = 1;
                                $id = $this->insertnew("uploadfile", $x);
                                $imagesarray[] .= $id;
                            }
                        } else {
                            $imagename = $path . "/" . $imgname;
                            if (move_uploaded_file($image[$name]["tmp_name"][$key], $imagename)) {
                                $x['filename'] = $imgname;
                                $x['orgname'] = $image[$name]["name"][$key];
                                $x['updatedby'] = $_SESSION['calitechemployee'];
                                $x['updatedon'] = date("Y-m-d H:i:s");
                                $x['path'] = $imagename;
                                $x['status'] = 1;
                                $id = $this->insertnew("uploadfile", $x);
                                $imagesarray[] .= $id;
                            }
                        }
                    }
                } else {
                    echo ' Invalid File gif,jpeg,png,jpg files allowed';
                }
            } else {
                echo ' Invalid File file size not more then 500MB';
            }
        }
        return implode(",", $imagesarray);
    }

    function uploadfile($path, $image, $name, $allowedext)
    {
        $imagename = "";
        // print_r($image);
        $allowedExts = $allowedext;
        $temp = explode(".", $image[$name]["name"]);
        $exte = end($temp);
        $extension = strtolower($exte);
        if (($image[$name]["size"] < 600000000)) {
            if (in_array($extension, $allowedExts)) {
                if ($image[$name]["error"] > 0) {
                    return "Return Code: " . $image[$name]["error"] . "<br>";
                } else {
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $imgname = time() . chr(rand(65, 90)) . chr(rand(97, 122)) . chr(rand(65, 90)) . "." . $extension;
                    if (file_exists($path . "/" . $image[$name]["name"])) {
                        $imagename = $path . "/" . $imgname;
                        if (move_uploaded_file($image["$name"]["tmp_name"], $imagename)) {
                            $x['filename'] = $imgname;
                            $x['orgname'] = $image[$name]["name"];
                            $x['uploadedby'] = $_SESSION['calitechemployee'];
                            $x['uploadedon'] = date("Y-m-d H:i:s");
                            $x['path'] = $imagename;
                            $x['status'] = 1;
                            $id = $this->insertnew("uploadfile", $x);
                            return $imagename;
                        }
                    } else {
                        $imagename = $path . "/" . $imgname;
                        if (move_uploaded_file($image[$name]["tmp_name"], $imagename)) {
                            $x['filename'] = $imgname;
                            $x['orgname'] = $image[$name]["name"];
                            $x['uploadedby'] = $_SESSION['calitechemployee'];
                            $x['uploadedon'] = date("Y-m-d H:i:s");
                            $x['path'] = $imagename;
                            $x['status'] = 1;
                            $id = $this->insertnew("uploadfile", $x);
                            return $imagename;
                        }
                    }
                }
            } else {
                echo ' Invalid File gif,jpeg,png,jpg files allowed';
            }
        } else {
            echo ' Invalid File file size not more then 500MB';
        }
    }

    function uploadfilesame($path, $image, $name, $allowedext)
    {
        $imagename = "";
        // print_r($image);
        $allowedExts = $allowedext;
        $temp = explode(".", $image[$name]["name"]);
        $exte = end($temp);
        $extension = strtolower($exte);
        if (($image[$name]["size"] < 600000000)) {
            if (in_array($extension, $allowedExts)) {
                if ($image[$name]["error"] > 0) {
                    return "Return Code: " . $image[$name]["error"] . "<br>";
                } else {
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $imgname = time() . chr(rand(65, 90)) . chr(rand(97, 122)) . chr(rand(65, 90)) . "." . $extension;
                    if (file_exists($path . "/" . $image[$name]["name"])) {
                        $imagename = $path . "/" . $imgname;
                        if (move_uploaded_file($image["$name"]["tmp_name"], $imagename)) {
                            $x['filename'] = $imgname;
                            $x['orgname'] = $image[$name]["name"];
                            $x['uploadedby'] = $_SESSION['calitechemployee'];
                            $x['uploadedon'] = date("Y-m-d H:i:s");
                            $x['path'] = $imagename;
                            $x['status'] = 1;
                            $this->insertnew("uploadfile", $x);
                            return $imagename;
                        }
                    } else {
                        $imagename = $path . "/" . $imgname;
                        if (move_uploaded_file($image[$name]["tmp_name"], $imagename)) {
                            $x['filename'] = $imgname;
                            $x['orgname'] = $image[$name]["name"];
                            $x['uploadedby'] = $_SESSION['calitechemployee'];
                            $x['uploadedon'] = date("Y-m-d H:i:s");
                            $x['path'] = $imagename;
                            $x['status'] = 1;
                            $this->insertnew("uploadfile", $x);
                            return $imagename;
                        }
                    }
                }
            } else {
                echo ' Invalid File gif,jpeg,png,jpg files allowed';
            }
        } else {
            echo ' Invalid File file size not more then 500MB';
        }
    }

    function getdatafromurl($url, $fields)
    {
        //API URL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "?" . $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //           $ch = curl_init($url."?".$fields);
        echo $output = curl_exec($ch);
        //Print error if any
        curl_close($ch);
        return $output;
    }

    public
    function __destruct()
    {
        mysqli_close($this->con);
    }
}

function addOrdinalNumberSuffix($num)
{
    if (!in_array(($num % 100), array(11, 12, 13))) {
        switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
            case 1:
                return $num . 'st';
            case 2:
                return $num . 'nd';
            case 3:
                return $num . 'rd';
        }
    }
    return $num . 'th';
}

function changedateformate($dateString)
{
    if ((!empty($dateString)) && ($dateString != "00/00/0000")) {
        $myDateTime = DateTime::createFromFormat('d/m/Y', $dateString);
        //print_r($myDateTime);
        return $myDateTime->format('Y-m-d');
    } else {
        return "";
    }
}

function cmcinterpolation($minrange, $maxrange, $mincmc, $maxcmc, $cmctobefindon)
{
    //    echo $maxrange."-".$minrange;
    if ($maxrange == $minrange) {
        return $mincmc;
    }
    $z2 = ((($cmctobefindon - $minrange) * ($maxcmc - $mincmc)) / ($maxrange - $minrange)) + $mincmc;
    return $z2;
}

function changedateformatespeci($dateString, $speci)
{

    if ((!empty($dateString)) && ($dateString != "0000-00-00") && ($dateString != "0000-00-00 00:00:00")) {
        $myDateTime = DateTime::createFromFormat($speci, $dateString);
        try {
            return $myDateTime->format('Y-m-d');
        } catch (Exception $e) {
            echo $dateString;
            return $dateString;
        }
    } else {
        return "";
    }
}

function changedateformatespecito($dateString, $speci, $to)
{
    //    echo $dateString;
    if ((!empty($dateString)) && ($dateString != "0000-00-00") && ($dateString != "0000-00-00 00:00:00")) {
        $myDateTime = DateTime::createFromFormat($speci, $dateString);
        if ($myDateTime) {
            $newdate = $myDateTime->format($to);
            //if($newdate!="30")
            return $newdate;
        } else {
            //                    return $myDateTime;
            return $dateString;
        }
    } else {
        return "";
    }
}

function convert_number_to_words($number)
{

    $no = round($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
        } else
            $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ?
        "." . $words[$point / 10] . " " .
        $words[$point = $point % 10] : '';
    return $result . "Rupees  ";
}

function convert_number_to_words1($number)
{

    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = array(
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'fourty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        10000 => 'lakh',
        1000000 => 'million',
        1000000000 => 'billion',
        1000000000000 => 'trillion',
        1000000000000000 => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}


function PlaceWatermark($file, $text, $xxx, $yyy, $op, $outdir, $name, $dirname = "directdigitalsignature", $logo = "idcardlogo.png", $debug = 0)
{



    if (!file_exists($dirname)) {
        mkdir($dirname, 0777);
    }
    $name = $dirname . "/" . $name;

    $font_size = $xxx;
    $ts = explode("\n", $text);
    $width = 0;
    foreach ($ts as $k => $string) {
        $width = max($width, strlen($string));
    }
    $iw = ($logo == "") ? 0 : (($xxx == 2) ? 35 : 20);
    $sw = ($logo == "") ? 0 : (($xxx == 2) ? 40 : 19);
    if ($debug) {
        echo $iw;
        echo "<br>";
        echo $sw;
    }
    $width = (imagefontwidth($font_size) * $width) + $sw;

    $height = imagefontheight($font_size) * count($ts);
    $el = imagefontheight($font_size);
    $em = imagefontwidth($font_size);
    $img = imagecreatetruecolor($width, $height);
    // Background color
    $bg = imagecolorallocate($img, 255, 255, 255);
    imagefilledrectangle($img, 0, 0, $width, $height, $bg);
    // Font color


    $color = imagecolorallocate($img, 0, 0, 0);
    foreach ($ts as $k => $string) {
        $len = strlen($string);
        $ypos = 0;
        for ($i = 0; $i < $len; $i++) {
            $xpos = $i * $em;
            $ypos = $k * $el;
            imagechar($img, $font_size, $xpos + $iw, $ypos, $string, $color);
            $string = substr($string, 1);
        }
    }
    imagecolortransparent($img, $bg);
    $blank = imagecreatetruecolor($width, $height);
    $tbg = imagecolorallocate($blank, 255, 255, 255);
    imagefilledrectangle($blank, 0, 0, $width, $height, $tbg);
    imagecolortransparent($blank, $tbg);

    if (($op < 0) or ($op > 100)) {
        $op = 100;
    }
    imagecopymerge($blank, $img, 0, 0, 0, 0, $width, $height, $op);

    //imagepng($blank,$name.".png");
    if (!empty($logo)) {
        //                $logo = trim($logo);
        //
        //                $stamp = imagecreatefrompng($logo);
        //                $sx = imagesx($stamp);
        //                $sy = imagesy($stamp);
        //                $ratio = ($height / $sy);
        //                $sx = intval($sx * $ratio);
        //                $sy = $height;
        //
        //                imagecopyresampled($stamp, $stamp, 0, 0, 0, 0, $sx, $sy, imagesx($stamp), imagesy($stamp));
        //                imagecopymerge($blank, $stamp, 0, 0, 0, 0, $sx, $sy, 100);
    }

    imagepng($blank, $name . ".png");
    // Created Watermark Image
    return $name . ".png";
}

function getFinancialYear($today)
{
    //    $today = date("Y-m-d");
    $month = date("m", strtotime($today));
    $year = date("y", strtotime($today));
    $financialYear = "";
    if ($month < 4) {
        $financialYear = ($year - 1) . "-" . $year;
    } else {
        $financialYear = ($year) . "-" . ($year + 1);
    }
    return $financialYear;
}

function getfirstandlastday($today)
{
    $month = date("m", strtotime($today));
    $year = date("Y", strtotime($today));
    $startdate = "";
    $enddate = "";
    if ($month < 4) {
        $financialYear = ($year - 1) . "-" . $year;
        $startdate = ($year - 1) . "-04-01";
        $enddate = $year . "-03-31";
    } else {
        $financialYear = ($year) . "-" . ($year + 1);
        $startdate = $year . "-04-01";
        $enddate = ($year + 1) . "-03-31";
    }
    return array("startdate" => $startdate, "enddate" => $enddate);
}

function generateOrderID($userID, $finalTotal)
{
    // Get the current timestamp in milliseconds
    $timestamp = round(microtime(true) * 1000);

    // Concatenate user ID, timestamp, and final total
    $dataToHash = $userID . $timestamp;
    // . '-' . $finalTotal;

    // Generate the hash using the SHA-256 algorithm (you can use other algorithms like MD5 as well)
    // $orderID = hash('sha256', $dataToHash);

    return $dataToHash;
}
