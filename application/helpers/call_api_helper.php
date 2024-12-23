<?php
defined('BASEPATH') or exit('No direct script access allowed');

function call_api($url, $method = 'GET', $data = []) {
  $curl = curl_init();

  $options = [
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
  ];

  // Set metode dan data jika ada
  if ($method == 'POST') {
      $options[CURLOPT_POST] = true;
      $options[CURLOPT_POSTFIELDS] = json_encode($data);
  } elseif ($method == 'PUT') {
      $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
      $options[CURLOPT_POSTFIELDS] = json_encode($data);
  } elseif ($method == 'DELETE') {
      $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
  }

  curl_setopt_array($curl, $options);

  $response = curl_exec($curl);
  $error = curl_error($curl);

  curl_close($curl);

  if ($error) {
      return ['status' => false, 'message' => $error];
  }

  return json_decode($response, true);
}