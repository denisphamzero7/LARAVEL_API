<h1>Thêm chuyên mục</h1>
<form action="<?php echo route('categories.add');?>" method="post">

    <input type="text" name="category_name" placeholder="Tên chuyên mục"
        value="<?php echo old('category_name','mặt định');?>">
    <?php echo csrf_field(); ?>
    <!-- <input type=" hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
    <button type="submit">Thêm mới</button>
</form>