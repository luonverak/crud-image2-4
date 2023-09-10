<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    $connection = new mysqli('localhost','root','','php2-4');
    function moveImage($image){
        $profile  = date('dmthis').'-'.$_FILES[$image]['name'];
        $path = 'images/'.$profile;
        move_uploaded_file($_FILES[$image]['tmp_name'],$path);
        return $profile;
    }
    function add(){
        global $connection;
        if(isset($_POST['btn_save'])){
            $name = $_POST['fullname'];
            $position = $_POST['position'];
            $profile  = moveImage('profile');
            if(!empty($name) && !empty($position) && !empty($profile)){
                $sql = "INSERT INTO `employee`(`name`, `position`, `profile`)
                        VALUES ('$name','$position','$profile')";
                $rs  = $connection->query($sql);
                if($rs){
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success",
                                button: "Aww yiss!",
                                });
                            })
                        </script>
                    ';
                }
            }
        }
    }
    add();
    function get(){
        global $connection;
        $sql = "SELECT * FROM `employee`";
        $rs  = $connection->query($sql);
        while($row=mysqli_fetch_assoc($rs)){
            $create_at = $row['create_at'];
            $create_at = date('d/M/Y',strtotime($create_at));
            echo '
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['position'].'</td>
                    <td>
                        <img src="images/'.$row['profile'].'" width="120px" height="120px"
                        style="object-fit: cover;" alt="'.$row['profile'].'">
                    </td>
                    <td>'.$create_at.'</td>
                    <td>
                        <button id="openUpdate" type="button" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#myModal" >
                            <i class="fa-solid fa-pen-to-square"></i> Update</button>
                        <button type="button" remove_id="'.$row['id'].'" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete" >
                            <i class="fa-solid fa-trash"></i> Delete</button>
                    </td>
                </tr>
            ';
        }
    }
    function delete(){
        global $connection;
        if(isset($_POST['btn_delete'])){

        }
    }
    delete();
    function update(){
        global $connection;
        if(isset($_POST['btn_update'])){
            $name = $_POST['fullname'];
            $position = $_POST['position'];
            $profile  = $_FILES['profile']['name'];
            $id       = $_POST['emp_id'];
            if(empty($profile)){
                $profile = $_POST['old_profile'];
            }else{
                $profile = moveImage('profile');
            }
            if(!empty($name) && !empty($position) && !empty($profile)){
                $sql = "UPDATE `employee`
                        SET `name`='$name',`position`='$position',`profile`='$profile'
                        WHERE id='$id'";
                $rs  = $connection->query($sql);
                if($rs){
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success",
                                button: "Aww yiss!",
                                });
                            })
                        </script>
                    ';
                }
            }
        }
    }
    update();
?>