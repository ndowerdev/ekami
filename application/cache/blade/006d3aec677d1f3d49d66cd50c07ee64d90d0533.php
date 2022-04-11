<?php $__env->startSection('content'); ?>
<section>
<?php $__currentLoopData = $sub_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunked): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
		<?php $__currentLoopData = $chunked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				$aside_cover 	= ($n % 4 == 0)?'w-100':'';						
				$is_cover 		= ($n % 4 == 0)?'v-cover':'v-image';
				
				
				$json_images 	= json_decode($info['json_images'], TRUE);

				$first_image	= $json_images['images'][0];

				$keyword 		= $info['keyword'];
				$slug 			= $first_image['slug'];
				$post_url		= imake_url($niche,$slug);

				//$img_url		= $first_image['url'];
				$img_url		= blade_image($keyword);

				$json_sentences = json_decode($info['json_sentences'], TRUE);

				$max_word 		= ($n % 4 == 0)?120:30;

				$sentences      = collect($json_sentences)->shuffle()->take(5)->implode(' ');
				$sentences_txt  = word_limiter($sentences, $max_word,'.');

				$img_alt 		= imake_stringcase("ucwords", $keyword);

			?>
        <aside class="card mb-4">
		    <center>
            	<a href="<?php echo e($post_url); ?>">
            		<img class="card-img-top" alt="<?php echo e($img_alt); ?>" src="<?php echo e($img_url); ?>" width="100%" />
            	</a>            	
            </center>
		  <div class="card-body">
		    <h1 class="h3 card-title"><a href="<?php echo e($post_url); ?>"><?php echo e(imake_stringcase("ucwords", $keyword)); ?></a></h1>
		    <p class="card-text"><?php echo e($sentences_txt); ?></p>
		  </div>
		</aside>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 	
</section>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\belajardasar\blade/theme/native1/home.blade.php ENDPATH**/ ?>