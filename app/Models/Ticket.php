<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mercadopago',
        'user_id',
        'status',
        'status_detail',
        'status_product',
        'statement_descriptor',
        'transaction_amount',
        'transaction_amount_refunded',
        'transaction_amount_recibido',
        'coupon_amount',
        'date_created',
        'date_aproved',
        'date_of_expiration',
        'date_entregado',
        'date_entrega_aprox',
        'differential_pricing_id',
        'deduction_schema',
        'money_release_date',
        'money_release_schema',
        'payment_method_id',
        'payment_type_id',
        'payment_description',
        'payment_operation_type',
        'payment_authorization_code',
        'payment_currency_id',
        'payment_method_captured',
        'payment_installments_cuotas',
        'payment_payer_first_name',
        'payment_payer_email',
        'payment_payer_dni',
        'payment_payer_phone_area',
        'payment_payer_phone_number',
        'id_productos',
        'amount_productos',
        'colors_productos',
        'talles_productos',
        'contact',
        'direction',
        'price',
        'detalles',
    ];
    public function Users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
