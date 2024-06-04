<script src="<?= base_url('assets/backend/')?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url('assets/backend/')?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/backend/')?>assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?= base_url('assets/backend/')?>assets/vendor/echarts/echarts.min.js"></script>
<script src="<?= base_url('assets/backend/')?>assets/vendor/quill/quill.min.js"></script>
<script src="<?= base_url('assets/backend/')?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= base_url('assets/backend/')?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= base_url('assets/backend/')?>assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url('assets/backend/')?>assets/js/main.js"></script>
<script>
		$('#autohide').delay('slow').slideDown('slow').delay('10000').slideUp('600');
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('.select2').select2();
        });
    </script>
 <!-- <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))
    });
  </script> -->