<?php $from="nirbhay";
$id=1
?>
<form>
													<div class="rating">
														<x-star-rating value="3" number="5"></x-star-rating>
														<script src="js/StarRating.js"></script>
														<input type="hidden" id="productId" name="productId" value="<?php echo $from."_".$id;?>">
														<textarea row=5 col=20 style="height: auto;"></textarea>   
														
													</div>
													<button href="" style="font-size:10px; border-radius:0px;" class="btn btn-primary"><i class="icon-pencil"></i> Submit</button>
												</form>