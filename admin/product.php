<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 header("Location: login.php");
 exit();
}

if(isset($_POST['id']))
	$id = $_POST['id'];
elseif(isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = 0;

if(isset($_POST['regionId']))
	$regionId = $_POST['regionId'];
elseif(isset($_GET['regionId']))
	$regionId = $_GET['regionId'];
else
	$regionId = 0;

if(isset($_POST['categoryId']))
	$categoryId = $_POST['categoryId'];
elseif(isset($_GET['categoryId']))
	$categoryId = $_GET['categoryId'];
else
	$categoryId = 0;
	
$weight = $groups -> getSubLastWeight(0, "Product");

if($_GET['type'] == "edit")
{
	$result = $groups->getById($_GET['id']);
	$editRow = $conn->fetchArray($result);	
	extract($editRow);
}
if($_POST['type'] == "Save")
{
	extract($_POST);
	$vall="";
	if($season!="")
	{
		foreach($season as $key=>$val)
		{
			if($vall!="")
				$vall=$vall.",".$val;
			else
				$vall=$vall.$val;
		}
	}
	//echo $vall;
	//print_r($_POST); die();
	
	if(empty($title))
		$errMsg .= "<li>Please enter Product Title</li>";
	if(empty($urlname))
		$errMsg .= "<li>Please enter Alias Name</li>"	;
	elseif(!$groups -> isUnique($id, $urlname))
		$errMsg .= "<li>Alias Name already exists.</li>";
	
	if(empty($activity))
		$errMsg .= "<li>Please Select Product Category</li>";
	
	if(empty($code))
		$errMsg .= "<li>Please Enter product Code</li>";
	if(empty($price))
		$errMsg .= "<li>Please Enter product Price</li>";
	
	if(empty($errMsg))
	{
		
		$pid = $groups -> saveProduct($id, $title, $urlname, $block, $activity, $code, $price, $shortcontents, $contents, $publish, $featured, $weight);
		if($id > 0)
			$pid = $id;
		$groups -> saveImage($pid);
		$groups -> saveMap($pid);
		if($id>0)
			header("Location: product.php?type=edit&id=$id&msg=Product details updated successfully");
		else
			header("Location: product.php?msg=Product details saved successfully");
		exit();
	}		
}

if($_GET['type'] == "toogle")
{
	if($package->toggleStatus($_GET['id']) > 0)
		header("location: product.php?region=".$_GET['region']."&category=".$_GET['category']."&msg=Product status toogled successfully.");
}

if($_GET['type'] == "toogleFeatured")
{
	$id = $_GET['id'];
	$changeTo = $_GET['changeTo'];
	
	$sql = "UPDATE groups SET featured='$changeTo' WHERE id='$id'";
	$conn->exec($sql);
	header("location: product.php?msg=Product feature status toogled successfully.");
	
}


if($_GET['type'] == "tooglePublish")
{
	$id = $_GET['id'];
	$changeTo = $_GET['changeTo'];
	
	$sql = "UPDATE groups SET publish='$changeTo' WHERE id='$id'";
	$conn->exec($sql);
	header("location: product.php?&msg=product Show/Hide status toogled successfully.");
	
}

	
if($_GET['type'] == "removeImage")
{
	$groups->deleteImage($_GET['id']);
	//echo "hello";
	//header("location: product.php?type=edit&id=".$_GET['id']."&msg=product image deleted successfully.");?>
	<script> document.location='product.php?type=edit&id=<?=$_GET['id']?>&msg=product image deleted successfully.' </script>
<? }

if($_GET['type'] == "removeMap")
{
	$groups->deleteMap($_GET['id']);
	//echo "hello";
	//header("location: product.php?type=edit&id=".$_GET['id']."&msg=product image deleted successfully.");?>
	<script> document.location='product.php?type=edit&id=<?=$_GET['id']?>&msg=product map deleted successfully.' </script>
<? }

if($_GET['type']=="del")
{
		$groups -> delete($_GET['id']);
		//echo "hello";
		//header("Location : product.php?&msg=product deleted successfully.");?>
    	<script> document.location='product.php?&msg=Product deleted successfully.' </script>    
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo ADMIN_TITLE; ?></title>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FF0000
}
-->
</style>
<script type="text/javascript" src="../js/cms.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<script type="text/javascript">
  function search_product(key){
    // alert(key);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
       document.getElementById("search").innerHTML = xhttp.responseText;
       // alert(xhttp.responseText);
      }
    };
    xhttp.open("GET", "search_product.php?key="+key, true);
    xhttp.send();
  }
