<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce</title>
</head>
<body>
    <?php
    require_once('apiRequest.php');

    $id = (int) $_GET['id'];
    $retailerEndpoint = sprintf('/retailers/%s', $id);
    $retailerProductsEndpoint = sprintf('/retailers/%s/products', $id);

    $record = [
        'name' => '',
        'logo' => '',
        'description' => '',
        'website' => '',
        'id' => '',
    ];

    if (0 !== $id) {
        $response = apiRequest('GET', $retailerEndpoint);
        $response = json_decode($response, true);

        $record = [
            'name' => $response['data']['name'],
            'logo' => $response['data']['logo'],
            'description' => $response['data']['description'],
            'website' => $response['data']['website'],
            'id' => $response['data']['id'],
        ];

        $retailerProducts = apiRequest('GET', $retailerProductsEndpoint);
        $retailerProducts = json_decode($retailerProducts, true);
    }
    ?>

    <div class="card">
        <div class="row no-gutters">
            <div class="col-auto">
                <?php if ('' != $record['logo']): ?>
                    <img src="//<?= getApiBaseUrl(), '/', $response['data']['logo'] ?>" width="200">
                <?php elseif(0 != $id): ?>
                    <img src="//placehold.it/200" class="img-fluid" alt="">
                <?php endif; ?>
            </div>
            <div class="col">
                <div class="card-block px-2">
                    <h4 class="card-title"><?= $record['name'] ?></h4>
                    <p class="card-text"><?= $record['description'] ?></p>
                    <p class="card-text"><a href="//<?= $record['website'] ?>" target="_blank"><?= $record['website'] ?></a></p>
                </div>
            </div>
        </div>
        <div class="card-footer w-100 text-muted">
            <a class="btn-sm btn-success" href="index.php?page=productForm&retailerId=<?= $record['id']; ?>">Add Product</a>
            <a class="btn-sm btn-primary" href="index.php?page=retailerForm&id=<?= $record['id']; ?>">Edit</a>
            <a class="btn-sm btn-danger pull-right" href="index.php?page=retailerDelete&id=<?= $record['id']; ?>">Delete</a>
        </div>
    </div>
    <br>
    <h1>Products</h1>

    <?php
    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }
    ?>

    <?php if (null === $retailerProducts['data']): ?>
        <div class="alert alert-dark" role="alert">
            No records found.
        </div>
    <?php endif; ?>

    <div class="card-deck">
        <?php foreach ($retailerProducts['data'] as $record): ?>
            <div class="card" style="max-width: 15rem;">

                <?php if ('' != $record['logo']): ?>
                    <img src="//<?= getApiBaseUrl(), '/', $record['logo']; ?>" class="card-img-top" alt="<?= $record['name']; ?>">
                <?php elseif(0 != $id): ?>
                    <img src="//placehold.it/300" class="img-fluid" alt="">
                <?php endif; ?>

                <div class="card-body">
                    <h5 class="card-title"><?= $record['name']; ?></h5>
                    <p class="card-text">$ <?= sprintf('%.2f', $record['price']); ?></p>
                    <p class="card-text"><?= $record['description']; ?></p>
                </div>
                <div class="card-body">
                    <a class="btn-sm btn-primary" href="index.php?page=productView&id=<?= $record['id']; ?>&retailerId=<?= $id; ?>" class="card-link">Info</a>
                    <a class="btn-sm btn-primary" href="index.php?page=productForm&id=<?= $record['id']; ?>&retailerId=<?= $id; ?>" class="card-link">Edit</a>
                    <a class="btn-sm btn-danger pull-right" href="index.php?page=productDelete&id=<?= $record['id']; ?>&retailerId=<?= $id; ?>" class="card-link">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>