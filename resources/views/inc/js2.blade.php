  <!--Internal  Datepicker js -->
  <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
  <!-- Internal Select2 js-->
  <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
  <!-- Internal Jquery.mCustomScrollbar js-->
  <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  <!-- Internal Input tags js-->
  <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
  <!--- Tabs JS-->
  <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
  <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
  <!--Internal  Clipboard js-->
  <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
  <!-- Internal Prism js-->
  <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

  <script>
      $('#delete_file').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget)
          var id_file = button.data('id_file')
          var file_name = button.data('file_name')
          var invoice_number = button.data('invoice_number')
          var modal = $(this)

          modal.find('.modal-body #id_file').val(id_file);
          modal.find('.modal-body #file_name').val(file_name);
          modal.find('.modal-body #invoice_number').val(invoice_number);
      })

  </script>

  <script>
      // Add the following code if you want the name of the file appear on select
      $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

  </script>
