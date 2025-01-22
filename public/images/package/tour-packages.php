<?php
session_start();
include("checklogin.php");
include("connection.php");
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
?>
<?php
   if(isset($_POST["savedeskviewdeal"])){
	    $eemail=$_POST['fetchemail'];
        $ied=$_POST['fetchedeal'];
		$sqliquery = mysqli_query($con, "SELECT pac.id,pac.title,pac.image,pac.short_des,pac.des,pac.price,pac.night,pacday.id,pacday.day,pacday.pck_img,pacday.type_of_transport,pacday.duration,pacday.hotel_name,pacday.star,pacday.area,pacday.date,pacday.hotel_include,pacday.activity,pacday.activity_des,pacday.package_id FROM packages as pac INNER JOIN package_days as pacday ON pac.id = pacday.package_id Where pacday.package_id = '$ied'");
		while ($dsataccda = mysqli_fetch_array($sqliquery)){
		    //print_r($dsataccda);
		    $title = $dsataccda['title'];
			$image = $dsataccda['image'];
			$short_des = $dsataccda['short_des'];
			$des = $dsataccda['des'];
			$price = $dsataccda['price'];
			$night = $dsataccda['night'];
			$day = $dsataccda['day'];
			$pck_img = $dsataccda['pck_img'];
			$type_of_transport = $dsataccda['type_of_transport'];
			$duration = $dsataccda['duration'];
			$hotel_name = $dsataccda['hotel_name'];
			$star = $dsataccda['star'];
			$area = $dsataccda['area'];
			$date = $dsataccda['date'];
			$hotel_include = $dsataccda['hotel_include'];
			$activity = $dsataccda['activity'];
			$activity_des = $dsataccda['activity_des'];		
		}						

		$querys = mysqli_query($con,"INSERT INTO `crm_packages_days`(`title`, `image`, `short_des`, `des`, `price`, `night`, `day`, `pck_img`, `type_of_transport`, `duration`, `hotel_name`, `star`, `area`, `date`, `hotel_include`, `activity`, `activity_des` , `email_package`) 
		VALUES ('$title','$image','$short_des','$des','$price','$night','$day','$pck_img','$type_of_transport','$duration','$hotel_name','$star','$area','$date','$hotel_include','$activity','$activity_des' ,'$eemail')");
			
				$html="";
				$sqliquerys = mysqli_query($con, 
				"SELECT pac.id,pac.title,pac.image,pac.short_des,pac.des,pac.price,pac.night,pacday.id,pacday.day,pacday.pck_img,pacday.type_of_transport,pacday.duration,pacday.hotel_name,
				pacday.star,pacday.area,pacday.date,pacday.hotel_include,pacday.activity,pacday.activity_des,pacday.package_id FROM packages as pac 
				INNER JOIN package_days as pacday ON pac.id = pacday.package_id Where pacday.package_id = '$ied'");
	
				if($sqliquerys){
				$html.= "<center><table width='95%' style='border-collapse: collapse;color:#000;'align='center'>
				<tr><img src='logo-header.png' alt='leter' style='height: 129px; width: 20%;'/> </tr>
				 <tr><th colspan='3' style='padding:10px;font-size:18px;'>GoingBo </b> ".$title ."-Tour Packages</th></tr>";
				$count =1;
				while ($dsataccda = mysqli_fetch_array($sqliquerys)){
		   
					$image = $dsataccda['image'];
					$short_des = $dsataccda['short_des'];
					$des = $dsataccda['des'];
					$price = $dsataccda['price'];
					$night = $dsataccda['night'];
					$day = $dsataccda['day'];
					$pck_img = $dsataccda['pck_img'];
					$fghfghfgh = 'https://www.goingbo.com/public/images/package/'.$pck_img ;
					$type_of_transport = $dsataccda['type_of_transport'];
					$duration = $dsataccda['duration'];
					$hotel_name = $dsataccda['hotel_name'];
					$star = $dsataccda['star'];
					$area = $dsataccda['area'];
					$hotel_include = $dsataccda['hotel_include'];
					$activity = $dsataccda['activity'];
					$activity_des = $dsataccda['activity_des'];		
                    $html .= "
                           
                            <tr>
								<td style='padding:10px;font-size:18px;'><b>Title :</b> ".$title."</td>
                            </tr>
                            <tr>
								<td style='padding:10px;font-size:18px;'><b>Day :</b> ".$count ."</td>
							</tr>
							<tr>
								<td><img src=".$fghfghfgh." alt='".$count."' style='height: 220px; width: 50%;'></td>
							</tr>
							<tr>
                                <td style='padding:10px;font-size:18px;'><b>Night :</b> ".$night."</td>
							</tr>
							<tr>
                                <td style='padding:10px;font-size:18px;'><b>Price :</b> ".$price."</td>
							</tr>
                            <tr>
								<td style='padding:10px;font-size:18px;'><b>Type of Transport :</b> ".$type_of_transport."</td>
							</tr>
							<tr>
								<td style='padding:10px;font-size:18px;'><b>Duration :</b>". $duration."</td>
							</tr>
                            <tr>
                                <td style='padding:10px;font-size:18px;'><b>Hotel Rating :</b> ".$star."</td>
							</tr>
							<tr>
								<td style='padding:10px;font-size:18px;'><b>Area :</b> ".$area."</td>
							</tr>
							<tr>
                                <td style='padding:10px;font-size:18px;'text-align:justify;><b>Hotel Include :</b>".$hotel_include."</td>
                            </tr>
							<tr>
                                <td style='padding:10px;font-size:18px;text-align:justify;'><b>Activity :</b>". $activity."</td>
                            </tr>
                            <tr>
								<td style='padding:10px;font-size:18px;text-align:justify;><b>Short Description :</b>".$short_des."</td>
							</tr>
                            <tr>
                                <td style='padding:10px;font-size:18px;text-align:justify;'><b>Description :</b> ".$des."</td>
                            </tr>
                            <tr>
                                <td style='padding:10px;font-size:18px;text-align:justify;' colspan='2'><b>Activity Description :</b>". $activity_des."</td>
                            </tr>
                       ";
					   $count ++;
						 
					}
				}
			$html.= " </table></center>";
//echo $html;exit;
                $filename = "packege-details";
               
				$dompdf = new Dompdf();
				$dompdf->get_canvas();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'landscape');
                $dompdf->render();
                $pdfsave=$dompdf->output();
				sleep(100);
                file_put_contents('package-pdf/'.$filename.'.pdf', $pdfsave);
				
		if (isset($querys)){
            echo "<script type='text/javascript'>alert('Packege Details Insert Successfully!');</script>";
        }else{
            echo "<script type='text/javascript'>alert('Packege Details sending failed.');</script>";
        }
    }
	if(isset($_POST["savedeskviewdeal"])){
        $file = "package-pdf/packege-details.pdf";
        $fullPath = "package-pdf/packege-details.pdf";
        
        if (is_readable ($fullPath)) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);
           /* echo $ext;*/
            switch ($ext) {
                case "pdf":
                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=\"".$file."\"");
                break;
                default;
                header("Content-type: application/octet-stream");
                header("Content-Disposition: filename=\"".$file."\"");
            }
            header("Content-length: $fsize");
            header("Cache-control: private");
            readfile($fullPath);
            exit;
        } else {
                die("Invalid request");
        }    
    }
	if(isset($_POST['emailsend'])){
		$eemail=$_POST['fetchemail'];
		$ied=$_POST['fetchedeal'];
		$sqliquery = mysqli_query($con, "SELECT pac.id,pac.title,pac.image,pac.short_des,pac.des,pac.price,pac.night,pacday.id,pacday.day,pacday.pck_img,pacday.type_of_transport,pacday.duration,pacday.hotel_name,pacday.star,pacday.area,pacday.date,pacday.hotel_include,pacday.activity,pacday.activity_des,pacday.package_id FROM packages as pac INNER JOIN package_days as pacday ON pac.id = pacday.package_id Where pacday.package_id = '$ied'");
		while ($dsataccda = mysqli_fetch_array($sqliquery)){
		    //print_r($dsataccda);
		    $title = $dsataccda['title'];
			$image = $dsataccda['image'];
			$short_des = $dsataccda['short_des'];
			$des = $dsataccda['des'];
			$price = $dsataccda['price'];
			$night = $dsataccda['night'];
			$day = $dsataccda['day'];
			$pck_img = $dsataccda['pck_img'];
			$fghfghfgh = 'https://www.goingbo.com/public/images/package/'.$pck_img ;
			$type_of_transport = $dsataccda['type_of_transport'];
			$duration = $dsataccda['duration'];
			$hotel_name = $dsataccda['hotel_name'];
			$star = $dsataccda['star'];
			$area = $dsataccda['area'];
			$date = $dsataccda['date'];
			$hotel_include = $dsataccda['hotel_include'];
			$activity = $dsataccda['activity'];
			$activity_des = $dsataccda['activity_des'];		
		}						

		$querys = mysqli_query($con,"INSERT INTO `crm_packages_days`(`title`, `image`, `short_des`, `des`, `price`, `night`, `day`, `pck_img`, `type_of_transport`, `duration`, `hotel_name`, `star`, `area`, `date`, `hotel_include`, `activity`, `activity_des`, `email_package`) 
		VALUES ('$title','$image','$short_des','$des','$price','$night','$day','$pck_img','$type_of_transport','$duration','$hotel_name','$star','$area','$date','$hotel_include','$activity','$activity_des','$eemail')");
			
				$html="";
				$sqliquerys = mysqli_query($con, 
				"SELECT pac.id,pac.title,pac.image,pac.short_des,pac.des,pac.price,pac.night,pacday.id,pacday.day,pacday.pck_img,pacday.type_of_transport,pacday.duration,pacday.hotel_name,
				pacday.star,pacday.area,pacday.date,pacday.hotel_include,pacday.activity,pacday.activity_des,pacday.package_id FROM packages as pac 
				INNER JOIN package_days as pacday ON pac.id = pacday.package_id Where pacday.package_id = '$ied'");
	
				if($sqliquerys){
				$html.= "<center><table width='95%' style='border-collapse: collapse;color:#000;'align='center'>
				 <tr><img src='logo-header.png' alt='leter' style='height: 129px; width: 20%;'/> </tr>
				 <tr><th colspan='3' style='padding:10px;font-size:18px;'>".$title ."-Tour Packages</th></tr>";
				$count =1;
				
								while ($dsataccda = mysqli_fetch_array($sqliquerys)){
		   
					$image = $dsataccda['image'];
					$short_des = $dsataccda['short_des'];
					$des = $dsataccda['des'];
					$price = $dsataccda['price'];
					$night = $dsataccda['night'];
					$day = $dsataccda['day'];
					$pck_img = $dsataccda['pck_img'];
					$fghfghfgh = "https://www.goingbo.com/public/images/package/1989812985.jpg";

//					'https://www.goingbo.com/public/images/package/'.$pck_img ;
					$type_of_transport = $dsataccda['type_of_transport'];
					$duration = $dsataccda['duration'];
					$hotel_name = $dsataccda['hotel_name'];
					$star = $dsataccda['star'];
					$area = $dsataccda['area'];
					$hotel_include = $dsataccda['hotel_include'];
					$activity = $dsataccda['activity'];
					$activity_des = $dsataccda['activity_des'];		
					echo 
					$fghfghfgh;
					exit;
                    $html .= "
                           
                            <tr>
								<td style='padding:10px;font-size:18px;'><b>Title :</b> ".$title."</td>
                            </tr>
                            <tr>
								<td style='padding:10px;font-size:18px;'><b>Day :</b> ".$count ."</td>
							</tr>
							<tr>
								<td><img src=".$fghfghfgh." alt='".$count."' style='height: 220px; width: 50%;'></td>
							</tr>
							<tr>
                                <td style='padding:10px;font-size:18px;'><b>Night :</b> ".$night."</td>
							</tr>
							<tr>
                                <td style='padding:10px;font-size:18px;'><b>Price :</b> ".$price."</td>
							</tr>
                            <tr>
								<td style='padding:10px;font-size:18px;'><b>Type of Transport :</b> ".$type_of_transport."</td>
							</tr>
							<tr>
								<td style='padding:10px;font-size:18px;'><b>Duration :</b>". $duration."</td>
							</tr>
                            <tr>
                                <td style='padding:10px;font-size:18px;'><b>Hotel Rating :</b> ".$star."</td>
							</tr>
							<tr>
								<td style='padding:10px;font-size:18px;'><b>Area :</b> ".$area."</td>
							</tr>
							<tr>
                                <td style='padding:10px;font-size:18px;'text-align:justify;><b>Hotel Include :</b>".$hotel_include."</td>
                            </tr>
							<tr>
                                <td style='padding:10px;font-size:18px;text-align:justify;'><b>Activity :</b>". $activity."</td>
                            </tr>
                            <tr>
								<td style='padding:10px;font-size:18px;text-align:justify;><b>Short Description :</b>".$short_des."</td>
							</tr>
                            <tr>
                                <td style='padding:10px;font-size:18px;text-align:justify;'><b>Description :</b> ".$des."</td>
                            </tr>
                            <tr>
                                <td style='padding:10px;font-size:18px;text-align:justify;' colspan='2'><b>Activity Description :</b>". $activity_des."</td>
                            </tr>
                       ";
					   $count ++;
						 
					}
				}
			$html.= " </table></center>";
//echo $html;exit;
			$filename = "packege-details";
		
			$dompdf = new Dompdf();
				$dompdf->get_canvas();
			$dompdf->loadHtml($html);

			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$pdfsave=$dompdf->output();
			sleep(100);
			file_put_contents('package-pdf/'.$filename.'.pdf', $pdfsave);
			$to ='mahadeepsingh15@gmail.com';
			$from = 'mahadeepsingh15@gmail.com';
			$fromName = 'Goingbo Tour & Travel Pvt Ltd';
			$subject = 'Goingbo Tour & Travel Pvt Ltd';
			$file = "package-pdf/packege-details.pdf";
			$htmlContent = '<h3>Goingbo Tour & Travel Pvt Ltd</h3>';
			$headers = "From: $fromName"." <".$from.">";
			$semi_rand = md5(time());
			$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
			$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
			$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";
		   
			if(!empty($file) > 0){
				if(is_file($file)){
					$message .= "--{$mime_boundary}\n";
					$fp =    @fopen($file,"rb");
					$data =  @fread($fp,filesize($file));
			
					@fclose($fp);
					$data = chunk_split(base64_encode($data));
					$message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . "Content-Description: ".basename($file)."\n" . "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
				}
			}
			$message .= "--{$mime_boundary}--";
			$returnpath = "-f" . $from;
			mail($eemail, $subject, $message, $headers, $returnpath);
			$mail = @mail($to, $subject, $message, $headers, $returnpath);
			
			/*print_r($mail);*/
			
		if ($mail==1){
			echo "<script type='text/javascript'>alert('Packege Details send Successfully!');</script>";
		}else{
			echo "<script type='text/javascript'>alert('Packege Details send failed.');</script>";
		}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8" />
<title>Customer Relationship Management User | Tour Packages</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<script>
	function openForm() {
	  document.getElementById("myForm").style.display = "block";
	}

	function closeForm() {
	  document.getElementById("myForm").style.display = "none";
	}
</script>
</head>
<body>
<?php include("header.php");?>
	<div class="page-container row"> 
		<?php include("leftbar.php");?>
		<div class="clearfix"></div>
	</div>
</div>
<div class="page-content">
	<div id="portlet-config" class="modal hide">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button"></button>
			<h3>Widget Settings</h3>
		</div>
		<div class="modal-body"> Widget settings form goes here </div>
	</div>
	<div class="clearfix"></div>
	<div class="content">
		<ul class="breadcrumb">
			<li><p>Home <a href="tour-packages.php" style="color:#000;">Tour Packages</a></p></li>
		</ul>
	</div>
	<div>
		<h4 class="goingbotour">Goingbo Tour Packages</h4>
		<form action="" method="post" class="vbimt-search-form">
			<input name="title" value="<?php echo $title;?>" type="hidden"/>
			<input name="image" value="<?php echo $image;?>" type="hidden"/>
			<input name="short_des" value="<?php echo $short_des;?>" type="hidden"/>
			<input name="des" value="<?php echo $des;?>" type="hidden"/>
			<input name="price" value="<?php echo $price;?>" type="hidden"/>
			<input name="night" value="<?php echo $night;?>" type="hidden"/>
			<input name="day" value="<?php echo $day;?>" type="hidden"/>
			<input name="pck_img" value="<?php echo $pck_img;?>" type="hidden"/>
			<input name="type_of_transport" value="<?php echo $type_of_transport;?>" type="hidden"/>
			<input name="duration" value="<?php echo $duration;?>" type="hidden"/>
			<input name="hotel_name" value="<?php echo $hotel_name;?>" type="hidden"/>
			<input name="star" value="<?php echo $star;?>" type="hidden"/>
			<input name="area" value="<?php echo $area;?>" type="hidden"/>
			<input name="date" value="<?php echo $date;?>" type="hidden"/>
			<input name="hotel_include" value="<?php echo $hotel_include;?>" type="hidden"/>
			<input name="activity" value="<?php echo $activity;?>" type="hidden"/>
			<input name="activity_des" value="<?php echo $activity_des;?>" type="hidden"/>
		</form>
		<?php
			$packages = mysqli_query($con, "SELECT * FROM `packages`");
			while($rowss = mysqli_fetch_array($packages)){
				//print_r($row);
		?>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
				<h3><span class="fghfhgfhfg"><?php echo $rowss['title'];?></span> | <span class="packagesses"> <?php echo $rowss['night'];?> Nights | <?php echo $rowss['night']+1;?> Days Trip </span></h3>
			</div>
		</div>
		<div class="row holi-listing-list goingbo-manali-img">
			<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
				   <img class="goingbo-holidayspackag" src="https://www.goingbo.com/public/images/package/<?php echo $rowss['image'];?>" alt="">
			</div>
			<div class="col-sm-5 col-md-5 col-lg-5 col-xs-12 holi-listing-list-details">
				<div class="wrapper din_regular width450 usp">
					<span><p style="text-align:justify;font-size: 15px;line-height: 20px;"><?php echo $rowss['short_des'];?></p></span>
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 flR holi-listing-list-rate">
				<p class="holi-listing-list-actualrate din_medium"><span class="INR"><i class="fa fa-inr" aria-hidden="true"></i> </span><span><?php echo $rowss['price'];?></span></p>
				<p class="holi-listing-list-person din_regular ">Per person </p>
				<!--<form action="" method="post" class="vbimt-search-form">
					<input type="hidden" name="fetchedeal" id ="fetchedeal"value = "<?php //echo  $rowss['id'] ; ?>"/>	
					<button type="submit" name="savedeskviewdeal" class="btn btn-warning vbimt-downloadb btn-block">View Deal </button>
				</form>-->
			</div>
			<div class="hotel-listing-list-dealinfo din_regular">
				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
						<span class="flL hotel-listing-list-dealtext">Exclusive Online offer :</span>
					</div>
					<form action="" method="post" class="vbimt-search-form">
						<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
							<input type="text" name="fetchemail" id="fetchemail" class="goingbopack-crm" placeholder="E-mail" value="" required/>
							<input type="hidden" name="fetchedeal" id ="fetchedeal"value = "<?php echo  $rowss['id'] ; ?>"/>	
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<input type="hidden" name="fetchemail1"value="<?php echo $dfdf = $rowss['id']; ?>"/>
							<button type="submit" name="emailsend" class="btn btn-primary vbimt-downloadb btn-block">Email</button>
						</div>
					</form>
					<form action="" method="post" class="vbimt-search-form">
						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
							<input type="hidden" name="fetchedeal" id ="fetchedeal"value = "<?php echo  $rowss['id'] ; ?>"/>						
							<button type="submit" name="savedeskviewdeal" class="btn btn-warning vbimt-downloadb btn-block">Save</button>
						</div>
					</form>
				</div>
			</div>
			
		</div>
		<?php  } ?>
	</div>
</div>
<style>
.goingbopack-crm{
	border-radius:0px;
	border: #0aa699 1px solid !important;
}
.holi-listing-list {
    border: 1px solid #c8c8c8;
    background: #fff;
    clear: both;
    margin: 6px 0px 6px 6px;
}
.holi-listing-list-details {
    padding: 15px 9px 20px 0;
}
.holi-listing-list-rate {
    background-color: #f0f2ff;
    text-align: center;
    padding-top: 15px;
    /* min-height: 311px;
    min-height: 209px; */
}
.hotel-listing-list-dealinfo {
    padding: 11px 13px 8px;
    font-size: 12px;
    background-color: #f0f2ff;
    border-top: 1px solid #c8c8c8;
    clear: both;
    overflow: hidden;
    color: #83898b;
}
img.goingbo-holidayspackag {
    height: 211px;
    width: 100%;
    pading: 10px 10;
    padding: 10px 0px 10px 0px;
}
.din_regular {
    font-family: din-regularregular;
}
.holi-listing-list-actualrate {
    color: #247aae;
    font-size: 33px;
    margin-bottom: 1px;
    line-height: 44px;
}
.din_medium {
    font-family: 'DIN Medium';
}
.holi-listing-list-person {
    color: #83898b;
    font-size: 12px;
    margin-bottom: 20px;
    line-height: 16px;
}
.INR {
    font-family: webRupee;
}
.holi-listing-list-bookbtn.grey-btn {
    background-color: #ee8837;
    margin-bottom: 10px;
    border-radius: 0px;
    color: #fff;
}
.holi-listing-list-bookbtn {
    background-color: #cb3904;
    color: #fff;
    font-size: 16px;
    border-radius: 4px;
    margin-bottom: 4px;
    cursor: pointer;
    display: inline-block;
    width: 150px;
    padding: 0px 0;
    text-align: center;
    font-family: din-regularregular;
    /* margin: 112px 24px 15px 81px; */
}
.hotel-listing-list-dealinfo {
    padding: 11px 13px 8px;
    font-size: 12px;
    background-color: #f0f2ff;
    border-top: 1px solid #c8c8c8;
    clear: both;
    overflow: hidden;
    color: #83898b;
}
.din_regular {
    font-family: din-regularregular;
}
@media (min-width: 1000px)
.flL {
    float: left;
    margin: 0 5px 0 0;
}
.hotel-listing-list-dealtext {
    padding-top: 3px;
    margin-left: 10px;
    color: #595d5f;
}
.packagesses{
	color:#ff0000;
	font-size:14px;
}
goingbotour{
	font-weight:700;
	font-size:16px;
}
</style>
<script src="assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>-->
<script src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
</body>
</html>