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
              قائمة الطلبة
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
          قائمة الطلبة
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
          <h3 class="text-primary text-center mt-3">قائمة الطلبة</h3>
        </div>
        <div class="mt-3 mx-5">
        <div class="mt-4">
          <table class="table table-hover" id="table">
            <thead>
              <tr>
                <th scope="col">الاسم</th>
                <th class="col">اللقب</th>
                <th class="col">الهاتف</th>
                <th class="col-1">
                  معاينة
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                require("../dbcon.php");
                $sql = "SELECT u.fname, u.lname, u.phone
                FROM user u
                JOIN class c ON u.group = c.id
                WHERE c.teacher_id = $id AND u.role = 'student';
                ";
                $run = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($run)){
              ?>
              <tr>
                <td class="align-middle"><?php echo $row['fname'] ?></td>
                <td class="align-middle"><?php echo $row['lname'] ?></td>
                <td class="align-middle"><?php echo $row['phone'] ?></td>
                <td class="d-md-flex d-sm-inline-block justify-content-around">
                  <a
                    type="button"
                    href="studentview.php?studentId=<?php echo $row['id'] ?>"
                    class="btn btn-outline-success btn-sm viewBtn align-middle"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="fas fa-eye"></i>
                  </a>
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
          <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    إضافة طالب
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="addStudent">
                    <label class="form-label studentFnameLable">اسم الطالب</label>
                    <input
                      type="text"
                      name="studentFname"
                      class="form-control studentFname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label studentLnameLable">لقب الطالب</label>
                    <input
                      type="text"
                      name="studentLname"
                      class="form-control studentLname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label donerPhoneLable">هاتف الطالب</label>
                    <input
                      type="text"
                      name="studentPhone"
                      class="form-control studentPhone"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label studentClassLable">القسم</label>
                    <input
                      type="text"
                      name="studentClass"
                      class="form-control studentClass"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label studentUsernameLable">إسم المستخدم للطالب</label>
                    <input
                      type="text"
                      name="studentUsername"
                      class="form-control studentUsername"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label studentPasswordLable">كلمة السر للطالب</label>
                    <input
                      type="password"
                      name="studentPassword"
                      class="form-control studentPassword"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="إضافة طالب"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    تعديل معلومات الطالب
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="editStudent">
                    <input type="text" class="d-none editStudentId" name="editStudentId">
                    <label class="form-label editStudentFnameLable">اسم الطالب</label>
                    <input
                      type="text"
                      name="editStudentFname"
                      class="form-control editStudentFname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editStudentLnameLable">لقب الطالب</label>
                    <input
                      type="text"
                      name="editStudentLname"
                      class="form-control editStudentLname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editStudentPhoneLable">هاتف الطالب</label>
                    <input
                      type="text"
                      name="editStudentPhone"
                      class="form-control editStudentPhone"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editStudentClassLable">القسم</label>
                    <input
                      type="text"
                      name="editStudentClass"
                      class="form-control editStudentClass"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editStudentUsernameLable">إسم المستخدم للطالب</label>
                    <input
                      type="text"
                      name="editStudentUsername"
                      class="form-control editStudentUsername"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editStudentPasswordLable">كلمة السر للطالب</label>
                    <input
                      type="password"
                      name="editStudentPassword"
                      class="form-control editStudentPassword"
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
          <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    حذف طالب
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <input type="text" class="d-none deleteStudentId" >
                  <p>هل أنت متأكد من حذف هذا الطالب</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="deleteStudent">
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
