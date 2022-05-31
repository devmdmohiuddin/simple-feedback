<?php include 'inc/header.php'; ?>

<?php
   $name = '';
   $email = '';
   $body = '';
   $nameErr = '';
   $emailErr = '';
   $bodyErr = '';

  //  form submit
   if (isset($_POST['submit'])) {
    //  filed sanitize
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);

     if (empty($name)) {
       $nameErr = 'Name is required';
     }

     if (empty($email)) {
       $emailErr = 'Email is required';
     }

     if (empty($body)) {
       $bodyErr = 'Body is required';
     }

    //  data save to the db
    if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
      $sql = "INSERT INTO feedback (name, email, body) VALUES ('$name', '$email', '$body')";

      if (mysqli_query($conn, $sql)) {
        // success
        header('Location: feedback.php');
      } else {
        echo 'Error ' . mysqli_error($conn);
      }
    }

   }
?>

  <img src="/phpproject/feedback/img/logo.png" style="width: 150px" class="mb-3" alt="">
  <h2>Feedback</h2>
  <p class="lead text-center">Leave feedback for Company</p>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"class="mt-4 w-75">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ?>" id="name" name="name" placeholder="Enter your name">
      <div class="invalid-feedback">
        <?php echo $nameErr; ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null ?>" id="email" name="email" placeholder="Enter your email">
      <div class="invalid-feedback">
        <?php echo $emailErr; ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="body" class="form-label">Feedback</label>
      <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
      <div class="invalid-feedback">
        <?php echo $bodyErr; ?>
      </div>
    </div>
    <div class="mb-3">
      <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
    </div>
  </form>

  <?php include 'inc/footer.php' ?>