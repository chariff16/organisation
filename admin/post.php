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
              class="bg-light d-block text-decoration-none py-3 px-4"
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
          class="bg-light d-block text-decoration-none py-3 px-4"
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
          <h3 class="text-primary text-center mt-3">المنشورات</h3>
        </div>
        <div class="mt-3 mx-5">
        <button
            type="button"
            class="btn btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#addPostModal"
          >
            إضافة منشور
        </button>
        <div class="mt-4">
          <table class="table table-hover" id="table">
            <thead>
              <tr>
                <th scope="col">العنوان</th>
                <th class="col-2">التاريخ</th>
                <th class="col-1">
                  <p class="d-none d-md-block mb-0">تعديل/معاينة/حذف</p>
                  <p class="d-md-none mb-0">فعل</p>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                require("../dbcon.php");
                $sql = "SELECT * FROM `postes`";
                $run = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($run)){
              ?>
              <tr>
                <td class="align-middle"><?php echo $row['titel'] ?></td>
                <td class="align-middle"><?php echo date("Y-m-d",strtotime($row['date'])); ?></td>
                <td class="d-md-flex d-sm-inline-block justify-content-around">
                  <button
                    type="button"
                    class="btn btn-outline-primary btn-sm editBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#editPostModal"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="far fa-edit"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-outline-success btn-sm viewBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#viewPostModal"
                    value="<?php echo $row['id'] ?>"
                  >
                    <i class="fas fa-eye"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-outline-danger btn-sm deleteBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#deletePostModal"
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
          <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    إضافة منشور
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="addPost">
                    <label class="form-label titelLable">عنوان المنشور</label>
                    <input
                      type="text"
                      name="postTitel"
                      class="form-control postTitel"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label postLable">المنشور</label>
                    <textarea
                      type="text"
                      name="postInput"
                      class="form-control postInput"
                      aria-labelledby="passwordHelpBlock"
                      style="height: 100px"
                    ></textarea>
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="إضافة منشور"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    تعديل منشور
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="editPost">
                    <input type="text" class="d-none editId" name="editPostId">
                    <label class="form-label editTitelLable">عنوان المنشور</label>
                    <input
                      type="text"
                      name="postTitel"
                      class="form-control editPostTitel"
                      aria-labelledby="passwordHelpBlock"
                    />
                    <label class="form-label editPostLable">المنشور</label>
                    <textarea
                      type="text"
                      name="postInput"
                      class="form-control editPostInput"
                      aria-labelledby="passwordHelpBlock"
                      style="height: 100px"
                    ></textarea>
                    <div class="modal-footer">
                      <input
                        type="submit"
                        name="add"
                        class="btn btn-primary"
                        value="تحديث منشور"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="viewPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="d-flex justify-content-between p-3 border-bottom border-dark-subtle">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    حذف منشور
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
                  <p>هل أنت متأكد من حذف هذا المنشور</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="deletePost">
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
      $(document).on("submit", "#addPost", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("addPost", true);
        $.ajax({
          type: "POST",
          url: "code.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            let res = jQuery.parseJSON(response);
            if (res.code == 1) {
              if (res.errors.post) {
                $(".postInput").addClass("border-danger");
                $(".postLable").addClass("text-danger");
              }
              if (res.errors.title) {
                $(".postTitel").addClass("border-danger");
                $(".titelLable").addClass("text-danger");
              }
            }
            if (res.code == 200) {
              $('#addPostModal').modal('hide');                 
              $('#addPost')[0].reset();
              $('#table').load(location.href + " #table");
              alertify.success(res.message); 
            }
          },
        });
      });
      $(document).on('click', '.editBtn', function () {
        let post_id = $(this).val();
        let editId = $('.editId').val(post_id);
        $.ajax({
            type: "GET",
            url: "code.php?edit_post_id=" + post_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){

                    $('.editPostTitel').val(res.data.titel);
                    $('.editPostInput').val(res.data.post);
                    $('#editPostModal').modal('show');
                }
            }
        });
      });
      $(document).on("submit", "#editPost", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("editPost", true);
        $.ajax({
          type: "POST",
          url: "code.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            let res = jQuery.parseJSON(response);
            if (res.code == 1) {
              if (res.errors.title) {
                $(".editPostTitel").addClass("border-danger");
                $(".editTitelLable").addClass("text-danger");
              }
              if (res.errors.post) {
                $(".editPostInput").addClass("border-danger");
                $(".editPostLable").addClass("text-danger");
              }
            }
            if (res.code == 200) {
              $('#editPostModal').modal('hide');
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
        let account_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "code.php?view_post_id=" + account_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                alert(res.message);
                }else if(res.code == 200){
                    $('.viewPostTitel').text(res.data.titel);
                    $('.viewPostInput').text(res.data.post);
                    $('#viewModal').modal('show');
                }

            }
        });
      });
      $(document).on('click', '.deleteBtn', function () {
        let account_id = $(this).val();
        let deleteInput = $('.deleteId').val(account_id);
      });
      $(document).on("click", "#deletePost", function (e) {
        $(".form-control").removeClass("border-danger");
        e.preventDefault();
        let account_id = $('.deleteId').val();
        $.ajax({
            type: "GET",
            url: "code.php?deletePost=" + account_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.code == 404) {
                  alert(res.message);
                }else if(res.code == 200){
                    $('#deletePostModal').modal('hide');
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
