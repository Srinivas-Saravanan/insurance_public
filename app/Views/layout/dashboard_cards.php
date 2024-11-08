<!-- dashboard_cards.php -->
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary" onclick="this.querySelector('form').submit();">
                <div class="inner">
                    <h3><?= count($self) ?><sup style="font-size: 20px"></sup></h3>
                    <p>Total No. of Families</p>
                </div>
                <div class="icon">
                    <i class="ion ion-home"></i> <!-- Change the icon as needed -->
                </div>
                <form action="<?= base_url('home/home') ?>" method="post">
                    <input type="hidden" value="self" name="relationship">
                </form>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success" onclick="this.querySelector('form').submit();">
                <div class="inner">
                    <h3><?= count($elders) ?><sup style="font-size: 20px"></sup></h3>
                    <p>Total No. of Elders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i> <!-- Change the icon as needed -->
                </div>
                <form action="<?= base_url('home/home') ?>" method="post">
                    <input type="hidden" value="elders" name="relationship">
                    <button type="submit" class="card-block stretched-link text-decoration-none" ></button>
                </form>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-danger" onclick="this.querySelector('form').submit();">
                <div class="inner">
                    <h3><?= count($childrens) ?><sup style="font-size: 20px"></sup></h3>
                    <p>Total No. of Children</p>
                </div>
                <div class="icon">
                    <i class="ion ion-child"></i> <!-- Change the icon as needed -->
                </div>
                <form action="<?= base_url('home/home') ?>" method="post">
                    <input type="hidden" value="children" name="relationship">
                </form>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-info" onclick="this.querySelector('form').submit();">
                <div class="inner">
                    <h3><?= count($parents) ?><sup style="font-size: 20px"></sup></h3>
                    <p>Total No. of Parents</p>
                </div>
                <div class="icon">
                    <i class="ion ion-parents"></i> <!-- Change the icon as needed -->
                </div>
                <form action="<?= base_url('home/home') ?>" method="post">
                    <input type="hidden" value="parents" name="relationship">
                </form>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning" onclick="this.querySelector('form').submit();">
                <div class="inner">
                    <h3><?= count($parentInLaw) ?><sup style="font-size: 20px"></sup></h3>
                    <p>Total No. of Parent In-Laws</p>
                </div>
                <div class="icon">
                    <i class="ion ion-law"></i> <!-- Change the icon as needed -->
                </div>
                <form action="<?= base_url('home/home') ?>" method="post">
                    <input type="hidden" value="parentInLaw" name="relationship">
                </form>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-secondary" onclick="this.querySelector('form').submit();">
                <div class="inner">
                    <h3><?= count($spouses) ?><sup style="font-size: 20px"></sup></h3>
                    <p>Total No. of Spouses</p>
                </div>
                <div class="icon">
                    <i class="ion ion-heart"></i> <!-- Change the icon as needed -->
                </div>
                <form action="<?= base_url('home/home') ?>" method="post">
                    <input type="hidden" value="spouse" name="relationship">
                </form>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
