<?php
	require("db.php");
?>
<html>
 <head>

  <title>Demo Live search and pagination</title>

  <link rel="stylsheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

        </head>

<body>

<table id="tableId" class="display" cellspacing="1" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
            </tr>
        </tfoot>
        <tbody>
 <?php
  $sl="select * from reg";
  $qq=$con->query($sl);
  while($ff=$qq->fetch_object())
  {
 ?>
            <tr>
                <td><?php echo $ff->unm; ?></td>
                <td><?php echo $ff->pass; ?></td>
                <td><?php echo $ff->gender; ?></td>
                <td><?php echo $ff->hobby; ?></td>
                <td><?php echo $ff->state; ?></td>
            </tr>
 <?php
  }
 ?>
        </tbody>
    </table>

</body>
</html>

<script>
 $(document).ready(function(){
    $('#tableId').DataTable();
});
</script>