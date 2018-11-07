<?php

namespace Omnipay\Mollie\Message\Response;

use Omnipay\Common\ItemBag;
use Omnipay\Mollie\Item;

/**
 * @see https://docs.mollie.com/reference/v2/payments-api/get-order
 */
class FetchOrderResponse extends FetchTransactionResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return parent::isSuccessful() && $this->isPaid();
    }

    public function getItems()
    {

        if (isset($this->data['lines'])) {
            $items = [];

            foreach ($this->data['lines'] as $line) {
                $items[] = new Item($line);
            }

            return new ItemBag($items);
        }
    }
}
