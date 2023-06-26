<?php
include 'db_connect.php';
$searchErr = '';
$phone_details = '';
if (isset($_POST['save'])) {
    if (!empty($_POST['search'])) {
        $search = $_POST['search'];
        $stmt = $con->prepare("SELECT * FROM phone_info WHERE id LIKE '%$search%' OR phone_name LIKE '%$search%'");
        $stmt->execute();
        $phone_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $searchErr = "Please enter the information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>db-search</title>
</head>

<body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>ИР-Техникс</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">

                                    <form action="" method="GET">
                                        <div class="input-group md-3">
                                            <input type="text" name="search" value="" class="form-control" placeholder="Служебен номер на телефона">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>
    <h3><u>Search Result</u></h3><br/>
    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Employee Name</th>
            <th>Phone No</th>
            <th>Age</th>
            <th>Department</th>
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