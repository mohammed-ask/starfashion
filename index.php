<?php
// echo $_SERVER['REQUEST_URI']." ";
$head = "";
if (($_SERVER['HTTP_HOST'] == 'localhost')) {
    $head = "/starfashion";
}
$request = parse_url($_SERVER['REQUEST_URI']);
switch ($request['path']) {
    case "$head/admin/index":                                  // Admin Routes
        require __DIR__ . '/main/admin/index.php';
        break;
    case "$head/admin":
        require __DIR__ . '/main/admin/index.php';
        break;
    case "$head/admin/adminlogin":
        require __DIR__ . '/main/admin/adminlogin.php';
        break;
    case "$head/about";
        require __DIR__ . '/main/admin/about.php';
        break;
    case "$head/admin/checkadminlogin";
        require __DIR__ . '/main/admin/checkadminlogin.php';
        break;
    case "$head/admin/viewrole";
        require __DIR__ . '/main/admin/viewrole.php';
        break;
    case "$head/admin/insertuserdirect";
        require __DIR__ . '/main/admin/insertuserdirect.php';
        break;
    case "$head/admin/edituser";
        require __DIR__ . '/main/admin/edituser.php';
        break;
    case "$head/admin/updateuser";
        require __DIR__ . '/main/admin/updateuser.php';
        break;
    case "$head/admin/deleteuser";
        require __DIR__ . '/main/admin/deleteuser.php';
        break;
    case "$head/admin/dashboard";
        require __DIR__ . '/main/admin/dashboard.php';
        break;
    case "$head/admin/userlogindetails";
        require __DIR__ . '/main/admin/userlogindetails.php';
        break;
    case "$head/admin/test";
        require __DIR__ . '/main/admin/test.php';
        break;
    case "$head/admin/editrole";
        require __DIR__ . '/main/admin/editrole.php';
        break;
    case "$head/admin/updaterole";
        require __DIR__ . '/main/admin/update_role.php';
        break;
    case "$head/admin/addrole";
        require __DIR__ . '/main/admin/addrole.php';
        break;
    case "$head/admin/insertrole";
        require __DIR__ . '/main/admin/insertrole.php';
        break;
    case "$head/admin/deleterole";
        require __DIR__ . '/main/admin/deleterole.php';
        break;
    case "$head/admin/permission";
        require __DIR__ . '/main/admin/permission.php';
        break;
    case "$head/admin/addpermission";
        require __DIR__ . '/main/admin/addpermission.php';
        break;
    case "$head/admin/insertpermission";
        require __DIR__ . '/main/admin/insertpermission.php';
        break;
    case "$head/admin/editpermission";
        require __DIR__ . '/main/admin/editpermission.php';
        break;
    case "$head/admin/updatepermission";
        require __DIR__ . '/main/admin/updatepermission.php';
        break;
    case "$head/admin/deletepermission";
        require __DIR__ . '/main/admin/deletepermission.php';
        break;
    case "$head/admin/users";
        require __DIR__ . '/main/admin/viewusers.php';
        break;
    case "$head/admin/register";
        require __DIR__ . '/main/admin/addusers.php';
        break;
    case "$head/admin/adduser";
        require __DIR__ . '/main/admin/adduser.php';
        break;
    case "$head/admin/viewusermodal";
        require __DIR__ . '/main/admin/viewusermodal.php';
        break;
    case "$head/admin/composemail";
        require __DIR__ . '/main/admin/composemail.php';
        break;
    case "$head/admin/insertmail";
        require __DIR__ . '/main/admin/insertmail.php';
        break;
    case "$head/admin/viewinbox";
        require __DIR__ . '/main/admin/viewinbox.php';
        break;
    case "$head/admin/viewmaildetail";
        require __DIR__ . '/main/admin/viewmaildetail.php';
        break;
    case "$head/admin/sentmails";
        require __DIR__ . '/main/admin/sentmails.php';
        break;
    case "$head/admin/employeelist";
        require __DIR__ . '/main/admin/employeelist.php';
        break;
    case "$head/admin/addemployee";
        require __DIR__ . '/main/admin/addemployee.php';
        break;
    case "$head/admin/insertemployee";
        require __DIR__ . '/main/admin/insertemployee.php';
        break;
    case "$head/admin/editemployee";
        require __DIR__ . '/main/admin/editemployee.php';
        break;
    case "$head/admin/updatemployee";
        require __DIR__ . '/main/admin/updatemployee.php';
        break;
    case "$head/admin/settings";
        require __DIR__ . '/main/admin/settings.php';
        break;
    case "$head/admin/adminprofile";
        require __DIR__ . '/main/admin/adminprofile.php';
        break;
    case "$head/admin/updateprofile";
        require __DIR__ . '/main/admin/updateprofile.php';
        break;
    case "$head/admin/viewbankdetails";
        require __DIR__ . '/main/admin/viewbankdetails.php';
        break;
    case "$head/admin/userdocs";
        require __DIR__ . '/main/admin/userdocs.php';
        break;
    case "$head/admin/category";
        require __DIR__ . '/main/admin/viewcategory.php';
        break;
    case "$head/admin/addcategory";
        require __DIR__ . '/main/admin/addcategory.php';
        break;
    case "$head/admin/insertcategory";
        require __DIR__ . '/main/admin/insertcategory.php';
        break;
    case "$head/admin/editcategory";
        require __DIR__ . '/main/admin/editcategory.php';
        break;
    case "$head/admin/updatecategory";
        require __DIR__ . '/main/admin/updatecategory.php';
        break;
    case "$head/admin/deletecategory";
        require __DIR__ . '/main/admin/deletecategory.php';
    case "$head/admin/subcategory";
        require __DIR__ . '/main/admin/viewsubcategory.php';
        break;
    case "$head/admin/addsubcategory";
        require __DIR__ . '/main/admin/addsubcategory.php';
        break;
    case "$head/admin/insertsubcategory";
        require __DIR__ . '/main/admin/insertsubcategory.php';
        break;
    case "$head/admin/editsubcategory";
        require __DIR__ . '/main/admin/editsubcategory.php';
        break;
    case "$head/admin/updatesubcategory";
        require __DIR__ . '/main/admin/updatesubcategory.php';
        break;
    case "$head/admin/deletesubcategory";
        require __DIR__ . '/main/admin/deletesubcategory.php';
        break;
    case "$head/admin/products";
        require __DIR__ . '/main/admin/viewproducts.php';
        break;
    case "$head/admin/addproducts";
        require __DIR__ . '/main/admin/addproducts.php';
        break;
    case "$head/admin/insertproducts";
        require __DIR__ . '/main/admin/insertproducts.php';
        break;
    case "$head/admin/editproducts";
        require __DIR__ . '/main/admin/editproducts.php';
        break;
    case "$head/admin/updateproducts";
        require __DIR__ . '/main/admin/updateproducts.php';
        break;
    case "$head/admin/deleteproducts";
        require __DIR__ . '/main/admin/deleteproducts.php';
        break;
    case "$head/admin/slides";
        require __DIR__ . '/main/admin/viewslides.php';
        break;
    case "$head/admin/addslides";
        require __DIR__ . '/main/admin/addslides.php';
        break;
    case "$head/admin/insertslides";
        require __DIR__ . '/main/admin/insertslides.php';
        break;
    case "$head/admin/editslides";
        require __DIR__ . '/main/admin/editslides.php';
        break;
    case "$head/admin/updateslides";
        require __DIR__ . '/main/admin/updateslides.php';
        break;
    case "$head/admin/deleteslides";
        require __DIR__ . '/main/admin/deleteslides.php';
        break;
    case "$head/admin/aboutus";
        require __DIR__ . '/main/admin/viewaboutus.php';
        break;
    case "$head/admin/addaboutus";
        require __DIR__ . '/main/admin/addaboutus.php';
        break;
    case "$head/admin/insertaboutus";
        require __DIR__ . '/main/admin/insertaboutus.php';
        break;
    case "$head/admin/editaboutus";
        require __DIR__ . '/main/admin/editaboutus.php';
        break;
    case "$head/admin/updateaboutus";
        require __DIR__ . '/main/admin/updateaboutus.php';
        break;
    case "$head/admin/deleteaboutus";
        require __DIR__ . '/main/admin/deleteaboutus.php';
        break;
    case "$head/admin/contactus";
        require __DIR__ . '/main/admin/viewcontactus.php';
        break;
    case "$head/admin/addcontactus";
        require __DIR__ . '/main/admin/addcontactus.php';
        break;
    case "$head/admin/insertcontactus";
        require __DIR__ . '/main/admin/insertcontactus.php';
        break;
    case "$head/admin/editcontactus";
        require __DIR__ . '/main/admin/editcontactus.php';
        break;
    case "$head/admin/updatecontactus";
        require __DIR__ . '/main/admin/updatecontactus.php';
        break;
    case "$head/admin/deletecontactus";
        require __DIR__ . '/main/admin/deletecontactus.php';
        break;
    case "$head/admin/privacypolicy";
        require __DIR__ . '/main/admin/viewprivacypolicy.php';
        break;
    case "$head/admin/addprivacypolicy";
        require __DIR__ . '/main/admin/addprivacypolicy.php';
        break;
    case "$head/admin/insertprivacypolicy";
        require __DIR__ . '/main/admin/insertprivacypolicy.php';
        break;
    case "$head/admin/editprivacypolicy";
        require __DIR__ . '/main/admin/editprivacypolicy.php';
        break;
    case "$head/admin/updateprivacypolicy";
        require __DIR__ . '/main/admin/updateprivacypolicy.php';
        break;
    case "$head/admin/deleteprivacypolicy";
        require __DIR__ . '/main/admin/deleteprivacypolicy.php';
        break;
    case "$head/admin/termsandco";
        require __DIR__ . '/main/admin/viewtermsandco.php';
        break;
    case "$head/admin/addtermsandco";
        require __DIR__ . '/main/admin/addtermsandco.php';
        break;
    case "$head/admin/inserttermsandco";
        require __DIR__ . '/main/admin/inserttermsandco.php';
        break;
    case "$head/admin/edittermsandco";
        require __DIR__ . '/main/admin/edittermsandco.php';
        break;
    case "$head/admin/updatetermsandco";
        require __DIR__ . '/main/admin/updatetermsandco.php';
        break;
    case "$head/admin/deletetermsandco";
        require __DIR__ . '/main/admin/deletetermsandco.php';
        break;
    case "$head/admin/return";
        require __DIR__ . '/main/admin/viewreturn.php';
        break;
    case "$head/admin/addreturn";
        require __DIR__ . '/main/admin/addreturn.php';
        break;
    case "$head/admin/insertreturn";
        require __DIR__ . '/main/admin/insertreturn.php';
        break;
    case "$head/admin/editreturn";
        require __DIR__ . '/main/admin/editreturn.php';
        break;
    case "$head/admin/updatereturn";
        require __DIR__ . '/main/admin/updatereturn.php';
        break;
    case "$head/admin/deletereturn";
        require __DIR__ . '/main/admin/deletereturn.php';
        break;
    case "$head/admin/deliveryinfo";
        require __DIR__ . '/main/admin/viewdeliveryinfo.php';
        break;
    case "$head/admin/adddeliveryinfo";
        require __DIR__ . '/main/admin/adddeliveryinfo.php';
        break;
    case "$head/admin/insertdeliveryinfo";
        require __DIR__ . '/main/admin/insertdeliveryinfo.php';
        break;
    case "$head/admin/editdeliveryinfo";
        require __DIR__ . '/main/admin/editdeliveryinfo.php';
        break;
    case "$head/admin/updatedeliveryinfo";
        require __DIR__ . '/main/admin/updatedeliveryinfo.php';
        break;
    case "$head/admin/deletedeliveryinfo";
        require __DIR__ . '/main/admin/deletedeliveryinfo.php';
        break;
    case "$head/admin/logout";                  //admin Route close
        require __DIR__ . '/main/logout.php';
        break;
    case "$head/logout";
        require __DIR__ . '/main/logout.php';
        break;
    case "$head/index":
        require __DIR__ . '/main/index.php';
        break;
    case "$head/":
        require __DIR__ . '/main/index.php';
        break;
    case "$head/register";
        require __DIR__ . '/main/addusers.php';
        break;
    case "$head/dummyregister":
        require __DIR__ . '/main/dummyregister.php';
        break;
    case "$head/insertuser";
        require __DIR__ . '/main/insertuser.php';
        break;
    case "$head/login";
        require __DIR__ . '/main/login.php';
        break;
    case "$head/checklogin";
        require __DIR__ . '/main/checklogin.php';
        break;
    case "$head/dashboard";
        require __DIR__ . '/main/dashboard.php';
        break;
    case "$head/mail";
        require __DIR__ . '/main/mail.php';
        break;
    case "$head/insertmail";
        require __DIR__ . '/main/insertmail.php';
        break;
    case "$head/viewmaildetail";
        require __DIR__ . '/main/viewmaildetail.php';
        break;
    case "$head/insertfund";
        require __DIR__ . '/main/insertfund.php';
        break;
    case "$head/admin/requestwithdrawalamount";
        require __DIR__ . '/main/admin/requestwithdrawalamount.php';
        break;
    case "$head/insertrequestwithdrawal";
        require __DIR__ . '/main/insertrequestwithdrawal.php';
        break;
    case "$head/test";
        require __DIR__ . '/main/test.php';
        break;
    case "$head/forgotpassword";
        require __DIR__ . '/main/forgotpassword.php';
        break;
    case "$head/checkforgetpassword";
        require __DIR__ . '/main/checkforgetpassword.php';
        break;
    case "$head/resetpassword";
        require __DIR__ . '/main/resetpassword.php';
        break;
    case "$head/insertresetpassword";
        require __DIR__ . '/main/insertresetpassword.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/404.html';
        # code...
        break;
}