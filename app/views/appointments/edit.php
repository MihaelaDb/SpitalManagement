<?php include __DIR__ . '/../header.php'; ?>

<h2>Edit Appointment</h2>

<form method="post" action="?page=edit_appointment">
  <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
  <div class="mb-3">
    <label for="doctor_id" class="form-label">Doctor</label>
    <select class="form-select" name="doctor_id" id="doctor_id" required>
      <?php foreach($doctors as $doctor): ?>
        <option value="<?php echo $doctor['id']; ?>" <?php echo ($appointment['doctor_id'] == $doctor['id']) ? 'selected' : ''; ?>>
          <?php echo $doctor['name']; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="patient_id" class="form-label">Patient</label>
    <select class="form-select" name="patient_id" id="patient_id" required>
      <?php foreach($patients as $patient): ?>
        <option value="<?php echo $patient['id']; ?>" <?php echo ($appointment['patient_id'] == $patient['id']) ? 'selected' : ''; ?>>
          <?php echo $patient['name']; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="appointment_datetime" class="form-label">Appointment Date & Time</label>
    <input type="datetime-local" class="form-control" id="appointment_datetime" name="appointment_datetime" value="<?php echo date('Y-m-d\TH:i', strtotime($appointment['appointment_datetime'])); ?>" required>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $appointment['description']; ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Update Appointment</button>
</form>

<?php include __DIR__ . '/../footer.php'; ?>
