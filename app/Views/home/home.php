<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #f1f1f1;
            position: fixed;
            height: 100%;
            overflow: auto;
            transition: margin-left 0.3s;
        }

        .sidebar.hidden {
            margin-left: -200px;
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }

        .sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        .content {
            margin-left: 220px;
            padding: 1px 16px;
        }

        .content.hidden {
            margin-left: 0;
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }

        table {
            margin-top: 20px;
        }
        th, td {
            text-align: center;
        }
        .form-section {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <form action="<?= base_url('home/home') ?>" method="post">
        <!-- Form content here -->
        <form action="<?= base_url('home/home') ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder='<?= isset($name)? $name :"Enter name"?>'>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender">
                        <option <?= isset($gender)? '': 'selected'?>>Select</option>
                        <option <?= isset($gender) && $gender == 'male'? 'selected' :""?>value="male">Male</option>
                        <option <?= isset($gender) && $gender == 'female'? 'selected' :""?> value="female">Female</option>
                        <option <?= isset($gender) && $gender == 'other'? 'selected' :""?>value="others">Others</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="familyCode">Family Code</label>
                    <input type="number" class="form-control" name="familyCode" id="familyCode" placeholder="Enter family code">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="relationship">Relationship</label>
                    <select class="form-control" name="relationship" id="relationship">
                        <option selected>Select</option>
                        <option value="self">Self</option>
                        <option value="spouse">Spouse</option>
                        <option value="children">Children</option>
                        <option value="parents">Parents</option>
                        <option value="parentInLaw">Parent In Law</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div>
    </form>
</div>

        <h3>Families List</h3>
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Family Code</th>
                    <th>Relationship</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records['familyhead'])): ?>
                    <?php foreach ($records['familyhead'] as $record): ?>
                        <tr>
                            <td><?= esc($record['name']); ?></td>
                            <td><?= esc($record['gender']); ?></td>
                            <?php
                            $dob = strtotime($record['dob']);
                            $formatdob = date('d-m-Y', $dob);?>
                            <td><?= $formatdob ?></td>
                            <td><?= esc($record['familyCode']); ?></td>
                            <td><?= esc($record['relationship']); ?></td>
                            <td>
                                <?php $familyCode = $record['familyCode'];?>
                                <a href="<?= base_url('home/view/'.esc($familyCode))?>" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td colspan="6">
                        <a class="btn btn-success" href="<?= base_url('home/newFam') ?>">Add a New Family</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    </form>
</div>
<?= $this->endSection() ?>

    <div class="content" id="content">
    <div class="container mt-4">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
