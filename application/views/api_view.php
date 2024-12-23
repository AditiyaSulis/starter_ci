<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Data</title>
</head>
<body>
    <h1>API Data</h1>
    <?php if ($data['status'] === false): ?>
        <p style="color: red;">Failed to fetch data from API. Please try again later.</p>
    <?php elseif (empty($apiData)): ?>
        <p>No data available.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($apiData as $item): ?>
                <li><strong>Title:</strong> <?= htmlspecialchars($item['name']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
