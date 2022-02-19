<?php

namespace App\Http\Controllers\Carts;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
	public function index()
	{
		$items = \Cart::getContent();
		$this->data['items'] =  $items;

		return $this->load_theme('carts.index', $this->data);
	}

    public function store(Request $request)
	{
		$params = $request->except('_token');
		
		$product = Product::findOrFail($params['product_id']);
		$slug = $product->slug;

		$attributes = [];
		if ($product->configurable()) {
			$product = Product::from('products as p')
							->whereRaw("p.parent_id = :parent_product_id
							and (select pav.text_value 
									from product_attribute_values pav
									join attributes a on a.id = pav.attribute_id
									where a.code = :size_code
									and pav.product_id = p.id
									limit 1
								) = :size_value
							and (select pav.text_value 
									from product_attribute_values pav
									join attributes a on a.id = pav.attribute_id
									where a.code = :color_code
									and pav.product_id = p.id
									limit 1
								) = :color_value
								", [
									'parent_product_id' => $product->id,
									'size_code' => 'size',
									'size_value' => $params['size'],
									'color_code' => 'color',
									'color_value' => $params['color'],
								])->firstOrFail();

			$attributes['size'] = $params['size'];
			$attributes['color'] = $params['color'];
		}

		$itemQuantity =  $this->_getItemQuantity(md5($product->id)) + $params['qty'];
		$this->_checkProductInventory($product, $itemQuantity);

		$item = [
			'id' => md5($product->id),
			'name' => $product->name,
			'price' => $product->price,
			'quantity' => $params['qty'],
			'attributes' => $attributes,
			'associatedModel' => $product,
		];

		\Cart::add($item);

		\Session::flash('success.message', 'Product '. $item['name'] .' has been added to cart');
		return redirect('/product/'. $slug);
	}

    public function update(Request $request)
	{
        // return $request;
		$params = $request->except('_token');

		if ($items = $params['items']) {
			foreach ($items as $cartID => $item) {
				$cartItem = $this->_getCartItem($cartID);
				$this->_checkProductInventory($cartItem->associatedModel, $item['quantity']);

				\Cart::update($cartID, [
					'quantity' => [
						'relative' => false,
						'value' => $item['quantity'],
					],
				]);
			}

			\Session::flash('success', 'The cart has been updated');
			return redirect('/carts');
		}
	}

    public function destroy($cart)
	{
		\Cart::remove($cart);
		return redirect('/carts');
	}

	private function _checkProductInventory($product, $itemQuantity)
	{
		if ($product->productInventory->qty < $itemQuantity) {
			throw new \App\Exceptions\OutOfStockException('The product '. $product->sku .' is out of stock');
		}
	}

	private function _getCartItem($cartID)
	{
		$items = \Cart::getContent();
		return $items[$cartID];
	}

	private function _getItemQuantity($itemId)
	{
		$items = \Cart::getContent();
		$itemQuantity = 0;
		if ($items) {
			foreach ($items as $item) {
				if ($item->id == $itemId) {
					$itemQuantity = $item->quantity;
					break;
				}
			}
		}

		return $itemQuantity;
	}
}
