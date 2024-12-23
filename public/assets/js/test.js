// Lắng nghe sự kiện khi người dùng thay đổi trạng thái của checkbox "Chọn tất cả"
document.getElementById("check_all").addEventListener("change", function() {
    // Lấy tất cả các checkbox con và thay đổi trạng thái tương ứng
    var checkboxes = document.querySelectorAll(".dt-checkboxes");
    for (var checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
  
  // Lắng nghe sự kiện khi người dùng bấm nút "Kiểm tra checkbox đã chọn"
  document.getElementById("check_selected").addEventListener("click", function() {
    // Lấy tất cả các checkbox đã được chọn
    var checkedValues = [];
    var checkboxes = document.querySelectorAll(".dt-checkboxes:checked");
  
    checkboxes.forEach(function(checkbox) {
      checkedValues.push(checkbox.value);  // Lấy giá trị của mỗi checkbox đã chọn
    });
  
    // Hiển thị hoặc xử lý các giá trị của checkbox đã chọn
    if (checkedValues.length > 0) {
      alert("Các checkbox đã chọn: " + checkedValues.join(', '));
    } else {
      alert("Không có checkbox nào được chọn.");
    }
  });