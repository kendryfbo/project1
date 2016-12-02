<div class="container-fluid row ">
  <div class="jumbotron">
    <h3>Usuario: <?= $_SESSION['data'][0]['user'] ?></h3>
    <h3>Balance: <?= $_SESSION['data'][0]['balance'] ?></h3>
  </div>
  <div class="col-xs-8">
    <div class="row">
    <?php foreach ($_SESSION['data'][1] as $value): ?>
      <div class="col-xs-4">
        <div class="card ">
          <div class="card-block">
            <h4 class="card-title"><?= $value['symbol']  ?></h4>
            <h6 class="card-subtitle">Current Price: $<?= stackPrice($value['symbol']) ?></h6>
            <h6>Quantity: <?= $value['quantity'] ?> stacks</h6>
            <input class="btn btn-success" type="button" name="sell" value="sell">
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
  <div class="col-xs-4">
    <div class="card">
      <div class="card-block">
        <form class="form-group form-inline" action="portfolio.php" method="get">
          <input class="form-control" type="text" name="symbol" value="" placeholder="Symbol">
          <input class="btn btn-outline-success" type="submit" name="submit" value="Search">
        </form>
      </div>
      <?php if (isset($_GET['symbol'])): ?>
      <div class="card-block">
        <h4 class="card-title"><?= htmlspecialchars($_GET['symbol'])?> : $<?= htmlspecialchars($_GET['price'])?>
        </h4>
        <form class="form-group form-inline" action="#" method="post">
          <input class="form-control" type="text" name="quantity" value="" placeholder="quantity">
          <input class="btn btn-outline-info" type="button" name="submit" value="Buy">
        </form>
      </div>
      <?php endif; ?>
    </div>

  </div>
</div>
