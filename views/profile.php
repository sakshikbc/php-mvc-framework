<?php
$this->title = "Profile";
?>
<h1>Profile</h1>

<form action="" method="POST">
    <div class="form-group">
        <label>Subject</label>
        <input type="text" class="form-control" name="subject">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea name="body" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>