<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\FacturaMailable;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Producto;
use App\Models\Ticket;

class WebhooksController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        if($request->action == 'test.created'){
            Log::debug("Webhook de prueba recibido");
            return;
        }
        
        $id_mercadopago = $request->data_id; // obtenemos el id
        $respuesta = Http::get("https://api.mercadopago.com/v1/payments/$id_mercadopago"."?access_token=".env('MP_ACCESS_TOKEN'));
        $response = json_decode($respuesta);
        Log::debug("Ticket nro: ".$id_mercadopago. " paso por aqui!!");
        

        $user_id = $response->metadata->user_id;
        $status = $response->status;
        $status_detail = $response->status_detail;
        $status_product = "Sin entregar";
        $statement_descriptor = $response->statement_descriptor;
        $transaction_amount = $response->transaction_amount;
        $transaction_amount_refunded = $response->transaction_amount_refunded;
        $transaction_amount_recibido = null;
        $transaction_amount_recibido_object = $response->transaction_details;
        if($transaction_amount_recibido_object != null){
            $transaction_amount_recibido_object = (array)$transaction_amount_recibido_object;
            $transaction_amount_recibido = $transaction_amount_recibido_object['net_received_amount'];
        }
        $coupon_amount = $response->coupon_amount;
        $date_created = $response->date_created;
        $date_approved = $response->date_approved;
        $date_of_expiration = $response->date_of_expiration;
        $date_entregado = "Sin entregar";
        $date_entregado_aprox = "3 dias";
        $differential_pricing_id = $response->differential_pricing_id;
        $deduction_schema = $response->deduction_schema;
        $money_release_date = $response->money_release_date;
        $money_release_schema = $response->money_release_schema;
        $payment_method_id = $response->payment_method_id;
        $payment_type_id = $response->payment_type_id;
        $payment_description = $response->description;
        $payment_operation_type = $response->operation_type;
        $payment_authorization_code =  $response->authorization_code;
        $payment_currency_id = $response->currency_id;
        $payment_method_captured = $response->captured;
        $payment_installments_cuotas = $response->installments;
      

        $payment_payer_first_name = null;
        $payment_payer_email = null;
        $payment_payer_dni = null;
        $payment_payer_phone_area = null;
        $payment_payer_phone_number = null;
        $payment_payer = $response->payer;
        if($payment_payer != null){
            $payment_payer = (array)$payment_payer;
            $payment_payer_first_name = $payment_payer['first_name'];
            $payment_payer_email = $payment_payer['email'];
            $payment_payer_dni = (array)$payment_payer['identification'];
            $payment_payer_dni = $payment_payer_dni['number'];
            $payment_phone = (array)$payment_payer['phone'];
            if($payment_phone != null){
                $payment_payer_phone_area = $payment_phone['area_code'];
                $payment_payer_phone_number = $payment_phone['number'];
            }
        }

        
        $id_productos = $response->metadata->id_productos;
        $amount_productos = $response->metadata->cantidad_productos;
        $colors_productos = $response->metadata->colors;
        $talles_productos = $response->metadata->talles;
        $contact = $response->metadata->telefono;
        $direction = $response->metadata->direccion;
        $price =  $response->metadata->total_precios;
        if($response->metadata->detalles)
            $detalles = $response->metadata->detalles;
        else
            $detalles = "Sin detalles";
        $email = $response->metadata->email;

        $productos = [];
        $cantidad_aux = $amount_productos;
        $Aux = "";
        $cantidades = [];
        for ($i = 0; $i < strlen($cantidad_aux); $i++) {
            if($cantidad_aux[$i] != ' '){
                $Aux .= $cantidad_aux[$i];
                if($i == strlen($cantidad_aux)-1){
                    array_push($cantidades, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($cantidades, $Aux);
                $Aux = "";
            }
        }

        $colores_aux = $colors_productos;
        $Aux = "";
        $colores = [];
        for ($i = 0; $i < strlen($colores_aux); $i++) {
            if($colores_aux[$i] != '|'){
                $Aux .= $colores_aux[$i];
                if($i == strlen($colores_aux)-1){
                    array_push($colores, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($colores, $Aux);
                $Aux = "";
            }
        }
        $talles_aux = $talles_productos;
        $Aux = "";
        $talles = [];
        for ($i = 0; $i < strlen($talles_aux); $i++) {
            if($talles_aux[$i] != '|'){
                $Aux .= $talles_aux[$i];
                if($i == strlen($talles_aux)-1){
                    array_push($talles, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($talles, $Aux);
                $Aux = "";
            }
        }

        $id_productosAux = $id_productos;
        $idAux = "";
        $totalProductos = 0;
        for ($i = 0; $i < strlen($id_productosAux); $i++) {
            if($id_productosAux[$i] != ' '){
                $idAux .= $id_productosAux[$i];
                if($i == strlen($id_productosAux)-1){
                    $prodaux = Producto::findOrFail($idAux);
                    $prodaux->cantidad = $cantidades[$totalProductos];
                    $prodaux->colors = $colores[$totalProductos];
                    $prodaux->talles = $talles[$totalProductos];
                    array_push($productos, $prodaux);
                    $idAux = "";
                }
            }else{
                $prodaux = Producto::findOrFail($idAux);
                $prodaux->cantidad = $cantidades[$totalProductos];
                $prodaux->colors = $colores[$totalProductos];
                $prodaux->talles = $talles[$totalProductos];
                array_push($productos, $prodaux);
                $totalProductos++;
                $idAux = "";
            }
        }
        // tenemos los productos encontrados como queremos

        $correo = new FacturaMailable($productos,$direction,$contact,$detalles);
        Mail::to($email)->send($correo);


        // Ahora creamos el ticket!!

        // CREAMOS EL TICKET
        $ticket = new Ticket();

        $ticket->id_mercadopago = $id_mercadopago;
        $ticket->user_id = $user_id;
        switch($status){
            case 'pending':
                $ticket->status = "El usuario no ha concluido el proceso de pago";
                break;
            case 'approved':
                $ticket->status = "El pago ha sido aprobado y acreditado";
                break;
            case 'authorized':
                $ticket->status = "El pago ha sido autorizado pero aún no capturado";
                break;
            case 'in_process':
                $ticket->status = "El pago esta en proceso";
                break;
            case 'in_mediation':
                $ticket->status = "El usuario inició una disputa";
                break;
            case 'rejected':
                $ticket->status = "El pago fue rechazado (el usuario puede intentar pagar de nuevo)";
                break;
            case 'cancelled':
                $ticket->status = "El pago fue cancelado por una de las partes o venció";
                break;
            case 'refunded':
                $ticket->status = "El pago fue devuelto al usuario";
                break;
            case 'charged_back':
                $ticket->status = "Se realizó un contracargo en la tarjeta de crédito del comprador";
                break;
            default: 
                $ticket->status = $status;
                break;
        }
        switch($status_detail){
            case 'accredited':
                $ticket->status_detail = "El pago ha sido acreditado";
                break;
            case 'pending_contingency':
                $ticket->status_detail = "El pago se está procesando";
                break;
            case 'pending_review_manual':
                $ticket->status_detail = "El pago se encuentra en revisión para determinar su aprobación o rechazo";
                break;
            case 'cc_rejected_bad_filled_date':
                $ticket->status_detail = "Fecha de caducidad incorrecta";
                break;
            case 'cc_rejected_bad_filled_other':
                $ticket->status_detail = "Detalles de tarjeta incorrectos";
                break;
            case 'cc_rejected_bad_filled_security_code':
                $ticket->status_detail = "CVV incorrecto";
                break;
            case 'cc_rejected_blacklist':
                $ticket->status_detail = "La tarjeta está en una lista negra por robo/denuncia/fraude";
                break;
            case 'cc_rejected_call_for_authorize':
                $ticket->status_detail = "El medio de pago requiere autorización previa del monto de la operación";
                break;
            case 'cc_rejected_card_disabled':
                $ticket->status_detail = "La tarjeta está inactiva";
                break;
            case 'cc_rejected_duplicated_payment':
                $ticket->status_detail = "Transacciones duplicadas";
                break;
            case 'cc_rejected_high_risk':
                $ticket->status_detail = "Rechazada por Prevención de Fraude";
                break;
            case 'cc_rejected_insufficient_amount':
                $ticket->status_detail = "Cantidad insuficiente";
                break;
            case 'cc_rejected_invalid_installments':
                $ticket->status_detail = "Número de cuotas no válido";
                break;
            case 'cc_rejected_max_attempts':
                $ticket->status_detail = "Excedió el número máximo de intentos";
                break;
            case 'cc_rejected_other_reason':
                $ticket->status_detail = "Error genérico";
                break;
            case 'pending_waiting_payment':
                $ticket->status_detail = "Esperando a que el pago sea recibido y aprobado";
                break;
            default:
                $ticket->status_detail = $status_detail;
                break;
        }
        $ticket->status_product = $status_product;
        $ticket->statement_descriptor = $statement_descriptor;
        $ticket->transaction_amount = $transaction_amount;
        $ticket->transaction_amount_refunded = $transaction_amount_refunded;
        $ticket->transaction_amount_recibido = $transaction_amount_recibido;
        $ticket->coupon_amount = $coupon_amount;
        $ticket->date_created = $date_created;
        $ticket->date_aproved = $date_approved;
        $ticket->date_of_expiration = $date_of_expiration;
        $ticket->date_entregado = $date_entregado;
        $ticket->date_entrega_aprox = $date_entregado_aprox;
        $ticket->differential_pricing_id = $differential_pricing_id;
        $ticket->deduction_schema = $deduction_schema;
        $ticket->money_release_date = $money_release_date;
        if($money_release_schema == 'payment_in_flow')
            $ticket->money_release_schema = "Pago en cuotas";
        else
            $ticket->money_release_schema = $money_release_schema;
        switch($payment_method_id){
            case 'pix':
                $ticket->payment_method_id = "Método de pago digital instantáneo utilizado en Brasil";
                break;
            case 'account_money':
                $ticket->payment_method_id = "Cuando el pago se debita directamente de una cuenta de Mercado Pago";
                break;
            case 'debin_transfer':
                $ticket->payment_method_id = "Método de pago digital utilizado en Argentina que debita inmediatamente un monto de una cuenta, solicitando autorización previa";
                break;
            case 'ted':
                $ticket->payment_method_id = "Es el pago de Transferencia Electrónica Disponible, utilizado en Brasil, que tiene tarifas para ser utilizado. El pago se realiza el mismo día de la transacción, pero para ello es necesario realizar la transferencia dentro del plazo estipulado";
                break;
            case 'cvu':
                $ticket->payment_method_id = "Método de pago utilizado en Argentina";
                break;
            case 'master':
                $ticket->payment_method_id = "Metodo de pago Mastercard";
                break;
            default: 
                $ticket->payment_method_id = $payment_method_id;
                break;
        }
        switch($payment_type_id){
            case 'account_money':
                $ticket->payment_type_id = "Dinero en la cuenta de Mercado Pago";
                break;
            case 'ticket':
                $ticket->payment_type_id = "Boletos, Caixa Electronica Payment, PayCash y Oxxo, etc";
                break;
            case 'atm':
                $ticket->payment_type_id = "Pago en cajero automático (muy utilizado en México a través de BBVA Bancomer)";
                break;
            case 'credit_card':
                $ticket->payment_type_id = "Pago con tarjeta de crédito";
                break;
            case 'debit_card':
                $ticket->payment_type_id = "Pago con tarjeta de débito";
                break;
            case 'prepaid_card':
                $ticket->payment_type_id = "Pago con tarjeta prepago";
                break;
            case 'digital_currency':
                $ticket->payment_type_id = "Compras con Mercado Crédito";
                break;
            case 'digital_wallet':
                $ticket->payment_type_id = "Paypal";
                break;
            case 'voucher_card':
                $ticket->payment_type_id = "Beneficios Alelo, Sodexo";
                break;
            case 'crypto_transfer':
                $ticket->payment_type_id = "Pago con criptomonedas como Ethereum y Bitcoin";
                break;
            default:
                $ticket->payment_type_id = $payment_type_id;
                break;
        }
        $ticket->payment_description = $payment_description;
        switch ($payment_operation_type) {
            case 'investment':
                $ticket->payment_operation_type = "Pago en inversion";
                break;
            case 'regular_payment':
                $ticket->payment_operation_type = "Tipificación por defecto de una compra siendo pagada a través de Mercado Pago";
                break;
            case 'money_transfer':
                $ticket->payment_operation_type = "Transferencia de fondos entre dos usuarios";
                break;
            case 'recurring_payment':
                $ticket->payment_operation_type = "Debido a una suscripción de usuario activa";
                break;   
            case 'account_fund':
                $ticket->payment_operation_type = "Ingresos de dinero en la cuenta del usuario";
                break;  
            case 'payment_addition':
                $ticket->payment_operation_type = "Mercado Pago";
                break;        
            case 'cellphone_recharge':
                $ticket->payment_operation_type = "Recarga de la cuenta del celular de un usuario";
                break;  
            case 'pos_payment'  :
                $ticket->payment_operation_type = "Pago realizado a través de un Punto de Venta";
                break;  
            case 'money_exchange':
                $ticket->payment_operation_type = "Pago de cambio de moneda para un usuario";
                break;  
            default: 
                $ticket->payment_operation_type = $payment_operation_type;
                break;  
        }
        $ticket->payment_authorization_code = $payment_authorization_code;
        $ticket->payment_currency_id = $payment_currency_id;
        $ticket->payment_method_captured = $payment_method_captured;
        $ticket->payment_installments_cuotas = "Cuotas: ".$payment_installments_cuotas;
        $ticket->payment_payer_first_name = $payment_payer_first_name;
        $ticket->payment_payer_email = $payment_payer_email;
        $ticket->payment_payer_dni = $payment_payer_dni;
        $ticket->payment_payer_phone_area = $payment_payer_phone_area;
        $ticket->payment_payer_phone_number = $payment_payer_phone_number;
        $ticket->id_productos = $id_productos;
        $ticket->amount_productos = $amount_productos;
        $ticket->colors_productos = $colors_productos;
        $ticket->talles_productos = $talles_productos;
        $ticket->contact = $contact;
        $ticket->direction = $direction;
        $ticket->price = $price;
        $ticket->detalles = $detalles;
        $ticket->save(); 
    
        //$pdf = Pdf::loadView('pdf.index', compact('productos'));
        //return $pdf->stream();
        //return $pdf->download('invoice.pdf');
        // para q no lo deje volver hdp

    }
}
