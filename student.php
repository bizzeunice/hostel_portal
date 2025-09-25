<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/campman.css">
    <link rel="stylesheet" href="include/dashboard.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

</head>
<body>

<section class="w-50 mt-5 mx-auto bg-white shadow ">


    <h2 class="text-center bg-primary text-white p-3">Student Details</h2>
    <form action="hosteligible.php" method="post" class="px-5 py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="matric_no" class="form-label">Matric No:</label>
                    <input type="text" class="form-control mb-3" id="matric_no" name="matric_no" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_name" class="form-label">Full Name:</label>
                    <input type="text" class="form-control mb-3" id="full_name" name="full_name" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control mb-3" id="email" name="email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control mb-3" id="phone" name="phone" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender" class="form-label">Gender:</label>
                    <select class="form-control mb-3" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="graduated">Graduated</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="faculty_id" class="form-label">Faculty:</label>
                    <select class="form-control mb-3" id="faculty_id" name="faculty_id" required>
                        <option value="">Select Faculty</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="programme_id" class="form-label">Programme:</label>
                    <select class="form-control mb-3" id="programme_id" name="programme_id" required>
                        <option value="">Select Programme</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="department_id" class="form-label">Department:</label>
                    <select class="form-control mb-3" id="department_id" name="department_id" required>
                        <option value="">Select Department</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="level_id" class="form-label">Level:</label>
                    <select class="form-control mb-5" id="level_id" name="level_id" required>
                        <option value="">Select Level</option>
                    </select>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Submit</button>
        
    </form>
</section>
    
</body>
</html>