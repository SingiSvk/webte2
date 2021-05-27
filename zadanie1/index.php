<?php

    if(isset($_GET["path"])){
        $path = $_GET["path"];
    }else{
        $path = "../files";
    }
    $path_arr = explode('/', $path);
    $tmp = $path_arr[sizeof($path_arr)-1];

    if($tmp == ".."){
        $path = implode("/", array_slice($path_arr,0, sizeof($path_arr)-2));
    }elseif ($tmp == "."){
        $path = implode("/", array_slice($path_arr,0, sizeof($path_arr)-1));
    }

    if (!str_contains($path, "../files")){
        $path = "../files";
    }
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>cviko1</title>

    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <table id='table'>
        <tr class='headers'>
            <th onclick='sortTable(0)'>Name</th>
            <th onclick='sortTable(1)'>Size</th>
            <th onclick='sortTable(2)'>Upload date</th>
        </tr>

    <?php

    function formatBytes($bytes) {
        $units = array('B', 'KB', 'MB', 'GB');

        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }

    $arr = scandir($path);

    foreach ($arr as $val){
        $current_path = $path."/".$val;
        if(is_dir($current_path)){
            echo "
              <tr class='files'>
                <td><a href='?path=".$current_path."'>{$val}</a></td>
                <td></td>
                <td></td>
              </tr>";
        }else{
            $size = formatBytes(filesize($current_path));
            $time = date("F d Y H:i:s",filectime($current_path));
            echo "
              <tr class='files'>
                <td>{$val}</td>
                <td>{$size}</td>
                <td>{$time}</td>
              </tr>";
        }
    }

    ?>
    </table>
</div>

<div>
    <a href="upload.html"><button class="center" id="upload">Upload file</button></a>
</div>

<script src="script.js"></script>


</body>
</html>

