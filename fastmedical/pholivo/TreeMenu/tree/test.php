<?PHP
	require ("TreeMenu.class.php") ;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Testing the TreeMenu</title>
	<style type="text/css">
	.menutxt { 
	  font-family: Arial ;
		font-size: 0.7 em ;
		color: #000000 ;
		text-decoration: none ;
		}
	</style>
<?PHP // Generate the menu...
	$menu->Generate() ;
?>
</head>
<body>
<? $menu->PrintMenu() ; ?>
</body>
</html>
