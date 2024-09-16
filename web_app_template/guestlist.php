<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .guest {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .guest:nth-child(even) {
            background-color: #f9f9f9;
        }
        .guest .name {
            font-weight: bold;
            color: #007bff;
        }
        .guest .email {
            color: #28a745;
        }
        .guest .country {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Guestlist</h1>
        <?php
        require 'vendor/autoload.php';

        use Aws\DynamoDb\DynamoDbClient;
        use Aws\Exception\AwsException;

        // $awsAccessKeyId = getenv('AWS_ACCESS_KEY_ID');
        // $awsSecretAccessKey = getenv('AWS_SECRET_ACCESS_KEY');

        // Create a DynamoDB client
        $dynamoDb = new DynamoDbClient([
            'region'      => 'us-east-1',
            'version'     => 'latest',
            'credentials' => [
                'key'    => '',
                'secret' => '',
            ]
        ]);

        // Retrieve items from the DynamoDB table
        $tableName = 'GuestBook';

        try {
            $result = $dynamoDb->scan([
                'TableName' => $tableName,
            ]);

            foreach ($result['Items'] as $item) {
                $name = isset($item['Name']['S']) ? $item['Name']['S'] : '';
                $email = isset($item['Email']['S']) ? $item['Email']['S'] : '';
                $country = isset($item['Country']['S']) ? $item['Country']['S'] : '';

                echo '<div class="guest">';
                echo '<p class="name">Name: ' . htmlspecialchars($name) . '</p>';
                echo '<p class="email">Email: ' . htmlspecialchars($email) . '</p>';
                echo '<p class="country">Country: ' . htmlspecialchars($country) . '</p>';
                echo '</div>';
            }
        } catch (AwsException $e) {
            echo '<p>Error retrieving data: ' . $e->getMessage() . '</p>';
        }
        ?>
    </div>
</body>
</html>