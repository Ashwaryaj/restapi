<?php
if (isset($_GET['action'])) {
    $action=$_GET['action'];
}
switch ($action) {
    case 'create':
        $user=new User;
        $user->save();
        break;
}
