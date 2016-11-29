<div class="container-fluid row ">
  <div class="col-xs-12 jumbotron">
    <h1> <pre><?php print_r(getUserData(1)) ?></pre> </h1>
  </div>
  <div class="col-xs-12">
    <form class="form-inline text-xs-center" action="../html/portfolio.php" method="get">
      <table>
        <tbody>
          <tr>
            <th>
              <label style="text-transform:uppercase" for="symbol">Search Symbol</label>
            </th>
            <th>
              <input type="text" style="text-transform:uppercase" name="symbol" value="" placeholder="$GOOG">
            </th>
            <th>
              <input class="btn btn-outline-info bg-inverse" type="submit" name="submit" value="check" >
            </th>
          </tr>
        </tbody>
      </table>


    </form>
      <?php if (isset($_GET['price']) && !empty($_GET['price'])) : ?>
        <form class="form-inline text-xs-center" action="index.html" method="post">
          <table>
            <tbody>
              <tr>
                <th>
                  <label style="text-transform:uppercase"><?= $_GET['symbol'] ?> = <strong> $ <?= $_GET['price'] ?></strong></label>
                </th>
                <th>
                  <input type="number" name="name" placeholder="amount">
                </th>
                <th>
                  <input class="btn btn-outline-success bg-inverse" type="submit" name="submit" value="  $Buy  ">
                </th>
              </tr>
            </tbody>
          </table>




        </form>
      <?php endif; ?>
  </div>
  <!--
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
-->
</div>
