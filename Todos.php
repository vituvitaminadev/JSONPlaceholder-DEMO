<?php
header("Content-type:text/html; charset=utf8");
session_start();

$i = 0;
$ch = curl_init();

$url = "https://jsonplaceholder.typicode.com/todos";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$resp = curl_exec($ch);

if ($e = curl_error($ch)) {
	echo $e;
}
else {
	$_SESSION["Todos"] = json_decode($resp, true);
}

curl_close($ch);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>JSONPlaceholder Demo - To-do's</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body style="background-color: black";>
	
	<div class="container lista">
            <div class="row">
                <div class="col-lg-11">
                    <h3>To-do's</h3>
                </div>
                <div class="col-lg-1">
                    <a class="menuprincipal" style="text-decoration: none;" href="index.html">Home</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if($_SESSION["Todos"]) :
	                       	foreach ($_SESSION["Todos"] as $todos) :?>
                            <tr>
                                <td><?php echo $_SESSION["Todos"][$i]['userId'];?></td>
                                <td><?php echo $_SESSION["Todos"][$i]['id'];?></td>
                                <td><?php echo $_SESSION["Todos"][$i]['title'];?></td>
                                <td><?php
                                if ($_SESSION["Todos"][$i]['completed'] == 1) {
                                    echo "Completed!";
                                }else{
                                    echo "Not Completed!";
                                }$i++;?></td>
                            </tr>
                        	<?php endforeach;?>
                       		<?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</body>
</html>