</script>

</head>
<body>
<table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0"
	cellspacing="5" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><?php include("header.php"); ?></td>
  </tr>
  <tr>
    <td width="<?php echo ADMIN_LEFT_WIDTH; ?>" valign="top"><?php include("leftnav.php"); ?></td>
    <td width="<?php echo ADMIN_BODY_WIDTH; ?>" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#fff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">&nbsp; Manage Product
                        <div style="float: right;">
                          <?
														$addNewLink = "product.php";
													if(isset($_GET['category']) && !empty($_GET['category']))
														$addNewLink .= "?category=".$_GET['category'];
													?>
                          <a href="<?= $addNewLink?>" class="headLink">Add New</a></div></td>
                    </tr>
                    <tr>
                      <td>
                      <form action="<?= $_REQUEST['uri']?>" method="post" enctype="multipart/form-data">
                      <table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <?php if(!empty($errMsg)){ ?>
                          <tr align="left">
                            <td colspan="3" class="err_msg"><?php echo $errMsg; ?></td>
                          </tr>
                          <?php } ?>                          
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> Product Name : <span class="asterisk">*</span></strong></td>
                              <td><label for="title"></label>
                                <input name="title" type="text" class="text" id="title" value="<?= $name; ?>" onChange="copySame('urlname', this.value);" /></td>
                            </tr>
                            <tr><td></td></tr>                           
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> Alias Name : <span class="asterisk">*</span></strong></td>
                              <td>
                              	<div style="float:left"><label for="urlname"></label>
                                <input name="urlname" type="text" class="text" id="urlname" value="<?= $urlname; ?>" onChange="copySame('urlname', this.value);" onBlur="checkUrlName('<?php echo $id; ?>', this.value, 'urlmsg');" /></div>
                                <div style="padding-left:10px; float:left; width:150px;" id="urlmsg">&nbsp;</div></td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong>Block : <span class="asterisk">*</span></strong></td>
                              <td>
                              
                                <select name="block" class="list1" onChange="">
                                  <option value="Default">Default</option>
                                  	<? $block1=$groups->getByLinkType("Block");
									while($blockGet=$conn->fetchArray($block1))
									{?>
									   <option value="<?=$blockGet['name'];?>" <? if($blockGet['name']==$block){?> selected="selected" <? }?>>
									   		<?=$blockGet['name'];?>
                                       </option>
									<? }?>
                              	</select>
                                
                           	</td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong>Product Category : <span class="asterisk">*</span></strong></td>
                              <td>
                              	
                                <select name="activity" class="list1" onChange="">
                                  <option value="">--Select Category--</option>
                                  	<? $act=$groups->getByLinkType("Activity");
									while($actGet=$conn->fetchArray($act))
									{?>
									   <option value="<?=$actGet['name'];?>" <? if($actGet['name']==$activity){?> selected="selected" <? }?>>
									   		<?=$actGet['name'];?>
                                       </option>
									<? }?>
                              	</select>
                                
                           	</td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Product Code : <span class="asterisk">*</span></strong></td>
                              <td>
                              		<input type="text" name="code" value="<?=$code;?>" /> 
                              </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong> Product Price : <span class="asterisk">*</span></strong></td>
                              <td>
                              		<input type="text" name="price" value="<?=$price;?>" /> 
                              </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Product Summary :</strong></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td colspan="2" style="width:400px">
                								<textarea id="shortcontents" name="shortcontents"><?=$shortcontents;?></textarea>
                              </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Product Detail :</strong></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                              <td></td>
                              <td colspan="2">
                								<textarea id="contents" name="contents"><?=$contents;?></textarea>
                                <script type="text/javascript">
                                  CKEDITOR.replace( 'shortcontents');
                                  CKEDITOR.replace( 'contents' );
                                </script>
                              </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Publish :</strong></td>
                              <td>
                              	<label>
                                  <input name="publish" type="radio" id="featured_0" value="No" checked="checked" />
                                  No</label>
                                <label>
                                  <input type="radio" name="publish" value="Yes" id="featured_1" <? if($publish == 'Yes') echo 'checked="checked"';?> />
                                  Yes</label>
                              </td>
                            </tr>
                            <tr><td></td></tr>      
                           
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Featured :</strong></td>
                              <td>
                              	<label>
                                  <input name="featured" type="radio" id="featured_0" value="No" checked="checked" />
                                  No</label>
                                <label>
                                  <input type="radio" name="featured" value="Yes" id="featured_1" <? if($featured == 'Yes') echo 'checked="checked"';?> />
                                  Yes</label>
                              </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Weight :</strong></td>
                              <td><input name="weight" type="text" class="text" id="weight" value="<?php echo $weight; ?>" style="width:25px;" /></td>
                            </tr>
                            <tr><td></td></tr>
                            
                            
							<? if(file_exists("../".CMS_GROUPS_DIR.$editRow['image']) and $editRow['image']!='' && $_GET['type'] == 'edit')
							{?>
                                <tr>
                                  <td></td>
                                  <td class="tahomabold11"><strong>Current Image : </strong></td>
                                  <td><img src="../<?= CMS_GROUPS_DIR.$editRow['image']; ?>" width="150" />
                                  [ <a href="product.php?type=removeImage&id=<?= $id?>">Remove Image</a>]</td>
                                </tr>
                                
                            <? }?>
                            <tr><td></td></tr>
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Image :</strong></td>
                              <td><label for="image"></label>
                                <input type="file" name="image" id="image" /></td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td></td>
                              <td>
                              	<input name="type" type="submit" class="button" id="button" value="Save" />
                              	<?php if($_GET['type'] == "edit"){ ?>
                              	<input type="hidden" value="<?= $id?>" name="id" id="id" />
                                <?php }else{ ?>                                
                                <input name="reset" type="reset" class="button" id="button2" value="Clear" />
                                <?php } ?>
                                </td>
                            </tr>                        
                        </table>
                        </form></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr height="5"><td></td></tr>
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">
                        <div style="float:left;" >&nbsp;Product Lists</div>
                        <div style="float: right">
                          <input onkeyup="search_product(this.value)" style="padding: 2px" type="text" name="keyword" placeholder="Search Product" />&nbsp;
                        </div>
                        <div style="clear: both"></div>
                      </td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                            <td style="width:20px"><strong>Image</strong></td>
                            <td style="width:155px"> Product </td>
                            <td style="width:88px">Category</td>
                            <td style="width:30px;">Code</td>
                            <td style="width:40px;">Price</td>
                            <td style="width:50px;">Show</td>
                            <!-- <td style="width:10px">Featured</td> -->
                            <td style="width:10px">Weight</td>
                            <td style="width:45px"><strong>Action</strong></td>
                          </tr>
                          <tr>
                            <td colspan="20">
                              <table style="width:100%" id="search">

                          <?php
							$counter = 0;
							$pagename = "product.php?";
							$sql = "SELECT * FROM groups WHERE linkType = 'Product'";
							$sql .= " ORDER BY weight";
							//echo $sql;
							$limit = 20;
							include("paging.php");
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
                          
                          <?
													}
													?>
                          </table>
                          </td>
                          </tr>
                        </table>
                      <?php include("paging_show.php"); ?></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php include("footer.php"); ?></td>
  </tr>
</table>
</body>
</html>