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
              class="bg-light d-block text-decoration-none py-3 px-4"
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
          class="bg-light d-block text-decoration-none py-3 px-4"
        >
          قائمة المحسنين
        </a>
      </aside>
      <main>
        <div>
          <h3 class="text-primary text-center mt-3">قائمة المحسنين</h3>
        </div>
        <div class="mt-3 mx-5">
        <button
            type="button"
            class="btn btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#addDonnerModal"
          >
            إضافة محسن
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
                $sql = "SELECT * FROM `donner`";
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
                    data-bs-target="#editDonnerModal"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="far fa-edit"></i>
                  </button>
                  <a
                    type="button"
                    href="donnerview.php?donnerId=<?php echo $row['id'] ?>"
                    class="btn btn-outline-success btn-sm viewBtn"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="fas fa-eye"></i>
                  </a>
                  <button
                    type="button"
                    class="btn btn-outline-danger btn-sm deleteBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteDonnerModal"
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
          <div class="modal fade" id="addDonnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    إضافة محسن
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="addDonner">
                    <label class="form-label donnerFnameLable">اسم المحسن</label>
                    <input
                      type="text"
                      name="donnerFname"
                      class="form-control donnerFname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label donnerLnameLable">لقب المحسن</label>
                    <input
                      type="text"
                      name="donnerLname"
                      class="form-control donnerLname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label donerPhoneLable">هاتف المحسن</label>
                    <input
                      type="text"
                      name="donnerPhone"
                      class="form-control donnerPhone"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label donnerFundsLable">مبلغ التبرع</label>
                    <input
                      type="text"
                      name="donnerFunds"
                      class="form-control donnerFunds"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="إضافة محسن"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="editDonnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    تعديل معلومات محسن
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="editDonner">
                    <input type="text" class="d-none editDonnerId" name="editDonnerId">
                    <label class="form-label editDonnerFnameLable">اسم المحسن</label>
                    <input
                      type="text"
                      name="editDonnerFname"
                      class="form-control editDonnerFname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editDonnerLnameLable">لقب المحسن</label>
                    <input
                      type="text"
                      name="editDonnerLname"
                      class="form-control editDonnerLname"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editDonerPhoneLable">هاتف المحسن</label>
                    <input
                      type="text"
                      name="editDonnerPhone"
                      class="form-control editDonnerPhone"
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
          <div class="modal fade" id="deleteDonnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    حذف محسن
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <input type="text" class="d-none deleteDonnerId" >
                  <p>هل أنت متأكد من حذف هذا المحسن</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="deleteDonner">
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
      $(document).on("submit", "#addDonner", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("addDonner", true);
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
                $(".donnerFname").addClass("border-danger");
                $(".donnerFnameLable").addClass("text-danger");
              }
              if (res.errors.lname) {
                $(".donnerLname").addClass("border-danger");
                $(".donnerLnameLable").addClass("text-danger");
              }
              if (res.errors.phone) {
                $(".donnerPhone").addClass("border-danger");
                $(".donnerPhoneLable").addClass("text-danger");
              }
              if (res.errors.phone) {
                $(".donnerFunds").addClass("border-danger");
                $(".donnerFundsLable").addClass("text-danger");
              }
            }
            if (res.code == 200) {
              $('#addDonnerModal').modal('hide');                 
              $('#addDonner')[0].reset();
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
          },
        });
      });
      $(document).on('click', '.editBtn', function () {
        let id = $(this).val();
        let editId = $('.editDonnerId').val(id);
        $.ajax({
            type: "GET",
            url: "code.php?edit_donner_id=" + id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){

                    $('.editDonnerLname').val(res.data.lname);
                    $('.editDonnerFname').val(res.data.fname);
                    $('.editDonnerPhone').val(res.data.phone);
                    $('#editPostModal').modal('show');
                }
            }
        });
      });
      $(document).on("submit", "#editDonner", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("editDonner", true);
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
                $(".editDonnerLname").addClass("border-danger");
                $(".editDonnerLnameLable").addClass("text-danger");
              }
              if (res.errors.fname) {
                $(".editDonnerFname").addClass("border-danger");
                $(".editDonnerFnameLable").addClass("text-danger");
              }
              if (res.errors.phone) {
                $(".editDonnerPhone").addClass("border-danger");
                $(".editDonerPhoneLable").addClass("text-danger");
              }
            }
            if (res.code == 200) {
              $('#editDonnerModal').modal('hide');
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
        let deleteInput = $('.deleteDonnerId').val(id);
      });
      $(document).on("click", "#deleteDonner", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        let id = $('.deleteDonnerId').val();
        $.ajax({
            type: "GET",
            url: "code.php?deleteDonner=" + id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){
                    $('#deleteDonnerModal').modal('hide');
                    $('#table').load(location.href + " #table");
                    alertify.success(res.message); 
                }

            }
        });
      });
    </script>
  </body>
</html>
