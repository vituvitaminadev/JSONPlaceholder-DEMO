<?php
header("Content-type:text/html; charset=utf8");
session_start();

$i = 0;
$ch = curl_init();

$url = "https://jsonplaceholder.typicode.com/posts";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$resp = curl_exec($ch);

if ($e = curl_error($ch)) {
	echo $e;
}
else {
	$_SESSION["Posts"] = json_decode($resp, true);
}

curl_close($ch);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>JSONPlaceholder Demo - Posts</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body style="background-color: black";>
	
	<div class="container lista">
            <div class="row">
                <div class="col-lg-11">
                    <h3>Postagens</h3>
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
                                <th>Body</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if($_SESSION["Posts"]) :
	                       	foreach ($_SESSION["Posts"] as $posts) :?>
                            <tr>
                                <td><?php echo $_SESSION["Posts"][$i]['userId'];?></td>
                                <td><?php echo $_SESSION["Posts"][$i]['id'];?></td>
                                <td><?php echo $_SESSION["Posts"][$i]['title'];?></td>
                                <td><?php echo $_SESSION["Posts"][$i]['body']; $i++;?></td>
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