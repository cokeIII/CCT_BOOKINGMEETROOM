<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "headerSetup.php" ?>
</head>
<style>
    .mt-center {
        margin-top: 35vh;
    }
</style>

<body>
    <div class="container">
        <form action="login_sql.php" method="post">
            <div class="card mt-center">
                <div class="card-head p-2">
                    <h4>ตรวจสอบสิทธิ์การจอง</h4>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-md-12">
                            <label>กรุณาระบุรหัสบัตรประชาชน</label>
                            <input class="form-control" type="number" name="people_id" maxlength="13" required>
                        </div>
                    </div>

                </div>
                <div class="card-foot p-2">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-end">ตรวจสอบ</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
<?php include "footerSetup.php" ?>