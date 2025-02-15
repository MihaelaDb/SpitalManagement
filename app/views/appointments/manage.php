<?php include __DIR__ . '/../header.php'; ?>

<!-- Display session messages -->
<?php 
if(isset($_SESSION['success'])){
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
if(isset($_SESSION['error'])){
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<?php if($_SESSION['user']['role'] === 'doctor'): ?>
  <h2>All Appointments</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Patient</th>
        <th>Doctor</th>
        <th>Date & Time</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($appointments as $appointment): ?>
      <tr>
        <td><?php echo $appointment['id']; ?></td>
        <td><?php echo $appointment['patient_name']; ?></td>
        <td><?php echo $appointment['doctor_name']; ?></td>
        <td><?php echo $appointment['appointment_datetime']; ?></td>
        <td><?php echo $appointment['description']; ?></td>
        <td>
          <a href="?page=edit_appointment&id=<?php echo $appointment['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
          <a href="?page=delete_appointment&id=<?php echo $appointment['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <h2>My Appointments</h2>
  
  <h3>Create New Appointment</h3>
  <form method="post" action="?page=appointments">
    <div class="mb-3">
      <label for="doctor_id" class="form-label">Select Doctor</label>
      <select class="form-select" name="doctor_id" id="doctor_id" required>
        <?php foreach($doctors as $doctor): ?>
          <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="appointment_datetime" class="form-label">Appointment Date & Time</label>
      <input type="datetime-local" class="form-control" id="appointment_datetime" name="appointment_datetime" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Appointment</button>
  </form>
  
  <h3 class="mt-4">My Appointments List</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Date & Time</th>
        <th>Description</th>
        <th>Doctor</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($appointments as $appointment): ?>
      <tr>
        <td><?php echo $appointment['id']; ?></td>
        <td><?php echo $appointment['appointment_datetime']; ?></td>
        <td><?php echo $appointment['description']; ?></td>
        <td><?php echo $appointment['doctor_name']; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php include __DIR__ . '/../footer.php'; ?>
