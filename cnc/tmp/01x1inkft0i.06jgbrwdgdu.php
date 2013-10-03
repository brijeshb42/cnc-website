<section id="gallery">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h2 class="section-title">CnC <span>Gallery</span></h2>
				<div class="row">	
				    <ul class="unstyled thumbnails row gallery" >
				    	<?php foreach (($img?:array()) as $image): ?>
				    		<?php if ($image!='.' && $image!='..'): ?>
				    		
    						<li class="span3">
								<a href="img/gallery/<?php echo $image; ?>" class="swipebox magnifier" title ="" style="display:block;text-align:center;">
									<img width="270" height="270" src="img/gallery/<?php echo $image; ?>" class="img-circle" alt="img/gallery-13" />
								</a>
							</li>
							
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>