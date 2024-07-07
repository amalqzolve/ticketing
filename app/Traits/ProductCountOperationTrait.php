<?php

namespace App\Traits;

use App\inventory\ProductdetailslistModel;
use App\inventory\ProductTransactionModel;

use Carbon\Carbon;
use DB;

use Session;

trait ProductCountOperationTrait
{
    public function purchaseUpdation($from, $mode, $date, $data) //from =>'PI' / GRN //$mode=>insert or update
    {
        if ($mode == 'insert') { //only at creation of PI or GRN
            if ($data['save_as'] == 'existing') {
                $productId = $this->incrementStock($data['item_details_id'], $data['quantity']);
            } else if ($data['save_as'] == 'new') {
                $productId =  $this->insertOrUpdateProduct('', array(
                    'product_name' => $data['product_name'],
                    'unit' => $data['unit'],
                    'available_stock' => $data['quantity'],
                    'product_price' => $data['totalamount'] / $data['quantity'],
                    //'selling_price' => $data['selling_price'],
                    'product_status' => 1,
                    'description' => $data['description'],
                    'opening_stock' => $data['quantity'],
                    'branch' =>  $data['branch'],
                    // 'warehouse' => $data['warehouse'],
                )); //
            }
            $transactionId = $this->updateOrinsertProductTransaction('', array(
                'product_id' => $productId,
                'date' => Carbon::parse($date)->format('Y-m-d'),
                'desc' => 'from =>' . $from,
                'qty' => $data['quantity'],
                'stock_affection' => '+',
                // 'price',
                'branch' => $data['branch'],
            ));
            return array('new_product_id' => $productId, 'transaction_id' => $transactionId);
        } else { //updation of PI or GRN
            if ($data['new_product_id'] != '')
                $this->decrementStock($data['new_product_id'], $data['quantity_old']);
            if ((($data['save_as_old'] == 'existing') && ($data['save_as'] == 'new')) || (($data['save_as_old'] == '') && ($data['save_as'] == 'new'))) {
                $productId =  $this->insertOrUpdateProduct('', array(
                    'product_name' => $data['product_name'],
                    'unit' => $data['unit'],
                    'available_stock' => $data['quantity'],
                    'product_price' => $data['totalamount'] / $data['quantity'],
                    //'selling_price' => $data['selling_price'],
                    'product_status' => 1,
                    'description' => $data['description'],
                    'opening_stock' => $data['quantity'],
                    'branch' =>  $data['branch'],
                    // 'warehouse' => $data['warehouse'],
                )); //
            } else if (($data['save_as_old'] == 'new') && ($data['save_as'] == 'existing'))
                $productId = $this->incrementStock($data['item_details_id'], $data['quantity']);
            else
                $productId = $this->incrementStock($data['new_product_id'], $data['quantity']);

            $transactionId = $this->updateOrinsertProductTransaction($data['product_transaction_id'], array(
                'product_id' => $productId,
                'desc' => 'from =>' . $from,
                'qty' => $data['quantity'],
                // 'price',
                'branch' => $data['branch'],
            ));

            return array('new_product_id' => $productId, 'transaction_id' => $transactionId);
        }
    }


    public function salesUpdation()
    {
    }

    public function insertOrUpdateProduct($id, $inData)
    {
        $branch_settings = Session::get('branch_settings');
        $branch = Session::get('branch');
        if ($id == '')
            $inData['code'] = $branch_settings->product_sufix . '' . sprintf("%03d", $branch);

        $inserted = ProductdetailslistModel::updateOrCreate(['product_id' => $id], $inData);
        return $inserted->product_id;
    }

    public function incrementStock($id, $incrQty)
    {
        ProductdetailslistModel::where('product_id', $id)->increment('available_stock', $incrQty);
        return $id;
    }
    public function decrementStock($id, $dcrQty)
    {
        ProductdetailslistModel::where('product_id', $id)->decrement('available_stock', $dcrQty);
    }

    public function updateOrinsertProductTransaction($id, $inData)
    {
        $transaction = ProductTransactionModel::updateOrCreate(['id' => $id], $inData);
        return $transaction->id;
    }

    public function deleteProductTransaction($id)
    {
        ProductTransactionModel::where('id', $id)->delete();
    }
}
