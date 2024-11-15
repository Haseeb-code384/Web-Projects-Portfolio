# smsstudentform
 <form role="form" action="messages.php" method="POST">
            <div class="form-group">
        <label for="user_id">User id:</label>
        <input type="text" id="f_ph_number" name="user_id" class="form-control" >
    </div>

    <div class="form-group">
        <label for="class">Class:</label>
        <select id="class" name="class_id" required>
            <option value="">Select a class</option>
            <?php if (!empty($classes)): ?>
                <?php foreach ($classes as $class_id => $class_name): ?>
                    <option value="<?php echo $class_id; ?>"><?php echo $class_name; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="section">Section:</label>
        <select id="section" name="section_id" required>
            <option value="">Select a Section</option>
            <?php if (!empty($sections)): ?>
                <?php foreach ($sections as $section_id => $section_name): ?>
                    <option value="<?php echo $section_id; ?>"><?php echo $section_name; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="class">Student:</label>
        <select id="class" name="student_id" required>
            <option value="">Select a student</option>
            <?php foreach ($students as $student_id => $student_name): ?>
                <option value="<?php echo $student_id; ?>"><?php echo $student_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="f_ph_number">Father's Phone Number:</label>
        <input type="text" id="f_ph_number" name="f_ph_number" class="form-control" >
    </div>

    <div class="form-group">
        <label for="message">Message:</label>
        <textarea class="form-control" id="message" name="message" required></textarea>
    </div>
    <input type="hidden" name="status" value="active">

    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-success">Reset</button>
</form>
