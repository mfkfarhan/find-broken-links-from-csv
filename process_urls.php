<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['urls'])) {
    $urls = json_decode($_POST['urls'], true);
    $brokenUrls = [];

    foreach ($urls as $url) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $handle = curl_init($url);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($handle, CURLOPT_NOBODY, TRUE); // remove body
            curl_setopt($handle, CURLOPT_TIMEOUT, 10); //timeout
            
            curl_exec($handle);
            $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            curl_close($handle);

            // Consider all response codes other than 200 (OK) and 403 (Forbidden) as broken
            if ($httpCode !== 200 && $httpCode !== 403) {
                array_push($brokenUrls, ["url" => $url, "status" => $httpCode]);
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($brokenUrls);
}
