<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('function.inc.php');
?>
<!doctype html>

<html>

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>TCC - Shop</title>

  

  <!--BOOTSTRAP CSS-->

  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

  <!--CUSTOM CSS-->

  <link href="css/custom.css" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">

  <!--COLOR CSS-->

  <link href="css/color.css" rel="stylesheet" type="text/css">

  <!--RESPONSIVE CSS-->

  <link href="css/responsive.css" rel="stylesheet" type="text/css">

  <!--OWL CAROUSEL CSS-->

  <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

  <!--FONTAWESOME CSS-->

  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!--SCROLL FOR SIDEBAR NAVIGATION-->

  <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">



  <!--GOOGLE FONTS-->

  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>

  <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

      <![endif]-->
 <style type="text/css">
   .product-name {
    margin-bottom: 0.7rem;
    font-size: 1.3rem;
    font-weight: 500;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
   }
 </style>
</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

   <!--HEADER START-->
    <?php include_once('includes/head_new.php');
    $row = getTopBanner('shop-page');
    ?>
    <!--HEADER END-->

  

  <!--INNER BANNER START-->

<section id="inner-banner" class="bgimgservices bgimgshop" style="background-image: url('images/banners/<?=$row[0]->banner_img?>');
">
  <div class="img-background-overlay"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="service-head">
      <div class="headerText">
        <h1 class="banner-title">Advertise Latest / Hero Product</h1>    
      </div>
      </div>
    </div>
  </div>
  </div>
</section>

