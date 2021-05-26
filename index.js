loadcourses();
var lastupload="";
var course="";
function loadcourses(){
    var count=0;
    var classn="";
    var opts = "<option value='0'>Select Course</option>";
    var param = { action: "getcourses" };
  
    $.ajax({
      url: "./api/mainApi.php",
      method: "POST",
      dataType: "Json",
      data: param,
      success: (response) => {
        if (response.status) {
          var data = response.data;
          classn=data[0]['class'];
          data.forEach((row) => {
            count++;
            opts += `<option value='${row.id}'>${row.Name}</option>`;
          });
        }
        $("#class-name").text("Class: "+classn);
        $("#courses").html(opts);
        $("#course-count").text(count+" Courses");
      },
      error: (error) => {
        console.log(error);
      },
    });
}
getresources(-1);

function getresources(id){
  
    var param = { action: "getResource",course:id};

    var tbody="";
  
    $.ajax({
      url: "./api/mainApi.php",
      method: "POST",
      dataType: "Json",
      data: param,
      success: (response) => {
        if (response.status) {
          var data = response.data;
          if(id==-1){
            lastupload=data[0]['Date'];
            course="Recent Resources";
          }
          else{
            course=data[0]['Course'] + " Resources";
          }
          
          data.forEach((row) => {
           tbody+=`<tr>
           <td><img class="rounded-circle" style="width:40px;"
                   src="./assets/logos/${getlogo(row['Name'])}" alt="activity-user"></td>
           <td>
               <h5 class="mb-1 font-weight-bold">${row['Name']}</h5>
               <p class="m-0">Course: ${row['Course']}</p>
           </td>
           <td>
               <h6 class="text-muted"><i class="fas fa-calendar f-13 m-r-15"></i>${row['Date']}</h6>
           </td>
           <td class="text-center"><a href="${row['Path']}"
                   class="theme-bg2 text-white f-30 py-2 px-2 btn btn-rounded w-75 m-auto" download>
                   <i class="fas fa-download f-10 m-r-15"></i>
                   Download</a></td>
       </tr>
           `;
          });
        }
        $("#res tbody").html(tbody);
        $("#ld").text(lastupload);
        $("#t-card-title").text(course);
      },
      error: (error) => {
        console.log(error);
      },
    });
    
}
function getlogo(name){
  var logo="";
  var ext = name.substring(name.lastIndexOf(".")+1);
  switch (ext) {
    case 'xlsx':
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
$(".lgout").click(()=>{
  window.location.href="./public/logout"
});
$("#courses").on("change",(e)=>{
  let id=$("#courses").val();
 
  if(id==0){
    getresources(-1);
  }
  else{
    getresources(id);
  }
  
});