<?php
/**
 * @version $Id: default.php 50789 2012-03-11 14:41:23Z steph $
 * @author RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
?>
<div class="cart_quickcart">
    <?php if ($this->checkout_mode == 'sandbox'):?><span class="attention"><?php echo JText::_('ROKQUICKCART_WARN_SANDBOX_MODE')?></span><?php endif;?>
    <div class="cart_cartstatus">
        <div class="cart_statusicon"></div>
            <a href="<?php echo $this->current_url.'#rokquickcart';?>"><?php echo JText::_('ROKQUICKCART_YOUR_CART');?>: (<span class="simpleCart_quantity"></span> <?php echo JText::_('ROKQUICKCART_ITEMS');?>)</a>
    </div>
    <h2><?php echo $this->page_title;?></h2>
    <div class="cart_products">
    <?php $cnt = count($this->items); $i=0;?>
        <?php foreach($this->items as $item): ?>
            <?php if ($i%$this->cols==0): ?>
                <div class="simpleCart_shelfRow">
           <?php endif;?>
                <div class="simpleCart_shelfItem">
                    <div class="cart_product_grad"></div>
                    <div class="cart_product_sur1"></div>
                    <div class="cart_product_sur2"></div>
                    <div class="cart_product_sur3"></div>
                    <div class="cart_product_sur4"></div>
                    <div class="cart_product_content">
                        <div class="cart_padding">
                            <div class="cart_product_l">
                                <?php if($this->use_rokbox):?><a rel="rokbox" href="<?php echo $item->fullImage;?>"><?php endif; ?>
                    	        <img src="<?php echo $item->shelfImage;?>" alt="<?php echo $item->name;?>" title="<?php echo $item->name;?>" height="<?php echo $item->shelfImageHeight; ?>" width="<?php echo $item->shelfImageWidth; ?>" class="item_image"/>
                                <?php if($this->use_rokbox):?></a><?php endif; ?>
                                <span class="item_price"><?php echo $this->currency_symbol;?><?php echo $item->price;?></span>
                            </div>
                            <div class="cart_product_r">
                                <h5 class="item_name"><?php echo $item->name;?></h5>
                                <p class="product_Description">
                                    <?php echo $item->description;?>
                                </p>
                                <?php if($item->show_sizes):?><div><?php echo JText::_('ROKQUICKCART_SIZE');?>: <?php echo $item->sizes;?></div><?php endif;?>
                                <?php if( $item->show_colors):?><div><?php echo JText::_('ROKQUICKCART_COLOR');?>: <?php echo $item->colors;?></div><?php endif;?>
                                <?php if($this->shipping_per_item):?><div><input class="item_shipping" value="<?php echo $item->shipping;?>" type="hidden"></div><?php endif;?>
                                <span class="item_thumb"><?php echo $item->cartImage;?></span>
                                <div class="cart_product_add">
                                    <a href="<?php echo $this->current_url.'#rokquickcart';?>" class="item_add"><span class="btn btn-primary"> <?php echo JText::_('ROKQUICKCART_ADD_TO_CART');?></span><span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $cnt--; $i++;?>
            <?php if(($i%$this->cols==0)||($cnt==0)):?>
                </div>
            <?php endif;?>
        <?php endforeach; ?>
    </div>
    <div class="clr"></div>
    <a id="rokquickcart"></a>
    <h2><?php echo JText::_('ROKQUICKCART_YOUR_CART');?>: (<span class="simpleCart_quantity"></span> <?php echo JText::_('ROKQUICKCART_ITEMS');?>)</h2>
    <div class="cart_yourcart">
    	<div class="cart_grad"></div>
	    <div class="cart_sur1"></div>
	    <div class="cart_sur2"></div>
	    <div class="cart_sur3"></div>
	    <div class="cart_sur4"></div>
	    <div class="cart_yourcart_items">
            <div class="simpleCart_items" >
            </div>
			<hr />
            <div class="cart_totals">
                <div><?php echo JText::_('ROKQUICKCART_SUB_TOTAL');?>: <span class="simpleCart_total"></span></div>
                <?php if($this->tax):?><div><?php echo JText::_('ROKQUICKCART_TAX');?>: <span class="simpleCart_taxCost"></span></div><?php endif;?>
                <?php if($this->shipping):?><div><?php echo JText::_('ROKQUICKCART_SHIPPING');?>: <span class="simpleCart_shippingCost"></span></div><?php endif;?>
                <div><?php echo JText::_('ROKQUICKCART_TOTAL');?>: <span class="simpleCart_finalTotal"></span></div>
            </div>
            <div class="clr"></div>
        </div>
    </div>
    <div class="cart_buttons">
        <a href="javascript:;" class="simpleCart_checkout"><span class="btn btn-primary"> <?php echo JText::_('ROKQUICKCART_CHECKOUT');?></span><span></span></a>
        <a href="javascript:;" class="simpleCart_empty"><span class="btn btn-primary"> <?php echo JText::_('ROKQUICKCART_EMPTY_CART');?></span><span></span></a>
    </div>
    <div class="clr"></div>
</div>
<?php if ($this->pagination->get('pages.total') > 1) : ?>
	<div class="pagination pagination_rokquickcart">
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
				<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>
