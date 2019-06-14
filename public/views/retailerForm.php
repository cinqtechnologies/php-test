<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce</title>
</head>
<body>
    <?php
    require_once('apiRequest.php');

    $id = (int) $_GET['id'];
    $endpoint = sprintf('/retailers/%s', $id);

    $record = [
        'name' => '',
        'logo' => '',
        'description' => '',
        'website' => '',
        'id' => '',
    ];

    if (0 !== $id) {
        $response = apiRequest('GET', $endpoint);
        $response = json_decode($response, true);

        $record = [
            'name' => $response['data']['name'],
            'logo' => $response['data']['logo'],
            'description' => $response['data']['description'],
            'website' => $response['data']['website'],
            'id' => $response['data']['id'],
        ];
    }
    ?>

    <h1>Retailer Entry</h1>

    <?php
    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }
    ?>

    <form action="retailerSend.php" method="post" enctype="multipart/form-data" name="ecommerce">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputRetailer">Name</label>
          <input type="text" name="name" value="<?= $record['name'] ?>" class="form-control" id="inputRetailer" placeholder="Name">
        </div>
        <div class="form-group col-md-4">
          <label for="inputWebsite">Website</label>
          <input type="text" name="website" value="<?= $record['website'] ?>" class="form-control" id="inputWebsite" placeholder="www.yourbusiness.com">
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
      <button type="submit" class="btn btn-success">Send</button>
    </form>


</body>
</html>