<div class="clearfix clear"></div>
  <!--INNER BANNER END--> 


  <!--MAIN START-->

  <div id="main"> 

    <section class="promos-list shopcon">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 shopbanner">
          <a id="product">
            <h2>All Products</h2></a>
            <p><input type="hidden" name="category" value="<?=$_GET['cat_id']?>" id="category">
              <select class="form-control sortby" name="SORT_BY" id="SORT_BY">
                <option value="All">All</option>
                <option value="Best-Sellers">Best Sellers</option>
                <option value="New-Arrivals">New Arrivals</option>
                <option value="Popularity">Popularity</option>
                <option value="Discount">Discount</option>
                <option value="Price">Price:Low to High</option>
                <option value="Price1">Price:High to Low</option>
              </select>
            </p>
          </div>
        </div>  
      </div>
      <div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">

			<ul class="list-inline list-unstyled">
      <li><a href="index.php">Home</a></li>
			<li>Shop</li>
				<li id="catname">All</li>

			</ul>
			
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
      <div class="container-fluid shopbody">
        <div class="row">
          <div class="col-md-2 col-sm-12">
            <div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true">
              
              <!-- end of panel -->
              <?php  $category = getCategory('Y');
              $brand = getCategoryBrand();
              // echo "<pre>";
              // print_r($brand);
              // echo "</pre>";
              /*
              foreach($category as $row) {
              ?>
              <div class="panel">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed category" data-id="<?=$row->id?>"  data-name="<?=$row->categoryName?>" >
                    <?=$row->categoryName?>
                    </a>
                  </h4> 
                </div>
              </div>
              <?php } */ ?>
              <!-- end of panel -->

              <?php foreach($category as $row) {  ?>
                <div class="panel">
                <div class="panel-heading" role="tab" id="heading<?=$row->id?>">
                  <h4 class="panel-title">
                    <a class="collapsed category" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$row->id?>" aria-expanded="false" aria-controls="collapse<?=$row->id?>" data-id="<?=$row->id?>"  data-name="<?=$row->categoryName?>">
                    <?=$row->categoryName?>
                    </a>
                   
                  </h4>
                </div>
                <div id="collapse<?=$row->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$row->id?>">
                <?php foreach($brand[$row->id] as $bk => $bv) { ?>
                  <div class="panel-body">
                    <div class="checkbox brand" data-id="<?=$row->id?>"  data-name="<?=$row->categoryName?>">
                      <label><input type="checkbox" name="chk[]" value="<?=$bv?>" class="chk" data-catid="<?=$row->id?>"><?=$bv?></label>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>      
            <?php  }?>
         </div>
            <!-- end of #accordion -->
        </div>
          <div class="col-md-10 col-sm-12 " id="productBody" >
            <!-- card row start -->
            <?php
            $products =  getShopProducts( $_GET['cat_id'] , '', $_GET['id'] );
            $count = count($products);
            echo "<h1>".count($products)."</h1>";
            $prodPerPage = 8;
            $start = 'Y';
            foreach($products as $i => $data) {
              if($start == 'Y' ) {
                echo '<div class="container"><div class="row shoprow start" style="display:flex;flex-wrap:wrap;">';
                 $start = 'N';
              } 
            ?>
              <div class="col-sm-3">
                <div class="shopcard text-center "> 
                  <img class="shopimg" src="admin/productimages/<?php echo $data->id;?>/<?php echo $data->productImage1;?>" alt="<?=$data->productName?>" width="300" height="300">
                  <a href="#" class="ast-quick-view-text popup" data-toggle="modal" data-target="#flipFlop" data-id="<?php echo $data->id;?>">Quick View</a>
                  <div class="shopcardtext product-name" >
                    <h4 ><a href="product-details.php?pid=<?=$data->id?>">
                    <?=$data->productName?></a></h4>
                    <p>T$<?=displayPrice($data->productPrice)?></p>
                  </div>
                </div>
              </div>
              <!-- card col end -->
              <?php  if(fmod(($i+1), 3) == 0) {
                echo "</div class='end'>";
                $start = 'Y';
                } 
                if(($i+1) == 8) { break; }
              } 
              if($start == 'N' ) {
                echo "</div>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
<!--- Pagination Starts -->
<nav aria-label="Page navigation example" style="margin-left:75%">    
<ul id="pagination-demo" class="pagination justify-content-center"> 
<?php
$page = ceil($count/$prodPerPage);
if($page > 1) {
    for($i=1;$i<=$page;$i++) {
        echo '<span style="height:30px;background-color:blue;color:#fff;font-size:30px;font-weight:300;border:none;outline:none;margin:10px;padding:15px" class="page" data-id="'.$i.'" id="pageid'.$i.'" >'.$i.'</span>';
    }
}

?>  
</ul>
</nav>
<!--- Pagination Ends -->
  </div>

  <!--MAIN END--> 


  <!-- The modal -->
  <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
       
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <img class="quickimg" width="500" height="600" src="http://gauravb60.sg-host.com/wp-content/uploads/2023/02/Apple-Iphone-11-64GB-scaled.jpg">
            </div>
            <div class="col-md-6 quickviewinfo">
              <a href="#"><h5 class="pagetitle">Mobiles</h5></a>
              <a href="#" id="produrl"><h4 class="producttitle"><div id="pname">Samsung Fold 3</div></h4></a>
              <h5><span class="pricetitle" id="pprice">$500.00</span> & Free Shipping</h5>
              <hr/>
              <h4><span class="categorytitle">Category:</span> <span id="prodcategory">Mobiles</span></h4>
              <div class="quickicon">
                <fieldset>
                  <legend>Guaranteed Safe Checkout</legend>
                  <ul>
                    <li><img width="75" src="images/visa.png"></li>
                    <li><img width="75" src="images/Mastercard.png"></li>
                    <li><img width="75" src="images/americanexpress.png"></li>
                    <li><img width="75" src="images/discover.svg"></li>
                  </ul>
                </fieldset>
              </div>
            </div>
            <div class="col-12">
                <div class="control">
                  <button class="bttn bttn-left" id="minus">
                    <span>-</span>
                  </button>
                  <input type="number" class="input" id="input" min="1">
                  <button class="bttn bttn-right" id="plus">
                    <span>+</span>
                  </button>
                </div>
                <div class="addtocart">
                  <input type="hidden" name='pid' value="" id="pid">
                  <button type="submit" name="add-to-cart" class="addtocartbtn" >Add to cart</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- model end -->


  <!--FOOTER START-->
 <?php include_once('includes/foot.php');?>

  <!--FOOTER END--> 

</div>

<!--WRAPPER END--> 

<!--jQuery START--> 

<!--JQUERY MIN JS--> 

<script src="js/jquery-1.11.3.min.js"></script> 

<!--BOOTSTRAP JS--> 

<script src="js/bootstrap.min.js"></script> 

<!--Map Js--> 

<script src="http://maps.google.com/maps/api/js?sensor=false"></script> 

<!--OWL CAROUSEL JS--> 

<script src="js/owl.carousel.min.js"></script> 

<!--BANNER ZOOM OUT IN--> 

<script src="js/jquery.velocity.min.js"></script> 

<script src="js/jquery.kenburnsy.js"></script> 

<!--SCROLL FOR SIDEBAR NAVIGATION--> 

<script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 

<!--CUSTOM JS--> 

<script src="js/custom.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.collapse.in').prev('.panel-heading').addClass('active');
    $('#accordion, #accordion1, #accordion3')
      .on('show.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').addClass('active');
    })
    .on('hide.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').removeClass('active');
    });

      $(".popup").click(function() {
        var id = $(this).attr("data-id");
       $.ajax({
            type: "POST",
            url: 'product-details_ajax.php',
            dataType: 'json',
            data: {id:id},
            success: function(data)
            {
              $('#pname').text(data.productName);
              $('#pprice').text('$'+data.productPrice);
              $('#pid').val(data.id);
              $('#produrl').attr('href','product-details.php?pid='+data.id);
             // $('#pname').text(data.productName);
             $(".quickimg").attr("src", "admin/productimages/"+data.id+"/"+data.productImage1)
             $('#prodcategory').text(data.categoryName);
           }
       });
      });
      $(".addtocartbtn").click(function() {
        var id = $('#pid').val();
        var cnt = $('#input').val();
        
      //  alert("PID." + id+" \n QTY"+cnt);
       // console.log("Ajax start");
       
         $.ajax({
              type: "POST",
              url: 'product-add-tocart_ajax.php',
              dataType: 'json',
              data: {id:id,qty:cnt,action:'add'},
              success: function()
              {
                //$.parseJSON(data);
                alert('Product has been added to the cart');
               // $('#flipFlop').modal('hide');
                
            }
        }); 
       // console.log("Ajax ends");
        $("#flipFlop").modal('hide');
      });

    $("#SORT_BY").change(function(){
      //var url = $(this).val();
      var cat_id =  $("#category").val();
      var sort = $(this).val();
     // alert("Sort");
      const fruits = [];
      $('.chk:checkbox:checked').each(function() {
      //  alert($(this).val());
        fruits.push($(this).val());
      });

      $.ajax({
        type: "POST",
        url: 'get_product_details_ajax.php',
        dataType: 'json',
        data: {id:cat_id,sort:sort,brand:fruits},
        success: function(data)
        {
            var prodPerPage = 8;
            var totProduct = data.length;
            var page = Math.ceil((totProduct/prodPerPage));
            //alert(page);   
          var text = '';
          var start = 'Y';
          $.each( data, function( key, value ) {
              //alert(key+1);
            if(start == 'Y' ) {
              var str1 = '<div class="row shoprow start" >';
              text = text.concat(str1);
              start = 'N';
            } 
            var str = '<div class="col-sm-3"><div class="shopcard text-center"> <img class="shopimg" src="admin/productimages/'+data[key].id+'/'+data[key].productImage1+'" alt="img" width="300" height="300">  <a href="#" class="ast-quick-view-text popupx" data-toggle="modal" data-target="#flipFlop" data-id="'+data[key].id+'">Quick View</a>  <div class="shopcardtext product-name"><h4><a href="product-details.php?pid='+data[key].id+'">'+data[key].productName+'</a></h4>	<p>T$'+data[key].productPrice+'</p> </div></div></div>';
            text = text.concat(str);
            var res = (key+1) % 4;
            if(res == 0) {
              var str2 = "</div class='end'>";
              text = text.concat(str2);
              start = 'Y';
            } 
          });
          if(start == 'N' ) {
            text = text.concat("</div>");
          }
          $("#productBody").html(text);
        }
      }); 
    });

    $(".category").click(function(){
      var cat_id =  $(this).attr("data-id") ;
      var cat_name =  $(this).attr("data-name") ;
      //alert("##Category");
     //  alert("The paragraph was clicked."+cat_id);
     $("#category").val(cat_id);
     $("#SORT_BY").val('All');
     $('.chk').prop("checked", false);
      $.ajax({
            type: "POST",
            url: 'get_product_details_ajax.php',
            dataType: 'json',
            data: {id:cat_id},
           //page: {pageno:3},
            success: function(data)
            {
              
            //  var pageno =  this.page.pageno;
              var prodPerPage = 8;
              var totProduct = data.length;
              var page = Math.ceil((totProduct/prodPerPage));
              

              var text = '';
              var start = 'Y';
            
              const prodid = [];
              const prodimg = [];
              const prodname = [];
              const prodprice = [];
                
            $.each( data, function( key, value ) {
                prodid[key] = data[key].id;
                prodimg[key] = data[key].productImage1;
                prodname[key] = data[key].productName;
                prodprice[key] = data[key].productPrice;
            });
                if(totProduct >prodPerPage ) {
                var loopcnt = prodPerPage;
                } else {
                    var loopcnt = totProduct;
                }
            for(j=0;j<loopcnt;j++) {
               

                if(start == 'Y' ) {
                  var str1 = '<div class="row shoprow start" >';
                  text = text.concat(str1);
                 start = 'N';
                } 
             var str = '<div class="col-sm-3"><div class="shopcard text-center"> <img class="shopimg" src="admin/productimages/'+prodid[j]+'/'+prodimg[j]+'" alt="img" width="300" height="300">  <a href="#" class="ast-quick-view-text popupx" data-toggle="modal" data-target="#flipFlop" data-id="'+prodid[j]+'">Quick View</a>  <div class="shopcardtext product-name"><h4><a href="product-details.php?pid='+prodid[j]+'">'+prodname[j]+'</a></h4>	<p>T$'+prodprice[j]+'</p> </div></div></div>';
              text = text.concat(str);
                var res = (j+1) % 4;
                if(res == 0) {
                  var str2 = "</div class='end'>";
                  text = text.concat(str2);
                  start = 'Y';
                } 
              }   
              
              if(start == 'N' ) {
                text = text.concat("</div>");
              }
              $("#productBody").html(text);
                // pagination
                if(totProduct >prodPerPage ) {
                var pagehtml = '';
                for (let i = 1; i <=page; i++) {
                    var str2 = '<span style="height:30px;background-color:blue;color:#fff;font-size:30px;font-weight:300;border:none;outline:none;margin:10px;padding:15px" class="pageX" data-id="'+i+'"  id="pageid'+i+'">'+i+'</span>';
                    pagehtml = pagehtml.concat(str2);
                }
                $("#pagination-demo").html(pagehtml);
                } else {
                    $("#pagination-demo").html('');
                }
            }
      }); 
      $("#catname").html(cat_name);
    });

    $(".chk").click(function(){
     // var chkstr =  $('.chk:checked').serialize();
     var catid = $(this).attr("data-catid");
   //  alert("Checked"+catid);
   $("#SORT_BY").val('All');
      
     const fruits = [];
      $('.chk:checkbox:checked').each(function() {
        fruits.push($(this).val());
    });

     
      $.ajax({
            type: "POST",
            url: 'get_product_brand_ajax.php',
            dataType: 'json',
            data: {id:catid,brand:fruits},
            success: function(data)
            {
                
              var prodPerPage = 8;
              var totProduct = data.length;
              var page = Math.ceil((totProduct/prodPerPage));
            // alert("nack"+page);
              var text = '';
              var start = 'Y';
              const prodid = [];
              const prodimg = [];
              const prodname = [];
              const prodprice = [];
                
            $.each( data, function( key, value ) {
                prodid[key] = data[key].id;
                prodimg[key] = data[key].productImage1;
                prodname[key] = data[key].productName;
                prodprice[key] = data[key].productPrice;
            });
                if(totProduct >prodPerPage ) {
                var loopcnt = prodPerPage;
                } else {
                    var loopcnt = totProduct;
                }
            for(j=0;j<loopcnt;j++) {
               

                if(start == 'Y' ) {
                  var str1 = '<div class="row shoprow start" >';
                  text = text.concat(str1);
                 start = 'N';
                } 
             var str = '<div class="col-sm-3"><div class="shopcard text-center"> <img class="shopimg" src="admin/productimages/'+prodid[j]+'/'+prodimg[j]+'" alt="img" width="300" height="300">  <a href="#" class="ast-quick-view-text popupx" data-toggle="modal" data-target="#flipFlop" data-id="'+prodid[j]+'">Quick View</a>  <div class="shopcardtext product-name"><h4><a href="product-details.php?pid='+prodid[j]+'">'+prodname[j]+'</a></h4>	<p>T$'+prodprice[j]+'</p> </div></div></div>';
              text = text.concat(str);
                var res = (j+1) % 4;
                if(res == 0) {
                  var str2 = "</div class='end'>";
                  text = text.concat(str2);
                  start = 'Y';
                } 
              }  
              if(start == 'N' ) {
                text = text.concat("</div>");
              }
              $("#productBody").html(text);
     
              // pagination
              if(totProduct >prodPerPage ) {   
var pagehtml = '';
for (let i = 1; i <=page; i++) {
    var str2 = '<span style="height:30px;background-color:blue;color:#fff;font-size:30px;font-weight:300;border:none;outline:none;margin:10px;padding:15px" class="pageX" data-id="'+i+'"  id="pageid'+i+'">'+i+'</span>';
    pagehtml = pagehtml.concat(str2);
}
$("#pagination-demo").html(pagehtml);
              } else {
                $("#pagination-demo").html('');
              }
            }
      }); 
      
    });
     
    $(".page").click(function(){
      var page =  $(this).attr("data-id") ;
      var cat_id =  $("#category").val();
     // alert("Pagination @");
      const fruits = [];
      $('.chk:checkbox:checked').each(function() {
        //alert($(this).val());
        fruits.push($(this).val());
      });
      $('.page').css({"background-color":"blue"});
      $('#pageid'+page).css({"background-color":"red"});

      // alert("The paragraph was clicked."+page+' -- '+cat_id);
    
     $("#category").val(cat_id);
     $("#SORT_BY").val('All');
   //  $('.chk').prop("checked", false);
      $.ajax({
            type: "POST",
            url: 'get_product_details_ajax.php',
            dataType: 'json',
            data: {id:cat_id,page:page,brand:fruits},
            success: function(data)
            {
              var text = '';
              var start = 'Y';
              $.each( data, function( key, value ) {
                if(start == 'Y' ) {
                  var str1 = '<div class="row shoprow start" >';
                  text = text.concat(str1);
                 start = 'N';
                } 
             var str = '<div class="col-sm-3"><div class="shopcard text-center "> <img class="shopimg" src="admin/productimages/'+data[key].id+'/'+data[key].productImage1+'" alt="img" width="300" height="300">  <a href="#" class="ast-quick-view-text popupx" data-toggle="modal" data-target="#flipFlop" data-id="'+data[key].id+'">Quick View</a>  <div class="shopcardtext product-name"><h4><a href="product-details.php?pid='+data[key].id+'">'+data[key].productName+'</a></h4>	<p>T$'+data[key].productPrice+'</p> </div></div></div>';
              text = text.concat(str);
                var res = (key+1) % 4;
                if(res == 0) {
                  var str2 = "</div class='end'>";
                  text = text.concat(str2);
                  start = 'Y';
                } 
              });
              if(start == 'N' ) {
                text = text.concat("</div>");
              }
              $("#productBody").html(text);
            }
      }); 
      $("#catname").html(cat_name); 
    });
  });

  // script of plus minus quantity
  var minus = document.querySelector("#minus");
  var plus = document.querySelector("#plus");
  var input = document.querySelector("#input");

  var quantity = 1;

  input.value = quantity;

  minus.addEventListener('click', function(event){
    if (quantity > 1) {
        quantity --;
      input.value = quantity;
    }
  });

  plus.addEventListener('click', function(event){
    quantity ++;
    input.value = quantity;
  });
