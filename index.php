<?php
/**
 * Advanced URL Auto-Mapping Script
 * Target: life-pulse-site.base44.app
 */

// ১. আপনার মেইন সাইটের লিঙ্ক (শেষে স্লাশ দিবেন না)
$target_domain = "https://life-pulse-site.base44.app";

// ২. বর্তমান ইউআরএল পাথ ডিটেক্ট করা
$request_uri = $_SERVER['REQUEST_URI'];

// ৩. ফুল টার্গেট ইউআরএল তৈরি
// htmlspecialchars ব্যবহার করা হয়েছে যাতে "%3C" এর মতো এরর না আসে
$final_destination = $target_domain . $request_uri;
$safe_url = htmlspecialchars($final_destination, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>BLOOD DONATION  - Live</title>
    <style>
        /* ফুল স্ক্রিন ভিউ সেটআপ */
        body, html { 
            margin: 0; 
            padding: 0; 
            height: 100%; 
            width: 100%; 
            overflow: hidden; 
            background-color: #ffffff;
        }
        
        .main-container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Iframe কে পুরো স্ক্রিন জুড়ে রাখা */
        #content-frame {
            flex-grow: 1;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* মোবাইল অপ্টিমাইজেশন */
        @media only screen and (max-width: 768px) {
            body { position: fixed; } 
        }
    </style>
</head>
<body>

<div class="main-container">
    <iframe 
        src="<?php echo $safe_url; ?>" 
        id="content-frame"
        allow="geolocation; microphone; camera; midi; vr; accelerometer; gyroscope; payment; ambient-light-sensor; encrypted-media; usb" 
        sandbox="allow-forms allow-modals allow-popups allow-presentation allow-same-origin allow-scripts"
        allowfullscreen>
    </iframe>
</div>

<script>
/**
 * ৫. স্মার্ট ব্রাউজার কন্ট্রোল
 */

// ব্যাক বাটন চাপলে সরাসরি গুগল-এ চলে যাবে
(function() {
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        window.location.replace("https://www.google.com"); 
    };
})();

// পেজ টাইটেল অটো আপডেট (ঐচ্ছিক)
// ফ্রেমের ভেতর থেকে টাইটেল নেওয়া অনেক সময় সিকিউরিটির কারণে ব্লক থাকে
// তবে আপনি চাইলে নিজের মতো এখানে টাইটেল সেট করতে পারেন।
console.log("Current Page Loaded: <?php echo $safe_url; ?>");
</script>

</body>
</html>
