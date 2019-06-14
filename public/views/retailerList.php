<?php
require_once('apiRequest.php');
$records = apiRequest('GET', '/retailers');
$records = json_decode($records, true);

if (isset($records['error']['message'])) {
    die($records['error']['message']);
}
?>

<p>
    <a class="btn-sm btn-success" href="index.php?page=retailerForm">Add Retailer</a>
</p>

<div class="card-deck">
    <?php foreach ($records['data'] as $record): ?>
        <div class="card mb-3" style="max-width: 18rem;">

            <?php if ('' != $record['logo']): ?>
                <img src="//<?= getApiBaseUrl(), '/', $record['logo']; ?>" class="card-img-top" alt="<?= $record['name']; ?>">
            <?php else: ?>
                <img src="//placehold.it/200" class="img-fluid" alt="">
            <?php endif; ?>

            <div class="card-body">
                <h5 class="card-title"><?= $record['name']; ?></h5>
                <p class="card-text"><?= $record['description']; ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> <a href="//<?= $record['website']; ?>" target="_blank" class="card-link"><?= $record['website']; ?></a> </li>
            </ul>
            <div class="card-body">
                <a class="btn-sm btn-primary pull-right" href="index.php?page=retailerView&id=<?= $record['id']; ?>" class="card-link">View</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
