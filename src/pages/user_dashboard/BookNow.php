<?php
include '../../includes/autoloader.php';
include '../../includes/conn.php';

$conn = new conn();
$session = new session();
include 'includes/header.php';

$get_role = $session->get('role');
if ($get_role != 'user') {
    header('Location: ../../index.php');
}
?>

<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css' rel='stylesheet'>

<!-- Bootstrap styles and custom styles -->
<style>
.schedule-card {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 10vh;
}

.rules {
    text-align: left;
    font-size: 14px;
    line-height: 1.5;
    margin-top: 10px;
}
</style>

<body>
    <div class="container">
        <?php include 'includes/navbar.php'; ?>
        <div class="mt-5">
            <div class="row mt-5">
                <div class="card schedule-card">
                    <div class="card-header">
                        <h5 class="card-title">Select your booking below: </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="selectpackage" tabindex="-1" role="dialog" aria-labelledby="selectpackageLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectpackageLabel">Select your package for <span
                            id="selectedDate"></span>: </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center" id="package">
                        <div class="text-start">
                            <h5>Standard package:
                            </h5>
                        </div>
                        <!-- <div class="card-body">
                                    <img src="../../../p2.png" alt="Package 2" class="img-fluid">
                                    <p class="card-text">Night Stay</p>
                                    <a href="#" class="btn btn-outline btn-success" id="p2">Book Now</a>
                                    <p class="text-muted">Starting form: <br />
                                        <strong>₱18,000.00</strong>
                                    </p>
                                </div> -->
                        <?php
                        $conn = new Database();
                        $connection = $conn->getConnection();

                        $packages = new Packages($connection);
                        $standard_package = $packages->getStandardPackage();
                        $standard_package = json_decode($standard_package, true);

                        foreach ($standard_package as $package) {
                            // Echo card
                            echo '<div class="col-md-4">'; // Start column
                            echo '<div class="card-body">';
                            echo '<img src="../../../p2.png" alt="' . $package['PackageName'] . '" class="img-fluid">';
                            echo '<p class="card-text">' . $package['PackageName'] . '</p>';
                            echo '<a href="#" class="btn btn-outline btn-success" id="' . $package['PackageID'] . '">Book Now</a>';
                            echo '<p class="text-muted">Starting form: <br />';
                            echo '<strong>₱' . number_format($package['Price'], 2) . '</strong>';
                            echo '</p>';
                            echo '</div>';
                            echo '</div>'; // End column
                        }
                        ?>
                        <div class="row">
                            <div class="text-start">
                                <h5>Custom packages:
                                </h5>
                            </div>
                            <?php
                            $custom_package = $packages->getCustomPackage();
                            $custom_package = json_decode($custom_package, true);

                            foreach ($custom_package as $package) {
                                // Echo card
                                echo '<div class="col-md-4">'; // Start column
                                echo '<div class="card-body">';
                                echo '<img src="../../../p2.png" alt="' . $package['PackageName'] . '" class="img-fluid">';
                                echo '<p class="card-text">' . $package['PackageName'] . '</p>';
                                echo '<a href="#" class="btn btn-outline btn-success" id="' . $package['PackageID'] . '">Book Now</a>';
                                echo '<p class="text-muted">Starting form: <br />';
                                echo '<strong>₱' . number_format($package['Price'], 2) . '</strong>';
                                echo '</p>';
                                echo '</div>';
                                echo '</div>'; // End column
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row" id="policies">
                        <div class="col-md-4">
                            <!-- Rules and Policies add design dont use card-->
                            <h5 class="text-center">Rules and Policies</h5>
                            <p class="rules">
                                <strong>1. </strong> No smoking inside the premises.<br />
                                <strong>2. </strong> No pets allowed.<br />
                                <strong>3. </strong> No loud music after 10pm.<br />
                                <strong>4. </strong> No littering.<br />
                                <strong>5. </strong> No vandalism.<br />
                                <strong>6. </strong> No illegal activities.<br />
                                <strong>7. </strong> No outside food and drinks.<br />
                                <strong>8. </strong> No refund policy.<br />
                                <strong>9. </strong> No cancellation policy.<br />
                                <strong>10. </strong> No rescheduling policy.<br />
                            </p>
                        </div>
                        <div class="col-md-8">
                            <!-- Includsion -->
                            <h5 class="text-center">Inclusions</h5>
                            <div class="row">
                                <p class="flex gap-2">
                                    <strong>Adult Pool</strong>
                                    <br />
                                    <strong>Kiddie Pool</strong>
                                    <br />
                                    <strong>Billiards</strong>
                                    <br />
                                    <strong>Basketball</strong>
                                    <br />
                                    <strong>Dart</strong>
                                    <br />
                                    <strong>Playground</strong>
                                    <br />
                                    <strong>Smart TV | Netflix & Cable</strong>
                                    <br />
                                    <strong>Wi-Fi</strong>
                                    <br />
                                    <strong>Videoke</strong>
                                    <br />
                                    <strong>Barbeque Grill</strong>
                                    <br />
                                    <strong>Refrigerator</strong>
                                    <br />
                                    <strong>Rice Cooker</strong>
                                    <br />
                                    <strong>Gas Stove</strong>
                                    <br />
                                    <strong>Water Dispenser</strong>
                                    <br />
                                    <strong>4 Fully Airconditioned Rooms</strong>
                                    <br />
                                </p>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5>Lists of Addons:</h5>
                                    <!-- <ul>
                                        <li>Jacuzzi | Additional - 300PHP/hour</li>
                                        <li>Gas Stove | Additional - 250PHP/day</li>
                                        <li>Dryer Machine | 50PHP/Hour</li>
                                        <li>Himalayan Charcoal | 100PHP/Hour</li>
                                        <li>Air Fryer | 150PHP/Hour</li>
                                    </ul> -->
                                    <div class="row">
                                        <div class="flex gap-2">
                                            <strong class="col-md-6">Jacuzzi | Additional - 300PHP/hour</strong>
                                            <br />
                                            <strong class="col-md-6">Gas Stove | Additional - 250PHP/day</strong>
                                            <br />
                                            <strong class="col-md-6">Dryer Machine | 50PHP/Hour</strong>
                                            <br />
                                            <strong class="col-md-6">Himalayan Charcoal | 100PHP/Hour</strong>
                                            <br />
                                            <strong class="col-md-6">Air Fryer | 150PHP/Hour</strong>
                                        </div>
                                    </div>

                                    <p class="note">* Addons request upon on venue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="payment">Proceed Payment</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selectedDate">
                    <input type="hidden" id="selectedPackage">
                    <input type="hidden" id="selectedAddons">

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center">Reciept</h3>
                            <h5 class="text-left">Total Price:
                                <span id="totalAmount"></span>
                            </h5>
                            <!-- Total due amount today for downpayment 50% -->
                            <h5 class="text-left">50% Deposit Due Now: <span id="totalDueAmount"></span></h5>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <p>Send your payment here:</p>
                            <img src="../../../samplepayment.jpg" alt="Bank Information" class="img-fluid"
                                id="bankInfoImage" style="width:350px; height:400px;">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proofOfPayment">Proof of Payment:</label>
                                <input type="file" class="form-control" id="proofOfPayment">
                            </div>
                            <div class="form-group">
                                <label for="sender">Name of Sender:</label>
                                <input type="text" class="form-control" id="sender">
                            </div>
                            <div class="form-group">
                                <label for="referenceNumber">Reference Number:</label>
                                <input type="text" class="form-control" id="referenceNumber">
                            </div>
                            <div class="form-group">
                                <label for="dateSent">Date Sent:</label>
                                <input type="date" class="form-control" id="dateSent">
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="submitPayment">Submit Payment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm total amount before payment -->

    <!-- Reciept modal -->
    <div class="modal fade" id="recieptModal" tabindex="-1" role="dialog" aria-labelledby="recieptModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recieptModalLabel">Payment Reciept</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Thank you for booking with us! Here is your reciept:</h5>
                            <p>Please wait for the confirmation of your booking. We will send you an email once your
                                booking is confirmed.</p>
                        </div>
                    </div>
                    <!-- Add total payment here -->
                    <p>Booking Date: <span id="bookingDate"></span></p>
                    <p>Booking Package: <span id="bookingPackage"></span></p>
                    <div class="row" id="addons"></div>
                    <p>Reference Number: <span id="bookingReferenceNumber"></span></p>
                    <p>Date Sent: <span id="bookingDateSent"></span></p>
                    <hr>
                    <p>Total Cost: <span id="bookingCost"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Include FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <script>
    $(document).ready(function() {
        $.ajax({
            url: 'controllers/getReservations.php',
            type: 'GET',
            success: function(res) {
                var data = JSON.parse(res);
                var events = [];
                data.forEach(function(d) {
                    events.push({
                        title: 'Reserved',
                        start: d.CheckInDate,
                        end: d.CheckOutDate,
                        color: 'red'
                    });
                });
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: events,
                    dateClick: function(info) {
                        var selectedDate = new Date(info.dateStr);
                        var currentDate = new Date();
                        currentDate.setHours(0, 0, 0, 0);

                        if (selectedDate <= currentDate) {
                            alert('You cannot reserve on a past or today\'s date.');
                        } else {
                            // Check if the selected date has a reservation
                            var hasReservation = events.some(function(event) {
                                return event.start === info.dateStr;
                            });

                            if (hasReservation) {
                                alert('There is already a reservation on this date.');
                            } else {
                                $('#selectedDate').text(info.dateStr);
                                $('#selectpackage').modal('show');
                            }
                        }
                    },
                    eventClick: function(info) {
                        alert('Event: ' + info.event.title);
                    }
                });
                calendar.render();
            }
        });

        $('#policies').hide();
        $('#payment').hide();
        // check what package is selected
        $('#package').on('click', 'a', function(e) {
            e.preventDefault();
            var packageId = $(this).attr('id'); // Get the ID of the clicked package
            $('#selectedPackage').val(packageId); // Set the selected package ID in the hidden input
            $('#package').hide();
            $('#policies').show();
            $('#payment').show();
            alert('Package ' + packageId + ' selected');
        });


        // when payment button is clicked, get package and date and addons
        $('#payment').on('click', function() {
            $('#selectpackage').modal('toggle');
            var selectedDate = $('#selectedDate').text();
            var selectedPackage = $('#selectedPackage').val();

            // get the total cost
            var cost;
            // add details to reciept
            $.ajax({
                url: 'getCost.php',
                type: 'POST',
                data: {
                    packageId: selectedPackage
                },
                success: function(res) {
                    // parse json
                    var package = JSON.parse(res);
                    cost = package.Price;

                    // convert to int
                    cost = parseInt(cost);

                    // compute to 50% downpayment and 50% full payment
                    var downpayment = cost / 2;
                    // convert to readable price format
                    cost = cost.toLocaleString();
                    downpayment = downpayment.toLocaleString();
                    $('#totalAmount').text('₱' + cost);
                    $('#totalDueAmount').text('₱' + downpayment);
                },
                error: function(xhr, status, error) {
                    // handle error
                    console.error("Error fetching cost:", error);
                }
            });

            $('#selectedDate').val(selectedDate);
            $('#selectedPackage').val(selectedPackage);
            $('#selectedAddons').val(selectedAddons);
            $('#selectmodal').modal('hide');
            $('#paymentModal').modal('show');

            $('#selectedAddons').val(JSON.stringify(selectedAddons));
        });

        $('#paymentModal').on('click', '#submitPayment', function() {
            var selectedDate = $('#selectedDate').val();
            var selectedPackage = $('#selectedPackage').val();
            var selectedAddons = $('#selectedAddons').val();
            var proofOfPayment = $('#proofOfPayment').prop('files')[0];
            var sender = $('#sender').val();
            var referenceNumber = $('#referenceNumber').val();
            var dateSent = $('#dateSent').val();
            var formData = new FormData();

            formData.append('selectedDate', selectedDate);
            formData.append('selectedPackage', selectedPackage);
            formData.append('selectedAddons', selectedAddons);
            formData.append('proofOfPayment', proofOfPayment);
            formData.append('sender', sender);
            formData.append('referenceNumber', referenceNumber);
            formData.append('dateSent', dateSent);
            formData.append('guestEmail', '<?php echo $session->get('email'); ?>');

            $.ajax({
                url: 'controllers/submitPayment.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res);
                }
            });

            // open reciept modal
            $('#paymentModal').modal('toggle');
            $('#recieptModal').modal('show');

            // add data to modal for reciept
            // calculate the cost

            var cost;
            $.ajax({
                url: 'getCost.php',
                type: 'POST',
                data: {
                    packageId: selectedPackage
                },
                success: function(res) {
                    // parse json
                    var package = JSON.parse(res);
                    cost = package.Price;

                    // convert to int
                    cost = parseInt(cost);

                    // add addons cost
                    if (selectedAddons.includes('Jacuzzi')) {
                        cost += 300;
                    } else if (selectedAddons.includes('Gas Stove')) {
                        cost += 250;
                    } else if (selectedAddons.includes('Dryer Machine')) {
                        cost += 50;
                    } else if (selectedAddons.includes('Himalayan Charcoal')) {
                        cost += 100;
                    } else if (selectedAddons.includes('Air Fryer')) {
                        cost += 150;
                    }

                    // make the date readable
                    var date = new Date(selectedDate);
                    var options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    date = date.toLocaleDateString('en-US', options);

                    // add the data to the receipt modal
                    $('#bookingDate').text(date);
                    $('#bookingPackage').text(selectedPackage);
                    $('#bookingReferenceNumber').text(referenceNumber);
                    $('#bookingDateSent').text(dateSent);
                    $('#bookingCost').text('₱' + cost);

                    // add the addons to the receipt modal
                    var addons = '';
                    selectedAddons.forEach(function(addon) {
                        addons += '<span>' + addon + '</span><br>';
                    });
                    $('#addons').html(addons);

                    // open receipt modal after processing data
                    $('#recieptModal').modal('show');
                },
                error: function(xhr, status, error) {
                    // handle error
                    console.error("Error fetching cost:", error);
                }
            });
        });
    });
    </script>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>