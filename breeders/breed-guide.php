
 <style>
          .pdfobject-container { height: 500px;}
          .pdfobject { border: 1px solid #666; }
   </style>
   <link rel="resource" type="application/l10n" href="locale/locale.properties">
<script src="pdf.js"></script>

  <script src="viewer.js"></script>
<?php
include('header.php');
?>


  <div id="main-content" >

    <div class="content-left">
        <!-- side bar here -->
        <?php include('b_side_bar.php');?>
        <!-- side bar end -->

    </div>

<div class="right">
<embed width="100%" height="900px" src="../pdf/guide_to_dog_breeding.pdf">
</div>
</div>

<?php include('footer.php');
?>