<!DOCTYPE html>
<?php include('func.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid bg-dark float-end p-3">
        <h1 class="text-light" >Employee CRUD</h1>
        <button id="openAdd" type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#myModal">
        <i class="fa-solid fa-plus"></i>    Add Employee
        </button>
    </div>
    <table class="table align-middle table-hover " style="table-layout: fixed;" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Profile</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php get();?>
        </tbody>
    </table>
    <!-- The Modal add -->
    <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 id="txt" class="modal-title">Modal Heading</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data" >
                <label for="">Fullname</label>
                <input type="text" name="fullname" id="fullname" class="form-control mb-3" >
                <label for="">Position</label>
                <input type="text" name="position" id="position" class="form-control mb-3" >
                <label for="">Profile</label>
                <input type="file" name="profile" id="prpfile" class="form-control mb-3" >
                <input type="hidden" name="old_profile" id="old_profile">
                <input type="hidden" name="emp_id" id="emp_id">
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button name="btn_save" id="btn_save" type="sumit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    <button name="btn_update" id="btn_update" type="submit" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    <!-- The Modal delete -->
    <div class="modal" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Are you sur for delete?</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <form action="" method="post">
                <input type="hidden" id="remove_id" name="remove_id" id="">
                <button name="btn_delete" type="submit" class="btn btn-primary me-3" data-bs-dismiss="modal">Yes,Delete its.</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </form>
        </div>
        </div>
    </div>
    </div>

</body>
<script>
    $(document).ready(function(){
        $("#openAdd").click(function(){
            $("#btn_save").show();
            $("#btn_update").hide();
            $("#txt").text("Enter Employee Information");
        })
        $("body").on("click","#openUpdate",function(){
            $("#btn_save").hide();
            $("#btn_update").show();
            $("#txt").text("Edit Employee Information");
            id       = $(this).parents("tr").find("td").eq(0).text();
            name     = $(this).parents("tr").find("td").eq(1).text();
            position = $(this).parents("tr").find("td").eq(2).text();
            profile  = $(this).parents("tr").find("td:eq(3) img").attr('alt');

            $("#fullname").val(name);
            $("#position").val(position);
            $("#old_profile").val(profile);
            $("#emp_id").val(id);
        })
        $("body").on('click',"#openDelete",function(){
            id = $(this).parents("tr").find("td").eq(0).text();
            $("#remove_id").val(id)
        })
    })
</script>
</html>