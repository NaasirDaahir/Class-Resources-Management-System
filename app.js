// $(".etdate").collapse("show");
loadclases();
loadCourses();
var usertype = 2;

$(".Tdate").click(function () {
  $(".etdate").collapse("toggle");
  $(".coll-con ion-icon").attr("name", "arrow-forward");
});
$("#loginForm").on("submit", function (e) {
  e.preventDefault();
  var username = $("#username").val();
  var password = $("#password").val();

  let userInfo = {
    username: username,
    password: password,
  };

  var response = makeRequest("../api/loginController.php", userInfo);
  response.then((data) => {
    if (data.status == true) {
      window.location.href = "../index.php";
    } else {
      console.log(data.message);
      $("#password").addClass("is-invalid");
      $("#username").addClass("is-invalid");
      $("#error").text("Username Or Password is incorrect");
      $("#error").addClass("text-left text-danger");
    }
  });
});
$("#username,#password").on("keydown", (e) => {
  console.log(e.target.id);
  $("#" + e.target.id).removeClass("is-invalid");
  $("#error").removeClass("text-left text-danger");
  $("#error").text("");
});

getResources();

function getResources() {
   
  var param = { action: "getSiCResource"};

  var tbody="";

  $.ajax({
    url: "../api/mainApi.php",
    method: "POST",
    dataType: "Json",
    data: param,
    success: (response) => {
      if (response.status) {
        var data = response.data;

        data.forEach((row) => {
         tbody+=`<tr>
         <td><img class="rounded-circle" style="width:40px;"
                 src="../assets/logos/${getlogo(row['Name'])}" alt="activity-user"></td>
         <td>
             <h5 class="mb-1 font-weight-bold">${row['Name']}</h5>
         </td>
         <td>
             <h6 class="text-muted"><i class="fas fa-calendar f-13 m-r-15"></i>${row['Date']}</h6>
         </td>
         <td class="text-center"><a href="javascript:"
                 class="f-20 py-2 px-2 w-75 m-auto">
                 <i class="fas fa-download f-15 m-r-15"></i>
                 0 Downloads</a></td>
     </tr>
         `;
        });
      }
      $("#classsIns tbody").html(tbody);
    },
    error: (error) => {
      console.log(error);
    },
  });
}
async function makeRequest(path, data) {
  var result = {};
  await $.ajax({
    url: path,
    method: "POST",
    dataType: "JSON",
    data: data,
    success: (response) => {
      result = response;
    },
    error: function (error) {
      result = error;
    },
  });
  // console.log(result);
  return result;
}

$("#classModal").click(function (e) {
  e.preventDefault();
  $("#class-register")[0].reset();
  $(".new-class").addClass("d-none");
  $("#classname").html("");
  var opts = "<option value='0'>Select Class</option>";
  var param = { action: "fillClasses" };

  $.ajax({
    url: "../api/mainApi.php",
    method: "POST",
    dataType: "Json",
    data: param,
    success: (response) => {
      if (response.status) {
        var data = response.data;

        data.forEach((row) => {
          opts += `<option value='${row.id}'>${row.Name}</option>`;
        });
      }
      $("#classname").html(opts);
    },
    error: (error) => {
      console.log(error);
    },
  });
  $("#RegisterclassModal").modal();
});

$("#add-new").click(() => {
  $(".new-class").removeClass("d-none");
});
var type = "join";
$(".new-class input").on("keydown", (e) => {
  type = "create";
  $("#classname").val("0");
});
$("#class-register").on("submit", (e) => {
  e.preventDefault();
  if (
    ($("#classname").val() == 0 && $("#classname1").val() == "") ||
    $("#coursename").val() == ""
  ) {
    swal("", "Please Select Class or fill in the planks", "warning", "small");
  } else {
    var param = {};
    var classname = $("#classname1").val();
    var sclassname = $("#classname").val();
    var coursename = $("#coursename").val();
    
    if (type == "create") {
      param = {
        action: "createJoinClass",
        type: type,
        name: classname,
      };
      
    } else {
      var classnameSelected=$("#classname option[value="+sclassname+"]").text();
      console.log(classnameSelected);
      param = {
        action: "createJoinClass",
        type: type,
        name: sclassname,
        classname:classnameSelected
      };
    }
    param.coursename = coursename;
    $.ajax({
      url: "../api/mainApi",
      method: "POST",
      dataType: "Json",
      data: param,
      success: (response) => {
        if (response.status) {
          var data = response.Message;
          swal({
            showConfirmButton: false,   
            title: "",
            type: "success",
            icon: "success",
            text: data,
          });

          setTimeout(() => {
            swal.close();
            $("#class-register")[0].reset();
            $("#RegisterclassModal").modal("hide");
            loadclases();
          }, 1500);
        } else {
          var data = response.Message;
          swal({
            type: "error",
            icon: "error",
            title: "",
            text: data,
          });
        }
      },
      error: (error) => {
        console.log(error);
      },
    });
  }
});

