# Website error Checker and Pushbullet Notifier

This PHP script checks for the presence of a specified CSS class in the HTML content of multiple websites. If the class is not found, it sends a notification using the Pushbullet API.

---

## Features

1. **Website Monitoring**:
   - Verifies if a specific CSS class exists in the HTML content of the provided websites.
   - Uses a custom user-agent to mimic a browser request.

2. **Error Handling**:
   - Detects and logs failed website content retrieval.

3. **Pushbullet Notifications**:
   - Sends a notification via Pushbullet when the specified CSS class is not found on a website.

---

## Requirements

- PHP installed on your server (version 7.0 or above recommended).
- A valid Pushbullet API token to enable notifications.
- Internet access to fetch website content.

---

## Installation and Setup

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/website-class-checker.git
   cd website-class-checker
