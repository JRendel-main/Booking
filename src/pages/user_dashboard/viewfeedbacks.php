<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include '../../includes/autoloader.php';
    include '../../includes/conn.php';

    $db = new Database();
    $conn = $db->getConnection();
    $session = new session();
    include 'includes/header.php';
    include 'includes/navbar.php';
    ?>
    <br />
    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addFeedbackModal">
                    Give us your Feedback
                </button>
            </div>
        </div>
        <br />
        <?php
        $feedbacks = new Feedback($conn);
        $feedbackList = $feedbacks->getFeedbacks();

        if ($feedbackList) {
            foreach ($feedbackList as $feedback) {
                // convert timestamp to human readable format
                $timestamp = date('d M Y h:i A', strtotime($feedback['timestamp']));

                echo '<div class="card mb-3">
            <div class="card-header bg-primary text-white">Feedback</div>
            <div class="card-body">
                <h5 class="card-title">' . $feedback['FirstName'] . ' ' . $feedback['LastName'] . '</h5>
                <p class="card-text">' . $feedback['feedback'] . '</p>
                <p class="card-text"><small class="text-muted">' . $timestamp . '</small></p>
            </div>
            <div class="card-footer text-muted">
                Feedback received
            </div>
        </div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">
        No feedbacks available
      </div>';
        }
        ?>
    </section>

    <!-- Add Feedback Modal -->
    <div class="modal fade" id="addFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="addFeedbackModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="controllers/addFeedback.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFeedbackModalLabel">Give us your Feedback</h5>
                    </div>
                    <div class="modal-body">

                        <form action="controllers/addfeedback.php" method="POST">
                            <?php
                            if ($feedbacks->checkForFeedback($session->get('user_id'))) {
                                if ($feedbacks->checkAlreadySubmitted($session->get('user_id'))) {
                                    echo '<div class="alert alert-warning" role="alert">
                            You have already submitted a feedback
                          </div>';
                                } else {
                                    echo '<div class="form-group">
                            <label for="feedback">Feedback</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                        </div>';
                                }
                            } else {
                                echo '<div class="alert alert-warning" role="alert">
                        You have no reservation to give feedback
                      </div>';
                            }
                            ?>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <?php
                        if ($feedbacks->checkForFeedback($session->get('user_id'))) {
                            if ($feedbacks->checkAlreadySubmitted($session->get('user_id'))) {
                                echo '<button type="submit" class="btn btn-primary" disabled>Submit</button>';
                            } else {
                                echo '<button type="submit" class="btn btn-primary">Submit</button>';
                            }
                        } else {
                            echo '<button type="submit" class="btn btn-primary" disabled>Submit</button>';
                        }
                        ?>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>