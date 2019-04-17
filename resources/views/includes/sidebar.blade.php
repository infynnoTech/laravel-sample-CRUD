				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<?php

									    $cavatar='uploads/placeholder300x300.png';

								?>
								<a href="#"><img src="{{asset($cavatar)}}" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>
							<div class="media-body">
								<div class="media-title font-weight-semibold">
										{{Auth::user()->name}}

									</div>
								<div class="font-size-xs opacity-50">
									<i class="icon-pin font-size-sm"></i> &nbsp;
									Ahmedabad
								</div>
							</div>
							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->
				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<?php
								$activeClass='';
								if (Request::is('home')  || Request::is('home')){
									 $activeClass = 'active';
								}
							?>
							<a href="{{URL::to('home')}}" class="nav-link {{$activeClass}}">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu {{ ((Request::is('products') || Request::is('categories') || Request::is('product-add') )? 'nav-item-expanded nav-item-open': '') }}">
							<a href="javascript:void(0)" class="nav-link">
								<i class="icon-basket"></i>
								<span>
									Products
								</span>
							</a>
							<ul class="nav nav-group-sub" data-submenu-title="C3 library">
								<li class="nav-item"><a href="{{route('categories')}}" class="nav-link {{ ((Request::is('categories'))? 'active': '') }}">Categories</a></li>
								<li class="nav-item"><a href="{{route('products')}}" class="nav-link {{ ((Request::is('products') || Request::is('product-add'))? 'active': '') }}">Prodcuts</a></li>

							</ul>
						</li>
					</ul>
				</div>
				<!-- /main navigation -->
			</div>
			<!-- /sidebar content -->
		</div>
		<!-- /main sidebar -->
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-light">
