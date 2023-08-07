<?php
  session_start();
  $id = $_SESSION['id'];
  $role = $_SESSION['role'];
  $class = $_SESSION['group'];
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="../css/admin_dashbord.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <title>لوحة التحكم</title>
  </head>
  <body>
    <nav
      class="nav bg-primary d-flex justify-content-between align-items-center px-5 py-2"
    >
      <div class="d-md-none">
        <button
          class="btn btn-outline-light"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasScrolling"
          aria-controls="offcanvasScrolling"
        >
          <i
            class="fas fa-bars bars-icon"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          ></i>
        </button>

        <div
          class="offcanvas offcanvas-end bg-primary"
          data-bs-scroll="true"
          data-bs-backdrop="false"
          tabindex="-1"
          id="offcanvasScrolling"
          aria-labelledby="offcanvasScrollingLabel"
        >
          <div class="offcanvas-header">
            <h5 class="offcanvas-title text-light" id="offcanvasScrollingLabel">
              جمعية أسرتي
            </h5>
            <button
              type="button"
              class="btn btn-outline-light"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="offcanvas-body p-0">
            <a
              href="dashbord.php"
              class="bg-light d-block text-decoration-none p-3"
            >
              قائمة الإختبارات
            </a>
            <a
              href="post.php"
              class="text-light d-block text-decoration-none py-3 px-4"
            >
              المنشورات
            </a>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-center d-none d-md-flex">
        <a href="index.html">
          <img src="../img/logo.png" alt="logo" class="nav-logo" />
        </a>
        <p class="m-0 px-5 text-light">جمعية أسراتي</p>
      </div>

      <a
        href="#"
        class="btn btn-outline-light m-0 fs-6 logoutBtn"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal"
        >تسجيل الخروج</a
      >
    </nav>
    <section class="d-flex">
      <aside class="bg-primary aside-bar d-none d-md-inline">
        <a
          href="dashbord.php"
          class="bg-light d-block text-decoration-none p-3"
        >
          قائمة الاختبارات
        </a>
        <a
          href="post.php"
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          المنشورات
        </a>
      </aside>
      <main>
        <div>
          <h3 class="text-primary text-center mt-3">أرشيف الطالب</h3>
        </div>
        <div class="mt-3 mx-5">
        <div class="mt-4">
          <table class="table table-hover" id="table">
            <thead>
              <tr>
                <th class="col">المادة</th>
                <th class="col">العلامة</th>
                <th class="col">تاريخ</th>
              </tr>
            </thead>
            <tbody>
              <?php
                require("../dbcon.php");
                $sql = "SELECT * FROM `exam` WHERE studentid = '$id'";
                $run = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($run)){
              ?>
              <tr>
                <td class="align-middle"><?php echo $row['class'] ?></td>
                <td class="align-middle"><?php echo $row['grades'] ?></td>
                <td class="align-middle"><?php echo date("Y-m-d",strtotime($row['date'])) ?></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </main>
      <div class="mOdels">
        <div class="modal fade" id="viewExamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    المنشور
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <div class="d-flex">
                    <p class="col-2">العنوان</p>
                    <p class="col fw-bold viewPostTitel">محمد</p>
                  </div>
                  <p>المنشور</p>
                  <p class="border rounded p-2 viewPostInput">محتوى المنشور</p>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    إغلاق
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
      $(document).on("submit", "#addStudent", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("addStudent", true);
        $.ajax({
          type: "POST",
          url: "code.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            let res = jQuery.parseJSON(response);
            if (res.code == 1) {
              if (res.errors.fname) {
                $(".studentFname").addClass("border-danger");
                $(".studentFnameLable").addClass("text-danger");
              }
              if (res.errors.lname) {
                $(".studentLname").addClass("border-danger");
                $(".studentLnameLable").addClass("text-danger");
              }
              if (res.errors.phone) {
                $(".studentPhone").addClass("border-danger");
                $(".studentPhoneLable").addClass("text-danger");
              }
              if (res.errors.username) {
                $(".studentUsername").addClass("border-danger");
                $(".studentUsernameLable").addClass("text-danger");
              }
              if (res.errors.password) {
                $(".studentPassword").addClass("border-danger");
                $(".studentPasswordLable").addClass("text-danger");
              }
              if (res.errors.class) {
                $(".studentClass").addClass("border-danger");
                $(".studentClassLable").addClass("text-danger");
              }
            }
            if (res.code == 2) {
              $(".studentUsername").addClass("border-danger");
              $(".studentUsernameLable").text(res.message);
              $(".studentUsernameLable").addClass("text-danger");
            }
            if (res.code == 200) {
              $('#addStudentModal').modal('hide');                 
              $('#addStudent')[0].reset();
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
          },
        });
      });
      $(document).on('click', '.editBtn', function () {
        let id = $(this).val();
        let editId = $('.editStudentId').val(id);
        $.ajax({
            type: "GET",
            url: "code.php?edit_student_id=" + id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){

                    $('.editStudentLname').val(res.data.lname);
                    $('.editStudentFname').val(res.data.fname);
                    $('.editStudentPhone').val(res.data.phone);
                    $('.editStudentClass').val(res.data.group);
                    $('.editStudentUsername').val(res.data.username);

                    $('#editPostModal').modal('show');
                }
            }
        });
      });
      $(document).on("submit", "#editStudent", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("editStudent", true);
        $.ajax({
          type: "POST",
          url: "code.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            let res = jQuery.parseJSON(response);
            if (res.code == 1) {
              if (res.errors.lname) {
                $(".editStudentLname").addClass("border-danger");
                $(".editStudentLnameLable").addClass("text-danger");
              }
              if (res.errors.fname) {
                $(".editStudentFname").addClass("border-danger");
                $(".editStudentFnameLable").addClass("text-danger");
              }
              if (res.errors.phone) {
                $(".editStudentPhone").addClass("border-danger");
                $(".editStudentPhoneLable").addClass("text-danger");
              }
              if (res.errors.username) {
                $(".editStudentUsername").addClass("border-danger");
                $(".editStudentUsernameLable").addClass("text-danger");
              }
              if (res.errors.class) {
                $(".editStudentClass").addClass("border-danger");
                $(".editStudentClassLable").addClass("text-danger");
              }
            }
            if (res.code == 200) {
              $('#editStudentModal').modal('hide');
              $('#editStudent')[0].reset();
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
            if(res.code == 404) {
              alert(res.message);
            }
          },
        });
      });
      $(document).on('click', '.deleteBtn', function () {
        let id = $(this).val();
        let deleteInput = $('.deleteStudentId').val(id);
      });
      $(document).on("click", "#deleteStudent", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        let id = $('.deleteStudentId').val();
        $.ajax({
            type: "GET",
            url: "code.php?deleteStudent=" + id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){
                    $('#deleteStudentModal').modal('hide');
                    $('#table').load(location.href + " #table");
                    alertify.success(res.message); 
                }

            }
        });
      });
      $(document).ready(function() {
        $(".logoutBtn").click(function() {
          $.ajax({
            url: "../logout.php",
            type: "POST",
            dataType: "json",
            success: function(response) {
              if (response.status === "success") {
                window.location.href = "../index.html";
              }
            },
            error: function(xhr, status, error) {
              console.error("AJAX Error:", status, error);
            }
          });
        });
      });
    </script>
  </body>
</html>
