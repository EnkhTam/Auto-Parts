<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card - Auto Parts </title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
  <div class="header">
    <div class="container">
      <div class="navbar">
          <div class="logo">
              <img src="pics/logo.jpeg" width="120px" height="80px">
          </div>
          <nav>
            <ul id="MenuItems">
              <li> <a href="index.php">Home</a></li>
              <li> <a href="products.php">Products</a></li>
              <li> <a href="user_account.php">Login</a></li>
            </ul>
          </nav>
          <img src="pics/view_cart.png" width="30px" height="30px">
          <img src="pics/menu.png" class="menu-icon" onclick="menutoggle()">
      </div>
    </div>
  </div>

<!------------credit card-page--------------->

  <form class="credit-card">
  <h3 class="title">Credit card detail</h3>

  <div class="form-container">
  <!-- Name on the card -->
  <input type="text" class="name" placeholder="Name On The Card">
  <!-- Card Number -->
  <input type="text" class="card-number" placeholder="Card Number">
  <!-- Expiration Date -->
  <input type="text" class="exp-date" placeholder="Expiration date:      01/2022">

    <!-- Card Verification Field -->
    <div class="card-verification">
      <div class="cvv-input">
        <input type="text" placeholder="CVV">
      </div>
      <div class="cvv-details">
        <p>3 or 4 digits usually found <br> on the signature strip</p>
      </div>
    </div>
    <br>
    <!-- Buttons -->
    <button type="submit" name="btn">Proceed</button>
</div>
</form>


<!---------- footer --------->

<div class="footer">
  <div class="container">
    <div class="row">
      <div class="footer-col-1">
        <!-- <p> Created By Enkhamgalan Tamillow</p> -->
        <h3>Download Our App</h3>
        <p>Download App for Android and ios Mobile Phone. </p>
      </div>
      <div class="footer-col-2">
        <br>
        <br>
        <br>
        <img src="pics/logo.jpeg" width="100px">
      </div>
    </div>
  </div>
</div>

</body>
</html>
