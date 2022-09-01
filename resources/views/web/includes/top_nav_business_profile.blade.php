<html>
	<?php
		if( isset($business_data->category) ) {?>
			<?php
			if( isset($check_is_active_subscription) && $check_is_active_subscription == 1 ) {?>
				<a href="{{url('businessProfile')}}"><li class="{{ request()->is('businessProfile') ? 'active' : 'default' }}">Profile info</li></a>
				<a href="{{url('storeProfile')}}"><li class="{{ request()->is('storeProfile') ? 'active' : 'default' }}">Store info</li></a>
				<a href="{{url('products')}}"><li class="{{ request()->is('products') ? 'active' : 'default' }}">Product</li></a>
				<?php
				if($business_data->create_view_deals_status == 1) {?>
					<a href="{{url('storeDeals')}}"><li class="{{ request()->is('storeDeals') ? 'active' : 'default' }}">My Deals</li></a>
				<?php
				} else {?>	
					<a href="javascript:void(0);">
						<li class="disabled_view"  disabled data-toggle="modal" data-target="#subscription_modal">My Deals</li>
					</a>
				<?php
				}
			} else {?>
				<style type="text/css">
					.tabs .tabs-list li.disabled_view {
						background-color: transparent !important;
						color: #CCC !important;
						cursor: not-allowed !important;
					}
				</style>
				<a href="{{url('businessProfile')}}">
					<li class="{{ request()->is('businessProfile') ? 'active' : 'default' }}">Profile info</li>
				</a>
				<a href="javascript:void(0);">
					<li class="disabled_view"  disabled data-toggle="modal" data-target="#subscription_modal">Store info</li>
				</a>
				<a href="javascript:void(0);">
					<li class="disabled_view"  disabled data-toggle="modal" data-target="#subscription_modal">Product</li>
				</a>
				<a href="javascript:void(0);">
					<li class="disabled_view"  disabled data-toggle="modal" data-target="#subscription_modal">My Deals</li>
				</a>
				<?php
			}
			?>
		<?php
		} else {
			?>
			<style type="text/css">
					.tabs .tabs-list li.disabled_view {
						background-color: transparent !important;
						color: #CCC !important;
						cursor: not-allowed !important;
					}
				</style>
				<a href="{{url('businessProfile')}}">
					<li class="{{ request()->is('businessProfile') ? 'active' : '' }}">Profile info</li>
				</a>
				<a href="javascript:void(0);">
					<li class="disabled_view"  disabled data-toggle="modal" data-target="#subscription_modal">Store info</li>
				</a>
				<a href="javascript:void(0);">
					<li class="disabled_view"  disabled data-toggle="modal" data-target="#subscription_modal">Product</li>
				</a>
				<a href="javascript:void(0);">
					<li class="disabled_view"  disabled data-toggle="modal" data-target="#subscription_modal">My Deals</li>
				</a>
				<?php
			
		}?>

		<?php
		$follower_text = "";
		if(Auth::check() && (Auth::user()->user_type == "business") ) {
			$follower_text = "Followers";
		}
		if(Auth::check() && (Auth::user()->user_type == "customer") ) {
			$follower_text = "Following";
		}
		?>

		<a href="{{url('favourite')}}"><li class="{{ request()->is('favourite') ? 'active' : '' }}">Favourites</li></a>
		<a href="{{url('storeFollowing')}}"><li class="{{ request()->is('storeFollowing') ? 'active' : '' }}"><?php echo $follower_text;?></li></a>
	<!--	<a href="{{url('storeReviews')}}"><li class="{{ request()->is('storeReviews') ? 'active' : '' }}">Reviews</li></a> 
	-->	
	<a href="{{url('storeReferrals')}}"><li class="{{ request()->is('storeReferrals') ? 'active' : '' }}">Referrals</li></a>

		<div class="modal fade" id="subscription_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Access Restriction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p><strong>You do not have any Active Membership Plan, Please activate or purchase a membership plan to access this feature.<br /></strong>
				<br />You can upgrade your Membership Plan, <a href="{{url('storePlans')}}"> Click Here </a></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
		</div>
</html>