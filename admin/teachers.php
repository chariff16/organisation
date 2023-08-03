<!DOCTYPE html>
<html dir="rtl" lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/admin_dashbord.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
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
              class="text-light d-block text-decoration-none p-3"
            >
              ادارة الحسابات الطلبة
            </a>
            <a
              href="teachers.php"
              class="bg-light d-block text-decoration-none py-3 px-4"
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
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          ادارة الحسابات الطلبة
        </a>
        <a
          href="teachers.php"
          class="bg-light d-block text-decoration-none py-3 px-4"
        >
          ادارة الحسابات اﻷساتذة
        </a>
        </a>
        <a
          href="admins.php"
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          ادارة الحسابات الإدارة
        </a>
        <a
          href="class.php"
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          قائمة الأقسام
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
          <h3 class="text-primary text-center mt-3">قائمة الأساتذة</h3>
        </div>
        <div class="mt-3 mx-5">
        <button
            type="button"
            class="btn btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#addTeacherModal"
          >
            إضافة أستاذ
        </button>
        <div class="mt-4">
          <table class="table table-hover" id="table">
            <thead>
              <tr>
                <th scope="col">الاسم</th>
                <th class="col">اللقب</th>
                <th class="col">الهاتف</th>
                <th class="col-1">
                  <p class="d-none d-md-block mb-0">تعديل/معاينة/حذف</p>
                  <p class="d-md-none mb-0">فعل</p>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                require("../dbcon.php");
                $sql = "SELECT * FROM `user` WHERE role = 'teacher'";
                $run = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($run)){
              ?>
              <tr>
                <td class="align-middle"><?php echo $row['fname'] ?></td>
                <td class="align-middle"><?php echo $row['lname'] ?></td>
                <td class="align-middle"><?php echo $row['phone'] ?></td>
                <td class="d-md-flex d-sm-inline-block justify-content-around">
                  <button
                    type="button"
                    class="btn btn-outline-primary btn-sm editBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#editTeacherModal"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="far fa-edit"></i>
                  </button>
                  <a
                    type="button"
                    class="btn btn-outline-success btn-sm viewBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#viewTeacherModal"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="fas fa-eye"></i>
                  </a>
                  <button
                    type="button"
                    class="btn btn-outline-danger btn-sm deleteBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteTeacherModal"
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
          <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    إضافة أستاذ
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="addTeacher">
                    <label class="form-label teacherFnameLable">اسم أستاذ</label>
                    <input
                      type="text"
                      name="teacherFname"
                      class="form-control teacherFname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label teacherLnameLable">لقب أستاذ</label>
                    <input
                      type="text"
                      name="teacherLname"
                      class="form-control teacherLname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label teacherPhoneLable">هاتف أستاذ</label>
                    <input
                      type="text"
                      name="teacherPhone"
                      class="form-control teacherPhone"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label teacherClassLable">القسم</label>
                    <input
                      type="text"
                      name="teacherClass"
                      class="form-control teacherClass"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label teacherUsernameLable">إسم المستخدم الأستاذ</label>
                    <input
                      type="text"
                      name="teacherUsername"
                      class="form-control teacherUsername"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label teacherPasswordLable">كلمة السر الأستاذ</label>
                    <input
                      type="password"
                      name="teacherPassword"
                      class="form-control teacherPassword"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="إضافة أستاذ"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    تعديل معلومات لأستاذ
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="editTeacher">
                    <input type="text" class="d-none editId" name="editTeacherId">
                    <label class="form-label editTeacherFnameLable">اسم أستاذ</label>
                    <input
                      type="text"
                      name="editTeacherFname"
                      class="form-control editTeacherFname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editTeacherLnameLable">لقب أستاذ</label>
                    <input
                      type="text"
                      name="editTeacherLname"
                      class="form-control editTeacherLname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editTeacherPhoneLable">هاتف أستاذ</label>
                    <input
                      type="text"
                      name="editTeacherPhone"
                      class="form-control editTeacherPhone"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editTeacherClassLable">القسم</label>
                    <input
                      type="text"
                      name="editTeacherClass"
                      class="form-control editTeacherClass"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editTeacherUsernameLable">إسم المستخدم الأستاذ</label>
                    <input
                      type="text"
                      name="editTeacherUsername"
                      class="form-control editTeacherUsername"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editTeacherPasswordLable">كلمة السر الأستاذ</label>
                    <input
                      type="password"
                      name="editTeacherPassword"
                      class="form-control editTeacherPassword"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="تعديل المعلومات"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="viewTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    معاينة معلومات الأساتذ
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
                    <p class="col-2">إسم الأستاذ</p>
                    <p class="col fw-bold mx-3 viewTeacherFname">محمد</p>
                  </div>
                  <div class="d-flex">
                    <p class="col-2">لقب الأستاذ</p>
                    <p class="col fw-bold mx-3 viewTeacherLname">محمد</p>
                  </div>
                  <div class="d-flex">
                    <p class="col-2">هاتف أستاذ</p>
                    <p class="col fw-bold mx-3 viewTeacherPhone">محمد</p>
                  </div>
                  <div class="d-flex">
                    <p class="col-2">إسم المستخدم للأستاذ</p>
                    <p class="col fw-bold mx-3 align-self-center viewTeacherUsername">محمد</p>
                  </div>
                  <div class="d-flex">
                    <p class="col-2">قسم</p>
                    <p class="col fw-bold mx-3 viewTeacherClass">محمد</p>
                  </div>
                  
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
          <div class="modal fade" id="deleteTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    حذف الأستاذ
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <input type="text" class="d-none deleteTeacherId" >
                  <p>هل أنت متأكد من حذف هذا الأساتذ</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="deleteTeacher">
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
      $(document).on("submit", "#addTeacher", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("addTeacher", true);
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
                $(".teacherFname").addClass("border-danger");
                $(".teacherFnameLable").addClass("text-danger");
              }
              if (res.errors.lname) {
                $(".teacherLname").addClass("border-danger");
                $(".teacherLnameLable").addClass("text-danger");
              }
              if (res.errors.username) {
                $(".teacherUsername").addClass("border-danger");
                $(".teacherUsernameLable").addClass("text-danger");
              }
              if (res.errors.password) {
                $(".teacherPassword").addClass("border-danger");
                $(".teacherPasswordLable").addClass("text-danger");
              }
              if (res.errors.class) {
                $(".teacherClass").addClass("border-danger");
                $(".teacherClassLable").addClass("text-danger");
              }
              if (res.errors.phone) {
                $(".teacherPhone").addClass("border-danger");
                $(".teacherPhoneLable").addClass("text-danger");
              }
            }
            if (res.code == 2) {
                $(".teacherUsername").addClass("border-danger");
                $(".teacherUsernameLable").addClass("text-danger");
                $(".studentUsernameLable").text(res.message);
            }
            if (res.code == 200) {
              $('#addTeacherModal').modal('hide');                 
              $('#addTeacher')[0].reset();
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
          },
        });
      });
      $(document).on('click', '.editBtn', function () {
        let teacher_id = $(this).val();
        let editId = $('.editId').val(teacher_id);
        console.log(editId.val());
        $.ajax({
            type: "GET",
            url: "code.php?edit_teacher_id=" + teacher_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){
                    $('.teacherFname').val(res.data.fname);
                    $('.teacherLname').val(res.data.lname);
                    $('.teacherUsername').val(res.data.username);
                    $('.teacherClass').val(res.data.group);
                    $('.teacherPhone').val(res.data.phone);
                    $('#editPostModal').modal('show');
                }
            }
        });
      });
      $(document).on("submit", "#editTeacher", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("editTeacher", true);
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
                $(".editTeacherFname").addClass("border-danger");
                $(".editTeacherFnameLable").addClass("text-danger");
              }
              if (res.errors.lname) {
                $(".editTeacherLname").addClass("border-danger");
                $(".editTeacherLnameLable").addClass("text-danger");
              }
              if (res.errors.phone) {
                $(".editTeacherPhone").addClass("border-danger");
                $(".editTeacherPhoneLable").addClass("text-danger");
              }
              if (res.errors.class) {
                $(".editTeacherClass").addClass("border-danger");
                $(".editTeacherClassLable").addClass("text-danger");
              }
              if (res.errors.username) {
                $(".editTeacherUsername").addClass("border-danger");
                $(".editTeacherUsernameLable").addClass("text-danger");
              }
            }
            if (res.code == 200) {
              $('#editTeacherModal').modal('hide');
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
            if(res.code == 404) {
              alert(res.message);
            }
          },
        });
      });
      $(document).on('click', '.viewBtn', function () {
        let account_id = $(this).attr("value");
        $.ajax({
            type: "GET",
            url: "code.php?view_teacher_id=" + account_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                alert(res.message);
                }else if(res.code == 200){
                    $('.viewTeacherFname').text(res.data.fname);
                    $('.viewTeacherLname').text(res.data.lname);
                    $('.viewTeacherPhone').text(res.data.phone);
                    $('.viewTeacherClass').text(res.data.group);
                    $('.viewTeacherUsername').text(res.data.username);
                    $('#viewModal').modal('show');
                }

            }
        });
      });
      $(document).on('click', '.deleteBtn', function () {
        let account_id = $(this).val();
        let deleteInput = $('.deleteTeacherId').val(account_id);
      });
      $(document).on("click", "#deleteTeacher", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        let account_id = $('.deleteTeacherId').val();
        $.ajax({
            type: "GET",
            url: "code.php?deleteTeacher=" + account_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){
                    $('#deleteTeacherModal').modal('hide');
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
