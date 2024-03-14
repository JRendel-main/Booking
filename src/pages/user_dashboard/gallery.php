<?php
include '../../includes/autoloader.php';

include '../../includes/conn.php';

$conn = new conn();
$session = new session();
include 'includes/header.php';
include 'includes/navbar.php';
?>

<section class="gallery1">

    <div class="gallery">
        <div class="gallery-item">
            <img src="../../../entrance.jpg" alt="Image 1">
        </div>
        <div class="gallery-item">
            <img src="../../../fresco.jpg" alt="Image 2">
        </div>
        <div class="gallery-item">
            <img src="../../../up.jpg" alt="Image 3">
        </div>
        <br>
        <div class="gallery-item">
            <img src="../../../VDR photo.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../room.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../sala.jpg" alt="Image 3">
        </div>
        <br>
        <div class="gallery-item">
            <img src="../../../pool side.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../up.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../pool.jpg" alt="Image 3">
        </div>

        <div class="gallery-item">
            <img src="../../../outside.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../topview.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../topview2.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../sala2.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../sala3.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../sala4.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../bedroom1.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../bedroom2.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../pool2.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../billiards.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../bball.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../nightpool.jpg" alt="Image 3">
        </div>
        <div class="gallery-item">
            <img src="../../../nightpoolside.jpg" alt="Image 3">
        </div>

    </div>

    <div class="lightbox">
        <img src="" alt="Enlarged Image">
    </div>
</section>


<!-- ======= FOOTER =======
<footer class="footer">
    <div class="checkbox-container-footer">

       CONTACT DETAILS 
       LINK TO 
       NAMES
       SOCIAL MEDIA BUTTON
    </div>
</footer> -->

<!--BOOKING MODAL-->
<!--should always be at the last page-->
<div class="bg-modal">
    <div class="modal-contents">

        <div class="close">x</div>

        <div class="Date_container">
            <h2>Enter Date: </h2>
            <form action="booking1.php" method="POST">
                <input type="date" name="start_date" id="start_date" min="<?php echo date("Y-m-d"); ?>" required>
                <br><br>
                <input type="date" name="end_date" id="end_date" required>
                <br><br>
                <button type="submit" value="submit">Proceed</button>
            </form>
        </div>

        </br>
    </div>
</div>

<!--JS RESOURCE-->
<script>
    document.getElementById('start_date').addEventListener('input', function () {
        var startDate = this.value;
        document.getElementById('end_date').min = startDate;
    });
</script>
<script src="main.js"></script>

</div>
</div>
</body>

</html>