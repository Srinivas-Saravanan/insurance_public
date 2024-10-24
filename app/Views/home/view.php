<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Family Members</title>
    <style>
        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #f1f1f1;
            position: fixed;
            height: 100%;
            overflow: auto;
            transition: margin-left 0.3s; /* Smooth transition */
        }

        .sidebar.hidden {
            margin-left: -200px; /* Hide the sidebar */
        }

        /* Sidebar links */
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

        /* Page content */
        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px; /* Adjust as needed */
        }

        .content.hidden {
            margin-left: 0; /* Adjust content when sidebar is hidden */
        }

        /* Responsive styles */
        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar a {
                float: left;
            }
            div.content {
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
<?= view('home/sidebar'); ?> 
<div class="container mt-5" style="margin-left: 16%;">
    <h2 class="mb-4">Family Members of <?= esc($familyHead['name']) ?></h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Relationship</th>
                <th>Family Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allMembers as $member): ?>
            <tr>
                <td><?= esc($member['name']) ?></td>
                <td><?= esc($member['gender']) ?></td>
                <?php 
                $dob = strtotime($member['dob']);
                $formatdob = date('d-m-Y', $dob);
                ?>
                <td><?= esc($formatdob) ?></td>
                <td><?= esc($member['relationship']) ?></td>
                <td><?= esc($member['familyCode']) ?></td>
                <td>
                    <?php $code = esc($member['familyCode']); $name = esc($member['name']); ?>
                    <form action='<?= base_url("home/editAdd/$code/$name") ?>' method="get" style="display:inline;">
                        <input type="hidden" name='function2' value="Edit">
                        <button class="btn btn-success" type="submit">Edit</button>
                    </form>
                    <form action='<?= base_url("home/delete/$code/$name") ?>' method="post" style="display:inline;">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6">
                    <form action='<?= base_url("home/editAdd/$code") ?>' method="get">
                        <input type="hidden" name='function' value="Add">
                        <button class="btn btn-primary" type="submit">Add new Member</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
