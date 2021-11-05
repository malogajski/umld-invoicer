<?php

namespace App\Enums\Invoices;

use BenSampo\Enum\Enum;


final class InvoiceStatus extends Enum
{
    const CREATED = 'CREATED';
    const SENT = 'SENT';
    const RECEIVED = 'RECEIVED';
    const DRAFT = 'DRAFT';
    const PAID = 'PAID';
    const PARTIALLY_PAID = 'PARTIALLY_PAID';
    const ADVANCE_INVOICE = 'ADVANCE_INVOICE';
    const FINAL_INVOICE = 'INVOICE';
}
