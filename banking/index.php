<?php

include_once("../objects/functions.php");
include_once("../objects/fund.php");
include_once("../config/database.php");
include_once("../config/connect.php");


$insertdata=new DB_con();

$database=new database();
$db=$database->getConnection();
$fund=new fund($db);

include_once("../header.php");

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Members</a>";
echo "</div>";

include_once("../footer.php");
?>
<?php
if(isset($_POST['submit']))
{
  // keep track validation errors
  $bank_nameError = null;
  $account_numberError = null;
  $amount_savedError = null;
  $date_savedError = null;

// keep track post values
  $bank_name = $_POST['bank_name'];
  $account_number = $_POST['account_number'];
  $amount_saved = $_POST['amount_saved'];
  $date_saved = $_POST['date_saved'];

// validate input
  $valid = true;
  if (empty($bank_name)) {
    $bank_nameError = 'Please enter Bank Name';
    $valid = false;
  }

  $valid = true;
  if (empty($account_number)) {
    $account_numberError = 'Please enter account number';
    $valid = false;
  }


  if (empty($amount_saved)) {
    $amount_savedError = 'Please enter amount to be saved';
    $valid = false;
  } else if ( $amount_saved < 0)  {
    $amount_savedError = 'Amount saved should be more than 0';
    $valid = false;
  }

  if (empty($date_saved)) {
    $date_savedError = 'Please enter date_saved';
    $valid = false;
  }

// insert into DB
  $sql=mysql_query("insert into save_banking(bank_name,account_number,amount_saved,date_saved) 
    values('$bank_name','$account_number','$amount_saved','$date_saved')");

}
?>
<form  action="" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Bank Name</td>
            <td><input type='text' name='bank_name' size='2' value="<?php echo $bank_name; ?>" class='form-control'></td>
        </tr>

        <tr>
            <td>Account Number</td>
            <td><input type='text' name='account_number' value="<?php echo $account_number; ?>" class='form-control'></td>


        </tr>
           <tr>
            <td>Date Saved</td>
            <td><input type='Date' name='date_saved' value="<?php echo $date_saved; ?>"  readonly class='form-control'></td> 
        </tr>
  
        <tr>
            <td>Amount Saved</td>

            <td><input type='text' name='amount_saved' value="<?php echo $amount_saved; ?>" class='form-control'></td>
            
        </tr>
        <tr>
            <td>
                <!--<button type="submit" class="btn btn-primary">Save</button>-->
                <input type="submit" value="Save" name="submit">
            </td>
        </tr>
 
    </table>
</form>
