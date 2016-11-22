<div class="container-fluid row ">
  <div class="col-xs-12 jumbotron">
    <h1>this is the data</h1>
  </div>
  <div class="col-xs-12">
    <form class="form-inline text-xs-center" action="../html/portfolio.php" method="get">
      <label style="text-transform:uppercase" for="symbol">Search Symbol
        <input type="text" style="text-transform:uppercase" name="symbol" value="" placeholder="$GOOG">
        <input type="submit" name="submit" value="check" class="btn btn-outline-info btn-lg bg-inverse">
      </label>
    </form>
      <?php if (isset($_GET['price']) && !empty($_GET['price'])) : ?>
        <form class="form-inline text-xs-center" action="index.html" method="post">
          <label style="text-transform:uppercase"> <?= $_GET['symbol'] ?> = <strong><?= $_GET['price'] ?></strong>
            <input type="number" name="name" placeholder="amount">
            <input class="btn btn-outline-success bg-inverse btn-lg" type="button" name="name" value="$Buy ">
          </label>
        </form>
      <?php endif; ?>
  </div>
  <div class="col-xs-12">
    <div class="row">
      <div class="col-lg-4">
        <div class="card card-block">
            <h1 class="card-title text-xs-center display-4"><strong>FB</strong>-FaceBook</h1>
        <div class="card-block">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>FB</th>
                <th>amount</th>
                <th>Buy</th>
                <th>$</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>1</th>
                <th>FB</th>
                <th>20</th>
                <th>0.78$</th>
                <th>1.0$</th>
                <th><button class="btn btn-outline-success type"="button" name="button">Sell</button>
                </th>
              </tr>
              <tr>
                <th>2</th>
                <th>FB</th>
                <th>35</th>
                <th>11$</th>
                <th class="text-success">11.02$</th>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