$('input[name="usertype"]').click((e) => {
  usertype = e.target.value;
  if (usertype == "Lecturer") {
    usertype = 1;
    $("#class").parent().addClass("d-none");
    $("#userid").parent().addClass("d-none");
  } else {
    usertype = 2;
    $("#class").parent().removeClass("d-none");
    $("#userid").parent().removeClass("d-none");
  }
});
$("#RegisterUser").on("submit", (e) => {
  e.preventDefault();
  let userInfo = new FormData($("#RegisterUser")[0]);
  userInfo.append("type", usertype);
  userInfo.append("action", "RegisterUser");
  $.ajax({
    url: "../api/mainApi.php",
    method: "POST",
    dataType: "Json",
    data: userInfo,
    contentType: false,
    processData: false,
    success: (response) => {
      let status = response.status;
      let message = response.Message;
      if (status == true) {
        swal({
          type: "success",
          icon: "success",
          title: message,
        });
      } else {
        swal({
          type: "error",
          icon: "error",
          title: message ? message : "An Error Occured",
         
        });
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

$(".logout").click((e) => {
  window.location.href = "./logout.php";
});

function loadclases() {
  var count=0;
  var links = "";
  var param = {
    action: "LoadClasses",
  };
  $.ajax({
    url: "../api/mainApi.php",
    method: "POST",
    dataType: "Json",
    data: param,
    success: (response) => {
      let status = response.status;
      let message = response.data;
      if (status) {
        message.forEach((_class) => {
          links += `<li class=""><a href="classdetail?class_id=${_class["id"]}" class="">${_class["Name"]}</a></li>`;
          count++;
        });
        $("#loaded_clases").html(links);
        $("#class-count").text(count);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}
function loadCourses() {
  var links = "";
  var param = {
    action: "getInstructorCourses",
  };
  $.ajax({
    url: "../api/mainApi.php",
    method: "POST",
    dataType: "Json",
    data: param,
    success: (response) => {
      let status = response.status;
      let message = response.data;
      if (status) {
        message.forEach((_course) => {
          links += `<li class=""><a href="javascript:">${_course["class"]} (${_course["Name"]})</a></li>`;
        });
        $("#loaded_courses").html(links);
      
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

Dropzone.autoDiscover = false;
  
var myDropzone = new Dropzone(".dropzone", { 
   autoProcessQueue: false,
   parallelUploads: 15,
   dictDefaultMessage:"Upload Resource Here",
   init: function () {
    this.on("queuecomplete", function (file) {
      setTimeout(() => {
        swal({
          showConfirmButton: false,   
          title: "",
          type: "success",
          icon: "success",
          text: "All Resources Uploaded Successfully",
        });
      }, 500);
      
      getResources();
      this.removeAllFiles()
  });
  }
});

function getlogo(name){
  var logo="";
  var ext = name.substring(name.lastIndexOf(".")+1);
  switch (ext) {
    case 'excel':
      logo="excel.png";
      break;
    case 'pdf':
      logo="pdf.png";
      break;
    case 'pptx':
      logo="pptx.png";
      break;
    case 'ppt':
      logo="pptx.png";
      break;
    case 'docx':
      logo="word.png";
      break;
    case 'doc':
      logo="word.png";
      break;

    case 'zip' ||'rar'||'tar':
      logo="zip.png";
      break;
    default:
      logo="file.png";
      break;
  }
  return logo;
}

$('#uploadbtn').click(function(){
   myDropzone.processQueue();
});