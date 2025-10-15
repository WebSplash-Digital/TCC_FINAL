<?php
function sendMail($email_to_name,$email_to, $email_subject,$email_body ) {
    $admin_email = getConfigValue('ADMIN_EMAIL');
	$to       = "$email_to_name <$email_to>";
	$subject  = $email_subject;
	$message  = $email_body;
	$headers  = 'From: '.$admin_email.'' . "\r\n" .
		'MIME-Version: 1.0' . "\r\n" . 
		'Content-type: text/html; charset=utf-8';
	if(mail($to, $subject, $message, $headers)) {
	//echo "Email sent";
	}else{
	//echo "Email sending failed";
	}
}

function getCategory($withProduct = '') {
	global $dbh;
	if($withProduct == 'Y') {
		$sql="SELECT distinct cat.* FROM `category` cat,products prod WHERE cat.id = prod.category and productAvailability = 'In Stock' and product_status =1 order by cat.id" ;  
	} else {
		$sql="SELECT * from category as cat order by cat.id"; 
	}
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}



function getBanner() {
	global $dbh;
	$sql="SELECT * from banners where status = 1 limit 4";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getPromotion() {
	global $dbh;
	$sql="SELECT * from promotions where status = 1";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getPlans() {
	global $dbh;
	$sql="SELECT * from plans where status = 1";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}
function getFeaturedPlans() {
	global $dbh;
	$sql="SELECT * from plan_mst where status = 1 and home_flag = 1 limit 4";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getLowPrice($results) {
	global $dbh;
	foreach($results as $k => $udata) {
		$arr[] = $udata->id;
	}
	$str = implode(",", $arr);

	$sql = "SELECT * FROM `plan_details` where plan_id in ($str) and sub_id = 1 and plan_option like '%Price%'";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$resultp = $query->fetchAll(PDO::FETCH_OBJ);
	foreach($resultp as $k => $udata) {
		$arr[$udata->plan_id] = $udata->plan_value;
	}
	// echo "<pre>";
	// print_r($arr);
	// echo "</pre>";
	return $arr;
}
function getFeatureList() {
	global $dbh;
	$sql="SELECT * from plan_features where status = 1";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	foreach($results as $data) {
		$array[$data->id] = $data->feature_title;
	}
	return $array;
}

function getCategoryList() {
	global $dbh;
	$sql="SELECT * from category";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	foreach($results as $data) {
		$array[$data->id] = $data->categoryName;
	}
	return $array;
}

function getConfigValue($var) {
	global $dbh;
	$sql="SELECT option_value FROM `config_options` WHERE `option_name` LIKE '$var'";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results[0]->option_value;
}
function getFAQ($var) {
	global $dbh;
	$sql="SELECT * FROM `faq_mst` WHERE `faq_type` = '$var' and status= 1";
	$query = $dbh -> prepare($sql);
	$query->execute();
	return $results = $query->fetchAll(PDO::FETCH_OBJ);
}

function getPromotionById($id) {
	global $dbh;
	$sql="SELECT * FROM `promotions` WHERE `id` = '$id'";
	$query = $dbh -> prepare($sql);
	$query->execute();
	return $results = $query->fetchAll(PDO::FETCH_OBJ);
}
function getAllPlans($id = '') {
	global $dbh;
	if($id !='') {
		$sql="SELECT * FROM `plan_mst` where category = '$id'";
	} else {
		$sql="SELECT * FROM `plan_mst`";
	}
	$query = $dbh -> prepare($sql);
	$query->execute();
	return $results = $query->fetchAll(PDO::FETCH_OBJ);
}
function getPlanMst($id) {
	global $dbh;
	$sql="SELECT * FROM plan_mst where id = $id";
	//die($sql);
	$query = $dbh -> prepare($sql);
	$query->execute();
	return $results = $query->fetchAll(PDO::FETCH_OBJ);
}
function getPlanDetails($id) {
	global $dbh;
	$sql="SELECT * FROM plan_details where plan_id = '$id' order by id";
	$query = $dbh -> prepare($sql);
	$query->execute();
	return $results = $query->fetchAll(PDO::FETCH_OBJ);
}

function getProfessionals() {
	global $dbh;
	$sql="SELECT * from tcc_professionals where status = 1 order by display_order limit 4";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getTopBanner($id) {
	global $dbh;
	$sql="SELECT * from page_topbanner where status = 1  and  page_name = '$id' ";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getFeaturedProducts() {
	global $dbh;
	$sql="SELECT * from plan_mst where status = 1 and home_flag = 1";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getShopProducts($cat = '' , $home = '' ,$sort ='' ) {
	global $dbh;
	$orderby = " "; 

	$sql="SELECT * FROM `products` WHERE 1 " ;
	if($home == 1) {
		$sql.="  AND `featured_product` = 1  ";
	}
	if($cat != '') {
		$sql.="  AND `category` = '".$cat."'  ";
	}
	if($sort != '' && $sort =='Best-Sellers') {
		$sql.="  AND `bestseller` = '1'  ";
	} elseif($sort != '' && $sort =='New-Arrivals') {
		$sql.="  AND `new_arrival` = '1'  ";
	}elseif($sort != '' && $sort =='Popularity') {
		$sql.="  AND `popularity` = '1'  ";
	}elseif($sort != '' && $sort =='Discount') {
		$sql.="  AND productPriceBeforeDiscount > productPrice  ";
	}elseif($sort != '' && $sort =='Price') {
		//$sql.="  AND `category` = '".$cat."'  ";
		 $orderby = " order by productPrice asc ";
	}elseif($sort != '' && $sort =='Price1') {
			//$sql.="  AND `category` = '".$cat."'  ";
			 $orderby = " order by productPrice desc ";
	} 
	if(isset($_POST['brand']) && count($_POST['brand']) > 0) {
		$brand = implode("','", $_POST['brand']);
		$sql.="  AND `productCompany` in  ('".$brand."')  ";
	}
	$limit_query = " ";
	if(isset($_POST['page'])) {
		$limit = 8;
		$start =  ((($_POST['page'] -1) * $limit)  );
		$limit_query = " limit $start, $limit ";
	} 
	$sql.="  AND `product_status` = 1 and productAvailability = 'In Stock'   $orderby  $limit_query";
	//die($sql);
	//$sql="SELECT * FROM `products` WHERE `featured_product` = 1 AND `product_status` = 1 and productAvailability = 'In Stock';";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}


function getProductDetail($pid ) {
	global $dbh;
//	$sql="SELECT * FROM `products` WHERE id = '".$pid."'";
$sql="SELECT prod.*,`categoryName` FROM `products` prod, category cat WHERE prod.id = '".$pid."' and cat.id =prod.category";

	$query = $dbh ->prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

/*********Get Cart Details by Current user id ***********/
function getCartListByUserId($userId){
	global $dbh;
	$sql="SELECT * FROM `cart` where user_id=".$userId;
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}
/*****************END Get Cart Details By Current User Id***** */
/**********GET cart total ***************** ******************/
function getCartTotal($userId){
	global $dbh;
	$sql="SELECT sum(amount) as CartTotal FROM `cart` where user_id=".$userId;
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}
/*********************END get cart Total********************** */



/**********************CART COUT******************************** */
function cartCount($userId){
	global $dbh;
	$sql="SELECT sum(qty) as CartiteamCount FROM `cart` where user_id=".$userId;
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}
/*******************END CART COUNT****************************** */

function displayPrice($number) {
 return number_format((float)$number, 2, '.', '');
}

function getCategoryBrand() {
	global $dbh;
	$sql="SELECT category, productCompany, count(*) as cnt FROM `products` where productAvailability = 'In Stock' group by category,productCompany";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	foreach($results as $data) {
		$array[$data->category][] = $data->productCompany;
	}
	return $array;
}

//get Applied Job Status by userID

function getAppliedJobStatusByUserId($jobId){
	
	global $dbh; 
	
	//$brand = 'Samsung';
	$userid = $_SESSION['jsid']; 
	$sql="SELECT * FROM `tblapplyjob` WHERE  JobId=".$jobId." and UserId=".$userid;
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);

	return $results;
}
//get UserDetails

function getUserDetailsByyUserId($userid){
	
	global $dbh; 
	
	//$brand = 'Samsung';
	$userid = $_SESSION['id']; 
	$sql="SELECT * FROM `tbljobseekers` WHERE  id=".$userid;
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);

	return $results;
}

//get orderdetails

function orderdetails($userid){
	global $dbh;

	$userid = $_SESSION['jsid']; 

	// echo $userid;
	$f1="00:00:00";
	$from=date('Y-m-d')." ".$f1;
	$t1="23:59:59";
	$to=date('Y-m-d')." ".$t1;
	$sql="SELECT COUNT(id) as count FROM Orders where orderDate Between '$from' and '$to' and UserId='$userid'";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	//print_r($results);
	return $results;
}

//get pendingorderdetails

function pendingorderdetails($userid){
	global $dbh;

	$userid = $_SESSION['jsid']; 
	$status='Delivered';									 
							
	$sql="SELECT COUNT(id) as count FROM Orders where orderStatus!='$status' || orderStatus is null and UserId='$userid'";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	//print_r($results);
	return $results;
}


//get rejectedorderdetails

function rejectedorderdetails($userid){
	global $dbh;

	$userid = $_SESSION['jsid']; 
	$status='Delivered';									 
							
	$sql="SELECT COUNT(id) as count FROM Orders where orderStatus='$status' and UserId='$userid'";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	//print_r($results);
	return $results;
}

//Get All Applied Job Count by userId
function getAllAppliedJobByUserId($userid){
	global $dbh;
	$userid = $_SESSION['jsid']; 
	$sql="SELECT COUNT(ID) as count FROM `tblapplyjob` WHERE  UserId=".$userid."";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

//Get All Applied Job Count by userId
function getAllRejectedJobByUserId($userid){
	global $dbh; 
	$sql="SELECT COUNT(ID)  as count FROM `tblapplyjob` WHERE  UserId=".$userid." and status = 'Rejected'";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

//Get All Applied Job Count by userId
function getAllSortedJobByUserId($userid){
	global $dbh;
	
	$sql="SELECT COUNT(ID)  as count FROM `tblapplyjob` WHERE  UserId=".$userid." and status='Shortlisted'";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

//Get All wishlist by userId
function getAllwishlistByUserId($userid){
	global $dbh;
	
	//$sql="SELECT * FROM `wishlist` INNER JOIN products ON products.id=wishlist.productId WHERE wishlist.userId=".$userid." ";
	$sql = "select * from wishlist where userId=".$_SESSION['id'];
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}


//get All Recent order list by current user
function userwiseOrderDetails($userid){
	// echo $userid;
	global $dbh; 
	$sql="SELECT orders.id,products.productName,products.productPrice,orders.quantity,orders.orderStatus FROM `Orders` INNER JOIN products on products.id=orders.productId WHERE  UserId='$userid' order by id desc";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	// print_r($results); 

	return $results;
}

//get All Recent order list by current user
function getOrderDetailsByOrderID($orderid){
	// echo $orderid;
	global $dbh; 
	$sql="SELECT orders.id,products.productName,products.productPrice,orders.quantity,orders.orderDate,orders.orderStatus FROM `Orders` INNER JOIN products on products.id=orders.productId WHERE  orders.id='$orderid' order by id desc";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	// print_r($results); 

	return $results;
}
//get All Recent applied job list by current user
function getRecentAppliedJobCurrentUser($userid){
	global $dbh; 
	$sql="SELECT * FROM `tblapplyjob` WHERE  UserId=".$userid." order by id desc";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

//Get Job Details by jobId
function getJobDetailsByJobid($jobId){
	global $dbh;
	$sql="SELECT * FROM `tbljobs` WHERE  jobId=".$jobId."";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getShopProductsByBrand($cat, $brand  ,$sort ='' ) {
	global $dbh;
	$orderby = " "; 
	//$brand = 'Samsung';
	$sql="SELECT * FROM `products` WHERE 1 " ;
	
	if($cat != '') {
		$sql.="  AND `category` = '".$cat."'  ";
	}
	if($brand != '') {
		$sql.="  AND `productCompany` in  ('".$brand."')  ";
	}
	if($sort != '' && $sort =='Best-Sellers') {
		$sql.="  AND `bestseller` = '1'  ";
	} elseif($sort != '' && $sort =='New-Arrivals') {
		$sql.="  AND `new_arrival` = '1'  ";
	}elseif($sort != '' && $sort =='Popularity') {
		$sql.="  AND `popularity` = '1'  ";
	}elseif($sort != '' && $sort =='Discount') {
		$sql.="  AND productPriceBeforeDiscount > productPrice  ";
	}elseif($sort != '' && $sort =='Price') {
		//$sql.="  AND `category` = '".$cat."'  ";
		 $orderby = " order by productPrice asc ";
	}elseif($sort != '' && $sort =='Price1') {
			//$sql.="  AND `category` = '".$cat."'  ";
			 $orderby = " order by productPrice desc ";
	} 
	if(isset($_POST['page'])) {
		$limit = 8;
		$start =  (($_POST['page'] * $limit) -1 );
		$limit_query = " limit $start, $limit ";
	}
	$sql.="  AND `product_status` = 1 and productAvailability = 'In Stock'   $orderby $limit_query ";
	//die("Stop");
	//return $sql;
// echo "<br>".$sql;
// die();
	//$sql="SELECT * FROM `products` WHERE `featured_product` = 1 AND `product_status` = 1 and productAvailability = 'In Stock';";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}


//get Orderdetails by order id
//Get Job Details by jobId
function getConfirmationDeatils($orderid){
	global $dbh;
	$sql="SELECT * FROM `orders` WHERE  id=".$orderid."";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

//get order details 
function getOrderDetailsById($orderId){
	global $dbh;
	$sql="SELECT * FROM `order_details` WHERE  order_id=".$orderId."";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

//delete all cart record by user id
function deleteAllCartDataByuserid($userId){
	global $dbh;
	$sql="Delete from `cart` WHERE  user_id=".$userId."";
	$query = $dbh -> prepare($sql); 
	$query->execute();
}

//get order total amount
function  getOrdertTotal($userId,$orderId){
	global $dbh;
	$sql="SELECT sum(Amount) as OrderTotal FROM `order_details` where user_id=".$userId." and order_id=".$orderId;
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

//Get order List by userid
function getOrderListByuserId($userId){
	global $dbh;
    $sql="SELECT * FROM `orders` WHERE  userId=".$userId."";
	$query = $dbh -> prepare($sql); 
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

?>