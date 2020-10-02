<?php $__env->startSection('title', 'Edit Product'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center">Edit Product - <?php echo e($product->product_name); ?></h2>
        <hr>

        <section>


            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <section>
                <div class="grid-padding-x grid-x ">

                    <div class="small-12 medium-6 cell">
                        <form action="/profile/<?php echo e(user()->username); ?>/products/<?php echo e($product->id); ?>/update_product" method="post" enctype="multipart/form-data">

                            <label for="product_name">Product Name:</label>
                            <input type="text" id="product_name" name="product_name" value="<?php echo e($product->product_name); ?>">

                            <label for="price">Price:</label>
                            <input type="text" id="price" name="price" value="<?php echo e($product->price); ?>">

                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="10"><?php echo e($product->description); ?></textarea>



                            <label for="productImage" class="button">Upload Image</label>
                            <input type="file" id="productImage" class="show-for-sr" name="productImage">

                            <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">

                            <div>
                                <input type="submit" class="button expanded" value="Update">
                            </div>


                        </form>

                    </div>


                </div>

            </section>

        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/admin/product/editProduct.blade.php ENDPATH**/ ?>