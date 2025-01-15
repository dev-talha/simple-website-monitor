<?php

$websites = [
    ["url" => "https://www.babps.com/", "class" => "header-logo"],
    ["url" => "https://foara.com/", "class" => "header-logo"],
    ["url" => "https://amucets.com/", "class" => "header-logo"],
];

$pushbulletToken = "o.inXAbVtjmYdAcjzEU8yGCr4BluV4"; // Replace with your Pushbullet token

$pushbulletUrl = "https://api.pushbullet.com/v2/pushes";

// Function to send notification via Pushbullet

function sendPushbulletNotification($title, $message) {
    global $pushbulletToken, $pushbulletUrl;

    $data = [
        "type" => "note",
        "title" => $title,
        "body" => $message
    ];

    $options = [
        "http" => [
            "header" => "Access-Token: " . $pushbulletToken,
            "method" => "POST",
            "content" => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    file_get_contents($pushbulletUrl, false, $context);

}

foreach ($websites as $website) {
    $url = $website['url'];
    $class = $website['class'];

    // Set up a context with a custom user-agent to mimic a browser
    $options = [
        "http" => [
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
        ]
    ];
    $context = stream_context_create($options);

    // Fetch the website content using the custom context
    $html = file_get_contents($url, false, $context);

    if ($html === false) {
        echo "Failed to fetch content from: $url\n";
		 $message = "Failed to fetch content from: $url\n";
			sendPushbulletNotification("Error:", $message);
    } else {
        // Check if the class exists in the HTML content
        if (strpos($html, $class) !== false) {
            echo "Class '$class' found on website: $url\n\n";
        } else {
            echo "Class '$class' not found on website: $url\n";

            // Send Pushbullet notification when class is not found
            $message = "Class '$class' not found on website: $url";
            sendPushbulletNotification("Missing Class Notification", $message);
        }

        echo "<br>";
        echo "\n\n"; // Add a newline for separation between websites
    }
}
?>
