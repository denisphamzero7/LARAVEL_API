<h1>upload file</h1>
<form action="<?php echo route('categories.file');?>" method="post" enctype="multipart/form-data">

    <input type="file" name="photo" placeholder="Tên chuyên mục">
    <?php echo csrf_field(); ?>
    <!-- <input type=" hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
    <button type="submit">upload file</button>
</form>
