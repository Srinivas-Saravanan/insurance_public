<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Family</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

        div.content {
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
    <form action='<?= base_url("home/saveFam") ?>' method='post'>
        <div class="content">
            <div class="form-group">
                <br>
                <label for="name">Name</label>
                <input required class="form-control" type="text" name="name"> 
                <span class="text-danger"><?= isset($validation)? displayError($validation,'name'): ''  ?></span>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select required class="form-control" name="gender"> 
                    <option selected>Select</option>
                    <option value='male'>Male</option>
                    <option value='female'>Female</option>
                    <option value='other'>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="familyCode">Family Code</label>
                <input required class="form-control" type="number" name="familyCode" id="familyCode"> 
                <span class="text-danger"><?= isset($validation)? displayError($validation,'familyCode'): ''  ?></span>
                <span id="familyCodeError" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="dob">DOB</label>
                <?php 
                $today = new DateTime();
                $maxDate = $today->modify('-18 years')->format('Y-m-d');
                $minDate = $today->modify('-60 years')->format('Y-m-d');
                ?>
                <input required class="form-control" type="date" name="dob" max="<?= $maxDate ?>" min="<?= $minDate ?>"> 
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
    <?= $this->endSection('content');?>
    <script>
        $(document).ready(function() {
            $('#familyCode').on('change', function() {
                let familyCode = $(this).val();
                if (familyCode) {
                    $.ajax({
                        url: '<?= base_url("home/valFam") ?>',
                        type: 'POST',
                        data: { familyCode: familyCode },
                        success: function(response) {
                            if (response.exists) {
                                $('#familyCodeError').text('Family Code already exists.');
                            } else {
                                $('#familyCodeError').text('');
                            }
                        }
                    });
                } else {
                    $('#familyCodeError').text('');
                }
            });
        });
    </script>
   

</body>
</html>
