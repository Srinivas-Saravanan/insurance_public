<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7x7E2g+7bj/+n2g59K4vP6oO1Z+ts5L5mR4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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
        button {
        background: #007bff;
        border: none !important;
        font-size:0;
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
        .card {
            margin-right: 20px; 
            flex: 1; 
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            
        }
        .card-families {
            background-color: #007bff; 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border-radius: 15px; /* Curve corners */
    overflow: hidden; /* Ensure content stays within rounded corners */
}
        }
        .card-elders {
            background-color: #28a745; 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border-radius: 15px; /* Curve corners */
    overflow: hidden; /* Ensure content stays within rounded corners */
}
        }
        .card-children {
            background-color: #dc3545; 
            .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border-radius: 15px; /* Curve corners */
    overflow: hidden; /* Ensure content stays within rounded corners */
}
        }
        .card-parents {
            background-color: #17a2b8; /* New color for Parents */
            .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border-radius: 15px; /* Curve corners */
    overflow: hidden; /* Ensure content stays within rounded corners */
}
        }
        .card-parentInLaw {
            background-color: #ffc107; /* New color for Parent In-Laws */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .card-spouse{
            background-color: #555;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .card-group {
            display: flex; 
            justify-content: space-between; 
             transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
        }
        .card-title {
            font-size: 1.5rem; 
            font-weight: bold; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }
        .card-text {
            font-size: 2rem; 
            font-weight: bold; 
            margin-top: 10px; 
        }
        .card-body {
            padding-left: 20px; 
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
        .card:hover {
    transform: scale(1.05); /* Scale up the card */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
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
<?=view('home/sidebar')?>
<div class="content">
    <div class="container mt-4">
        <div class="card-group">
            <div class="card card-families text-center" onclick="this.querySelector('form').submit();">
                <div class="card-body">
                    <h5 class="card-title">Total No. of Families</h5>
                    <p class="card-text"><?=count($self)?></p>
                    <form action="<?=base_url('home/home')?>" method="post">
                        <input type="hidden" value="self" name="relationship">
                    </form>
                </div>
            </div>
            <div class="card card-elders text-center" onclick="this.querySelector('form').submit();">
                <div class="card-body">
                    <h5 class="card-title">Total No. of Elders</h5>
                    <p class="card-text"><?=count($elders)?></p>
                    <form action="<?=base_url('home/home')?>" method="post">
                        <input type="hidden" value="elders" name="relationship">
                    </form>
                </div>
            </div>
            <div class="card card-children text-center" onclick="this.querySelector('form').submit();">
                <div class="card-body">
                    <h5 class="card-title">Total No. of Children</h5>
                    <p class="card-text"><?=count($childrens)?></p>
                    <form action="<?=base_url('home/home')?>" method="post">
                        <input type="hidden" value="children" name="relationship">
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="card-group mt-4">
            <div class="card card-parents text-center" onclick="this.querySelector('form').submit();">
                <div class="card-body">
                    <h5 class="card-title">Total No. of Parents</h5>
                    <p class="card-text"><?=count($parents)?></p>
                    <form action="<?=base_url('home/home')?>" method="post">
                        <input type="hidden" value="parents" name="relationship">
                    </form>
                </div>
            </div>
            <div class="card card-parentInLaw text-center" onclick="this.querySelector('form').submit();">
                <div class="card-body">
                    <h5 class="card-title">Total No. of Parent In-Laws</h5>
                    <p class="card-text"><?=count($parentInLaw)?></p>
                    <form action="<?=base_url('home/home')?>" method="post">
                        <input type="hidden" value="parentInLaw" name="relationship">
                    <!-- <button type="submit"  class="btn btn-primary stretched-link"></button> -->
                    </form>
                </div>
            </div>
            <div class="card card-spouse text-center" onclick="this.querySelector('form').submit();">
                <div class="card-body">
                    <h5 class="card-title">Total No. of Spouses</h5>
                    <p class="card-text"><?=count($spouses)?></p>
                    <form action="<?=base_url('home/home')?>" method="post">
                        <input type="hidden" value="spouse" name="relationship">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYwFf5O3t2cOCoXj5L5i/Fd5URP6p9Ods8kpX9kHyNeZlJ" crossorigin="anonymous"></script>
</body>
</html>
