<?php $__env->startSection('title', 'Product'); ?>


<?php $__env->startSection('content'); ?>


    <div class="grid-container fluid product">

        <h2 class="text-center">Product</h2>
        <hr>

        <section>
            <div class="grid-x grid-padding-x">

                <div class="small-12 medium-6 cell">
                    <form action="/search/product" method="post" class="input-group">
                        <input type="text" placeholder="Search Product" name='search'  class="input-group-field">
                        <div class="input-group-button">
                            <input type='submit' class="button" value="Search">
                        </div>
                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                    </form>
                </div>
                or
                <div class="small-12 medium-5 cell">
                    <a href="/profile/<?php echo e(user()->username); ?>/products/create" class="button" >Create</a>
                </div>


            </div>

            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="grid-x grid-padding-x">

                <?php if($products): ?>

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Product Price</td>
                                    <td>Product Description</td>
                                    <td>Product Image</td>
                                    <td>Action</td>
                                </tr>
                            </thead>

                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td><?php echo e($product['product_name']); ?></td>
                                    <td><?php echo e($product['price']); ?></td>
                                    <td><?php echo e($product['description']); ?></td>
                                    <td><img src="/<?php echo e($product['image_path']); ?>" alt="<?php echo e($product['product_name']); ?>"></td>

                                    <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Edit Product" >
                                            <a href='/profile/<?php echo e(user()->username); ?>/products/<?php echo e($product['id']); ?>/edit_product'><i class="fa fa-edit" title="Edit Product"></i></a>
                                        </span>

                                                    &nbsp;

                                                    
                                                    
                                                    


                                                    <span data-tooltip class="has-tip top" tabindex="1" title="Delete Product">
                                            <form action='/profile/<?php echo e(user()->username); ?>/products/<?php echo e($product['id']); ?>/delete_product' method="post" class="delete-product">
                                                <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::generate()); ?>">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                            </form>
                                        </span>
                                    </td>

                                </tr>

                            </tbody>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>



                <?php endif; ?>

            </div>


        </section>

    </div>



    

    <?php $__env->stopSection(); ?>










<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.2\htdocs\bodymassage\resources\views/admin/product/index.blade.php ENDPATH**/ ?>