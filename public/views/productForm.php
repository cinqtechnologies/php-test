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

    $retailersData = apiRequest('GET', '/retailers');
    $retailersData = json_decode($retailersData, true);
    $retailersData = array_column($retailersData['data'], 'name', 'id');

    if (0 !== $id) {
        $response = apiRequest('GET', $endpoint);
        $response = json_decode($response, true);

        $record = [
            'id' => $response['data']['id'],
            'retailer_id' => $response['data']['retailer_id'],
            'name' => $response['data']['name'],
            'price' => $response['data']['price'],
            'logo' => $response['data']['logo'],
            'description' => $response['data']['description'],
        ];
    }
    ?>

    <h1>Product Entry</h1>

    <?php
    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }

    $retailerIdReference = $_GET['retailerId'] ?? 0;
    ?>

    <form action="productSend.php" method="post" enctype="multipart/form-data" name="ecommerce">
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="inputRetailerId">Retailer</label>
          <select id="inputRetailerId" class="form-control" name="retailerId">
            <?php foreach ($retailersData as $retailerId => $retailerName): ?>
                <?php if ($retailerIdReference == $retailerId): ?>
                    <option value="<?= $retailerId ?>" selected="true"><?= $retailerName ?></option>
                <?php else: ?>
                    <option value="<?= $retailerId ?>"><?= $retailerName ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="inputProduct">Product</label>
          <input type="text" name="name" value="<?= $record['name'] ?>" class="form-control" id="inputProduct" placeholder="Wallet, Purse, Smarphone">
        </div>
        <div class="form-group col-md-2">
          <label for="inputPrice">Price</label>
          <input type="text" name="price" value="<?= $record['price'] ?>" class="form-control" id="inputPrice" placeholder="99.99">
        </div>
      </div>

        <div class="custom-file col-md-4">
            <input type="file" name="logo" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>

          <br>
        <?php if ('' != $record['logo']): ?>
            <img src="//<?= getApiBaseUrl(), '/', $response['data']['logo'] ?>" width="200">
        <?php endif; ?>

      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control" name="description" id="inputDescription" rows="3" value="<?= $record['description'] ?>" placeholder="A simple description"><?= $record['description'] ?></textarea>
      </div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
      <input type="hidden" name="retailerId" value="<?= $retailerIdReference ?>">
      <button type="submit" class="btn btn-success">Send</button>
    </form>
</body>
</html>




