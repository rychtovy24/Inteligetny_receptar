<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="text-center col-sm-12 mb-4">
                <h3 class="font-weight-bold"><?php echo e($user->user_name); ?></h3>
            </div>
        </div>
        <div class="row">
            <?php if($currentAuthUser->id == $user->id): ?>
            <div class="text-center col-sm-6 border rounded">
                <h2 class="mb-4 mt-4">Ingredients</h2>
                <form action="/ingredients/store" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input list="ingredients" name="food" placeholder="select ingredient">
                    <datalist id="ingredients">
                        <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($food->name); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </datalist>
                    <input name="count" size="5" placeholder="count" class="ml-4">
                    <input list="measures" name="measure" size="14" placeholder="select measure" class="mr-4">
                    <datalist id="measures">
                        <?php $__currentLoopData = config('constant.measure'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $measure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($measure); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </datalist>
                    <button type="submit" class="btn btn-primary" name="button">Add food</button>
                </form>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Ingredient name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Destroy</th>
                    </tr>
                    </thead>
                    <?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                                <td><a href="/ingredients/<?php echo e($ing->id); ?>"><?php echo e($ing->food->name); ?></a></td>
                            <td><strong><?php echo e($ing->count); ?></strong> <i><?php echo e($ing->unit_of_measure); ?></i></td>
                                <td><a href="/ingredients/<?php echo e($ing->id); ?>/destroy"><img class="img-fluid" src="<?php echo e(url('images/x.png')); ?>" alt="x"></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>

            </div>
            <?php endif; ?>
            <div class="text-center offset-1 col-sm-4">
                <h4>Recipes</h4>
                <div class="card">
                    <?php $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($recipe->uri); ?>"><?php echo e($recipe->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>