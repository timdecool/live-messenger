<?php
    if(isset($_GET['page'])) $getPage = strtolower($_GET['page']);
    $page = isset($_GET['page']) && file_exists("./controllers/controller_".$_GET['page'].".php") ? $getPage: array_key_first(CONFIG_ROUTES);