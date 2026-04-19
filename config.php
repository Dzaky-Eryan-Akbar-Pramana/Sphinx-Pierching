<?php
// Firebase Configuration
define('FIREBASE_PROJECT_ID', 'projek-sphinx'); // Project ID Firebase
define('FIREBASE_API_KEY', 'AIzaSyBw4w0-uBaeFb2lTwOZLeyHKanHHQaZ1CU'); // API Key Firebase
define('FIREBASE_WEB_API_KEY', 'AIzaSyBw4w0-uBaeFb2lTwOZLeyHKanHHQaZ1CU'); // Web API Key
define('FIREBASE_AUTH_DOMAIN', 'projek-sphinx.firebaseapp.com');
define('FIREBASE_DATABASE_URL', 'https://projek-sphinx-default-rtdb.firebaseio.com');
define('FIREBASE_STORAGE_BUCKET', 'projek-sphinx.firebasestorage.app');
define('FIREBASE_MESSAGING_SENDER_ID', '497460614598');
define('FIREBASE_APP_ID', '1:497460614598:web:68ec7fdfeef07073014ec7');

// Firestore REST API Base URL
define('FIRESTORE_BASE_URL', 'https://firestore.googleapis.com/v1/projects/' . FIREBASE_PROJECT_ID . '/databases/(default)/documents/');
?>