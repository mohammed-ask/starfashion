<?php
include '../session.php';
/* @var $obj db */
$limit = $_GET['length'];
$start = $_GET['start'];
$i = 1;
$return['recordsTotal'] = 0;
$return['recordsFiltered'] = 0;
$return['draw'] = $_GET['draw'];
$return['data'] = array();
$orderdirection = "";
if (isset($_GET['order'][0]['dir'])) {
    $orderdirection = $_GET['order'][0]['dir'];
}
$oary = array('users.id', 'users.name', 'users.email', 'users.mobile', 'users.panno', 'users.dob', 'users.address', 'users.bankname', 'users.accountno', 'users.ifsc', 'users.password', 'users.cost', 'users.investmentamount');
$ocoloum = "";
if (isset($_GET['order'][0]['column'])) {
    $ci = $_GET['order'][0]['column'];
    $ocoloum = $oary[$ci];
}
$order = "";
if (!empty($ocoloum)) {
    $order = " order by $ocoloum $orderdirection ";
}
$search = "";
if (isset($_GET['search']['value']) && !empty($_GET['search']['value'])) {
    $sv = $_GET['search']['value'];
    $search .= " and (users.name like '%$sv%' or users.email like '%$sv%')";
}
if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
    $search .= " and users.name like '" . $_GET['columns'][0]["search"]["value"] . "'";
}
if ((isset($_GET['columns'][1]["search"]["value"])) && (!empty($_GET['columns'][1]["search"]["value"]))) {
    $search .= " and users.description like '" . $_GET['columns'][1]["search"]["value"] . "'";
}
$return['recordsTotal'] = $obj->selectfieldwhere("users  ", "count(users.id)", "status in (0,1) and type = 1 and id not in (1,46) ");
$return['recordsFiltered'] = $obj->selectfieldwhere("users ", "count(users.id)", "status in (0,1) and type = 1 and id not in (1,46) $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "users ",
    "*",
    "status in (0,1) and type = 1 and id not in (1,46) $search $order limit $start, $limit"
);
$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $i;
    $n[] = $row['name'];
    $n[] = $row['usercode'];
    $n[] =  $row['mobile'];
    $n[] =  $row['email'];
    $n[] =  $obj->selectfieldwhere("roles", "name", "id=" . $row['role'] . "");
    $activation = $row['activate'] === 'Yes' ? 'checked' : '';
    if (in_array(41, $permissions)) {
        $n[] = '<label class="switch">
    <input type="checkbox" ' . $activation . ' class="setactive" data-type="activate" data-id="' . $row['id'] . '" value="' . $row['activate'] . '">
    <span class="slider round"></span>
</label>';
    } else {
        $n[] = '';
    }
    $a = "<div class='flex items-center space-x-4 text-sm'>";
    if (in_array(10, $permissions)) {
        $a .= "<button class='flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' @click='openModal'  onclick='dynamicmodal(\"" . $row['id'] . "\", \"editemployee\", \"\", \"Edit Employee\")' aria-label='Edit'>
             <svg class='w-5 h-5' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20'>
                 <path d='M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z'>
                 </path>
             </svg></button>";
    }
    if (in_array(11, $permissions)) {
        $a .= "<button class='flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' onclick='del(\"" . $row['id'] . "\", \"deleteuser\", \"Delete User \")' aria-label='Delete'>
             <svg class='w-5 h-5' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20'>
                 <path fill-rule='evenodd' d='M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z' clip-rule='evenodd'></path>
             </svg></button>";
    }
    $a  .= '</div>';
    $n[] = $a;
    $n[] = '<button class="px-2 py-1  text-sm  bg-purple  rounded-lg" @click="openModal" onclick="dynamicmodal(\'' . $row["id"] . '\', \'employeeclient\', \'\', \'Employee Clients\')">View Clients</button>';
    $data[] = $n;
    $i++;
}
$return['data'] = $data;
echo json_encode($return);
