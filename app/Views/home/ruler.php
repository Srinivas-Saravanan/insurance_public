<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules Editor</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
            padding: 20px;
        }

        .form-check-input {
            width: 1.5em;
            height: 1.5em;
        }

        .form-check-label {
            margin-left: 10px; 
            margin-top:5px;
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar a {
                float: left;
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
    </style>
</head>
<body>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('alert')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('alert') ?>
    </div>
<?php endif; ?>
<div class="content">
    <form action="<?=base_url('home/saveRules')?>" method="post">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="self" id="self" value="true" <?= isset($self['allowed']) && $self['allowed'] == 'true' ? 'checked' : '' ?>>
            <label class="form-check-label" for="self">Self Allowed</label>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="spouse" id="spouse" value="true" <?= isset($spouse['allowed']) && $spouse['allowed'] == 'true' ? 'checked' : '' ?>>
            <label class="form-check-label" for="spouse">Spouse Allowed</label>
        </div>

        <div class="form-group">
            <label for="child">Allowed Children</label>
            <select class="form-control" name="child" id="child">
                <option value="0" <?= isset($children['allowedMembers']) && $children['allowedMembers'] == 0 ? 'selected' : '' ?>>0</option>
                <option value="1" <?= isset($children['allowedMembers']) && $children['allowedMembers'] == 1 ? 'selected' : '' ?>>1</option>
                <option value="2" <?= isset($children['allowedMembers']) && $children['allowedMembers'] == 2 ? 'selected' : '' ?>>2</option>
            </select>
        </div>

        <div class="form-group">
            <label for="elders">Other Members</label>
            <select class="form-control" name="elders" id="elders">
                <option value="1p" <?= isset($allowedElders['parentsAllowed']) && $allowedElders['parentsAllowed'] == 1 && !$allowedElders['parentInLawAllowed'] ? 'selected' : '' ?>>1 Parent</option>
                <option value="2p" <?= isset($allowedElders['parentsAllowed']) && $allowedElders['parentsAllowed'] == 2 && !$allowedElders['parentInLawAllowed'] ? 'selected' : '' ?>>2 Parents</option>
                <option value="1pil" <?= isset($allowedElders['parentInLawAllowed']) && $allowedElders['parentInLawAllowed'] == 1 && !$allowedElders['parentsAllowed'] ? 'selected' : '' ?>>1 Parent In Law</option>
                <option value="2pil" <?= isset($allowedElders['parentInLawAllowed']) && $allowedElders['parentInLawAllowed'] == 2 && !$allowedElders['parentsAllowed'] ? 'selected' : '' ?>>2 Parent In Laws</option>
                <option value="either" <?= isset($allowedElders['parentsAllowed'], $allowedElders['parentInLawAllowed']) && $allowedElders['parentsAllowed'] == 2 && $allowedElders['parentInLawAllowed'] == 2 && $allowedElders['cross'] == 1 ? 'selected' : '' ?>>Either Parents or Parent In Law's</option>
                <option value="any2" <?= isset($allowedElders['cross']) && $allowedElders['cross'] == 2 ? 'selected' : '' ?>>Any 2</option>
                <option value="all" <?= isset($allowedElders['cross']) && $allowedElders['cross'] == 3 ? 'selected' : '' ?>>All</option>
            </select>
        </div>

        <input type="hidden" name="familyCode" value="<?= $familyCode ?>">

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
</div>
<?= $this->endSection('content') ?>


<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
