<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Hostel - DELSU Hostel Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/campman.css">
    <link rel="stylesheet" href="include/dashboard.css">
</head>

<body>
    <?php include 'include/sidebar.php'; ?>

    <div id="content">
        <!-- Top Bar -->


        <!-- Banner -->
        <div class="campus-banner">
            <div class="campus-text">
                <h2>Reserve Room</h2>
            </div>
            <span>
                <a href="dashboard.php" class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to
                    Dashboard</a>
            </span>
        </div>

        <!-- Alerts -->
        <div class="container-fluid px-0">

            <div class="hostel-details bg-white mb-3 p-3 shadow rounded">
                <div class="row">
                    <div class="col-md-6">
                        <h3><i class="fas fa-info-circle me-2"></i>Hostel Information</h3>
                        <table class="table table-borderless">
                            <tr>
                                <th width="120">Name:</th>
                                <td>Abraka Hall</td>
                            </tr>
                            <tr>
                                <th>Campus:</th>
                                <td>Abraka Campus</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td>Male Hostel</td>
                            </tr>
                            <tr>
                                <th>Rooms No:</th>
                                <td>1</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h3><i class="fas fa-align-left me-2"></i>Description</h3>
                        <p>Abraka Hall is one of the premium male hostels on Abraka Campus. It features 24/7 security,
                            WiFi access, common study rooms, and a recreational area. Each room has an ensuite bathroom
                            and is equipped with a bed, study table, and wardrobe for each student.</p>
                        <p class="mb-0"><strong>Facilities:</strong> WiFi, 24/7 Security, Common Room, Laundry, Study
                            Area</p>
                    </div>
                </div>
            </div>



            <!-- Create Hostel Form -->
            <div class="form-section bg-white">
                <h3><i class="fas fa-plus-circle me-2"></i>Reserve A Room</h3>
                <p class="text-muted">Enter details for a reserved room</p>

                <form id="hostelForm" method="post" action="">
                    <div class="row">
                         <div class="col-md-6 mb-3">
                            <label for="room_number" class="form-label"> room_number </label>
                            <input type="text" class="form-control" id="room_number" name="room_number" value=""
                                placeholder="e.g., 1" required readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tatus" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>


                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="campus_id" class="form-label">Reserved_for	</label>
                            <input type="text" class="form-control" id="reserved_for" name="peserved_for">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="reserved_reason" class="form-label"> Reserved Reason</label>
                            <textarea name="reserved_reason" id="" class="form-control"></textarea>
                        </div>






                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline me-2">Clear Form</button>
                        <button type="submit" class="btn btn-primary">Reserverd Bed</button>
                    </div>
                </form>
            </div>




        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="include/dash.js"></script>
</body>

</html>