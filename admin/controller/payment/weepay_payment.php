<?php

error_reporting(0);

class ControllerPaymentWeepayPayment extends Controller
{

    private $error = array();
    private $base_url = "";
    private $order_prefix = "opencart20X_";
    private $module_version = "1.5.0.0";

    public function index()
    {
        $this->language->load('payment/weepay_payment');
        $this->load->model('payment/weepay_payment');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('weepay_payment_', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['text_edit'] = $this->language->get('heading_title');
        $this->data['link_title'] = $this->language->get('text_link');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');

        $this->data['entry_bayiid'] = $this->language->get('entry_bayiid');
        $this->data['entry_api'] = $this->language->get('entry_api');
        $this->data['entry_secret'] = $this->language->get('entry_secret');

        $this->data['entry_installement'] = $this->language->get('entry_installement');

        $this->data['text_tabapi'] = $this->language->get('text_tabapi');
        $this->data['text_tababout'] = $this->language->get('text_tababout');
        $this->data['entry_order_status'] = $this->language->get('entry_order_status');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_threed'] = $this->language->get('entry_threed');
        $this->data['entry_class_responsive'] = $this->language->get('entry_class_responsive');
        $this->data['entry_class_popup'] = $this->language->get('entry_class_popup');
        $this->data['entry_form_type'] = $this->language->get('entry_form_type');
        $this->data['entry_installment_options'] = $this->language->get('entry_installment_options');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_test_mode'] = $this->language->get('entry_test_mode');

        $this->data['entry_form_checkout_type'] = $this->language->get('entry_form_checkout_type');
        $this->data['entry_class_normal'] = $this->language->get('entry_class_normal');
        $this->data['entry_class_onepage'] = $this->language->get('entry_class_onepage');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['order_status_after_payment_tooltip'] = $this->language->get('order_status_after_payment_tooltip');
        $this->data['order_status_after_cancel_tooltip'] = $this->language->get('order_status_after_cancel_tooltip');
        $this->data['entry_test_tooltip'] = $this->language->get('entry_test_tooltip');
        $this->data['entry_cancel_order_status'] = $this->language->get('entry_cancel_order_status');

        $this->data['message'] = '';
        $this->data['error_warning'] = '';
        $this->data['error_version'] = '';

        $error_data_array_key = array(
            'bayiid',
            'api',
            'secret',
        );

        if (isset($this->request->get['update_error'])) {
            $this->data['error_version'] = $this->language->get('entry_error_version_updated');
        } else {
            $this->load->model('payment/weepay_payment');
            $versionCheck = $this->model_payment_weepay_payment->versionCheck(VERSION, $this->module_version);

            if (!empty($versionCheck['version_status']) and $versionCheck['version_status'] == '1') {
                $this->data['error_version'] = $this->language->get('entry_error_version');
                $this->data['weepay_or_text'] = $this->language->get('entry_weepay_or_text');
                $this->data['weepay_update_button'] = $this->language->get('entry_weepay_update_button');
                $version_updatable = $versionCheck['new_version_id'];
                $this->data['version_update_link'] = $this->url->link('payment/weepay_payment/update', 'token=' . $this->session->data['token'] . "&version=$version_updatable", true);
            }
        }

        foreach ($error_data_array_key as $key) {
            $this->data["error_{$key}"] = isset($this->error[$key]) ? $this->error[$key] : '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false,
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: ',
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/weepay_payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: ',
        );

        $this->data['action'] = $this->url->link('payment/weepay_payment', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        $merchant_keys_name_array = array(
            'weepay_payment_bayiid',
            'weepay_payment_api',
            'weepay_payment_secret',
            'weepay_payment_status',
            'weepay_payment_form_type',
            'weepay_payment_order_status_id',
            'weepay_payment_sort_order',
            'weepay_payment_installement',
            'weepay_payment_test_mode',
            'weepay_payment_cancel_order_status_id',
        );

        foreach ($merchant_keys_name_array as $key) {
            $this->data[$key] = isset($this->request->post[$key]) ? $this->request->post[$key] : $this->config->get($key);
        }

        $this->load->model('localisation/order_status');
        if ($data['weepay_payment_order_status_id'] == '') {
            $data['weepay_payment_order_status_id'] = $this->config->get('config_order_status_id');
        }
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $this->template = 'payment/weepay_payment.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
        $this->response->setOutput($this->render());
    }

    public function install()
    {
        $this->load->model('payment/weepay_payment');
        $this->model_payment_weepay_payment->install();

    }

    public function uninstall()
    {
        $this->load->model('payment/weepay_payment');
        $this->model_payment_weepay_payment->uninstall();

    }

    public function update()
    {
        $this->load->model('payment/weepay_payment');
        $this->load->language('payment/weepay_payment');
        $version_updatable = $this->request->get['version'];
        $updated = $this->model_payment_weepay_payment->update($version_updatable);
        if ($updated == 1) {
            $this->session->data['success'] = $this->language->get('text_success');
            $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        } else {
            $this->redirect($this->url->link('payment/weepay_payment', 'token=' . $this->session->data['token'] . "&update_error=$updated", 'SSL'));
        }
    }

    public function orderAction()
    {
        $this->language->load('payment/weepay_payment');
        $language_id = (int) $this->config->get('config_language_id');
        $this->data = array();
        $order_id = (int) $this->request->get['order_id'];
        $this->data['token'] = $this->request->get['token'];
        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['text_DealerPaymentId'] = $this->language->get('text_DealerPaymentId');
        $this->data['text_sepet_total'] = $this->language->get('text_sepet_total');
        $this->data['text_odenen'] = $this->language->get('text_odenen');
        $this->data['text_komisyon'] = $this->language->get('text_komisyon');
        $this->data['text_taksit_sayi'] = $this->language->get("text_taksit_sayi");
        $this->data['text_creditcart'] = $this->language->get('text_creditcart');
        $this->data['text_rescode'] = $this->language->get('text_rescode');

        $bayiid = $this->config->get('weepay_payment_bayiid');
        $api = $this->config->get('weepay_payment_api');
        $secret = $this->config->get('weepay_payment_secret');

        $weepayArray = array();

        $weepayArray['Aut'] = array(
            'bayi-id' => $bayiid,
            'api-key' => $api,
            'secret-key' => $secret,
        );
        $weepayArray['Data'] = array(
            'OrderID' => $order_id,
        );

        $weepayEndPoint = "https://api.weepay.co/Payment/GetPaymentDetail";
        $result = json_decode($this->curlPostExt(json_encode($weepayArray), $weepayEndPoint, true));

        $this->data['DealerPaymentId'] = $result->Data->PaymentDetail->DealerPaymentId;
        $this->data['sepet_total'] = $result->Data->PaymentDetail->Amount;

        $this->data['komisyon'] = $result->Data->PaymentDetail->DealerCommissionAmount;
        $this->data['taksit_sayi'] = $result->Data->PaymentDetail->InstallmentNumber;
        $this->data['creditcart'] = $result->Data->PaymentDetail->CardNumberFirstSix . 'XXX' . $result->Data->PaymentDetail->CardNumberLastFour . ' - ' . $result->Data->PaymentDetail->CardHolderFullName;
        $this->data['rescode'] = $result->Data->ResultCode . " - " . $result->Data->PaymentTrxDetailList[0]->ResultMessage;
        $this->template = 'payment/weepay_order.tpl';

        $this->response->setOutput($this->render());
    }

    private function curlPostExt($data, $url, $json = false)
    {
        $ch = curl_init(); // initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $url); // set url to post to
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
        if ($json) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // times out after 4s
        curl_setopt($ch, CURLOPT_POST, 1); // set POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // add POST fields
        if ($result = curl_exec($ch)) { // run the whole process
            curl_close($ch);

            return $result;
        }
    }

    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'payment/weepay_payment')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $validation_array = array(
            'bayiid',
            'api',
            'secret',
        );

        foreach ($validation_array as $key) {
            if (empty($this->request->post["weepay_payment_{$key}"])) {
                $this->error[$key] = $this->language->get("error_$key");
            }
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    private function _addhistory($order_id, $order_status_id, $comment)
    {

        $this->load->model('sale/order');
        $this->model_sale_order->addOrderHistory($order_id, array(
            'order_status_id' => $order_status_id,
            'notify' => 1,
            'comment' => $comment,
        ));

        return true;
    }

}
