 <!-- Internal Select2 js-->
 <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
 <!--Internal Fileuploads js-->
 <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
 <!--Internal Fancy uploader js-->
 <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
 <!--Internal  Form-elements js-->
 <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
 <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
 <!--Internal Sumoselect js-->
 <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
 <!--Internal  Datepicker js -->
 <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
 <!--Internal  jquery.maskedinput js -->
 <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
 <!--Internal  spectrum-colorpicker js -->
 <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
 <!-- Internal form-elements js -->
 <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

 <script>
     var date = $('.fc-datepicker').datepicker({
         dateFormat: 'yy-mm-dd'
     }).val();

 </script>

 <script>
     $(document).ready(function() {
         $('select[name="section_id"]').on('change', function() {
             var SectionId = $(this).val();
             if (SectionId) {
                 $.ajax({
                     url: "{{ URL::to('section') }}/" + SectionId,
                     type: "GET",
                     dataType: "json",
                     success: function(data) {
                         $('select[name="product"]').empty();
                         $.each(data, function(key, value) {
                             $('select[name="product"]').append('<option value="' +
                                 value + '">' + value + '</option>');
                         });
                     },
                 });

             } else {
                 console.log('AJAX load did not work');
             }
         });

     });

 </script>


 <script>
     function myFunction() {

         var Amount_Commission = parseFloat(document.getElementById("amount_commission").value);
         var Discount = parseFloat(document.getElementById("Discount").value);
         var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
         var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

         var Amount_Commission2 = Amount_Commission - Discount;


         if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

             alert('يرجي ادخال مبلغ العمولة ');

         } else {
             var intResults = Amount_Commission2 * Rate_VAT / 100;

             var intResults2 = parseFloat(intResults + Amount_Commission2);

             sumq = parseFloat(intResults).toFixed(2);

             sumt = parseFloat(intResults2).toFixed(2);

             document.getElementById("Value_VAT").value = sumq;

             document.getElementById("Total").value = sumt;

         }

     }

 </script>