<br>
<div class="container">

  <div class="card text-xs-center">

    <h1 class="card-header bg-primary">Login</h1>
    <form class="card-block" name="login" action="../html/login.php" method="post" onsubmit="return validation();">

    <?php if (isset($_POST['error']) && $_POST['error']) : ?>

      <div class="form-group form-inline text-xs-center">

          <div class="alert alert-danger">
            <strong>Invalid</strong> User and Password Combination
          </div>
      </div>

    <?php endif; ?>

      <div class="form-group form-inline text-xs-center">
        <label for="user">UserName:</label>
        <input id="user" type="text" class="form-control" name="user" placeholder="Insert UserName">
      </div>
      <div class="form-group form-inline text-xs-center">
        <label for="user">Password:</label>
        <input id="pass" type="password" class="form-control" name="pass" placeholder="Insert Password">
      </div>

      <div class="form-group form-inline text-xs-center ">
        <button type="submit" name="login" class="btn btn-outline-primary">Login</button>
      </div>
    </form>
  </div>
</div>
<script>
  if (document.getElementById('user').value === '') {
      document.getElementById('user').focus();
  }
</script>
