<?php



$mem_id2=$_GET['id'];
//echo  $mem_id2; 

//echo $mem_id2=$_GET['id'];

//} else{

	//die('ERROR: missing ID.');
//}
include_once("objects/functions.php");
include_once("objects/fund.php");
include_once("config/database.php");

$insertdata=new DB_con();

$database=new database();
$db=$database->getConnection();
$fund=new fund($db);

$page_title="Savings";
include_once("header.php");

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Members</a>";
echo "</div>";



include_once("footer.php");

?>
<?php

//if(isset($_POST['submit']))
if(isset($_POST['submit']))
{
echo "data updated";
$s_mem_id=$_POST['s_mem_id'];
$s_date=$_POST['s_date'];
$s_amount=$_POST['s_amount'];
$s_balance=$_POST['s_balance'];
$s_overpay=$_POST['s_overpay'];
$s_t_id=$_POST['s_t_id'];
$amnt=700;
 if($s_amount<700){

 	$arreas=$s_amount-700;
 	$s_balance=$arreas;
 }elseif ($s_amount>700) {


 	# code...
 }
$sql=$insertdata->insert($s_mem_id,$s_date,$s_amount,$s_balance,$s_overpay,$s_t_id);
//$sql=$insertdata->insert($fname,$email,$contact,$gender,$education,$adrss);

if($sql)
{
 echo "<div class='alert alert-success'>Member was added succesfully.</div>";
}
else
{
echo "<div class='alert alert-danger'>Unable to add member.</div>";
}
}
 ?>

<form  action="" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Mem_ID</td>
            <td><input type='text' name='s_mem_id' size='2' value="<?php echo $mem_id2; ?>" class='form-control' /></td>
        </tr>

        <tr>
            <td>Date</td>
            <td><input type='date' name='s_date' value='' class='form-control' /></td>
        </tr>
           <tr>
            <td>Amount</td>
            <td><input type='text' name='s_amount' value='' class='form-control' /></td>
            <td>Balance</td>
            <td><input type='text' name='s_balance' value='' class='form-control' /></td>
        </tr>
 		
    	 <tr>
            <td>Overpay</td>
            <td><input type='text' name='s_overpay' value='' class='form-control' /></td>
            <td>text</td>
        </tr>
        s_t_id
        <tr>
            <td>Trust_Fund</td>
            <td>
                <!-- categories select drop-down will be here -->
    			<?php


            	//echo 'Categories are here';
            	// read the product categories from the database
				$stmt =$fund->read();
 
				// put them in a select drop-down
				echo "<select class='form-control' name='s_t_id'>";
   				 echo "<option>Select Fund...</option>";
 
   				 while ($row_fund = $stmt->fetch(PDO::FETCH_ASSOC)){
      				  extract($row_fund);
       			 echo "<option value='{$t_id}'>{$t_name}</option>";
    			}
 
				echo "</select>";

            ?>

            </td>
        </tr>
        <tr>

                    <td>Fines</td>
            <td><input type='text' name='s_fine' value='' class='form-control' /></td>
        </tr>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <!--<button type="submit" class="btn btn-primary">Save</button>-->
                <input type="submit" value="Save" name="submit">
            </td>
        </tr>
 
    </table>
</form>