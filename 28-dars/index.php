<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Districts</title>

</head>
<body>
<form action="" method="post">
    <center>
        <h1>Php da shaxar tanlash knopkasini DB bilan sozlash </h1>
        <hr/>
        <label>Iltimos viloyatni tanlang: </label>
        <select name="regionId">
            <option>----Viloyat----</option>
            <?php
            $regions = getRegions();
            foreach ($regions as $region) { ?>
                <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
            <?php } ?>
        </select>
        <button type="submit" name="submitRegion">Tanlash</button>
        <?php if (isset($_POST['submitRegion'])) { ?>
            <br>
            <label>Iltimos tumanni tanlang: </label>
            <select name="districtId">
                <option>----Tuman----</option>
                <?php
                $regionId = $_POST['regionId'];
                $districts = getDistricts($regionId);
                foreach ($districts as $district) { ?>
                    <option value="<?= $district['id'] ?>"><?= $district['name'] ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="submitDistrict">Tanlash</button>
        <?php } ?>

    </center>
</form>


</body>
</html>