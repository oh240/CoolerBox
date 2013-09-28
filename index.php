<?php
	
	require('config_file/config.php');
	require('config_file/functions.php');
	
	$dbh = connectDb();
	
	$items = array();
	
	$sql = "select * from items where chk_type != 'delete' order by seq";
	
	foreach ($dbh->query($sql) as $row) {
		array_push($items,$row);
	}
	
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/kickstart.js"></script> <!-- KICKSTART -->
	<link rel="stylesheet" href="css/kickstart.css" media="all" /> <!-- KICKSTART -->
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="js/init.js"></script>
</head>
<body>
	
	<div class="grid">
		<br>
		<h2>Cooler Keeper</h2>
		<br>
		<div class="notice success">
			<i class="icon-ok"></i>
				Success Messages !!		
		</div>
		<br>
		<ul class="menu">
			<li class="current"><a href="">野菜</a></li>
			<li><a href="">精肉・魚介類</a></li>
			<li class="divider"><a href="#">飲料水</a></li>
			<li><a href="">その他</a></li>
			<li><a href="">ジャンルの新規追加</a></li>
		</ul>
		<br>
		<table id="items">
			<tbody>
			<tr class="act">
				<th>品目</th>
				<th>数量</th>
				<th>期限</th>
				<th>操作</th>
			</tr>
			<?php foreach ($items as $item) :?>
				<tr id="item_<?php echo $item['id'] ;?>" data-id="<?php echo $item['id'] ;?>">
					<td>
						<input type="checkbox" <?php if ($item['chk_type'] == 'check') {echo "checked";} ?>>
						<span <?php if($item['chk_type'] == 'check') {echo "class='end'";} ?>><?php echo h($item['name']);?></span>
					</td>
					<td class="nums_area"><?php echo h($item['nums']) ;?></td>
					<td class="date_area">
						<?php if (isset($item['limit'])) :?>
							<?php echo h($item['limit']) ;?>
						<?php else :?>
							-
						<?php endif ;?>
					</td>
					<?php if($item['chk_type'] != 'check') :?>
						<td>
								<span class="editItem"> <i class="icon-pencil"></i></span>
								<span class="deleteItem"> <i class="icon-remove"></i></span>
								<span class="dragItem"> <i class="icon-move"></i></span>
						<?php else :?>
						<td class="gray">
								<span class="editItem"> <i class="icon-pencil"></i></span>
								<span class="deleteItem"> <i class="icon-remove"></i></span>
								<span class="dragItem"> <i class="icon-move"></i></span>
							<?php endif;?>
						</td>
				</tr>
			<?php endforeach ;?>
			</tbody>
		</table>
		<br>
		<table>
			<tr class="act">
				<th colspan="4">新規追加</th>
			</tr>
			<tr>
				<th>追加する品目名</th>
				<th>数量</th>
				<th>期限</th>
				<th>操作</th>
			</tr>
			<tr>
				<td>
					<input type="text" id="Add_name" class="col_10">
				</td>
				<td>
					<input type="text" id="Add_nums" class="col_5">
				</td>
				<td>
					<input type="date" id="Add_date">
				</td>
				<td>
					<button class="small addItem">追加する</button>
				</td>
			</tr>
		</table>
	</div>
	<script src="js/ajax_process.js"></script>
</body>
</html>