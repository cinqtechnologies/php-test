<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce</title>
</head>
<body>
    <?php
    require_once('apiRequest.php');

    $id = (int) $_GET['id'];
    $endpoint = sprintf('/products/%s', $id);

    $record = [
        'id' => '',
        'retailer_id' => '',
        'name' => '',
        'price' => '',
        'logo' => '',
        'description' => '',
    ];

    if (0 !== $id) {
        $response = apiRequest('GET', $endpoint);
        $response = json_decode($response, true);

        $retailerData = apiRequest('GET', '/retailers/' . $response['data']['retailer_id']);
        $retailerData = json_decode($retailerData, true);

        $record = [
            'id' => $response['data']['id'],
            'retailer_id' => $response['data']['retailer_id'],
            'retailer_name' => $retailerData['data']['name'],
            'name' => $response['data']['name'],
            'price' => $response['data']['price'],
            'logo' => $response['data']['logo'],
            'description' => $response['data']['description'],
        ];
    }
    ?>

    <h1>Product Details</h1>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success" role="success"><?= $_GET['msg']; ?></div>
    <?php endif; ?>

    <?php if ('' != $record['logo']): ?>
        <img src="//<?= getApiBaseUrl(), '/', $response['data']['logo'] ?>" style="max-width: 400px; float: left; margin-right: 20px;">
    <?php elseif(0 != $id): ?>
        <img src="//placehold.it/400" class="img-fluid" alt="">
    <?php endif; ?>

    <h2><?= $record['name'] ?></h2>
    <strong>Retailer:</strong> <?= $record['retailer_name'] ?><br>
    <strong>Price:</strong> $<?= sprintf('%.2f', $record['price']) ?><br>
    <strong>Description:</strong> <?= $record['description'] ?>

    <div class="container">
        <br>
        <p>I would like to receive this product information in my personal email.</p>
        <form class="form-inline">
          <div class="form-group mx-sm-4 mb-2">
            <input type="text" name="email" class="form-control" id="email" placeholder="youremail@domain.com">
          </div>
          <?php
          $msg = 'An email containing this product information has been sent to you.';
          ?>
          <a href="index.php?page=productView&id=<?= $id; ?>&msg=<?= $msg; ?>" class="btn btn-success mb-2">Send</a>
        </form>
    </div>
</body>
</html>