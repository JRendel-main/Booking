<?php
include '../../includes/autoloader.php';
include '../../includes/conn.php';

$conn = new conn();
$session = new session();
include 'includes/header.php';
?>

<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css' rel='stylesheet'>

<!-- Bootstrap styles and custom styles -->
<style>
    .book {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5vh;
    }

    .schedule-card {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <div class="container">
        <?php include 'includes/navbar.php'; ?>
        <div class="mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="book">
                        <div class="card schedule-card">
                            <div class="card-header">
                                <h5 class="card-title">Select Available date:</h5>
                            </div>
                            <div class="card-body">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Include FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <script>
        $(document).ready(function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    // Sample dates
                    {
                        title: 'Reserved',
                        start: '2024-03-01',
                        end: '2024-03-03',
                        backgroundColor: 'red', // Customize color as needed
                        borderColor: 'red'
                    },
                    {
                        title: 'Reserved',
                        start: '2024-03-10',
                        end: '2024-03-12',
                        backgroundColor: 'red', // Customize color as needed
                        borderColor: 'red'
                    },
                    {
                        title: 'Reserved',
                        start: '2024-03-20',
                        end: '2024-03-22',
                        backgroundColor: 'red', // Customize color as needed
                        borderColor: 'red'
                    },
                ],
                eventClick: function (info) {
                    var eventObj = info.event;
                    if (eventObj.url) {
                        window.open(eventObj.url);
                        info.jsEvent.preventDefault();
                    }
                }
            });
            calendar.render();
        });
    </script>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>