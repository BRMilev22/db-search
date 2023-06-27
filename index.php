<?php
include 'db_connect.php';
$searchErr = '';
$phone_details = '';
if (isset($_POST['save'])) {
    if (!empty($_POST['search'])) {
        $search = $_POST['search'];
        $stmt = $con->prepare("SELECT * FROM phone_info WHERE id = ? OR phone_name LIKE ?");
        $stmt->bindValue(1, $search); 
        $stmt->bindValue(2, $search . '%'); 
        $stmt->execute();
        $phone_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $searchErr = "Моля напишете служебен номер!";
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
            <label class="control-label col-sm-4" for="email"><b>Search phone by ID or Model:</b>:</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="search" placeholder="ID or Model">
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
                    echo '<tr>Не бе намерен телефон с този служебен номер!</tr>';
                 }
                 else{
                    foreach($phone_details as $key=>$value)
                    {
                        ?>
                    <tr>
                        <td><?php echo $value['id'];?></td>
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

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<form action="add_item.php" method="POST">
  <label for="id">ID:</label>
  <input type="text" name="id" id="id">

  <label for="phone_name">Телефон:</label>
  <textarea name="phone_name" id="phone_name"></textarea>

  <label for="price">Цена:</label>
  <textarea name="price" id="price"></textarea>

  <label for="shape">Състояние:</label>
  <textarea name="shape" id="shape"></textarea>

  <label for="battery">Батерия:</label>
  <textarea name="battery" id="battery"></textarea>

  <label for="notes">Бележки:</label>
  <textarea name="notes" id="notes"></textarea>

  <input type="submit" value="Добави телефон">
</form>

<form action="remove_item.php" method="POST">
  <label for="id">ID:</label>
  <input type="text" name="id" id="id">
  <input type="submit" value="Премахни телефон">
</form>


<br><br><br><br><br><br><br><br><br><br><br>

<h1 class = "e_db" >Entire database</h1>

<Style>
  .e_db
  {
    text-align: center;
  }
</Style>


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
        include 'db_connect.php';
        $stmt = $con->prepare("SELECT * FROM phone_info");
        $stmt->execute();
        $phone_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($phone_details as $phone_info): ?>
            <tr>
                <td><?php echo $phone_info['id']; ?></td>
                <td><?php echo $phone_info['phone_name']; ?></td>
                <td><?php echo $phone_info['price']; ?></td>
                <td><?php echo $phone_info['shape']; ?></td>
                <td><?php echo $phone_info['battery']; ?></td>
                <td><?php echo $phone_info['notes']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>