</script>
<script>
	$(function(){
		$(document).on("click", '.popupx',function(){
		  var id = $(this).attr("data-id");
      $.ajax({
            type: "POST",
            url: 'product-details_ajax.php',
            dataType: 'json',
            data: {id:id},
            success: function(data)
            {
              $('#pname').text(data.productName);
              $('#pprice').text('$'+data.productPrice);
              $('#pid').val(data.id);
              $('#produrl').attr('href','product-details.php?pid='+data.id);
             // $('#pname').text(data.productName);
             $(".quickimg").attr("src", "admin/productimages/"+data.id+"/"+data.productImage1);
             $('#prodcategory').text(data.categoryName);
           }
       });
		});
        $(document).on("click", '.pageX',function(){
                var page =  $(this).attr("data-id") ;
                //var cat_name =  $(this).attr("data-name") ;
                var cat_id =  $("#category").val();
                //  var sort = $(this).val();
                //alert("Ajax Pagination");
                const fruits = [];
                $('.chk:checkbox:checked').each(function() {
                //alert($(this).val());
                fruits.push($(this).val());
                });
                //alert("The paragraph was clicked."+page+' -- '+cat_id);
                $("#category").val(cat_id);
                $("#SORT_BY").val('All');
                $('.pageX').css({"background-color":"blue"});
                $('#pageid'+page).css({"background-color":"red"});
                $.ajax({
            type: "POST",
            url: 'get_product_details_ajax.php',
            dataType: 'json',
            data: {id:cat_id,page:page,brand:fruits},
            success: function(data)
            {
              var text = '';
              var start = 'Y';
              $.each( data, function( key, value ) {
                if(start == 'Y' ) {
                  var str1 = '<div class="row shoprow start" >';
                  text = text.concat(str1);
                 start = 'N';
                } 
             var str = '<div class="col-sm-3"><div class="shopcard text-center"> <img class="shopimg" src="admin/productimages/'+data[key].id+'/'+data[key].productImage1+'" alt="img" width="300" height="300">  <a href="#" class="ast-quick-view-text popupx" data-toggle="modal" data-target="#flipFlop" data-id="'+data[key].id+'">Quick View</a>  <div class="shopcardtext product-name"><h4><a href="product-details.php?pid='+data[key].id+'">'+data[key].productName+'</a></h4>	<p>T$'+data[key].productPrice+'</p> </div></div></div>';
              text = text.concat(str);
                var res = (key+1) % 4;
                if(res == 0) {
                  var str2 = "</div class='end'>";
                  text = text.concat(str2);
                  start = 'Y';
                } 
              });
              if(start == 'N' ) {
                text = text.concat("</div>");
              }
              $("#productBody").html(text);
             
            }
      }); 
        });    
	});
</script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/63fdb6bf4247f20fefe30dd0/1gqbh3q1f';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->


</body>

</html>
