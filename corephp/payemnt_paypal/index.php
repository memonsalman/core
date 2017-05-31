<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='sallyjones1234@gmail.com'; // Business email ID
?>

<style>
body
{
    font: bold 14px arial;
}
.product
{
    float: left;
    margin-right: 10px;
    border: 1px solid #cecece;
    padding: 10px;
    margin-right: 20px;
}
</style>
<div style="margin:50px">
    <h3>Note: Create a test buyer account at Paypal Sandbox then try this demo.</h3>
    <h3><a href=" https://developer.paypal.com/" target="_blank"> https://developer.paypal.com/</a></h3>
	<hr />
	<pre>
	buyer id ==  "ron@hogwarts.com"  Password == "qwer1234"
	
	buyer id ==  "sallyjones1234@gmail.com"  Password == "p@ssword1234"
	
	buyer id ==  "joe@boe.com"  Password == "123456789"
	
</pre>
<hr />
</div>
<h4>Welcome, Guy's</h4>

<div class="product">            
    <div class="image">
        <img height="100px" width="100px" src="http://foodnetindia.in/wp-content/uploads/2015/06/parle_g.jpg" />
    </div>
    <div class="name">
        Ahir Product
    </div>
    <div class="price">
        Price:$10
    </div>
    <div class="btn">
    <form action="<?php echo $paypal_url ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="Parle G">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" value="10">
    <input type="hidden" name="cpp_header_image" value="https://media.licdn.com/mpr/mpr/shrink_100_100/AAEAAQAAAAAAAAhXAAAAJDIxZDQxODc4LTJlMTEtNDYxZS04YzMwLTA2N2MxYzMyMWViOA.jpg">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
    </div>
</div>

<h3 align="center">Chandresh ahir : <a href="https://www.facebook.com/ahir.div.ahir"> follow me here</a></h3>


