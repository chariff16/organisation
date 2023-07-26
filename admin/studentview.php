<?php
  if ((isset($_GET['studentId']))) {
    require('../dbcon.php');
    $id = mysqli_real_escape_string($con, $_GET['studentId']);
  }else {
    header("location: ../index.html");
  }
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
              ادارة الحسابات الطلبة
            </a>
            <a
              href="teachers.php"
              class="text-light d-block text-decoration-none py-3 px-4"
            >
              ادارة الحسابات اﻷساتذة
            </a>
            <a
              href="admins.php"
              class="text-light d-block text-decoration-none py-3 px-4"
            >
              ادارة الحسابات الإدارة
            </a>
            <a
              href="post.php"
              class="text-light d-block text-decoration-none py-3 px-4"
            >
              المنشورات
            </a>
            <a
              href="donners.php"
              class="text-light d-block text-decoration-none py-3 px-4"
            >
              قائمة المحسنين
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
        class="btn btn-outline-light m-0 fs-6"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal"
        >تسجيل الخروج</a
      >
    </nav>
    <section class="d-flex">
      <aside class="bg-primary aside-bar d-none d-md-inline">
        <a
          href="dashbord.php"
          class="bg-light d-block text-decoration-none py-3 px-4"
        >
          ادارة الحسابات الطلبة
        </a>
        <a
          href="teachers.php"
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          ادارة الحسابات اﻷساتذة
        </a>
        <a
          href="admins.php"
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          ادارة الحسابات الإدارة
        </a>
        <a
          href="post.php"
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          المنشورات
        </a>
        <a
          href="donners.php"
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          قائمة المحسنين
        </a>
      </aside>
      <main>
        <div>
          <h3 class="text-primary text-center mt-3">أرشيف الطالب</h3>
        </div>
        <div class="mt-3 mx-5">
        <button
            type="button"
            class="btn btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#addExamModal"
          >
            إضافة إختبار
        </button>
        <div class="mt-4">
          <table class="table table-hover" id="table">
            <thead>
              <tr>
                <th class="col">المادة</th>
                <th class="col">العلامة</th>
                <th class="col">تاريخ</th>
                <th class="col-1">
                  <p class="d-none d-md-block mb-0">تعديل/حذف</p>
                  <p class="d-md-none mb-0">فعل</p>
                </th>
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
                <td class="d-md-flex d-sm-inline-block justify-content-around">
                  <button
                    type="button"
                    class="btn btn-outline-primary btn-sm editBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#editExamModal"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="far fa-edit"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-outline-danger btn-sm deleteBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteExamModal"
                    value="<?php echo $row['id'] ?>"
                  >
                  <i class="fas fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </main>
      <div class="mOdels">
          <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    إضافة إختبار
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="addExam">
                    <input type="text" class="d-none" name="studentId" value="<?php echo $id ?>">
                    <label class="form-label classAddedLable">المادة</label>
                    <input
                      type="text"
                      name="classAdded"
                      class="form-control classAdded"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label gradeAddedLable">العلامة</label>
                    <input
                      type="text"
                      name="gradeAdded"
                      class="form-control gradeAdded"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="إضافة إختبار"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="editExamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    تعديل معلومات الاختبار
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="editExam">
                    <input type="text" class="d-none editFundId" name="editExamId">
                    <label class="form-label editClassLable">المادة</label>
                    <input
                      type="text"
                      name="editClass"
                      class="form-control editClass"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editGradeLable">العلامة</label>
                    <input
                      type="text"
                      name="editGrade"
                      class="form-control editGrade"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="تحديث المعلومات"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="deleteExamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    حذف الاختبار
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <input type="text" class="d-none deleteExamId" >
                  <p>هل أنت متأكد من حذف هذا الاختبار</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="deleteFund">
                    حذف
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
      $(document).on("submit", "#addExam", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("addExam", true);
        $.ajax({
          type: "POST",
          url: "code.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            let res = jQuery.parseJSON(response);
            if (res.code == 1) {
              if (res.errors.class) {
                $(".classAdded").addClass("border-danger");
                $(".classAddedLable").addClass("text-danger");
              }
              if (res.errors.grade) {
                $(".gradeAdded").addClass("border-danger");
                $(".gradeAddedLable").addClass("text-danger");
              }
            }
            if (res.code == 200) {
              $('#addExamModal').modal('hide');                 
              $('#addExam')[0].reset();
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
            if (res.code == 500) {
              alert(res.message);
            }
          },
        });
      });
      $(document).on('click', '.editBtn', function () {
        let id = $(this).val();
        let editId = $('.editExamId').val(id);
        $.ajax({
            type: "GET",
            url: "code.php?edit_exam_id=" + id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){
                    $('.editClass').val(res.data.class);
                    $('.editGrade').val(res.data.grades);
                    $('#editExamModal').modal('show');
                }
            }
        });
      });
      $(document).on("submit", "#editExam", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("editExam", true);
        $.ajax({
          type: "POST",
          url: "code.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            let res = jQuery.parseJSON(response);
            if (res.code == 1) {
              if (res.errors.class) {
                $(".editClass").addClass("border-danger");
                $(".editClassLable").addClass("text-danger");
              }
              if (res.errors.grade) {
                $(".editGrade").addClass("border-danger");
                $(".editGradeLable").addClass("text-danger");
              }
            }
            if (res.code == 200) {
              $('#editExamModal').modal('hide');
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
        let deleteInput = $('.deleteExamId').val(id);
      });
      $(document).on("click", "#deleteFund", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        let id = $('.deleteExamId').val();
        $.ajax({
            type: "GET",
            url: "code.php?deleteExam=" + id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){
                    $('#deleteExamModal').modal('hide');
                    $('#table').load(location.href + " #table");
                    alertify.success(res.message); 
                }

            }
        });
      });
    </script>
  </body>
</html>
