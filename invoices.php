<?php

$pdo = new PDO('sqlite:chinook.db');

$sql = '
  SELECT invoices.InvoiceId, invoices.InvoiceDate, invoices.Total, customers.FirstName, customers.LastName
  FROM invoices
  INNER JOIN customers
  ON invoices.CustomerId = customers.CustomerId
  ORDER BY invoices.InvoiceDate DESC
';

// $sql = '
//   SELECT invoices.InvoiceId, invoices.InvoiceDate, invoices.Total, customers.FirstName, customers.LastName
//   FROM invoices, customers
//   WHERE invoices.CustomerId = customers.CustomerId
//   ORDER BY invoices.InvoiceDate DESC
// ';

$statement = $pdo->prepare($sql); // prepared statement
$statement->execute();

$invoices = $statement->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoices</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-3">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Date</th>
          <th>Invoice Number</th>
          <th>Customer</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($invoices as $invoice) : ?>
          <tr>
            <td>
              <?php echo $invoice->InvoiceDate ?>
            </td>
            <td>
              <?php echo $invoice->InvoiceId ?>
            </td>
            <td>
              <?php echo $invoice->FirstName . ' ' . $invoice->LastName ?>
            </td>
            <td>
              $<?php echo $invoice->Total ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>
</html>

