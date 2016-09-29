<?php
include("init.php");
$key=$_GET['key'];
// echo $key; die();
$result=$conn->exec("select * from groups where linkType='Product' and (name like '%$key%' or urlname like '%$key%') order by linkType");
$counter = 0;
while($row = $conn -> fetchArray($result))
{?>
	<tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
            <td valign="top">&nbsp;</td>
            <td valign="top" style="width:25px;"><img src="../<?= CMS_GROUPS_DIR.$row['image']; ?>" width="40" height="30" /></td>
            <td valign="top" style="width:220px"><?= $row['name'] ?></td>
            
            <td valign="top" style="width:135px;"><?=$row['activity'];?></td>
            <td valign="top" style="width:54px;"><?=$row['code'];?></td>
            <td valign="top" style="width:55px;"><?=$row['price'];?></td>
            
            <td valign="top" style="width:85px">
    		<?
			$changeTo = 'Yes';
			if ($row['publish'] == 'Yes')
				$changeTo = 'No';
			?>
      		(<a href="product.php?type=tooglePublish&id=<?= $row['id']?>&changeTo=<?=$changeTo;?>"><?=$row['publish'];?></a>)</td>
            
            
    		<td valign="top" style="width:60px"><?= $row['weight'] ?></td>
    		<td valign="top" style="width:77px;"> [ <a href="product.php?type=edit&id=<?= $row['id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this product from database. Continue?')){ document.location='product.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a> ]</td>
  </tr>
<? }?>