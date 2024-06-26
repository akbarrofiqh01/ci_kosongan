<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    function bonus_income()
    {
        $datestart         = date('Y-m-d 00:00:00', now());
        $dateend           = date('Y-m-d 23:59:59', now());

        $this->db->where('pktactive_status', 'active');
        $getttactive = $this->db->get('tb_pktactive');
        foreach ($getttactive->result() as $show) {

            $arraytanggal = json_decode($show->pktactive_datelist);
            if (in_array(date('Y-m-d', strtotime(sekarang())), $arraytanggal)) {
                $walllet    = $this->usermodel->userWallet('withdrawal', $show->pktactive_userid);

                $this->db->where('w_balance_ket', 'income');
                $this->db->where('w_balance_wallet_id', $walllet->wallet_id);
                $this->db->where('w_balance_date_add BETWEEN "' . $datestart .  '" AND "' . $dateend . '"');
                $cekkkk_balance = $this->db->get('tb_wallet_balance');
                if ($cekkkk_balance->num_rows() == 0) {

                    $this->db->insert(
                        'tb_wallet_balance',
                        [
                            'w_balance_wallet_id'       => $walllet->wallet_id,
                            'w_balance_amount'          => $show->pktactive_amount,
                            'w_balance_type'            => 'credit',
                            'w_balance_desc'            => 'Auto Income',
                            'w_balance_date_add'        => sekarang(),
                            'w_balance_txid'            => strtolower(random_string('alnum', 64)),
                            'w_balance_ket'             => 'income',
                        ]
                    );
                }
            } else {
                $this->db->update(
                    'tb_pktactive',
                    [
                        'pktactive_status'  => 'nonactive'
                    ],
                    [
                        'pktactive_code'    => $show->pktactive_code,
                    ]
                );
            }
        }
    }


    function kirimPesan($message = "Hello World", $number = 0)
    {
        
        $userkey = 'b3f16549743b';
        $passkey = '59391aaa7eee4bb7f17cf4c1';
        $telepon = $number;
        $message = str_replace('%20', ' ', $message);
        // $message = 'Hi John Doe, have a nice day.';
        $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $telepon,
            'message' => $message
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);

        echo "<pre>";
        print_r($results);
        echo "</pre>";
    }
}
