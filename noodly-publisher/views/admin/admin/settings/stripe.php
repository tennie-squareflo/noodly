<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
		<!-- begin:: Content -->
		<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

			<!-- begin:: Content Head -->
			<div class="k-content__head	k-grid__item">
				<div class="k-content__head-main">
					<h3 class="k-content__head-title">Stripe Settings</h3>
				</div>
			</div>

			<!-- end:: Content Head -->
			<!-- begin:: Content Body -->
			<div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
				<div class="row">
					<div class="col-lg-12">

						<!--begin::Portlet-->
						<div class="k-portlet" id="k_page_portlet">
							<div class="k-portlet__body">
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="k-section k-section--first">
                                            <div class="k-section__body">
                                                <h3 class="k-section__title k-section__title-lg">&nbsp;</h3>

                                                <?php
                                                if(isset($vars['stripe_message']) && $vars['stripe_message'] != ''){
                                                    ?><div class="alert alert-<?= isset($vars['stripe_message_type']) && $vars['stripe_message_type'] ? 'success' : 'danger' ?>"><?= $vars['stripe_message'] ?></div><?php
                                                }


                                                if(isset($vars['stripe_settings']['access_token'])){
                                                    ?><h1>You are connected</h1>
                                                    <p>
                                                        You are connected with the following account:<br />
                                                        E-mail: <b><?= isset($vars['stripe_settings']['email']) ? $vars['stripe_settings']['email'] : '???' ?></b><br />
                                                        Name: <b><?= isset($vars['stripe_settings']['display_name']) ? $vars['stripe_settings']['display_name'] : '???' ?></b><br /><?php

                                                        if(isset($vars['stripe_settings']['livemode']) && $vars['stripe_settings']['livemode']){

                                                        } else {
                                                            ?><br />
                                                            You are currently in <b>Test</b> mode.<?php
                                                        }

                                                        ?>
                                                    </p>

                                                    <form method="post" onsubmit="if(!confirm('Are you sure you want to disconnect?')){return(false);}">
                                                        <input type="hidden" name="action" value="<?= $this->stripe_model->getDisconnectAction() ?>">
                                                        <input type="submit" value="Disconnect" class="btn btn-danger">
                                                    </form><?php
                                                } else {
                                                    /*
                                                    $s_url = "https://connect.squareup.com/oauth2/";
                                                    $s_url .= "authorize?client_id=".$config['square']['live']['id'];
                                                    $s_scope = "MERCHANT_PROFILE_READ PAYMENTS_READ PAYMENTS_WRITE CUSTOMERS_READ CUSTOMERS_WRITE";
                                                    $s_scope .= " ORDERS_READ ORDERS_WRITE ITEMS_READ";
                                                    $s_url .= "&scope=".urlencode($s_scope);
                                                    */

                                                    ?><h1>You are not connected yet</h1>
                                                    <p>Click on the button below to connect your Stripe account.</p>

                                                    <form method="post">
                                                        <input type="hidden" name="action" value="<?= $this->stripe_model->getConnectAction() ?>">
                                                        <input type="submit" value="Connect your Stripe account" class="btn btn-success">
                                                    </form><?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>

                                    </div>
                                    <div class="col-xl-2"></div>
                                </div>
							</div>
						</div>

						<!--end::Portlet-->
					</div>
				</div>
			</div>

			<!-- end:: Content Body -->
		</div>
