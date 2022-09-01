<!doctype html>
<html lang="en">
  <head>
    <title> Contact Us </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 m-auto">
                <h3><strong> Customer Contact Us Email </strong></h3>
                <p><strong> Name: <strong><?php echo $sb['txtName']." ".$sb['txtlName'];?> </p>
                <p><strong> Email Address: <strong><?php echo $sb['txtEmail'];?> </p>
                <p><strong> Subject #: <strong><?php echo $sb['subject'];?> </p>
                <p><strong> Message: <strong><?php echo $sb['txtMsg'];?> </p>
            </div>
        </div>
    </div>
  </body>
</html>