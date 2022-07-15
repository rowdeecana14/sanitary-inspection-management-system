<?php

namespace App\Controller;
use App\Controller\BaseController;
use App\Model\Settings\UserModel;
use App\Model\PaymentModel;
use App\Model\BusinessPermitModel;
use App\Model\SanitaryPermitModel;
use App\Model\MedicalCertificateModel;
use App\Model\ExhumationCertificateModel;
use App\Model\TransferCadaverModel;
use App\Helper\Helper;

class ReportController extends BaseController {

   public function generate($request) {
      $data = [];
      $title = "All payments";
      $date_from = explode('/', $request->date_from);
      $date_end = explode('/', $request->date_end);

      $date = [
         'from' =>  $date_from[2].'-'.$date_from[0].'-'.$date_from[1],
         'end' =>  $date_end[2].'-'.$date_end[0].'-'.$date_end[1],
      ];

      if($request->types == "all") {
         $model = new PaymentModel;
      }
      else  if($request->types == "business") {
         $model = new BusinessPermitModel;
         $title = "Business Permits";
      }
      else  if($request->types == "sanitary") {
         $model = new SanitaryPermitModel;
         $title = "Sanitary Permits";
      }
      else  if($request->types == "medical") {
         $model = new MedicalCertificateModel;
         $title = "Medical Certificates";
      }
      else  if($request->types == "exhumation") {
         $model = new ExhumationCertificateModel;
         $title = "Exhumation Certificates";
      }
      else  if($request->types == "transfer") {
         $model = new TransferCadaverModel;
         $title = "Transfer Cadaver";
      }

      $data = $model->reports($date);
      $result = [];

      foreach($data as $index => $payment) {
         array_push($result, [
               'index' => $index + 1,
               'or_no' => $payment['or_no'],
               'amount' => number_format($payment['amount'], 2) ,
               'paid_at' => Helper::humanDate('M d, Y', $payment['paid_at']),
         ]);
      }

      return [
         "success" => true,
         "message" => "success",
         "data" =>[
            "payments" => $result,
            "title" => $title,
         ]
     ];
   }
}
?>