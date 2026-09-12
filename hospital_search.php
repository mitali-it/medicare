<?php

$conn = new mysqli("127.0.0.1", "root", "", "hospital");

$name = $_REQUEST["name"];

$name = $conn->real_escape_string($name);

$sql = "SELECT * FROM add_hospital
        WHERE hn LIKE '%$name%'";

$res = $conn->query($sql);

if($res && $res->num_rows > 0)
{
    while($rows = mysqli_fetch_array($res))
    {
?>

<div class="col-lg-4 col-md-6 mb-4 hospital-item">

    <div class="hospital-card">

        <img
            src="img/<?php echo htmlspecialchars($rows[14]); ?>"
            class="hospital-img"
            alt="Hospital Image">

        <div class="card-body">

            <h4 class="hospital-name">
                <?php echo htmlspecialchars($rows[0]); ?>
            </h4>

            <p class="location">
                📍 <?php echo htmlspecialchars($rows[1]); ?>
            </p>

            <span class="hospital-badge">
                Multi-Speciality Hospital
            </span>

            <div class="rating">
                ⭐ 4.8
                <span class="review">
                    (220 Reviews)
                </span>
            </div>

            <a href="details.php?id=<?php echo urlencode($rows[0]); ?>"
               class="details-btn">
                View Details →
            </a>

        </div>

    </div>

</div>

<?php
    }
}
else
{
?>

<div class="col-12 text-center">
    <h4>No Hospitals Found</h4>
</div>

<?php
}

?>