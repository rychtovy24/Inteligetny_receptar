<?php $__env->startSection('content'); ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <datalist id="ingredients">
        <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($food->name); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </datalist>
    <datalist id="measures">
        <?php $__currentLoopData = config('constant.measure_recipe'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $measure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($measure); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </datalist>
    <div class="container">

        <form action="/recipe/store" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="col-sm-6">
                    <p>Title: <input type="text" name="title" placeholder="Recipe title"></p>
                    <p>
                        <button type="button" name="add_step" id="add_step" class="btn btn-success">Add Step</button>
                        <button type="button" name="remove" id="btn_remove_step" class="btn btn-danger">X</button>
                    </p>

                    <div class="steps">
                        <div class="step1">
                            <div class="text-info">1. step</div>
                            <textarea name="step1_description" id="step1_description" cols="50" rows="5"></textarea>
                        </div>
                    </div>

                </div>
                <div class="text-center col-sm-6">
                    <div class="card">
                        <div class="card-header">Ingretient List<br>
                            <button type="button" name="add_ingredient" id="add_ingredient" class="btn btn-success">Add Ingredient</button>
                            <button type="button" name="btn_remove_ingredient" id="btn_remove_ingredient" class="btn btn-danger">Remove Ingredient</button>
                        </div>
                        <div class="card-body">

                            <table class="table ingredientList" id="ingredient_list">
                                <tr class="ingredient-item">
                                    <td><input list="ingredients" name="food1" placeholder="select ingredient"></td>
                                    <td><input name="count1" size="5" placeholder="count" class="ml-4"></td>
                                    <td><input list="measures" name="measure1" size="14" placeholder="select measure" class="mr-4"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="button">Create recipe</button>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            var i=1;
            var j=1;


            $('#add_ingredient').click(function(){
                i++;
                $('#ingredient_list').append('<tr class="ingredient_item'+i+'"><td><input list="ingredients" name="food'+i+'" placeholder="select ingredient"></td><td><input name="count'+i+'" size="5" placeholder="count" class="ml-4"></td><td><input list="measures" name="measure'+i+'" size="14" placeholder="select measure" class="mr-4"></td></tr>');
            });


            $('#add_step').click(function(){
                j++;
                $('.steps').append('<div class="step'+j+'"><div class="text-info">'+j+'. step</div><textarea name="step'+j+'_description" id="step'+j+'_description" cols="50" rows="5"></textarea></p>');
            });


            $(document).on('click', '#btn_remove_ingredient', function(){
                if (i === 1){
                    return;
                }
                console.log('tu');
                $('.ingredient_item'+i+'').remove();
                i--;
            });

            $(document).on('click', '#btn_remove_step', function(){
                if (j == 1){
                    return;
                }
                $('.step'+j+'').remove();
                j--;
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>