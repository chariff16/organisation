<?php
  session_start();
  $role = $_SESSION['role'];
  if ($role == 'admin') {
    $id = $_SESSION['id'];  
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
              class="text-light d-block text-decoration-none py-3 px-4"
            >
              ادارة الحسابات اﻷساتذة
            </a>
            <a
              href="admins.php"
              class="bg-light d-block text-decoration-none py-3 px-4"
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
          class="text-light d-block text-decoration-none py-3 px-4"
        >
          ادارة الحسابات اﻷساتذة
        </a>
        <a
          href="admins.php"
          class="bg-light d-block text-decoration-none py-3 px-4"
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
          <h3 class="text-primary text-center mt-3">إدارة الحسابات الإدارة</h3>
        </div>
        <div class="mx-5 mt-3">
          <button
            type="button"
            class="btn btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#addModal"
          >
            إضافة عضو
          </button>
          
        </div>
        <div class="mt-4 mx-5">
          <table class="table table-hover" id="table">
            <thead>
              <tr>
                <th scope="col">الإسم</th>
                <th scope="col">اللقب</th>
                <th scope="col">رقم الهاتف</th>
                <th class="col-1">
                  <p class="d-none d-md-block mb-0">تعديل/معاينة/حذف</p>
                  <p class="d-md-none mb-0">فعل</p>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                require("../dbcon.php");
                $sql = "SELECT * FROM `user` WHERE role = 'admin'";
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
                    data-bs-target="#editModal"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="far fa-edit"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-outline-success btn-sm viewBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#viewModal"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="fas fa-eye"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-outline-danger btn-sm deleteBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
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
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    إضافة عضو
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="add">
                    <p class="inTro">
                      يرجى أن تدخل معلومات العضو الجديد
                    </p>
                    <label for="inputPassword5" class="form-label"
                      >إسم</label
                    >
                    <input
                      type="text"
                      name="fname"
                      class="form-control fName"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label for="inputPassword5" class="form-label"
                      >اللقب</label
                    >
                    <input
                      type="text"
                      name="lname"
                      class="form-control lName"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label for="inputPassword5" class="form-label"
                      >إسم المستخدم</label
                    >
                    <input
                      type="text"
                      name="username"
                      class="form-control userName"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label for="inputPassword5" class="form-label">كلمة المرور</label>
                    <input
                      type="password"
                      name="password"
                      class="form-control passWord"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label for="inputPassword5" class="form-label"
                      >الهاتف</label
                    >
                    <input
                      type="text"
                      name="phone"
                      class="form-control phOne"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="إضافة عضو"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    تعديل معلومات عضو
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="edit">
                    <p class="inTro">
                      يرجى أن تدخل معلومات العضو الجديد
                    </p>
                    <label for="inputPassword5" class="form-label"
                      >إسم</label
                    >
                    <input
                      type="text"
                      name="fname"
                      class="form-control editFname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label for="inputPassword5" class="form-label"
                      >اللقب</label
                    >
                    <input
                      type="text"
                      name="lname"
                      class="form-control editLname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label for="inputPassword5" class="form-label"
                      >الهاتف</label
                    >
                    <input
                      type="text"
                      name="phone"
                      class="form-control editPhone"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label for="inputPassword5" class="form-label"
                      >إسم المستخدم</label
                    >
                    <input
                      type="text"
                      name="username"
                      class="form-control editUserName"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label for="inputPassword5" class="form-label">كلمة المرور</label>
                    <input
                      type="password"
                      name="password"
                      class="form-control editPassword"
                      aria-labelledby="passwordHelpBlock"
                    />
                    
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="إضافة عضو"
                      />
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    معاينة عضو
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
                    <p class="col">الإسم</p>
                    <p class="col viewFname">محمد</p>
                  </div>
                  <div class="d-flex">
                    <p class="col">اللقب</p>
                    <p class="col viewLname">محمد</p>
                  </div>
                  <div class="d-flex">
                    <p class="col">إسم المستخدم</p>
                    <p class="col viewUserName">محمد</p>
                  </div>
                  <div class="d-flex">
                    <p class="col">الهاتف</p>
                    <p class="col viewPhone">محمد</p>
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
          <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    حذف عضو
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <input type="text" class="d-none deleteId" >
                  <p>هل أنت متأكد من حذف هذا العضو</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="delete">
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
      $(document).on("submit", "#add", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("addAcc", true);
        $.ajax({
          type: "POST",
          url: "code.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            let res = jQuery.parseJSON(response);
            if (res.code == 1) {
              if (res.errors.field1) {
                $(".fName").addClass("border-danger");
                $(".passWord").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
              if (res.errors.field2) {
                $(".lName").addClass("border-danger");
                $(".passWord").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
              if (res.errors.field3) {
                $(".userName").addClass("border-danger");
                $(".passWord").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
              if (res.errors.field4) {
                $(".passWord").addClass("border-danger");
                $(".passWord").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
              if (res.errors.field5) {
                $(".phOne").addClass("border-danger");
                $(".passWord").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
            }
            if (res.code == 2) {
              $(".userName").addClass("border-danger");
              $(".passWord").val("");
              $(".inTro").addClass("text-danger");
              $(".inTro").text(res.message);
            }
            if (res.code == 200) {
              $('#addModal').modal('hide');                 
              $('#add')[0].reset();
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
          },
        });
      });
      $(document).on('click', '.editBtn', function () {
        let account_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "code.php?edit_account_id=" + account_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                alert(res.message);
                }else if(res.code == 200){

                    $('.editFname').val(res.data.fname);
                    $('.editLname').val(res.data.lname);
                    $('.editUserName').val(res.data.username);
                    $('.editPhone').val(res.data.phone);
                    $('#editModal').modal('show');
                }
            }
        });
      });
      $(document).on("submit", "#edit", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("editAcc", true);
        $.ajax({
          type: "POST",
          url: "code.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            let res = jQuery.parseJSON(response);
            if (res.code == 1) {
              if (res.errors.field1) {
                $(".editFname").addClass("border-danger");
                $(".editPassword").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
              if (res.errors.field2) {
                $(".editLname").addClass("border-danger");
                $(".editPassword").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
              if (res.errors.field3) {
                $(".editUserName").addClass("border-danger");
                $(".editPassword").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
              if (res.errors.field4) {
                $(".editPhone").addClass("border-danger");
                $(".editPassword").val("");
                $(".inTro").addClass("text-danger");
                $(".inTro").text(res.message);
              }
            }
            if (res.code == 2) {
              $(".editUserName").addClass("border-danger");
              $(".editPassword").val("");
              $(".inTro").addClass("text-danger");
              $(".inTro").text(res.message);
            }
            if (res.code == 200) {
              $('#editModal').modal('hide');
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
          },
        });
      });
      $(document).on('click', '.viewBtn', function () {
        let account_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "code.php?view_account_id=" + account_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                alert(res.message);
                }else if(res.code == 200){
                    $('.viewFname').text(res.data.fname);
                    $('.viewLname').text(res.data.lname);
                    $('.viewUserName').text(res.data.username);
                    $('.viewPhone').text(res.data.phone);
                    $('#viewModal').modal('show');
                }

            }
        });
      });
      $(document).on('click', '.deleteBtn', function () {
        let account_id = $(this).val();
        let deleteInput = $('.deleteId').val(account_id);
      });
      $(document).on("click", "#delete", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        let account_id = $('.deleteId').val();
        $.ajax({
            type: "GET",
            url: "code.php?deleteAccount=" + account_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){
                    $('#deleteModal').modal('hide');
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
