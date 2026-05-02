<?php
require_once 'config.php';

class FirebaseFirestore {
    private $projectId;
    private $apiKey;

    public function __construct() {
        $this->projectId = FIREBASE_PROJECT_ID;
        $this->apiKey = FIREBASE_API_KEY;
    }

    // Fungsi untuk menyimpan dokumen ke Firestore
    public function saveDocument($collection, $documentId, $data) {
        $url = FIRESTORE_BASE_URL . $collection . '?documentId=' . urlencode($documentId) . '&key=' . $this->apiKey;

        $jsonData = json_encode(['fields' => $this->convertToFirestoreFields($data)]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($response === false) {
            $curlError = curl_error($ch);
            curl_close($ch);
            return ['error' => 'cURL error: ' . $curlError];
        }
        curl_close($ch);

        if ($httpCode == 200 || $httpCode == 201) {
            return json_decode($response, true);
        } else {
            return ['error' => 'Failed to save document', 'httpCode' => $httpCode, 'response' => $response];
        }
    }

    // Fungsi untuk mengambil satu dokumen dari Firestore
    public function getDocument($collection, $documentId) {
        $url = FIRESTORE_BASE_URL . $collection . '/' . $documentId . '?key=' . $this->apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            $data = json_decode($response, true);
            return $this->convertFromFirestoreFields($data['fields'] ?? []);
        } else {
            return null;
        }
    }

    // Fungsi untuk mengambil semua dokumen dalam satu koleksi
    public function getCollection($collection) {
        $url = FIRESTORE_BASE_URL . $collection . '?key=' . $this->apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            $data = json_decode($response, true);
            $documents = [];
            foreach ($data['documents'] ?? [] as $doc) {
                $docId = basename($doc['name']);
                $documents[$docId] = $this->convertFromFirestoreFields($doc['fields'] ?? []);
            }
            return $documents;
        } else {
            return [];
        }
    }

    // Ubah data PHP ke format field Firestore
    private function convertToFirestoreFields($data) {
        $fields = [];
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $fields[$key] = ['stringValue' => $value];
            } elseif (is_int($value)) {
                $fields[$key] = ['integerValue' => (string)$value];
            } elseif (is_float($value)) {
                $fields[$key] = ['doubleValue' => $value];
            } elseif (is_bool($value)) {
                $fields[$key] = ['booleanValue' => $value];
            } elseif (is_array($value)) {
                $fields[$key] = ['arrayValue' => ['values' => array_map(function($v) {
                    return is_string($v) ? ['stringValue' => $v] : (is_int($v) ? ['integerValue' => (string)$v] : ['stringValue' => json_encode($v)]);
                }, $value)]];
            } else {
                $fields[$key] = ['stringValue' => json_encode($value)];
            }
        }
        return $fields;
    }

    // Ubah format field Firestore kembali ke data PHP biasa
    private function convertFromFirestoreFields($fields) {
        $data = [];
        foreach ($fields as $key => $field) {
            if (isset($field['stringValue'])) {
                $data[$key] = $field['stringValue'];
            } elseif (isset($field['integerValue'])) {
                $data[$key] = (int)$field['integerValue'];
            } elseif (isset($field['doubleValue'])) {
                $data[$key] = (float)$field['doubleValue'];
            } elseif (isset($field['booleanValue'])) {
                $data[$key] = $field['booleanValue'];
            } elseif (isset($field['arrayValue'])) {
                $data[$key] = array_map(function($v) {
                    return $v['stringValue'] ?? $v['integerValue'] ?? json_decode($v['stringValue'] ?? 'null', true);
                }, $field['arrayValue']['values'] ?? []);
            } else {
                $data[$key] = null;
            }
        }
        return $data;
    }
}

// Buat instance Firebase yang siap dipakai
$firestore = new FirebaseFirestore();
?>