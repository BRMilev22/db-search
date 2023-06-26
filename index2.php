<?php
include 'db_connect.php';
$searchErr = '';
$phone_details = '';
if (isset($_POST['save'])) {
    if (!empty($_POST['search'])) {
        $search = $_POST['search'];
        $stmt = $con->prepare("SELECT * FROM phone_info WHERE id LIKE '%$search%'");
        $stmt->execute();
        $phone_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $searchErr = "Please enter the information";
    }
}
?>
<html>
<head>
<title>ИР-Техникс</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>
.container
{
    width:70%;
    height:30%;
    padding:20px;
}
</style>
</head>
 
<body>
    <div class="container">
    <h3><u>ИР-Техникс search engine</u></h3>
    <br/><br/>
    <form class="form-horizontal" action="#" method="post">
    <div class="row">
        <div class="form-group">
            <label class="control-label col-sm-4" for="email"><b>Search phone by ID:</b>:</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="search" placeholder="ID">
            </div>
            <div class="col-sm-2">
              <button type="submit" name="save" class="btn btn-primary">Search</button>
            </div>
        </div>
        <div class="form-group">
            <span class="error" style="color:red;">* <?php echo $searchErr;?></span>
        </div>
         
    </div>
    </form>
    <br/><br/>
    <h3><u>Резултат</u></h3><br/>
    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Phone name</th>
            <th>Price</th>
            <th>Shape</th>
            <th>Battery</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tbody>
        <?php
                 if(!$phone_details)
                 {
                    echo '<tr>No data found</tr>';
                 }
                 else{
                    foreach($phone_details as $key=>$value)
                    {
                        ?>
                    <tr>
                        <td><?php echo $key+1;?></td>
                        <td><?php echo $value['phone_name'];?></td>
                        <td><?php echo $value['price'];?></td>
                        <td><?php echo $value['shape'];?></td>
                        <td><?php echo $value['battery'];?></td>
                        <td><?php echo $value['notes'];?></td>
                    </tr>
                         
                        <?php
                    }
                     
                 }
                ?>
             
         </tbody>
      </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>