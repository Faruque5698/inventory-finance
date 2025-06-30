<?php

namespace App\Traits;

use Illuminate\Foundation\Http\FormRequest;

trait SaleTrait
{
    public function processData(FormRequest $request, $method = 'create')
    {
        $data['sale_date'] = $request->sale_date;
        $data['total_amount'] = $request->total_amount ?? 0;
        $data['discount'] = $request->discount ?? 0;
        $data['vat'] = $request->vat ?? 0;
        $data['paid_amount'] = $request->paid_amount ?? 0;
        $data['due_amount'] =$request->due_amount ?? 0;
        $data['net_amount'] =$request->net_amount ?? 0;
        $data['quantity'] =$request->quantity ?? 0;

        if ($data['due_amount'] <= 0) {
            $data['status'] = 'paid';
        } elseif ($data['paid_amount'] > 0) {
            $data['status'] = 'partially_paid';
        } else {
            $data['status'] = 'due';
        }
        if ($method == 'create') {
            $data['invoice_no'] = generateSequentialUniqueCode('inv', 'sales', 'invoice_no', 5);
        }

        return $data;
    }
}
