$(document).ready(function () {
    "use strict";
    $("#products-datatable").DataTable({
      language: {
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'>",
          next: "<i class='mdi mdi-chevron-right'>",
        },
        info: "Hiển thị kết quả _START_ đến _END_ của _TOTAL_",
        lengthMenu:
          'Hiện <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> danh sách',
      },
      pageLength: 10,
      columns: [
        {
          orderable: !1,
          render: function (e, l, a, o) {
            var checkboxvalue = e;
            return (
              "display" === l &&
                (e =
                  '<div class="form-check"><input type="checkbox" name="check_list[]" value="'+checkboxvalue+'" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>'),
              e
            );
          },
          checkboxes: {
            selectRow: !0,
            selectAllRender:
              '<div class="form-check"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>',
          },
        },
        { orderable: !0 },
        { orderable: !0 },
        { orderable: !0 },
        { orderable: !0 },
        { orderable: !0 },
        { orderable: !0 },
        { orderable: !0 },
        { orderable: !1 },
      ],
      select: { style: "multi" },
      order: [[6, "sort"]],
      drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded"),
          $(".dataTables_length label").addClass("form-label"),
          $(".dataTables_filter label").addClass("form-label");
      },
    });
  });
  