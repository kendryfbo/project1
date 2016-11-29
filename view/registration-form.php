<script>
  if (document.forms.registration.pass1.value === "") {
    document.forms.registration.pass1.focus();
  }
</script>
<br>
<div class="container">

  <div class="card text-xs-center">

    <h1 class="card-header bg-info">Registration</h1>
    <form name="registration" class="card-block right" action="../html/register.php" method="post">
    <?php if (isset($_POST['error']) && $_POST['error'][0]) : ?>

      <div class="form-group form-inline text-xs-center">
          <div class="alert alert-danger">
            <strong>Invalid:</strong> <?= $_POST['error'][1] ?>
          </div>
        </div>

    <?php endif; ?>
      <div class="form-group form-inline text-xs-center">
        <label for="user">UserName:</label>
        <input type="text" class="form-control" name="user" placeholder="Insert UserName">
      </div>
      <div class="form-group form-inline text-xs-center">
        <label for="user">Password:</label>
        <input type="password" class="form-control" name="pass1" placeholder="Insert Password">
      </div>
      <div class="form-group form-inline text-xs-center">
        <label for="user">Re-Enter:</label>
        <input type="password" class="form-control" name="pass2" placeholder="Repeat Password">
      </div>
      <div class="form-group form-inline text-xs-center ">
        <button type="submit" name="register" class="btn btn-outline-primary">Login</button>
      </div>
    </form>
  </div>
</div>
