<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .card {
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Increased shadow on hover */
        }
        .card-group {
            margin: 0 auto; /* Center the card group */
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <?php
        // Define card data directly in the view
        $cards = [
            ['title' => 'Total No. of Families', 'count' => count($self), 'bg_color' => 'bg-primary', 'relationship' => 'self'],
            ['title' => 'Total No. of Elders', 'count' => count($elders), 'bg_color' => 'bg-success', 'relationship' => 'elders'],
            ['title' => 'Total No. of Children', 'count' => count($childrens), 'bg_color' => 'bg-danger', 'relationship' => 'children'],
            ['title' => 'Total No. of Parents', 'count' => count($parents), 'bg_color' => 'bg-info', 'relationship' => 'parents'],
            ['title' => 'Total No. of Parent In-Laws', 'count' => count($parentInLaw), 'bg_color' => 'bg-warning', 'relationship' => 'parentInLaw'],
            ['title' => 'Total No. of Spouses', 'count' => count($spouses), 'bg_color' => 'bg-secondary', 'relationship' => 'spouse'],
        ];
        ?>
        <?php foreach ($cards as $card): ?>
            <div class="col-md-4 mb-4">
                <div class="card <?= $card['bg_color'] ?> text-center" onclick="this.querySelector('form').submit();">
                    <div class="card-body">
                        <h5 class="card-title"><?= $card['title'] ?></h5>
                        <p class="card-text"><?= $card['count'] ?></p>
                        <form action="<?= base_url('home/home') ?>" method="post">
                            <input type="hidden" value="<?= $card['relationship'] ?>" name="relationship">
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>


<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
