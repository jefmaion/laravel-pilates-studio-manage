<?php

namespace App\Services;


use App\Models\Transaction;

class TransactionService extends BaseService {

    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }

}